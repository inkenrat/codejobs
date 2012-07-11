<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Comments_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->language = whichLanguage();
		$this->table 	= "comments";

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
	
	public function getCommentsByRecord($ID_Application, $ID_Record) {
		$data = $this->Db->query("	SELECT ID_User, Comment, Start_Date, Username, Avatar 
									FROM muu_comments 
									INNER JOIN muu_re_comments_applications 
									ON muu_comments.ID_Comment = muu_re_comments_applications.ID_Comment
									WHERE muu_re_comments_applications.ID_Application = '$ID_Application' 
									AND muu_re_comments_applications.ID_Record = '$ID_Record'
								");

		return $data;
	}
	
	public function addComment() {
		$this->helper(array("time", "alerts"));

		if(COOKIE("ZanComment")) {
			return getAlert("You must wait a little to publish another comment");
		} elseif(!POST("comment")) {
			return getAlert("You must write your comment");
		} elseif(isSPAM(POST("comment"))) {
			return getAlert("Your comment contains a lot of SPAM");
		} elseif(isVulgar(POST("comment"))) {
			return getAlert("Your comment is very vulgar");
		} elseif(isInjection(POST("comment", "clean"))) {
			return getAlert("Please do not try to inject HTML in your comments");
		} elseif(!POST("recordID")) {
			return getAlert("Invalid comment");
		}

		$data = array(
			"ID_User" 	 => SESSION("ZanUserID"),
			"Comment" 	 => POST("comment"),
			"Start_Date" => now(4),
			"Text_Date"  => now(2),
			"Username"	 => SESSION("ZanUser"),
			"Avatar"	 => SESSION("ZanUserAvatar")
		);
		
		$ID_Comment = $this->Db->insert($this->table, $data);

		if(segment(0, isLang()) === "blog") {
			$ID_Application = 3;

			$this->Db->updateBySQL("blog", "Comments = (Comments) + 1 WHERE ID_Post = '". POST("recordID") ."'");
		}

		$data = array(
			"ID_Application" => $ID_Application, 
			"ID_Comment" 	 => $ID_Comment,
			"ID_Record"		 => POST("recordID")
		);

		$ID_Comment2Application = $this->Db->insert("re_comments_applications", $data);
		
		COOKIE("ZanComment", TRUE, 20);

		redirect(POST("URL") ."/#new");
	}
	
	private function all($trash, $order, $limit) {
		$this->Db->select("ID_User, Comment, Start_Date, Username, Avatar");

		if(!$trash) {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("State != 'Deleted'", NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '".$_SESSION["ZanAdminID"]."' AND State != 'Deleted'", NULL, $order, $limit);	
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("State", "Deleted", NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND State = 'Deleted'", NULL, $order, $limit);
		}
	}
		
	public function getNotifications($application = 3) {
		$data = $this->Db->query("	SELECT COUNT(*) AS Total
									FROM muu_comments 
									INNER JOIN muu_re_comments_applications 
									ON muu_comments.ID_Comment = muu_re_comments_applications.ID_Comment
									WHERE muu_re_comments_applications.ID_Application = '$application'
								");
	
		if($data) {
			return $data[0]["Total"];
		}
	}
	
}
