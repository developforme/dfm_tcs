<?php
	class LoginController 
	{
		public function index() 
		{
			if( empty( User::userID()) ) {
				require_once('views/login/index.php');
			}
			else{
				dfm::redirect('index.php?controller=logged&action=index');
			}
		}
	}
?>