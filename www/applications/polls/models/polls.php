<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Polls_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->table = "polls";
		
		$this->Data = $this->core("Data");
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Poll DESC", $search = NULL, $field = NULL, $trash = FALSE) {
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
		$this->Db->select("ID_Poll, Title, Type, Start_Date, Situation");
		
		if(!$trash) { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
		}	
	}
	
	private function editOrSave() {		
		$j = 0;
		$k = 0;
		
		foreach(POST("answers") as $key => $answer) {
			if($answer === "") {
				$j += 1; 
			} else {
				$k += 1;
			}
		}
		
		if(count(POST("answers")) === $j) {
			return getAlert(__(_("You need to write a answers")));
		} elseif($k < 2) {
			return getAlert(__(_("You need to write more than one answer")));
		} else {
			$this->answers = POST("answers");
		}

		$validations = array(
			"title" => "required"
		);

		$data = array(
			"ID_User" 	 => SESSION("ZanUserID"),
			"Start_Date" => now(4),
			"Text_Date"  => now(2),
		);

		$this->Data->ignore("answers");
		
		$this->data = $this->Data->proccess($data, $validations);
	}
	
	private function save() {
		$lastID = $this->Db->insert($this->table, $this->data);
		
		if($lastID) {
			for($i = 0; $i <= count($this->answers) - 1; $i++) {
				$answers[$i]["ID_Poll"] = $lastID;
				$answers[$i]["Answer"]  = $this->answers[$i];
			}
			
			$this->Db->insertBatch("polls_answers", $answers);
			
			return getAlert(__(_("The poll has been saved correctly")), "success");
		}
		
		return getAlert(__(_("Insert error")));
	}
	
	private function edit() {
		$this->Db->updateBySQL($this->table, "Title = '$this->title', Type = '$this->type', State = '$this->state'", $this->ID);
		
		$this->Db->deleteBySQL("ID_Poll = '$this->ID'", "polls_answers");
		
		foreach($this->answers as $key => $answer) {
			if($answer !== "") {
				$this->Db->insert("polls_answers", array("ID_Poll" => $this->ID, "Answer" => $answer));
			}
		}
		
		return getAlert(__(_("The poll has been edit correctly")), "success");
	}
	
	public function getByID($ID) {
		$this->Db->select("ID_Poll");

		$data = $this->Db->find($ID, $this->table);
		
		$this->Db->select("Answer");

		$data2 = $this->Db->findBy("ID_Poll", $ID, "polls_answers");
		
		if($data2) {
			foreach($data2 as $answer) {
				$data[0][] = $answer["Answer"];
			}
		}
		
		return $data;
	}
	
	public function getLastPoll() {		
		$this->Db->select("ID_Poll, Title, Type, Start_Date, Situation");

		$data1 = $this->Db->findLast($this->table);
		
		if($data1) {
			$this->Db->select("ID_Answer, Answer");

			$data2 = $this->Db->findBy("ID_Poll", $data1[0]["ID_Poll"], "polls_answers");
			
			$data["question"] = $data1[0];
			$data["answers"]  = $data2;
			
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function vote() {
		$ID_Poll   = POST("ID_Poll");
		$ID_Answer = POST("answer");
		$IP		   = getIP();
		$date	   = now(4);
		$end	   = $date + 3600;
		
		$this->Db->select("ID_Poll, IP, Start_Date, End_Date");

		$data = $this->Db->findBySQL("ID_Poll = '$ID_Poll' AND IP = '$IP' AND End_Date > $date", "polls_ips");
		
		if($data) {
			showAlert(__(_("You've previously voted on this poll")), path());
		} else {					
			$this->Db->updateBySQL("polls_answers", "Votes = (Votes) + 1", $ID_Answer);								
			
			$data = array(
				"ID_Poll" 	 => $ID_Poll,
				"IP"	  	 => $IP,
				"Start_Date" => $date,
				"End_Date"	 => $end
			);

			$this->Db->insert("polls_ips", $data);
			
			createCookie("ZanPoll", $ID_Poll, 3600);
			
			showAlert(__(_("Thank you for your vote!")), path());
		}
		
		return TRUE;
	}
}