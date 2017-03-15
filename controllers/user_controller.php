<?php
	class UserController 
	{
		
		/* TABLE ATTRIBUTES */
		public function table_attributes( $crud = "index" )
		{
			switch( $crud )
			{
				case "index":
					$attributes = array(
						"username" => "Username",
						"fullname" => "Full Name",
						"email"    => "Email",
						);
					break;
				
				case "create":
					$attributes = array(
						"username",
						"fullname",
						"email",
						"password",
						);
					break;
			}
			
			return $attributes;
		}
	
		public function index() 
		{
			// Login required
			if( empty(User::userID()) ) {
				echo "Access denied";
				exit();
			}

			/* CRUD VIEWS */
			$title = "Manage Users";
			$controller_type = "core";
			
			require_once('views/crud/header.php');
			require_once('views/crud/read.php');
			
			/* CREATE ATTRIBUTES */
			$create_attributes = array
			  (
			  array(
			    "name"       => "username", 
				"text"       => "Username",
				"type"       => "input", 
				"data-error" => "Please enter the username.", 
				"required"   => "required"),
			  array(
				"name"       => "fullname", 
				"text"       => "Full Name",
				"type"       => "input", 
				"data-error" => "Please enter the full name.", 
				"required"   => "required"),
			  array(
				"name"	     => "email", 
				"text"       => "Email",
				"type" 	     => "input", 
				"data-error" => "Please enter an email address", 
				"required"   => "required"),
			  array(
				"name"	     => "password", 
				"text"       => "Password",
				"type" 	     => "password", 
				"data-error" => "Please enter the user passworrd", 
				"required"   => "required")
			  );
			  
			require_once('views/crud/create.php');
			
			/* EDIT ATTRIBUTES */
			$edit_attributes = array
			  (
			  array(
			    "name"       => "username", 
				"text"       => "Username",
				"type"       => "input", 
				"data-error" => "Please enter the username.", 
				"required"   => "required"),
			  array(
				"name"       => "fullname", 
				"text"       => "Full Name",
				"type"       => "input", 
				"data-error" => "Please enter the full name.", 
				"required"   => "required"),
			  array(
				"name"	     => "email", 
				"text"       => "Email",
				"type" 	     => "input", 
				"data-error" => "Please enter an email address", 
				"required"   => "required"),
			  );
			
			require_once('views/crud/update.php');
			require_once('views/crud/footer.php');

		}
	}
?>