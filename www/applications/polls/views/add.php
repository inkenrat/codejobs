<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	   = isset($data) ? recoverPOST("ID", $data[0]["ID_Poll"])			 : recoverPOST("ID");
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])			 : recoverPOST("title");
	$answers   = isset($data) ? recoverPOST("answers", $data[1])				 : recoverPOST("answers");
	$type 	   = isset($data) ? recoverPOST("type", $data[0]["Type"])			 : recoverPOST("type");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])	 : recoverPOST("situation");
	$edit      = isset($data) ? TRUE 											 : FALSE;
	$action	   = isset($data) ? "edit"											 : "save";
	$href	   = isset($data) ? path($this->application ."/cpanel/$action/$ID/") : path($this->application ."/cpanel/add/");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(_(ucfirst(whichApplication()))), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array("name" => "title", "class" => "input required", "field" => __(_("Question")), "p" => TRUE, "value" => $title));
						
			echo div("answers");
				echo formField(NULL, __(_("Answers")) ." (". __(_("Empty answers not be added")) . "))");
				
				if(is_array($answers)) { 
					foreach($answers as $key => $answer) { 
						echo p(TRUE, "field panswer");	
							echo span("count", ($key + 1) . ".-");
							echo formInput(array("name" => "answers[]", "class" => "input required", "value" => $answer));	
						echo p(FALSE);
					}
				} else { 
					echo p(TRUE, "field panswer");	
						echo span("count", "1.-");
						echo formInput(array("name" => "answers[]", "class" => "input required", "value" => $answers));	
					echo p(FALSE);
				} 

			echo div(FALSE);
			
			echo span(NULL, repeat("&nbsp;", 4), "add-img");

			$options = array(
				0 => array("value" => "Simple",   "option" => __(_("Simple")),   "selected" => ($type === "Simple")   ? TRUE : FALSE),
				1 => array("value" => "Multiple", "option" => __(_("Multiple")), "selected" => ($type === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array("name" => "type", "class" => "select", "p" => TRUE, "field" => __(_("Type"))), $options);
			
			$options = array(
				0 => array("value" => "Active",   "option" => __(_("Active")),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __(_("Inactive")), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array("name" => "situation", "class" => "select", "p" => TRUE, "field" => __(_("Situation"))), $options);
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);