<?php

	// Show errors for debugging mode, set to zero for release mode
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	// Load DFM & model classes
	require_once("../core/main.dfm.php");
	
	spl_autoload_register(function($class) {
		dfm::inc_model( $class, "../" );
	});	
	
	// Controller 
	$controller_name = Request::get("controller", Request::TYPE_ALNUM);
	$project_controller = Request::get("type", Request::TYPE_ALNUM) == 'project' ? 'project/' : '';
	
	require_once('../controllers/' . $project_controller . $controller_name . '_controller.php');
	
	// Attributes
	$attributes = array();
	
	switch ($controller_name)
	{
		case "user":
		
			$table = "ea_users u, ea_user_settings us";
			$controller = new UserController();
			$attributes = $controller->table_attributes();	
			
		break;
		case "client":
		
			$table = "ea_services";
			$controller = new ClientController();
			$attributes = $controller->table_attributes();
		
		break;
		case "site":
		
			$table = "ea_users";
			$controller = new SiteController();
			$attributes = $controller->table_attributes();
			
		break;
			
	}
	
	$table = array_key_exists('tables', $attributes) ? $attributes['tables'] : $table;
	$crud = new crud($controller_name, $table, $attributes);
	$model = new $controller_name;

	if(!isset($_GET['action'])) {
		print json_encode(0);
		return;
	}

	// Route CRUD
	switch($_GET['action']) {
		case 'index':
		
			// Manipulate DATA with application model
			$newdata = $model->updateReadData( $crud->getData() );
		
			print json_encode($newdata);	
			break;
			
		case 'create':
			$post = $_POST;
			
			// Manipulate POST with application model
			$newpost = $model->updateCreatePost($post);
			
			// Send to AJAX script
			print $crud->createData($newpost);		
			
			// Manipulate AFTER-POST with application model (IF EXISTS)
			if (method_exists($model, 'afterCreatePost'))
			{
				$model->afterCreatePost($newpost);
			}
			
			break;
			
		case 'delete':
			$id  = $_POST["id"];
			print $crud->deleteData($id);		
			break;
			
		case 'update':
			$id  = $_POST["id"];
			$post = $_POST;
			
			// Manipulate POST with application model
			$newpost = $model->updateEditPost($id, $post);
			
			print $crud->updateData($id, $newpost);				
			break;
	}

	exit();
?>