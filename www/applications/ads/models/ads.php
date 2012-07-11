<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Ads_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
			
		$this->table  = "ads";
		$this->fields = "ID_Ad, Title, Position, Banner, URL, Code, Time, Principal, Situation";
		
		$this->Data = $this->core("Data");
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
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, NULL, $order, $limit)      : $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND Situation = 'Deleted'", $this->table, $this->fields, NULL, $order, $limit);	
		}	
	}
	
	private function editOrSave($action) {
		$validations = array(
			"title" => "required",
			"URL"   => "ping"
		);

		if(POST("code")) {
			unset($validations["URL"]);
		}

		$this->helper(array("alerts", "time", "files"));

		$data = array(
			"ID_User"    => SESSION("ZanUserID"),
			"Start_Date" => now(4),
			"End_Date"   => now(4) + 2419200
		);

		if($action === "edit") {
			$this->Data->ignore("banner");
		}

		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}

		if(FILES("image", "name")) {
			if(POST("banner")) {
				@unlink(POST("banner"));
			}
			
			$dir = "www/lib/files/images/ads/";
			
			$this->Files = $this->core("Files");										
			
			$this->data["Banner"] = $this->Files->uploadImage($dir, "image", "normal");
			
			if(!$this->data["Banner"]) {
				return getAlert(__(_("Upload error"))); 
			}
		} else {
			if(!isset($this->data["Code"])) {
				return getAlert(__(_("You need to upload an image or write the ad code")));
			}
		}		
	}
	
	private function save() {		
		if($this->data["Principal"] > 0) {
			$this->Db->select("Position");

			$data = $this->Db->findBySQL("Position = '". $this->data["Position"] ."' AND Principal = 1", $this->table);
					
			if($data) {
				$this->Db->updateBySQL($this->table, "Principal = 0 WHERE Position = '". $this->data["Position"] ."'");				
			}
		}
		
		$this->Db->insert($this->table, $this->data);
					
		return getAlert("The ad has been saved correctly", "success");	
	}
	
	private function edit() {	
		if($this->data["Principal"] > 0) {		
			$this->Db->select("Position");

			if($this->Db->findBySQL("Position = '". $this->data["Position"] ."' AND Principal = 1", $this->table)) {
				$this->Db->updateBySQL($this->table, "Principal = 0 WHERE Position = '". $this->data["Position"] ."'");				
			}
		}

		$this->Db->update($this->table, $this->data, POST("ID"));
		
		return getAlert("The ad has been edited correctly", "success");
	}
	
	private function search($search, $field) {
		if($search and $field) {
			$this->Db->select("ID_Ad, Title, Position, Banner, URL, Code, Start_Date, Principal, Situation");

			if($field === "ID") {
				$data = $this->Db->find($search, $this->table);	
			} else {
				$data = $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);
			}
		} else {
			return FALSE;
		}
		
		return $data;		
	}
	
	public function getByID($ID) {
		$this->Db->select("Title, Position, Banner, URL, Code, Time, Principal");

		return $this->Db->find($ID, $this->table);
	}
	
	public function getAds($position = NULL) {			
		$this->Db->select("Title, Position, Banner, URL, Code, Time, Principal");	
		
		return $this->Db->findBySQL("Position = '$position' AND Situation = 'Active'", $this->table);
	}
	
	public function click($ID) {		
		if($ID > 0) {
			return $this->Db->updateBySQL("ads", "Clicks = (Clicks) + 1", $ID);
		}
		
		return FALSE;
	}
	
}