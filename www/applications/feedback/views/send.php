<?php 
if(!defined("_access")) {
	die("Error: You don't have permission to access here..."); 
}

$name  = recoverPOST("name");	
$email = recoverPOST("email");
$message = recoverPOST("message");

echo div("new-user", "class");
	echo formOpen(path("users/register/new"), "form-new", "form-new");
		echo p(__(_("Contact us today")), "resalt");
		
		echo isset($alert) ? $alert : NULL;
		
		if(!is($inserted, TRUE)) {
			echo formInput(array(
				"id"	   => "name",
				"name" 	   => "name",				
				"field"    => __(_("Name")), 
				"p" 	   => TRUE, 
				"value"    => $name,
				"required" => TRUE
			));
			
			echo formInput(array(	
				"name" 	   => "email",
				"pattern"  => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
				"type"     => "email",
				"field"    => __(_("Email")), 
				"p" 	   => TRUE, 
				"value"    => $email,
				"required" => TRUE
			));
			
			echo formTextarea(array(
				"id"	   => "editor",
				"name" 	   => "message",								
				"field"    => __(_("Message")), 
				"p" 	   => TRUE, 
				"value"    => $message,
				"required" => TRUE
			));
			
			echo formInput(array(	
				"name" 	=> "send",
				"type"  => "submit",
				"class" => "submit",
				"value" => __(_("Send my message"))
			));
		}

	echo formClose();
echo div(FALSE);