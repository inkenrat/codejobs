<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Feedback_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->Email = $this->core("Email");
		
		$this->Email->setLibrary("PHPMailer");
		
		$this->Email->fromName  = get("webName");
		$this->Email->fromEmail = get("webEmailSend");
		
		$this->table  = "feedback";
		$this->fields = "ID_Feedback, Name, Email, Company, Phone, City, Subject, Message, Text_Date, Situation";
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Feedback DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, "ID_Feedback DESC", $limit);
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
	
	public function read($ID = false, $situation = "Read") {
		if($ID) {
			$this->Db->update($this->table, array("Situation" => $situation), $ID);
		}
	}
	
	public function getByID($ID) {
		$this->Db->select("ID_Feedback, Name, Email, Company, Phone, City, Subject, Message, Situation");

		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
	public function send() {
		if(!POST("name")) {
			return getAlert(__(_("You need to write your name")));
		} elseif(!isEmail(POST("email"))) {
			return getAlert(__(_("Invalid E-Mail")));
		} elseif(!POST("message")) {
			return getAlert(__(_("You need to write a message")));
		}
		
		$values = array(
			"Name"   	 => POST("name"),
			"Email"   	 => POST("email"),
			"Company"	 => "",
			"Phone" 	 => "",
			"Subject"  	 => "",
			"Message" 	 => POST("message", "decode", FALSE),
			"Start_Date" => now(4),
			"Text_Date"  => now(2)
		);
		
		$insert = $this->Db->insert($this->table, $values);
			
		if(!$insert) {
			return getAlert("Insert error");
		}

		$this->sendMail();
		
		$this->sendResponse();			
		
		return getAlert(__(_("Your message has been sent successfully, we will contact you as soon as possible, thank you very much!")), "success");
	}
	
	private function sendResponse() {
		$this->Email->email	  = POST("email");
		$this->Email->subject = __(_("Automatic response")) . " - " . get("webName");
		$this->Email->message = $this->view("response_email", NULL, "feedback", TRUE);
		
		$this->Email->send();
	}
	
	private function sendMail() {
		$this->Email->email	  = get("webEmailSend");
		$this->Email->subject = __(_("New Message")) ." - ". get("webName");
		$this->Email->message = $this->view("send_email", $vars, "feedback", TRUE);
		
		$this->Email->send();
	}
	
	public function getNotifications() {
		return $this->Db->countBySQL("Situation = 'Inactive'", $this->table);
	}
}
