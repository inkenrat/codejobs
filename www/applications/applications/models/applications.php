<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Applications_Model extends ZP_Model {
		
	public function __construct() {
		$this->Db = $this->db();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		
		$this->Users_Model  = $this->model("Users_Model");
		
		$this->table = "applications";
	}
		
	public function getList() {		
		$this->Db->select("ID_Application, Title, CPanel, Adding, BeDefault, Comments, Situation");

		$data = $this->Db->findAll($this->table);

		$list  = NULL;		
		
		if($data) { 
			$this->helper(array("array", "html"));

			foreach($data as $application) { 
				if($application["Situation"] === "Active") {
					if($application["CPanel"]) {
						$title = __(_($application["Title"]));
						
						if($this->Users_Model->isAllow("view", $application["Title"])) {	
							if($application["Slug"] === "configuration") {
								$list[]["item"] = span("bold", a($title, path($application["Slug"] . _sh . "cpanel" . _sh . "edit")));															
							} else {
								$list[]["item"] = span("bold", a($title, path($application["Slug"] . _sh . "cpanel" . _sh . "results")));
							}
							
							$list[count($list) - 1]["Class"] = FALSE;								
									
							if($application["Adding"]) {
								$adding = __(_("Add"));
								
								$li[0]["item"] = a($adding, path($application["Slug"] . _sh . "cpanel" . _sh . "add"));
								
								$i = count($list);			
														
								$list[$i]["item"]  = openUl();							
								
								$count = $this->CPanel_Model->deletedRecords($application["Slug"]);		
											
								if($count > 0) {	
									$span  = span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;");
									$span .= span("bold italic blue", __(_("Trash")) ." ($count)");
									
									$li[$i]["item"] = a($span, path($application["Slug"] ."/cpanel/results/trash", FALSE, array("title" => __(_("In trash")) .": ". $count)));
									
									$i = count($list) - 1;
									
									$list[$i]["item"] .= li($li);
									
									unset($li);	
								} else {
									$list[$i]["item"] .= li($li);
								}
															
								$list[$i]["item"] .= closeUl();
								$list[$i]["class"] = "no-list-style";	
									
								unset($li);								
							}																																		
						}
					}							
				}
			}
		}
		
		return $list;		
	}	
			
	public function getApplication($ID) {
		$this->Db->select("ID_Application, Title, CPanel, Adding, BeDefault, Comments, Situation");

		$application = $this->Db->find($ID, $this->table);
	
		return $application[0]["Title"];
	}
	
	public function getID($title) {		
		$this->Db->select("ID_Application");

		$applications = $this->Db->findBy("Title", $title, $this->table);

		return (is_array($applications)) ? $applications[0]["ID_Application"] : FALSE;
	}	
	
	public function getApplications() {
		$this->Db->select("ID_Application, Title, CPanel, Adding, BeDefault, Comments, Situation");

		return $this->Db->findBy("Situation", "Active", $this->table);
	}
	
	public function getDefaultApplications($default = FALSE) {	
		$this->Db->select("Title, Slug");

		$applications = $this->Db->findBySQL("BeDefault = 1 AND Situation = 'Active'", $this->table);
		
		$i = 0;
		
		foreach($applications as $application) {
			if($application["Slug"] === $default) {
				$options[$i]["value"]    = $application["Slug"];
				$options[$i]["option"]   = $application["Title"];
				$options[$i]["selected"] = TRUE;
			} else {
				$options[$i]["value"]    = $application["Slug"];
				$options[$i]["option"]   = $application["Title"];
				$options[$i]["selected"] = FALSE;
			}
				
			$i++;
		}
				
		return $options;		
	}	
	
	public function getByID($ID) {		
		$this->Db->select("ID_Application, Title, CPanel, Adding, BeDefault, Comments, Situation");

		return $this->Db->find($ID, $this->table);
	}
}