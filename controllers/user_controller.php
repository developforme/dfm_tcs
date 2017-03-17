<?php
	class UserController 
	{
		
		var $title = "Manage Users";
		var $controller_type = "core";
		
		public function index() 
		{
			// Login required
			if( empty(User::userID()) ) {
				echo "Access denied";
				exit();
			}
			
			/* CRUD VIEWS */
			$title = $this->title;
			$controller_type = $this->controller_type;
			
			require_once('views/crud/header.php');
			require_once('views/crud/read.php');
			
			/* ATTRIBUTES */
			$create_attributes = self::table_attributes()["create_attributes"];
			$edit_attributes = self::table_attributes()["update_attributes"];

			require_once('views/crud/create.php');
			require_once('views/crud/update.php');
			require_once('views/crud/footer.php');

		}
		
		/* TABLE ATTRIBUTES */
		public function table_attributes()
		{
			$crud_attributes = array();
			
			/* READ
			 * Viewed in the main table 
			 * @Key = field name
			 * @Value = UI text
			*/
			$crud_attributes["index"] = [
				"username" => "Username",
				"fullname" => "Full Name",
				"email"    => "Email"
			];
			
			/* UPDATE ATTRIBUTES
			 * Viewed when editing an existing row
			 * @Key = field name
			 * @Value = UI text
			*/
			$crud_attributes["update_attributes"] = array
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
			
			/* CREATE ATTRIBUTES
			 * Viewed when creating a new row
			 * @Key = field name
			 * @Value = UI text
			*/
			$crud_attributes["create_attributes"] = array
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
				"data-error" => "Please enter the user password", 
				"required"   => "required"),
			  array(
				"name"	     => "join_date", 
				"text"       => "",
				"type" 	     => "hidden", 
				"data-error" => "", 
				"required"   => "")
			  );
						
			return $crud_attributes;
		}
	}
?>