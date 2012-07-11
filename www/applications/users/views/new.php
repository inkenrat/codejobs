<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

$name  = isset($name)  ? recoverPOST("name", $name)    : recoverPOST("name");	
$email = isset($email) ? recoverPOST("email", $email)  : recoverPOST("email");				
$pwd   = isset($pwd)   ? recoverPOST("password", $pwd) : recoverPOST("password");

echo div("new-user", "class");
	echo formOpen(path("users/register"), "form", "form");
		echo p(__(_("Join today to")) ." ". get("webName"), "resalt");
		
		if(!isset($alert) and SESSION("UserRegistered") and !POST("register")) {
			redirect();
		} else {
			if(POST("register") and SESSION("UserRegistered")) {
				echo getAlert(__("You can't register many times a day"));
			} else { 
				echo isset($alert) ? $alert : NULL;
			}
		}

		if(!isset($inserted) or !$inserted) {
			if(!SESSION("UserRegistered")) {
				echo formInput(array(
					"id"	   => "username",
					"name" 	   => "username",
					"pattern"  => "^[a-z0-9_-]{3,15}$", 
					"class"    => "required", 
					"field"    => __(_("Username")), 
					"p" 	   => TRUE, 
					"value"    => recoverPOST("username"),
					"required" => TRUE
				));

				echo formInput(array(					
					"name" 	   => "name", 
					"field"    => __(_("Name")), 
					"p" 	   => TRUE, 
					"value"    => $name,
					"required" => TRUE
				));

				echo formInput(array(	
					"name" 	   => "password",
					"pattern"  => "^.*(?=.{6,})(?=.*[a-zA-Z])[a-zA-Z0-9]+$", 
					"type"     => "password",
					"field"    => __(_("Password")), 
					"p" 	   => TRUE, 
					"value"    => $pwd,
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
				
				echo formInput(array(	
					"name" 	=> "register",
					"type"  => "submit",
					"class" => "submit",
					"value" => __(_("Create my account"))
				));
			}
		}

	echo formClose();
echo div(FALSE);