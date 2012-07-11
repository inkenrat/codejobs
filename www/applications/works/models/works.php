<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Works_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();			
		
		$this->table = "works";
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Work DESC", $search = NULL, $field = NULL, $trash = FALSE) {		
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
		$this->Db->select("ID_Post, Title, Author, Views, Language, Situation");
		
		if(!$trash) { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
		}
	}
	
	private function editOrSave($action) {		
		
	}
	
	private function save() {
		
	}
	
	private function edit() {
		
	}
	
	public function getByID($ID) {
		$thid->Db->select("ID_Work, Title, Slug, Preview1, Preview2, Image, URL, Description, Situation");

		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
}