<?php
	class SiteController 
	{
		var $title = "Manage Sites";
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
			    "name"       => "name", 
				"text"       => "Name",
				"type"       => "input", 
				"data-error" => "Please enter the site's name.", 
				"required"   => "required"),
			  array(
				"name"       => "address", 
				"text"       => "Address",
				"type"       => "textarea", 
				"data-error" => "Please enter the address.", 
				"required"   => "required"),
			  array(
				"name"	     => "email", 
				"text"       => "Email",
				"type" 	     => "input", 
				"data-error" => "Please enter an email address", 
				"required"   => "required"),
			  array(
				"name"	     => "telephone", 
				"text"       => "Contact",
				"type" 	     => "text", 
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
			    "name"       => "name", 
				"text"       => "Name",
				"type"       => "input", 
				"data-error" => "Please enter the site's name.", 
				"required"   => "required"),
			  array(
				"name"       => "address", 
				"text"       => "Address",
				"type"       => "textarea", 
				"data-error" => "Please enter the address.", 
				"required"   => "required"),
			  array(
				"name"	     => "email", 
				"text"       => "Email",
				"type" 	     => "input", 
				"data-error" => "Please enter an email address", 
				"required"   => "required"),
			  array(
				"name"	     => "telephone", 
				"text"       => "Telephone",
				"type" 	     => "text", 
				"data-error" => "Please enter the telephone number", 
				"required"   => "required")
			  );	
			

			return $crud_attributes;
		}
	}
?>