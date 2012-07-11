<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Blog_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->language = whichLanguage();
		$this->table 	= "blog";
		$this->fields   = "ID_Post, ID_User, Title, Slug, Content, Tags, Author, Start_Date, Year, Month, Day, Views, Image_Small, Image_Medium, Comments, Enable_Comments, Language, Pwd";

		$this->Data = $this->core("Data");

		$this->Data->table($this->table);
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit) {	
		if(!$trash) { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, "ID_Post, Title, Author, Views, Language, Situation", NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, "ID_Post, Title, Author, Views, Language, Situation", NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, "ID_Post, Title, Author, Views, Language, Situation", NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, "ID_Post, Title, Author, Views, Language, Situation", NULL, $order, $limit);
		}
	}
	
	private function editOrSave($action) {
		$validations = array(
			"exists"  => array(
				"Slug" 	   => slug(POST("title", "clean")), 
				"Year"	   => date("Y"),
				"Month"	   => date("m"),
				"Day"	   => date("d"),
				"Language" => POST("language")
			),
			"title"   => "required",
			"content" => "required"
		);
		 
		$this->URL        = path("blog/". date("Y")) ."/". date("m") ."/". date("d") ."/". slug(POST("title", "clean"));
		$this->muralExist = POST("mural_exist");
		
		$this->helper(array("alerts", "time", "files"));

		$this->Files = $this->core("Files");
		
		$this->mural = FILES("mural");
		
		if($this->mural["name"] !== "") {
			$dir = "www/lib/files/images/mural/";

			$this->mural = $this->Files->uploadImage($dir, "mural", "mural");
		
			if(is_array($this->mural)) {
				return $this->mural["alert"];
			}
		}
		
		$dir = "www/lib/files/images/blog/";
		
		$this->image = $this->Files->uploadImage($dir, "image", "resize", TRUE, TRUE, FALSE);

		$data = array(
			"ID_User"      => SESSION("ZanUserID"),
			"Slug"         => slug(POST("title", "clean")),
			"Content"      => POST("content", "clean"),
			"Author"       => SESSION("ZanUser"),
			"Year"	       => date("Y"),
			"Month"	       => date("m"),
			"Day"	       => date("d"),
			"Image_Small"  => isset($this->image["small"])  ? $this->image["small"]  : NULL,
			"Image_Medium" => isset($this->image["medium"]) ? $this->image["medium"] : NULL,
			"Pwd"	       => (POST("pwd")) ? POST("pwd", "encrypt") : NULL,
			"Start_Date"   => now(4),
			"Text_Date"    => now(2),
			"Tags"		   => POST("tags")
		);
	
		$this->Data->ignore(array("categories", "tags", "mural_exists", "mural", "pwd", "category", "language_category", "application", "mural_exist"));

		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {			
		$insertID = $this->Db->insert($this->table, $this->data);
		
		if(isset($this->mural["name"]) and $this->mural["name"] !== "") {			
			$this->Db->insert("mural", array("ID_Post" => $insertID2, "Title" => POST("title"), "URL" => $this->URL, "Image" => $this->mural));
		}
	
		if(SESSION("ZanUserMethod") === "twitter") {
			$this->Twitter_Model = $this->model("Twitter_Model");
				
			$this->Twitter_Model->publish('"'. $this->title .'"', $this->URL);
		}
			
		return getAlert(__(_("The post has been saved correctly")), "success", $this->URL);
	}
	
	private function edit() {	
		$this->Db->update($this->table, $this->data, POST("ID"));				
			
		if(!is_array($this->mural) and !$this->muralExist) {
			$values = array(
				"ID_Post" => POST("ID"),
				"Title"	  => $this->data["Title"],
				"URL"	  => $this->URL, 
				"Image"	  => $this->mural
			);
		
			$this->Db->insert("mural", $values);	
		} elseif(!is_array($this->mural) and $this->muralExist) {
			unlink($this->muralExist);
						
			$this->Db->deleteBy("ID_Post", POST("ID"), "mural");
			
			$values = array(
				"ID_Post" => POST("ID"),
				"Title"	  => $this->title,
				"URL"	  => $this->URL, 
				"Image"	  => $this->mural
			);
			
			$this->Db->insert("mural", $values);	
		}
		
		return getAlert(__(_("The post has been edited correctly")), "success", $this->URL);
	}
	
	private function search($search, $field) {
		if($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);	      
		} else {
			return FALSE;
		}
	}
	
	public function count($type = "posts") {					
		$year  = isYear(segment(1,  isLang())) ? segment(1, isLang()) : FALSE;
		$month = isMonth(segment(2, isLang())) ? segment(2, isLang()) : FALSE;
		$day   = isDay(segment(3,   isLang())) ? segment(3, isLang()) : FALSE;

		if($type === "posts") {									
			if($year and $month and $day) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Day = '$day' AND Situation = 'Active'", $this->table);
			} elseif($year and $month) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Situation = 'Active'", $this->table);
			} elseif($year) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Situation = 'Active'", $this->table);
			} else {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table);
			}
		} elseif($type === "comments") {
			$count = 0;
		} elseif($type === "tag") {
			$data = $this->getByTag(segment(2, isLang()));
			
			$count = count($data);
		}
		
		return isset($count) ? $count : 0;
	}
	
	public function getArchive() {				
		$data = $this->Db->findFirst($this->table, "Year, Month");
		
		if($data) {
			$date["year"]  = $data[0]["Year"];
			$date["month"] = $data[0]["Month"];
			
			return $date;
		} else {
			return FALSE;
		}
	}
	
	public function getMural($limit) {		
		$data = $this->Db->findAll("mural", "Title, URL, Image", NULL, "ID_Post DESC", $limit);
		
		return $data;
	}
	
	public function getMuralByID($ID_Post) {				
		$data = $this->Db->findBy("ID_Post", $ID_Post, "mural", "Title, URL, Image");
	
		return $data;
	}
	
	
	public function getPosts($limit) {	
		return $this->Db->findBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Post DESC", $limit);
	}
	
	public function getPost($year, $month, $day, $slug) {		
		$post = $this->Db->findBySQL("Slug = '$slug' AND Year = '$year' AND Month = '$month' AND Day = '$day' AND Situation = 'Active'", $this->table, $this->fields);
		
		if($post) {						
			$this->Db->updateBySQL("blog", "Views = (Views) + 1", $post[0]["ID_Post"]);				
			
			$this->Comments_Model = $this->model("Comments_Model");
			
			$comments = $this->Comments_Model->getCommentsByRecord(3, $post[0]["ID_Post"]);
		
			$data[0]["post"]     = $post;
			$data[0]["comments"] = $comments;
									
			return $data;
		}		
		
		return FALSE;
	}
	
	public function getByDate($limit, $year = FALSE, $month = FALSE, $day = FALSE) {		
		if($year and $month and $day) {
			return $this->Db->findBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Day = '$day' AND Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Post DESC", $limit);
		} elseif($year and $month) {
			return $this->Db->findBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Post DESC", $limit);
		} elseif($year) {
			return $this->Db->findBySQL("Language = '$this->language' AND Year = '$year' AND Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Post DESC", $limit);
		}	
	}
	
	public function getByID($ID) {			
		return $this->Db->find($ID, $this->table, $this->fields);
	}
	
	public function getByTag($tag, $limit = FALSE) {
		$data = $this->Db->findBySQL("(Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Language = '$this->language' AND Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Post DESC", $limit);
		
		return $data;
	}
	
	public function deleteMural() {
		$this->ID_Post = POST("ID_Post");
		$this->mural   = POST("muralExist");
	
		unlink($this->mural);
					
		$this->Db->deleteBy("ID_Post", $this->ID_Post, "mural");
	}
	
	public function removePassword($ID) {
		$this->Db->update($this->table, array("Pwd" => ""), $ID);		
	}
	
}