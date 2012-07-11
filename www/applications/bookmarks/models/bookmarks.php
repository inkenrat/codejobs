<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Bookmarks_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->table  = "bookmarks";
		$this->fields = "ID_Bookmark, Title, Slug, URL, Description, Tags, Author, Views, Likes, Dislikes, Reported, Language, Start_Date, Situation";

		$this->Data = $this->core("Data");
		$this->Data->table("bookmarks");

		$this->helper("alerts");
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Link DESC", $search = NULL, $field = NULL, $trash = FALSE) {		
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
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
		$fields = "ID_Bookmark, ID_User, Title, URL, Author, Views, Reported, Language, Start_Date, Situation";

		if(!$trash) {			
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $fields, NULL, $order, $limit);
		} else {	
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $fields, NULL, $order, $limit) 	   : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $fields, NULL, $order, $limit);	
		}				
	}
	
	private function editOrSave() {
		$validations = array(
			"exists"  => array(
				"URL" => POST("URL")
			),
			"title" 	  => "required",
			"URL"   	  => "ping",
			"description" => "required"
		);

		$this->helper("time");

		$data = array(
			"ID_User" 	 => SESSION("ZanUserID"),
			"Author"  	 => SESSION("ZanUser"),
			"Slug"    	 => slug(POST("title", "clean")),
			"Start_Date" => now(4)
		);
				
		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function add() {
		$error = $this->editOrSave();

		if($error) {
			return $error;
		}
		
		$this->data["Situation"] = "Pending";

		$lastID = $this->Db->insert($this->table, $this->data);

		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setCredits(1, 2, 10, $lastID);
		
		if($lastID) {
			return getAlert(__("The bookmark has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}
	
	private function save() {
		if($this->Db->insert($this->table, $this->data)) {
			return getAlert(__("The bookmark has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}
	
	private function edit() {
		$this->Db->update($this->table, $this->data, POST("ID"));
		
		return getAlert("The link has been edit correctly", "success");
	}

	public function count($tag = NULL) {
		return (is_null($tag)) ? $this->Db->countBySQL("Situation = 'Active'", $this->table) : $this->Db->countBySQL("Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%' AND Situation = 'Active'", $this->table);
	}

	public function getByTag($tag, $limit) {
		return $this->Db->findBySQL("Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%' AND Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Bookmark DESC", $limit);
	}
	
	public function getByID($ID) {
		return $this->Db->find($ID, $this->table, $this->fields);
	}
	
	public function getAll($limit) {		
		$data = $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Bookmark DESC", $limit);
		
		return $data;
	}

	public function updateViews($bookmarkID) {
		return $this->Db->updateBySQL($this->table, "Views = (Views) + 1 WHERE ID_Bookmark = '$bookmarkID'");
	}

	public function setReport($ID) {
		if($this->Db->find($ID, "bookmarks")) {
			$this->Db->updateBySQL("bookmarks", "Reported = (Reported) + 1 WHERE ID_Bookmark = '$ID'");

			showAlert(__(_("Thanks for reporting this bookmark")), path("bookmarks/go/$ID"));
		} else {
			redirect();
		}
	}

}