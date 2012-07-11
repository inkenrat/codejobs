<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class CPanel_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();

		$this->Users_Model = $this->model("Users_Model");

		$this->Email = $this->core("Email");
		
		$this->Email->setLibrary("PHPMailer");
		
		$this->Email->fromName  = get("webName");
		$this->Email->fromEmail = get("webEmailSend");
						
		$this->application = whichApplication();
	}
	
	public function delete($ID) {
		if(!is_array($ID)) {	
			if($this->application === "users" and SESSION("ZanUserID") === $ID) {
				return FALSE;	
			} 

			$data = $this->Db->find($ID, $this->application);
			
			if($data[0]["Situation"] === "Deleted") {
				$this->Db->delete($ID, $this->application);
				
				$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
				
				if($count > 0) {
					return TRUE;
				}
			}

			return FALSE;
		} else {
			for($i = 0; $i <= count($ID) - 1; $i++) {
				$data = $this->Db->find($ID, $this->application);

				if($data[0]["Situation"] === "Deleted") {
					$this->Db->delete($ID[$i], $this->application);
				}
			}
			
			$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
			
			if($count > 0) {
				return TRUE;
			}
			
			return FALSE;			
		}
	}

	public function deletedRecords($table) {
		if(SESSION("ZanUserPrivilegeID") === 1) {
			return $this->Db->countBySQL("Situation = 'Deleted'", $table);
		} else {
			return	$this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $table);	
		}
	}
	
	public function home($application) {
		if($application === "users") {
			$fields = "Username";
		} elseif($application === "blog") {
			$fields = "Title, Slug, Year, Month, Day, Language";
		} elseif($application === "pages") {
			$fields = "Title, Slug, Language";
		} elseif($application === "bookmarks") {
			$fields = "ID_Bookmark, Title, Slug, Language";
		}

		$data = $this->Db->findAll($application, $fields, NULL, "DESC", _maxLimit);

		if($data) {
			$i = 1;	
							
			foreach($data as $record) {
				switch($application) {
					case "pages":
						$list[] = li(a(getLanguage($record["Language"], TRUE) ." $i. ". $record["Title"], path("pages/". $record["Slug"]), $record["Title"], TRUE));
					break;

					case "blog":
						$URL = path("blog/". $record["Year"] ."/". $record["Month"] ."/". $record["Day"] ."/". $record["Slug"]);

						$list[] = li(a(getLanguage($record["Language"], TRUE) .' '. $i .'. '. $record["Title"], $URL , $record["Title"], TRUE));	
					break;
					
					case "bookmarks":
						$list[] = li(a(getLanguage($record["Language"], TRUE) .' '. $i .". ". $record["Title"], path("bookmarks/go/". $record["ID_Bookmark"] ."/". $record["Slug"]), $record["Title"], TRUE));
					break;

					case "users":
						$list[] = li(a($i .". ". $record["Username"], path("users/". $record["Username"]), $record["Username"], TRUE));
					break;
				}
				
				$i++;
			}
		} else {
			$list = "<p>&nbsp&nbsp&nbsp". __(_("There are no new records")) ."</p>";
		}

		return $list;
	}
	
	public function getPagination($trash = FALSE) {
		$primaryKey = $this->Db->table($this->application);	
		
		$application = whichApplication();

		$start = 0;
		
		if($trash) {	
			$start = (segment(4, isLang()) === "page" and segment(5, isLang()) > 0) ? (segment(5, isLang()) * _maxLimit) - _maxLimit : 0;
		} else {
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;	
		}	

		$limit = $start .", ". _maxLimit;			
		
		if(POST("seek")) {
			if(POST("field") === "ID") {
				if(SESSION("ZanUserPrivilegeID") === 1) {
					$count = $this->Db->countBySQL("$primaryKey = '". POST("search") ."' AND Situation != 'Deleted'", $this->application);
				} else {
					$query = "ID_User = '". SESSION("ZanUserID") ."' AND $primaryKey = '". POST("search") ."' AND Situation != 'Deleted'";

					$count = $this->Db->countBySQL($query, $this->application);
				}
			} else {
				if(SESSION("ZanUserPrivilegeID") === 1) {
					$count = $this->Db->countBySQL("". POST("field") ." LIKE '%". POST("search") ."%' AND Situation != 'Deleted'", $this->application);
				} else {
					$query = "ID_User = '". SESSION("ZanUserID") ."' AND ". POST("field") ." LIKE '%". POST("search") ."%' AND Situation != 'Deleted'";

					$count = $this->Db->countBySQL($query, $this->application);						
				}
			}
		} elseif(!$trash) {
			if(SESSION("ZanUserPrivilegeID") === 1) {
				$count = $this->Db->countBySQL("Situation != 'Deleted'", $this->application);
			} else {
				$count = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->application);
			}
			
			$URL = path("$application/cpanel/results/page/");
		} else {
			if(SESSION("ZanUserPrivilegeID") === 1) {
				$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
			} else {
				$count = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->application);
			}
			
			$URL = path("$application/cpanel/results/trash/page/");
		}

		$this->helper("pagination");
					
		$pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;				
		
		return $pagination;		
	}
	
	public function records($trash = FALSE, $order = NULL) {
		$application = segment(0, isLang());
		$Model = ucfirst(segment(0, isLang())) ."_Model";

		$this->$Model = $this->model($Model);
		
		if(isset($this->$Model)) {
			if(POST("seek")) {
				$data = $this->$Model->cpanel("search", NULL, POST("field") ." ". POST("order"), POST("search"), POST("field"));
				
				if(!$data) {
					showAlert("Results not found", path(whichApplication() ."/cpanel/results"));
				}
			} else {
				$start = 0;
				
				if($trash) {		
					$start = (segment(4, isLang()) === "page" and segment(5, isLang()) > 0) ? (segment(5, isLang()) * _maxLimit) - _maxLimit : 0;
				} else {	 
					$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
				}			

				$limit = $start .", ". _maxLimit;
				
				if(segment(3, isLang()) === "order") {
					$i = (segment(4)) ? 3 : 4; 
					$j = (segment(4)) ? 4 : 5;
					
					if(segment($i) === "id") {
						$field = "ID";
					} elseif(segment($i) === "end-date") {
						$field = "End_Date";
					} elseif(segment($i) === "start-date") {
						$field = "Start_Date";
					} elseif(segment($i) === "text-date") {
						$field = "Text_Date";
					} else {
						$field = ucfirst(segment($i));
					}
					
					if(segment($j) === "asc") {		
						$data = $this->$Model->cpanel("all", $limit, "$field ASC", NULL, NULL, $trash);
					} elseif(segment($j) === "desc") {
						$data = $this->$Model->cpanel("all", $limit, "$field DESC", NULL, NULL, $trash);
					}
				} else {
					$data = $this->$Model->cpanel("all", $limit, $order, NULL, NULL, $trash);
				}
			}

			if($data) {
				return $data;
			} else {
				redirect(path("$application/cpanel/add"));
			}
		}
		
		return FALSE;
	}
	
	public function restore($ID) {		
		if(!is_array($ID)) {
			$this->Db->update($this->application, array("Situation" => "Active"), $ID);
			
			$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
			
			return ($count > 0) ? TRUE : FALSE;
		} else {
			for($i = 0; $i <= count($ID) - 1; $i++) {
				$this->Db->update($this->application, array("Situation" => "Active"), $ID[$i]);
			}	
					
			$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
			
			return ($count > 0) ? TRUE : FALSE;		
		}
	}
	
	public function thead($positions, $trash = FALSE) {
		$positions = str_replace(", ", ",", $positions);
		$parts     = explode(",", $positions);
		
		if(count($parts) > 0) {
			for($i = 0; $i <= count($parts) - 1; $i++) {
				if($parts[$i] != "checkbox") {					
					if($parts[$i] === "Action") {
						$thead[$i] = __(_($parts[$i]));
					} else {
						$thead[$i] = __(_($parts[$i]));
					}
				} else {
					$thead[$i] = NULL;	
				}
			}
		} else {
			$thead[0] = __(_($positions));	
		}
		
		$return = $thead;
		
		unset($thead);
		
		return $return;
	}
	
	public function total($trash = FALSE, $singular = "record", $plural = "records", $comments = FALSE) {		
		$primaryKey = $this->Db->table($this->application);
		
		if(POST("seek")) {
			if(POST("field") === "ID") {
				if(SESSION("ZanUserPrivilegeID") === 1) {
					$total = $this->Db->countBySQL("$primaryKey = '". POST("search") ."'", $this->application);
				} else {
					$total = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND $primaryKey = '". POST("search") ."'", $this->application);
				}
			} else {
				if(SESSION("ZanUserPrivilegeID") === 1) {
					$total = $this->Db->countBySQL("". POST("field") ." LIKE '%". POST("search") ."%'", $this->application);
				} else {
					$total = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ". POST("field") ." LIKE '%". POST("search") ."%'", $this->application);
				}
			}
			
			if($total === 0) {
				$total = "0 ". __(_("Records founded"));
			} elseif($total === 1) {
				$total = "1 ". __(_("Record found"));
			} else {
				$total = $total . " " .__(_("Records founded"));	
			}
			
			return $total;
		} elseif(!$trash) { 
			if(SESSION("ZanUserPrivilegeID") === 1) {
				$total = $this->Db->countBySQL("Situation != 'Deleted'", $this->application);
			} else {
				$total = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->application);
			}
		} else {
			if(SESSION("ZanUserPrivilegeID") === 1) {
				$total = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
			} else {
				$total = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->application);
			}
		}
		 
		if($comments) {
			if(whichApplication() === "blog") {
				$total = $this->Db->countBySQL("ID_Application = '3'", "comments");
			}
		}
		
		if($total === 0) {
			$total = "0 " . __(_($plural));
		} elseif((int) $total === 1) { 
			$total = "1 " . __(_($singular));
		} else { 
			$total = $total . " " . __(_($plural));
		}
		
		return $total;
	}
	
	public function trash($ID) {
		if($this->application === "users" and SESSION("ZanUserID") === $ID) {
			return TRUE;	
		}

		$data = array("Situation" => "Deleted");
		
		if(!is_array($ID)) {
			$this->Db->update($this->application, $data, $ID);
			
			$count = $this->Db->countBySQL("Situation = 'Active'", $this->application);
			
			return ($count > 0) ? TRUE : FALSE;
		} else {
			for($i = 0; $i <= count($ID) - 1; $i++) {
				$this->Db->update($this->application, $data, $ID[$i]);
			}
			
			$count = $this->Db->countBySQL("Situation = 'Active'", $this->application);
			
			return ($count > 0) ? TRUE : FALSE;
		}
	}
	
	public function validate($ID) {
		$data = array("Situation" => "Active");
		
		if(!is_array($ID)) {
			$this->Db->update($this->application, $data, $ID);
			
			$count = $this->Db->countBySQL("Situation = 'Inactive'", $this->application);
			
			return ($count > 0) ? TRUE : FALSE;
		} else {
			for($i = 0; $i <= count($ID) -1; $i++) {
				$this->Db->update($this->application, $data, $ID[$i]);
			}
			
			$count = $this->Db->countBySQL("Situation = 'Inactive'", $this->application);
			
			return ($count > 0) ? TRUE : FALSE;
		}
	}
}