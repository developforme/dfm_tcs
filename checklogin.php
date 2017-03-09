<?php
	// Start session
	session_start();
	
	// Show errors for debugging mode, set to zero for release mode
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	// Require DB connection
	require_once('connection.php');
	require_once('core/session.php');

	if(isset($_POST['btn-login']))
	{
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['password']);

		$password = md5($user_password);

		try
		{ 
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM users WHERE email = :email');
			$req->execute(array(":email"=>$user_email));
			$row = $req->fetch();

			// Login Success
			if($row['password'] == $password)
			{
				// Pass 1 to AJAX Script
				echo '1'; 
				
				// Set session
				$_SESSION['dfm_auth'] = $row['userID'].":".$password;
				$_SESSION['lastlogin'] = $row['last_login'];
				$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

				// Set cookie
				setcookie("dfm_auth", $row['userID'].":".$password, time()+(Session::session_duration()*60*60));	

			}
			
			// Login failed
			else{
				echo "Email or password does not exist"; // login fail
		   }
		}
		// MYSQL ERROR
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
?>