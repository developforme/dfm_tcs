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
		
			$table = "users";
			$controller = new UserController();
			$attributes = $controller->table_attributes();	
			
		break;
		case "client":
		
			$table = "clients";
			$controller = new ClientController();
			$attributes = $controller->table_attributes();
		
		break;
		case "site":
		
			$table = "sites";
			$controller = new SiteController();
			$attributes = $controller->table_attributes();
			
		break;
			
	}
	
	$crud=new crud($controller_name, $table, $attributes);

	if(!isset($_GET['action'])) {
		print json_encode(0);
		return;
	}

	// Route CRUD
	switch($_GET['action']) {
		case 'index':
			print $crud->getData();	
			break;
			
		case 'create':
			$post = $_POST;
			print $crud->createData($post);		
			break;
			
		case 'delete':
			$id  = $_POST["id"];
			print $crud->deleteData($id);		
			break;
			
		case 'update':
			$id  = $_POST["id"];
			$post = $_POST;
			print $crud->updateData($id, $post);				
			break;
	}

	exit();
?>