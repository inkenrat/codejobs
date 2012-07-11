<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Videos_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->table  = "videos";
		$this->fields = "ID_YouTube, Title";

		$this->language    = whichLanguage(); 
		$this->application = whichApplication();
		
		$this->YouTube = $this->library("youtube", "Youtube", NULL, "videos");

		$this->Data = $this->core("Data");
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Video DESC", $search = NULL, $field = NULL, $trash = FALSE) {	
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, "ID_Video DESC", $limit);
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
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $this->fields, NULL, $order, $limit);
		}	
	}
	
	private function editOrSave() {
		if((!POST("videos") or is_null(POST("videos"))) and (!POST("URL") or is_null(POST("URL"))) and (!POST("ID") or is_null(POST("ID")))) {
			return getAlert("You need select video o write URL");
		}
		
		if(POST("URL")) {
			$validations = array(
				"URL"=> "required"
			);
			
			$data = array(
				"URL" => POST("URL")
			);
		} elseif(POST("videos")) {
			$validations = array(
				"videos" => "required"
			);
			
			$data = array(
				"videos" => POST("videos")
			);
		}
			
		$this->ID 	     = POST("ID");		
		$this->URL       = POST("URL");
		$this->videos    = POST("videos");
		$this->date1  	 = now(4);
		$this->date2  	 = now(2);
		$this->situation = POST("situation");
		
		$this->data = $this->Data->proccess($data, $validations);
		
		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {
		if($this->URL and !is_null($this->URL)) {
			$_array = explode("v=", POST("URL", "decode", FALSE));
			
			if($this->find($_array[1])) {
				return getAlert(__("This video already exists"));
			}
			
			$validateVideo = $this->YouTube->validVideo($_array[1]);
	
			if(is_null($_array[1]) or !$validateVideo) {
				return getAlert(__("Invalid URL"));
			}
			
			$video  = $this->YouTube->getByID($_array[1]);
				
			if($video and is_array($video) and $validateVideo) {	
				$values = array(
					"ID_User"     => SESSION("ZanUserID"),
					"ID_YouTube"  => $video["id"],
					"Title"	      => trim($video["title"]),
					"Slug" 	      => slug($video["title"]),
					"Description" => trim($video["content"]),
					"URL"    	  => $this->URL,
					"Start_Date"  => $this->date1,
					"Text_Date"   => $this->date2,
					"Situation"   => $this->situation
				);
				
				$insert = $this->Db->insert($this->table, $values);
				
				if(!$insert) {
					return getAlert(__("Insert error"));
				}
			}
		}
		
		if(($this->videos) and !is_null($this->videos)) {
			foreach($this->videos as $value) {		
				if(!$this->find($value)) {
					$video = $this->YouTube->getByID($value);
					
					if($video and is_array($video)) {
						$values = array(
							"ID_User"     => SESSION("ZanUserID"),
							"ID_YouTube"  => $video["id"],
							"Title"	      => $video["title"],
							"Slug" 	      => slug($video["title"]),
							"Description" => $video["content"],
							"URL"    	  => $this->URL,
							"Start_Date"  => $this->date1,
							"Text_Date"   => $this->date2,
							"Situation"   => $this->situation
						);
						
						$insert = $this->Db->insert($this->table, $values);
						
						if(!$insert) {
							return getAlert(__(_("Insert error")));
						}
					}
				} else {
					return getAlert(__(_("At least one of the Videos you choose already exists")));
				}
			}
		}
		
		return getAlert(__(_("The videos has been saved correctly")), "success");
	}
	
	private function edit() {
		if(!$this->title or is_null($this->title)) {
			return getAlert(__(_("You need write a title")));
		}
		
		$values = array(
			"Title"	      => $this->title,
			"Slug" 	      => slug($this->title),
			"Description" => $this->description,
			"Situation"   => $this->situation
		);
		
		$response = $this->Db->update($this->table, $values, "ID_Video = " . $this->ID);
		
		if($response) {
			return getAlert("The video has been edited correctly", "success");
		} else {
			return getAlert("Edit error");
		}
	}
	
	public function getByUser($user = NULL) {
		return  $this->YouTube->getByUser($user);
	}
	
	public function query($query = NULL) {
		return  $this->YouTube->query($query);
	}
	
	public function search($search) {
		return  $this->YouTube->search($search);
	}
	
	public function getByID($ID) {
		$data = $this->Db->find($ID, $this->table, $this->fields);
		
		return $data;
	}
	
	public function getVideos($limit = 10) {		
		$data = $this->Db->findAll($this->table, $this->fields, NULL, "ID_Video DESC", $limit);
		
		return $data;
	}
	
	public function count($limit = 10) {
		$data = $this->Db->countAll($this->table);

		return $data;
	}
	
	public function find($ID = NULL) {
		return ($this->Db->findBY("ID_YouTube", $ID, $this->table, $this->fields)) ? TRUE : FALSE;
	}
}