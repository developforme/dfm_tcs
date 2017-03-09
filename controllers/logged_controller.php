<?php
	class LoggedController 
	{
		public function index() 
		{

			if(!isset($_SESSION['dfm_auth']))
			{
				header("Location: index.php");
			}
			
			$user = User::find(User::userID());
			require_once('views/logged/index.php');
		}		
	}
?>