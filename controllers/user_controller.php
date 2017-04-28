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
				"CONCAT(
				  u.first_name, ' ', u.last_name) 
				  AS name"    => "Name",
				"us.username" => "Username",
				"u.email"     => "Email"
			];
			
			$crud_attributes["where"] = "u.id = us.id_users AND id_roles = 1";
			
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
				"name"       => "first_name", 
				"text"       => "Full Name",
				"data-error" => "Please enter the full name.", 
				"required"   => "required"),
			  array(
				"form"       => "input",
				"type"       => "hidden", 
				"name"       => "last_name", 
				"text"       => "",
				"data-error" => "", 
				"required"   => ""),
			  array(
				"form"       => "input",
				"type"       => "text", 
			    "name"       => "username", 
				"text"       => "Username",
				"data-error" => "Please enter the username.", 
				"required"   => "required"),
			  array(
				"form"       => "input",
				"type"       => "text", 
				"name"	     => "email", 
				"text"       => "Email",
				"data-error" => "Please enter an email address", 
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
			    "name"       => "username", 
				"text"       => "Username",
				"data-error" => "Please enter the username.", 
				"required"   => "required",
				"exclude"    => 1),
			  array(
				"form"       => "input",
				"type"       => "text", 
				"name"       => "first_name", 
				"text"       => "Full Name",
				"data-error" => "Please enter the full name.", 
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
				"type"       => "password", 
				"name"	     => "password", 
				"text"       => "Password",
				"data-error" => "Please enter the user password", 
				"required"   => "required",
				"exclude"    => 1),
			  array(
			    "form"       => "input",
				"type"       => "hidden", 
				"name"	     => "last_name", 
				"text"       => "",
				"data-error" => "", 
				"required"   => ""),
			  array(
			    "form"       => "input",
				"type"       => "hidden", 
				"name"	     => "id", 
				"text"       => "",
				"data-error" => "", 
				"required"   => ""),
			  array(
				"form"       => "input",
				"type"       => "hidden", 
				"name"	     => "id_roles", 
				"text"       => "",
				"data-error" => "", 
				"required"   => ""),
			  array(
				"form"       => "input",
				"type"       => "hidden", 
				"name"	     => "join_date", 
				"text"       => "",
				"data-error" => "", 
				"required"   => "")
			);
			  
			// If using different tables for CRUD
			$crud_attributes["tables"] = [
				"create" => "ea_users",
				"read"   => "ea_users u, ea_user_settings us", 
				"update" => "ea_users", 
				"delete" => "ea_users"
			];
			
	
			return $crud_attributes;
		}
		
		public function show() 
		{
			
			if (!isset($_GET['id'])) {
				return call('pages', 'error');
			}

			$user = User::find($_GET['id']);

			require_once('views/user/show.php');
			
		}
		
		public function edit() 
		{
			if (!isset($_GET['id'])) {
				return call('pages', 'error');
			}

			$user = User::find($_GET['id']);

			if(isset($_POST['update_user']))
			{
				
				$password = dfm::hash_password($user['salt'], trim($_POST['password']));	
				
				$user_profile = 
					array(
					  "first_name" => $_POST['first_name'],
					  "last_name"  => $_POST['last_name'],
					  "email"      => $_POST['email']
					  );
				
				$user_settings =
					array(
					  "username" => $_POST['username'],
					  "password" => $password,
					  );
				
				db::update_array($user['id'], "ea_users", $user_profile);
				db::update_array($user['id'], "ea_user_settings", $user_settings, array(), "id_users");
				
				echo "Success";
			}
			
			require_once('views/user/edit.php');
			
			
			
		}
		
	}
?>