<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class CPanel_Controller extends ZP_Controller {
	
	private $vars = array();
	
	public function __construct() {		
		$this->application = $this->app("cpanel");
		
		$this->config($this->application);
		
		$this->CPanel = $this->classes("cpanel", "CPanel", NULL, "cpanel");
		
		$this->isAdmin = $this->CPanel->load();
		
		$this->vars = $this->CPanel->notifications();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		
		$this->Templates = $this->core("Templates");
		
		$this->Templates->theme("cpanel");
	}
	
	public function index() {
		if($this->isAdmin) {
			$this->home();
		} else {
			$this->login();
		}
	}
	
	public function home() {
		$this->title("Home");
		
		$this->helper("porlets", $this->application);
		
		$this->vars["lastPosts"] = porlet(__(_("Last posts")), $this->CPanel_Model->home("blog"));
		$this->vars["lastPages"] = porlet(__(_("Last pages")), $this->CPanel_Model->home("pages"));
		$this->vars["lastLinks"] = porlet(__(_("Last bookmarks")), $this->CPanel_Model->home("bookmarks"));
		$this->vars["lastUsers"] = porlet(__(_("Last users")), $this->CPanel_Model->home("users"));
		
		$this->vars["view"] = $this->view("home", TRUE);
		
		$this->render("content", $this->vars);
	}
	
	public function login() {
		$this->title("Login");
		$this->CSS("login", "users");
		$this->helper("alerts");
		
		if(POST("connect")) {
			$this->Users_Model = $this->model("Users_Model");
				
			if($this->Users_Model->isAdmin() or $this->Users_Model->isMember()) {
				$data = $this->Users_Model->getUserData();
			} 
			
			if(isset($data)) {
				SESSION("ZanUser", $data[0]["Username"]);
				SESSION("ZanUserName", $data[0]["Name"]);
				SESSION("ZanUserPwd", $data[0]["Pwd"]);
				SESSION("ZanUserAvatar", $data[0]["Avatar"]);
				SESSION("ZanUserID", $data[0]["ID_User"]);
				SESSION("ZanUserPrivilegeID", $data[0]["ID_Privilege"]);

				redirect(POST("URL"));
			} else { 
				showAlert(__(_("Incorrect Login")), path());
			}	
		} else {
			$this->vars["URL"]  = getURL();
			$this->vars["view"] = $this->view("login", TRUE);
		}
		
		$this->render("include", $this->vars);
		
		$this->rendering("header", "footer");
	}
	
	public function logout() {
		unsetSessions("cpanel");
	}
	
}