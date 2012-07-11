<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	     = isset($data) ? recoverPOST("ID", $data[0]["ID_Link"]) 				: 0;
	$title       = isset($data) ? recoverPOST("title", $data[0]["Title"]) 				: recoverPOST("title");
	$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) 	: recoverPOST("description");
	$URL         = isset($data) ? recoverPOST("URL", $data[0]["URL"]) 					: recoverPOST("URL");
	$tags    	 = isset($data) ? recoverPOST("tags", $data[0]["Tags"]) 				: recoverPOST("tags");
	$language  	 = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 	: recoverPOST("language");
	$situation   = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) 		: recoverPOST("situation");
	$edit        = isset($data) ? TRUE 													: FALSE;
	$action	     = isset($data) ? "edit"												: "save";
	$href	     = isset($data) ? path($this->application ."/cpanel/edit/$ID") 			: path($this->application ."/cpanel/add/");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(_(ucfirst(whichApplication()))), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __(_("Title")), 
				"p" 	=> TRUE, 
				"value" => $title
			));

			echo formInput(array(	
				"name" 	=> "URL", 
				"class" => "span10 required", 
				"field" => __(_("URL")), 
				"p" 	=> TRUE, 
				"value" => $URL
			));
			
			echo formTextarea(array(	
				"id" 	 => "editor", 
				"name" 	 => "description", 
				"class"  => "span10 required",
				"style"  => "height: 200px;", 
				"field"  => __(_("Description")), 
				"p" 	 => TRUE, 
				"value"  => $description
			));

			echo formInput(array(	
				"name" 	=> "tags", 
				"class" => "span10 required", 
				"field" => __(_("Tags")), 
				"p" 	=> TRUE, 
				"value" => $tags
			));

			echo formField(NULL, __(_("Language of the post")) ."<br />". getLanguagesInput($language, "language", "select"));
			
			$options = array(
				0 => array("value" => "Active",   "option" => __(_("Active")),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __(_("Inactive")), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array("name" => "situation", "class" => "select", "p" => TRUE, "field" => __(_("Situation"))), $options);
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);