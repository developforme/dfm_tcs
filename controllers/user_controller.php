<?php
	class UserController 
	{
		public function index() 
		{
			$users = User::all();
			require_once('views/user/index.php');
		}
		
		public function show() 
		{
			if (!isset($_GET['id'])) {
				return call('pages', 'error');
			}

			$user = User::find($_GET['id']);
			require_once('views/user/show.php');
		}
	}
?>