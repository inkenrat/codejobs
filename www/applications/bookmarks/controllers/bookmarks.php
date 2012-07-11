<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Bookmarks_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->Templates = $this->core("Templates");
		$this->Cache     = $this->core("Cache");
		
		$this->application = $this->app("bookmarks");
		
		$this->Templates->theme();

		$this->config("bookmarks");
		
		$this->Bookmarks_Model = $this->model("Bookmarks_Model");

		$this->helper("pagination");
	}
	
	public function index($bookmarkID = 0) {
		if($bookmarkID !== "add") {
			if($bookmarkID > 0) {
				$this->go($bookmarkID);
			} else {
				$this->getBookmarks();
			}
		}
	}

	public function add() {
		isConnected();

		if(POST("save")) {
			$vars["alert"] = $this->Bookmarks_Model->add();
		} 

		$this->CSS("forms", "cpanel");

		$this->helper(array("html", "forms"));

		$vars["view"] = $this->view("new", TRUE);

		$this->render("content", $vars);
	}

	public function like($ID) {
		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setLike($ID, "bookmarks", 10);
	}

	public function dislike($ID) {
		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setDislike($ID, "bookmarks", 10);
	}

	public function report($ID) {
		$this->Bookmarks_Model->setReport($ID, "bookmarks", 10);
	}	

	public function tag($tag) {
		$this->title(__(_("Bookmarks")));
		$this->CSS("bookmarks", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit($tag);

		$data = $this->Cache->data("tag-$tag-$limit", "bookmarks", $this->Bookmarks_Model, "getByTag", array($tag, $limit));

		if($data) {
			$this->helper("time");

			$vars["bookmarks"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("bookmarks", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function go($bookmarkID = 0) {
		$this->CSS("bookmarks", $this->application);
		$this->CSS("pagination");

		$data = $this->Cache->data("bookmark-$bookmarkID", "bookmarks", $this->Bookmarks_Model, "getByID", array($bookmarkID));

		if($data) {
			$this->helper("time");

			$this->title(__(_("Bookmarks")) ." - ". $data[0]["Title"]);
			
			$this->Bookmarks_Model->updateViews($bookmarkID);

			$vars["bookmark"] = $data[0];
			$vars["view"]     = $this->view("bookmark", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
	
	public function visit($bookmarkID = 0) {
		$data = $this->Cache->data("bookmark-$bookmarkID", "bookmarks", $this->Bookmarks_Model, "getByID", array($bookmarkID));

		if($data) {
			$this->Bookmarks_Model->updateViews($bookmarkID);

			redirect($data[0]["URL"]);
		} else {
			redirect();
		}
	}

	public function getBookmarks() {
		$this->title(__(_("Bookmarks")));
		$this->CSS("bookmarks", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit();
		
		$data = $this->Cache->data("bookmarks-$limit", "bookmarks", $this->Bookmarks_Model, "getAll", array($limit));
	
		$this->helper("time");
		
		if($data) {	
			$vars["bookmarks"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("bookmarks", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();	
		} 
	}
		
	private function limit($tag = NULL) {
		$count = $this->Bookmarks_Model->count($tag);	
		
		if(is_null($tag)) {
			$start = (segment(1, isLang()) === "page" and segment(2, isLang()) > 0) ? (segment(2, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("bookmarks/page/");
		} else {
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("bookmarks/tag/$tag/page/");
		}	

		$limit = $start .", ". _maxLimit;
		
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;

		return $limit;
	}
}