<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Codes_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->Templates = $this->core("Templates");
		$this->Cache     = $this->core("Cache");
		
		$this->application = $this->app("codes");
		
		$this->Templates->theme();

		$this->config("codes");
		
		$this->Codes_Model = $this->model("Codes_Model");

		$this->helper("pagination");
	}
	
	public function index($codeID = 0) {
		if($codeID > 0) {
			$this->go($codeID);
		} else {
			$this->getCodes();
		}
	}

	public function like($ID) {
		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setLike($ID, "codes", 17);
	}

	public function dislike($ID) {
		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setDislike($ID, "codes", 17);
	}

	public function report($ID) {
		$this->Codes_Model->setReport($ID, "codes", 17);
	}	

	public function tag($tag) {
		$this->title(__("Codes"));
		$this->CSS("codes", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit($tag);

		$data = $this->Cache->data("tag-$tag-$limit", "codes", $this->Codes_Model, "getByTag", array($tag, $limit));

		if($data) {
			$this->helper("time");

			$vars["codes"]  	= $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("codes", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function go($codeID = 0) {
		$this->CSS("codes", $this->application);
		$this->CSS("pagination");

		$data = $this->Cache->data("code-$codeID", "codes", $this->Codes_Model, "getByID", array($codeID));

		if($data) {
			$this->helper("time");

			$this->title(__(_("Codes")) ." - ". $data[0]["Title"]);
			
			$this->Codes_Model->updateViews($codeID);

			$vars["code"] 	= $data[0];
			$vars["view"]   = $this->view("codes", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
	
	public function visit($codeID = 0) {
		$data = $this->Cache->data("bookmark-$codeID", "codes", $this->Codes_Model, "getByID", array($codeID));

		if($data) {
			$this->Codes_Model->updateViews($codeID);

			redirect($data[0]["URL"]);
		} else {
			redirect();
		}
	}

	public function getCodes() {
		$this->title(__(_("Codes")));
		$this->CSS("codes", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit();
		
		$data = $this->Cache->data("codes-$limit", "codes", $this->Codes_Model, "getAll", array($limit));
	
		$this->helper("time");
		
		if($data) {	
			$vars["codes"]  	= $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("codes", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();	
		} 
	}
		
	private function limit($tag = NULL) {
		$count = $this->Codes_Model->count($tag);	
		
		if(is_null($tag)) {
			$start = (segment(1, isLang()) === "page" and segment(2, isLang()) > 0) ? (segment(2, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("codes/page/");
		} else {
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("codes/tag/$tag/page/");
		}	

		$limit = $start .", ". _maxLimit;
		
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;

		return $limit;
	}
}