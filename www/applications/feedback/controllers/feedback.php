<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Feedback_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->Feedback_Model = $this->model("Feedback_Model");
		$this->Templates 	  = $this->core("Templates");
		
		$this->application = "feedback";
		
		$this->Templates->theme();
	}
	
	public function index() {
		$this->feedback();
	}
	
	private function feedback() {
		//Change to feedback.css
		$this->CSS("new", "users");
		$this->js("tiny-mce", NULL, "basic");
		$this->title("Feedback");
		
		$vars["inserted"] = FALSE;
		$vars["view"] = $this->view("send", TRUE);
		
		if(POST("send")) {						
			$vars["alert"] = $this->Feedback_Model->send();			
		} 
		
		$this->render("content", $vars);
	}
}
