<?php
	class LoggedController 
	{
		public function index() 
		{

			if( empty( User::userID()) ) {
				header("Location: index.php");
			}
			
			$user = User::find(User::userID());
			require_once('views/logged/index.php');
		}		
	}
?>