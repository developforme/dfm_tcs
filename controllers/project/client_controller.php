<?php
	class ClientController 
	{
		var $title = "Manage Clients";
		var $controller_type = "project";

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
				"name"      => "Name",
				"address"   => "Address",
				"email"     => "Email",
				"telephone" => "Telephone"
			];
			
			/* UPDATE ATTRIBUTES
			 * Viewed when editing an existing row
			 * @Key = field name
			 * @Value = UI text
			*/
			$crud_attributes["update_attributes"] = array
			  (
			  array(
				"form"       => "input",
				"type"       => "text", 
			    "name"       => "name", 
				"text"       => "Name",
				"data-error" => "Please enter the client's name.", 
				"required"   => "required"),
			  array(
				"form"       => "input",
				"type"       => "textarea",
				"name"       => "address", 
				"text"       => "Address",
				"data-error" => "Please enter the address.", 
				"required"   => "required"),
			  array(
				"form"       => "input",
				"type"       => "text", 
				"name"	     => "email", 
				"text"       => "Email",
				"data-error" => "Please enter an email address", 
				"required"   => "required"),
			  array(
				"form"       => "input",
				"type" 	     => "text", 
				"name"	     => "telephone", 
				"text"       => "Telephone",
				"data-error" => "Please enter the telephone number", 
				"required"   => "required")
			  );
			  

			/* CREATE ATTRIBUTES
			 * Viewed when creating a new row
			 * @Key = field name
			 * @Value = UI text
			*/
			$crud_attributes["create_attributes"] = array
			  (
			  array(
				"form"       => "input",
				"type"       => "text", 
			    "name"       => "name", 
				"text"       => "Name",
				"data-error" => "Please enter the client's name.", 
				"required"   => "required"),
			  array(
				"form"       => "input",
				"type"       => "textarea", 
				"name"       => "address", 
				"text"       => "Address",
				"data-error" => "Please enter the address.", 
				"required"   => "required"),
			  array(
				"form"       => "input",
				"type"       => "text", 
				"name"	     => "email", 
				"text"       => "Email",
				"data-error" => "Please enter an email address", 
				"required"   => "required"),
			  array(
				"form"       => "input",
				"type" 	     => "text", 
				"name"	     => "telephone", 
				"text"       => "Telephone",
				"data-error" => "Please enter the telephone number", 
				"required"   => "required")
			  );	
			

			return $crud_attributes;
		}
	}
?>