<?php
	function call($controller, $action, $_type_controller = 'core') 
	{
		// Core
		if($_type_controller == "core")
		{
			// Require core controller
			require_once('controllers/' . $controller . '_controller.php');
			
			switch($controller) 
			{
				/* Core */
				case 'pages':
					$controller = new PagesController();
					break;		
					
				case 'login':
					$controller = new LoginController();
					break;	
					
				case 'logged':
					$controller = new LoggedController();
					break;	

				case 'user':
					$controller = new UserController();
					break;
			}
		}
		
		// Project
		if($_type_controller == "project")
		{
		
			// Require project controller
			require_once('controllers/project/' . $controller . '_controller.php');
			
			
			switch($controller) 
			{
				case 'site':
					require_once("models/project/site.php");
					$controller = new SiteController();
					break;
					
				case 'client':
					require_once("models/project/client.php");
					$controller = new ClientController();
					break;
			}
		}

		$controller->{ $action }();
	}
	
	// Core controllers
	$core_controllers = array('pages'  => ['home', 'error'],
							  'login'  => ['index'],
							  'logged' => ['index'],
							  'user'   => ['index', 'show']);
	// Project Controllers
	$project_controllers =  array('client' => ['index', 'show'],
								  'site'   => ['index', 'show']);

				
	// Merge controllers
	$controllers = array_merge($core_controllers, $project_controllers);

	if (array_key_exists($controller, $controllers)) 
	{
		if(isset($core_controllers[$controller]))
		{
			if (in_array($action, $core_controllers[$controller])) {
				call($controller, $action, 'core');
			} 
			else {
				call('pages', 'error');
			}
		}
		
		else if(isset($project_controllers[$controller]))
		{
			if (in_array($action, $project_controllers[$controller])) {
				call($controller, $action, 'project');
			} 
			else {
				call('pages', 'error');
			}
		}
	} 
	else {
		call('pages', 'error');
	}
?>