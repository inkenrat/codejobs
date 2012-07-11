<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	     = isset($data) ? recoverPOST("ID", $data[0]["ID_Link"]) 				: 0;
	$title       = isset($data) ? recoverPOST("title", $data[0]["Title"]) 				: recoverPOST("title");
	$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) 	: recoverPOST("description");
	$URL         = isset($data) ? recoverPOST("URL", $data[0]["URL"]) 					: "http://";
	$tags    	 = isset($data) ? recoverPOST("tags", $data[0]["Tags"]) 				: recoverPOST("tags");
	$language  	 = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 	: recoverPOST("language");
	$situation   = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) 		: recoverPOST("situation");
	$edit        = isset($data) ? TRUE 													: FALSE;
	$action	     = isset($data) ? "edit"												: "save";
	$href	     = path("bookmarks/add/");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Add new bookmark"), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "required",
				"style" => "width: 300px;", 
				"field" => __(_("Title")), 
				"p" 	=> TRUE, 
				"value" => $title
			));

			echo formInput(array(	
				"name" 	=> "URL", 
				"class" => "required",
				"style" => "width: 300px;", 
				"field" => __(_("URL")), 
				"p" 	=> TRUE, 
				"value" => $URL
			));
			
			echo formTextarea(array(	
				"id" 	 => "editor", 
				"name" 	 => "description", 
				"class"  => "required",
				"style"  => "width: 300px; height: 140px;", 
				"field"  => __(_("Description")), 
				"p" 	 => TRUE, 
				"value"  => $description
			));

			echo formInput(array(	
				"name" 	=> "tags", 
				"class" => "required",
				"style" => "width: 300px;", 
				"field" => __(_("Tags")), 
				"p" 	=> TRUE, 
				"value" => $tags
			));

			echo formField(NULL, __(_("Language of the post")) ."<br />". getLanguagesInput($language, "language", "select"));
			
			echo formInput(array(	
				"name" 	=> "save", 
				"class" => "required", 
				"value" => __("Save"), 
				"type"  => "submit"
			));
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);