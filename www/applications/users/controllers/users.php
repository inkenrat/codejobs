<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Users_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->Templates   = $this->core("Templates");
		$this->Users_Model = $this->model("Users_Model");
		
		$this->helpers();
		
		$this->application = $this->app("users");
		
		$this->Templates->theme();

		$this->CSS("forms");
	}
	
	public function index() {	
		redirect();
	}
	
	public function logout() {
		unsetSessions(path());
	}
	
	public function activate($user = NULL, $code = FALSE) {
		if(!$user or !$code) {
			redirect();
		} else {
			$data = $this->Users_Model->activate($user, $code);
			
			if(is_array($data)) {
				SESSION("ZanUser", $data[0]["Username"]);
				SESSION("ZanUserName", $data[0]["Name"]);
				SESSION("ZanUserPwd", $data[0]["Pwd"]);
				SESSION("ZanUserAvatar", $data[0]["Avatar"]);
				SESSION("ZanUserID", $data[0]["ID_User"]);
				SESSION("ZanUserPrivilegeID", $data[0]["ID_Privilege"]);
					 
				showAlert("Your account has been activated correctly!", path());
			} else {
				showAlert("An error occurred when attempting to activate your account!", path());
			}
		}
	}
	
	public function login() {
		$this->CSS("login", $this->application);
		
		$this->title("Login");
		
		$data = FALSE;

		$vars["href"] = path("users/login");

		if(POST("login")) {
			if($this->Users_Model->isAdmin() or $this->Users_Model->isMember()) {
				$data = $this->Users_Model->getUserData();
			} 
			
			if($data) {
				SESSION("ZanUser", $data[0]["Username"]);
				SESSION("ZanUserName", $data[0]["Name"]);
				SESSION("ZanUserPwd", $data[0]["Pwd"]);
				SESSION("ZanUserAvatar", $data[0]["Avatar"]);
				SESSION("ZanUserID", $data[0]["ID_User"]);
				SESSION("ZanUserPrivilegeID", $data[0]["ID_Privilege"]);

				redirect();
			} else { 
				showAlert(__(_("Incorrect Login")), path());
			}		
		} else {
			redirect();
		} 
	}
	
	public function recover($token = FALSE) {	
		$this->title("Recover Password");
		
		if(POST("change")) {			
			$vars["alert"] 	 = $this->Users_Model->change();
			$vars["tokenID"] = $token;
		} elseif(POST("recover")) {
			$status = $this->Users_Model->recover();

			$vars["inserted"] = isset($status["inserted"]) ? $status["inserted"] : FALSE;
			$vars["alert"]    = $status["alert"];	
		} elseif($token) {			
			$tokenID = $this->Users_Model->isToken($token, "Recover");
			
			if($tokenID > 0) {
				$vars["tokenID"] = $tokenID;
			} else {
				redirect();
			}
		} 

		$vars["view"] = $this->view("recover", TRUE);
		
		$this->render("content", $vars);
	}
	
	public function register() {			
		if(!SESSION("ZanUser")) {
			$this->title(__(_("Register")));

			if(POST("register")) {
				$vars["name"]     = POST("name")  	 ? POST("name")     : NULL;
				$vars["email"]    = POST("email") 	 ? POST("email")    : NULL;
				$vars["pwd"]      = POST("password") ? POST("password") : NULL;

				if(POST("username")) {
					$status = $this->Users_Model->addUser();
				
					$vars["inserted"] = $status["inserted"];
					$vars["alert"]    = $status["alert"];	
					$vars["first"]    = TRUE;
				}			
			}

			$vars["view"] = $this->view("new", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
}