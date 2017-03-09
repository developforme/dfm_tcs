<?php
	function call($controller, $action) 
	{
		require_once('controllers/' . $controller . '_controller.php');

		switch($controller) 
		{
			case 'pages':
				$controller = new PagesController();
				break;		
				
			case 'login':
				require_once('models/login.php');
				$controller = new LoginController();
				break;	
				
			case 'logged':
				require_once('models/logged.php');
				$controller = new LoggedController();
				break;	

			case 'user':
				require_once('models/user.php');
				$controller = new UserController();
				break;			
		}

		$controller->{ $action }();
	}

	$controllers = array('pages'  => ['home', 'error'],
						 'login'  => ['index'],
						 'logged' => ['index'],
						 'user'   => ['index', 'show']);

	if (array_key_exists($controller, $controllers)) 
	{
		if (in_array($action, $controllers[$controller])) {
			call($controller, $action);
		} else {
			call('pages', 'error');
		}
	} else {
		call('pages', 'error');
	}
?>