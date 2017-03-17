<?php
	class ClientController 
	{
		
		/* TABLE ATTRIBUTES */
		public function table_attributes( $crud = "index" )
		{
			
			$crud_attributes = array();
			
			// READ
			$crud_attributes["index"] = [
				"name"      => "Name",
				"address"   => "Address",
				"email"     => "Email",
				"telephone" => "Telephone"
			];
			
			// UPDATE
			$crud_attributes["update"] = ["name", "address", "email", "telephone", "id"];
			
			// CREATE
			$crud_attributes["create"] = ["name", "address", "email", "telephone"];
						
			return $crud_attributes;
			
		}
		
		public function index() 
		{
			// Login required
			if( empty(User::userID()) ) {
				echo "Access denied";
				exit();
			}
			
			/* CRUD VIEWS */
			$title = "Manage Clients";
			$controller_type = "project";
			
			require_once('views/crud/header.php');
			require_once('views/crud/read.php');
			
			/* CREATE ATTRIBUTES */
			$create_attributes = array
			  (
			  array(
			    "name"       => "name", 
				"text"       => "Name",
				"type"       => "input", 
				"data-error" => "Please enter the client's name.", 
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
			  
			require_once('views/crud/create.php');
			
			/* EDIT ATTRIBUTES */
			$edit_attributes = array
			  (
			  array(
			    "name"       => "name", 
				"text"       => "Name",
				"type"       => "input", 
				"data-error" => "Please enter the client's name.", 
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
			
			require_once('views/crud/update.php');
			require_once('views/crud/footer.php');

		}
	
		/*
		public function index() 
		{
			$clients = Client::all();
			require_once('views/project/client/index.php');
		}
		
		public function show() 
		{
			
			if (!isset($_GET['id'])) {
				return call('pages', 'error');
			}

			$client = User::find($_GET['id']);
			require_once('views/project/client/show.php');
			
		}
		
		*/
	}
?>