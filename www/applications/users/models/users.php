<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Users_Model extends ZP_Model {

	public function __construct() {
		$this->Db = $this->db();
				
		$this->Email = $this->core("Email");
		
		$this->Email->fromName  = get("webName");
		$this->Email->fromEmail = get("webEmailSend");
		
		$this->Data = $this->core("Data");
		
		$this->Data->table("users");

		$this->table = "users";
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
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
		$this->Db->select("ID_User, Username, Email, Website, Avatar, Points");

		if(!$trash) {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanuserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
		}
	}
	
	private function editOrSave() {
		$validations = array(
			"username" => "required",
			"email"	   => "email?",
			"pwd"	   => "length:6"
		);

		if((int) POST("privilege") === 1) {
			$privilege = "Super Admin";
		} elseif((int) POST("privielge") === 2) {
			$privilege = "Admin";
		} elseif((int) POST("privilege") === 3) {
			$privilege = "Moderator";
 		} else {
 			$privilege = "Member";
 		}
		
		$data = array(
			"Pwd"		 => encrypt(POST("pwd")),
			"Start_Date" => now(4),
			"Code"		 => code(),
			"Privilege"  => $privilege
		);

		$this->Data->ignore(array("pwd", "pwd2"));

		$this->data = $this->Data->proccess($data, $validations);
		
		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {
		$insertID = $this->Db->insert($this->table, $this->data);

		$data = array(
			"ID_User" => $insertID,
			"Name" 	  => POST("username")
		);

		$this->Db->insert("users_information", $data);

		$data = array(
			"ID_Privilege" => POST("privilege"),
			"ID_User"	   => $insertID
		);

		$this->Db->insert("re_privileges_users", $data);

		return getAlert("The user has been saved correctly", "success");	
	}
	
	private function edit() {
		//FALTA EDICIÓN
		
		return getAlert("The user has been edit correctly", "success");
	}

	public function addUser() {
		if(SESSION("UserRegistered")) {
			return array("inserted" => FALSE, "alert" => getAlert(__("You can't register many times a day")));
		}

		$validations = array(
			"exists"   => array(
				"Username" => POST("username"),
				"or"       => TRUE,
				"Email"    => POST("email"),
			),
			"username" => "required",
			"name" 	   => "name?",
			"password" => "length:6",
			"email"    => "email?"
		);

		$code = code(10);

		$data = array(
			"Pwd"	     => POST("password", "encrypt"),
			"Start_Date" => now(4),
			"Subscribed" => 1,
			"Code"		 => $code,
			"Situation"  => "Inactive"
		);
	
		$this->Data->ignore(array("password", "register", "name"));

		$data = $this->Data->proccess($data, $validations);
		
		if(isset($data["error"])) {
			return array("inserted" => FALSE, "alert" => $data["error"]);
		}
		
		$ID_User = $this->Db->insert($this->table, $data);
	
		if($ID_User) {
			$ID_User_Information = $this->Db->insert("users_information", array("ID_User" => $ID_User, "Name" => POST("name")));

			$this->Db->insert("re_privileges_users", array("ID_Privilege" => "4", "ID_User" => $ID_User));
			
			$message = $this->view("register_email", array("code" => $code), "users", TRUE);

			$this->Email->email   = POST("email");
			$this->Email->subject = __(_("Account Activation")) ." - ". get("webName");
			$this->Email->message = $this->view("register_email", array("user" => POST("username"), "code" => $code), "users", TRUE);
			
			$this->Email->send();

			SESSION("UserRegistered", TRUE);

			return array(
				"inserted" => TRUE,
				"alert"    => getAlert(__(_("The account has been created correctly, we will send you an email so you can activate your account")), "success")
			);
		} else {
			return array("inserted" => FALSE, "alert" => getAlert(__(_("Insert error"))));
		}
	}
	
	public function activate($user, $code) {
		$this->Db->select("ID_User, Username, Email, Pwd, Privilege");

		$data = $this->Db->findBySQL("Username = '$user' AND Code = '$code' AND Situation = 'Inactive'", $this->table);
		
		if($data) {
			$this->Db->update($this->table, array("Situation" => "Active"), $data[0]["ID_User"]);

			return $data;
		} 
		
		return FALSE;
	}
	
	public function change() {
		if(POST("change")) {
			$tokenID   = POST("tokenID");
			$password1 = POST("password1", "decode-encrypt");
			$password2 = POST("password2", "decode-encrypt");
			
			if(POST("password1") === "" or POST("password2") === "") {
				return getAlert(__(_("You need to write the two passwords")));
			} elseif(strlen(POST("password1")) < 6 or strlen(POST("password2")) < 6) {
				return getAlert(__(_("Your password must contain at least 6 characters")));
			} elseif($password1 === $password2) {
				$data = $this->Db->find($tokenID, "tokens");
				
				$this->Db->update("tokens", array("Situation" => "Inactive"), $data[0]["ID_Token"]);
					
				if(!$data) {
					showAlert(__(_("Invalid Token")), path());
				} else {			
					$this->Db->update("users", array("Pwd" => "$password1"), $data[0]["ID_User"]);
					
					showAlert(__(_("Your password has been changed successfully!")), path());
				}
			} else {
				return getAlert(__(_("The two passwords do not match")));
			}
		} else {
			redirect();
		}
	}
	
	public function isAdmin($sessions = FALSE) {
		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");	
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}
		
		$this->Db->select("ID_User");

		return $this->Db->findBySQL("ID_Privilege <= 2 AND (Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'", $this->table);
	}
	
	public function isMember($sessions = FALSE) {
		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");					
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}

		$this->Db->select("ID_User");
		
		return $this->Db->findBySQL("(Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'", $this->table);
	}
	
	public function getUserData($sessions = FALSE) {		
		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");						
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}

		$fields  = "ID_User, ID_Privilege, Username, Pwd, Email, Website, Avatar, Recommendation, Credits, Sign, Messages, Recieve_Messages, Topics, Replies, ";
		$fields .= "Comments, Codes, Bookmarks, Jobs, Suscribed, Start_Date, Code, CURP, RFC, Name, Age, Title, Address, Zip, Phone, Mobile, ";
		$fields .= "Gender, Relationship, Birthday, Country, District, City, Technologies, Twitter, Facebook, Linkedin, Viadeo, Situation";

		$this->Db->select($fields);
		
		$data = $this->Db->findBySQL("(Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'", $this->table);	
			
		return $data;
	}

	public function getOnlineUsers() {	
		$date = time();
		$time = 10;
		$time = $date - $time * 60;
		$IP   = getIP();		
		$user = SESSION("ZanUser");
				
		$this->Db->deleteBySQL("Start_Date < $time", "users_online_anonymous");
		$this->Db->deleteBySQL("Start_Date < $time", "users_online");

		if($user !== "") {		
			$this->Db->select("User, Start_Date");

			$users = $this->Db->findBy("User", $user, "users_online");
			
			if(!$users) {			
				$this->Db->insert("users_online", array("User" => $user, "Start_Date" => $date));
			} else {			
				$this->Db->updateBySQL("users_online", "Start_Date = '$date' WHERE User = '$user'");						
			}		
		} else {
			$this->Db->select("IP, Start_Date");

			$users = $this->Db->findBy("IP", $IP, "users_online_anonymous");
									
			if(!$users) {						
				$this->Db->insert("users_online_anonymous", array("IP" => $IP, "Start_Date" => $date));	
			} else {			
				$this->Db->updateBySQL("users_online_anonymous", "Start_Date = '$date' WHERE IP = '$IP'");		
			}	
		}
	}
	
	public function isAllow($permission = "view", $application = NULL) {			
		if(SESSION("ZanUserPrivilegeID") and !SESSION("ZanUserApplication")) {	
			$this->Applications_Model = $this->model("Applications_Model");
			
			if(is_null($application)) {
				$application = whichApplication();		
			}
			
			$privilegeID   = SESSION("ZanUserPrivilegeID");
			$applicationID = $this->Applications_Model->getID($application);
			
			if($this->getPermissions($privilegeID, $applicationID, $permission)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return TRUE;
		}
	}
	
	public function getPermissions($ID_Privilege, $ID_Application, $permission) {		
		$this->Db->select("ID_Privilege, ID_Application, Adding, Deleting, Editing, Viewing");

		$data = $this->Db->findBySQL("ID_Privilege = '$ID_Privilege' AND ID_Application = '$ID_Application'", "re_permissions_privileges");

		if($permission === "add") { 
			return ($data[0]["Adding"])   ? TRUE : FALSE;
		} elseif($permission === "delete") {
			return ($data[0]["Deleting"]) ? TRUE : FALSE;
		} elseif($permission === "edit") {
			return ($data[0]["Editing"])  ? TRUE : FALSE;
		} elseif($permission === "view") {
			return ($data[0]["Viewing"])  ? TRUE : FALSE;
		}
	}
	
	public function recover() {		
		if(POST("recover")) {
			$username = POST("username");
			$email	  = POST("email");
			
			if($username or isEmail($email)) {
				if($username) {
					$data = $this->Db->findBy("Username", $username, $this->table, "ID_User");
				
					if(!$data) {
						return getAlert(__(_("There was an error while processing your request, verifies that the information provided is correct")));
					} else {
						$userID    = $data[0]["ID_User"];
						$token     = encrypt(code());
						$startDate = now(4);
						$endDate   = $startDate + 86400;

						$data = $this->Db->findBySQL("ID_User = '$userID' AND Action = 'Recover' AND Situation = 'Active'", "tokens", "ID_Token");
						
						if(!$data) {
							$data = array(
								"ID_User" 	 => $userID,
								"Token"		 => $token,
								"Action"     => "Recover",
								"Start_Date" => $startDate,
								"End_Date"	 => $endDate
							);
							
							$this->Db->insert("tokens", $data);
							
							$this->Email->email	  = $email;
							$this->Email->subject = __(_("Recover Password")) ." - ". get("webName");
							$this->Email->message = $this->view("recover_email", array(), "users", TRUE);
							
							$this->Email->send();							

							return array(
								"inserted" => TRUE, 
								"alert"    => getAlert(__(_("We've sent you an email with instructions to retrieve your password")), "success")
							);
						} else {
							return array("alert" => getAlert(__(_("You can't apply for two password resets in less than 24 hours"))));
						}
					}
				} elseif(isEmail($email)) {
					$this->Db->select("ID_User");

					$data = $this->Db->findBy("Email", $email, $this->table);
					
					if(!$data) {
						return getAlert(__(_("This e-mail does not exists in our database")));
					} else {
						$userID    = $data[0]["ID_User"];
						$token     = encrypt(code());
						$startDate = now(4);
						$endDate   = $startDate + 86400;
						
						$this->Db->select("ID_Token");

						$data = $this->Db->findBySQL("ID_User = '$userID' AND Action = 'Recover' AND Situation = 'Active'", "tokens");
						
						if(!$data) {
							$data = array(
								"ID_User" 	 => $userID,
								"Token"		 => $token,
								"Start_Date" => $startDate,
								"End_Date"	 => $endDate
							);
							
							$this->Db->insert("tokens", $data);
							
							$this->Email->email	  = $email;
							$this->Email->subject = __(_("Recover Password")) ." - ". _webName;
							$this->Email->message = $this->view("recovering_email", array("token" => $token), "users", TRUE);

							$this->Email->send();							
						} else {
							return getAlert(__(_("You can not apply for two password resets in less than 24 hours")));
						}
					}					
				}
				
				return getAlert(__(_("We will send you an e-mail so you can recover your password")), "Success");
			} else {
				return getAlert(__(_("You must enter a username or e-mail at least")));					
			}					
		} else {
			return FALSE;
		}
	}
	
	public function last() {
		$this->Db->select("Username");

		$last = $this->Db->findLast($this->table);
		
		return ($last) ? $last[0] : NULL;
	}
	
	public function registered() {		
		$registered = $this->Db->countAll($this->table);
		
		return $registered;
	}
	
	public function online($all = TRUE) {		
		$registered = $this->Db->countAll("users_online");
		
		$anonymous = $this->Db->countAll("users_online_anonymous");
		
		$total = $registered + $anonymous;
		
		return ($all) ? $total : $anonymous;	
	}	
	
	public function isToken($token = FALSE, $action = NULL) {
		if($token and isset($action)) {
			$data = $this->Db->findBySQL("Token = '$token' AND Action = '$action' AND Situation = 'Active'", "tokens", "ID_Token");
		
			if(!$data) {
				showAlert(__(_("Invalid Token")), path());
			} else {
				return $data[0]["ID_Token"];
			}
		} else {
			showAlert(__(_("Invalid Token")), path());
		}
	}
	
	public function getByID($ID) {
		$fields  = "ID_User, ID_Privilege, Username, Pwd, Email, Website, Avatar, Points, Sign, Messages, Recieve_Messages, Topics, Replies, ";
		$fields .= "Comments, Codes, Tutorials, Jobs, Suscribed, Start_Date, Code, CURP, RFC, Name, Age, Title, Address, Zip, Phone, Mobile, ";
		$fields .= "Gender, Relationship, Birthday, Country, District, City, Technologies, Twitter, Facebook, Linkedin, Viadeo, Situation";

		$data = $this->Db->find($ID, $this->table, $fields);
		
		return $data;
	}
	
	public function setLike($ID, $table, $application) {
		if($this->Db->find($ID, $table)) {
			if($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "likes")) {
				showAlert(__(_("Already You like this")), path("bookmarks/go/$ID"));
			} elseif($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "dislikes")) {
				showAlert(__(_("Already You dislike this")), path("bookmarks/go/$ID"));
			}

			$this->helper("time");

			$this->Db->insert("likes", array("ID_User" => SESSION("ZanUserID"), "ID_Application" => $application, "ID_Record" => $ID, "Start_Date" => now(4)));
			
			$primaryKey = $this->Db->table($table);

			$this->Db->updateBySQL($table, "Likes = (Likes) + 1 WHERE $primaryKey = '$ID'");
			
			showAlert(__(_("Thanks for your like")), path("bookmarks/go/$ID"));
		} 

		showAlert(__(_("The record doesn't exists")), path());
	}

	public function setDislike($ID, $table, $application) {
		if($this->Db->find($ID, $table)) {
			if($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "dislikes")) {
				showAlert(__(_("Already You dislike this")), path("bookmarks/go/$ID"));
			} elseif($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "likes")) {
				showAlert(__(_("Already You like this")), path("bookmarks/go/$ID"));
			}

			$this->helper("time");

			$this->Db->insert("dislikes", array("ID_User" => SESSION("ZanUserID"), "ID_Application" => $application, "ID_Record" => $ID, "Start_Date" => now(4)));
			
			$primaryKey = $this->Db->table($table);

			$this->Db->updateBySQL($table, "Dislikes = (Dislikes) + 1 WHERE $primaryKey = '$ID'");

			showAlert(__("Thanks for your dislike"), path("bookmarks/go/$ID"));
		} 

		showAlert(__("The record doesn't exists"), path());
	}

	public function setCredits($credits, $recommendation, $application, $record, $action = "Add") {
		$this->helper("time");

		$data = array(
			"ID_User" 		 => SESSION("ZanUserID"),
			"ID_Application" => $application,
			"ID_Record"		 => $record,
			"Action"		 => $action,
			"Credits"		 => $credits,
			"Start_Date"	 => now(4) 
		);

		$this->Db->insert("credits", $data);

		if($application === 10) {
			$bookmarks = ", Bookmarks = (Bookmarks) + 1";
		} else {
			$bookmarks = "";
		}

		$this->Db->updateBySQL("users", "Credits = (Credits) + $credits, Recommendation = (Recommendation) + $recommendation $bookmarks WHERE ID_User = '". SESSION("ZanUserID") ."'");

		return FALSE;
	}

}