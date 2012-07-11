<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(_(ucfirst(whichApplication()))), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array("name" => "username", "class" => "input required", "field" => __(_("Username")), "p" => TRUE, "value" => $username));
			
			echo formInput(array("name" => "pwd", "type" => "password", "class" => "input required", "field" => __(_("Password")), "p" => TRUE, "value" => $pwd));

			echo formInput(array("name" => "pwd2", "type" => "hidden", "value" => $pwd));
	
			echo formInput(array("name" => "email", "class" => "input required", "field" => __(_("Email")), "p" => TRUE, "value" => $username));
			
			$i = 0;
			foreach($privileges as $value) { 
				$options[$i]["value"]    = $value["ID_Privilege"];
				$options[$i]["option"]   = $value["Privilege"];
				$options[$i]["selected"] = ($value["ID_Privilege"] === $privilege) ? TRUE : FALSE;

				$i++;
			} 

			echo formSelect(array("name" => "privilege", "class" => "select", "p" => TRUE, "field" => __(_("Privilege")), $options));
			
			$options = array(
				0 => array("value" => "Active",   "option" => __(_("Active")),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __(_("Inactive")), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array("name" => "situation", "class" => "select", "p" => TRUE, "field" => __(_("Situation")), $options));
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);