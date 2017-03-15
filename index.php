<?php
	// Start session
	session_name('dfm_session');
	session_start();

	// Show errors for debugging mode, set to zero for release mode
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	// Load DFM & model classes
	require_once("core/main.dfm.php");
	
	spl_autoload_register(function($class) {
		dfm::inc_model( $class );
	});	
	
	// Get controller and action
	if (isset($_GET['controller']) && isset($_GET['action'])) 
	{
		$controller = $_GET['controller'];
		$action     = $_GET['action'];
	} 
	// If no controller and action show homepage
	else 
	{
		$controller = 'pages';
		$action     = 'home';
	}

	// UI Layout 
	require_once('views/layout.php');
?>