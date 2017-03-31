<?php
	// Show errors for debugging mode, set to zero for release mode
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	// Require DB connection
	require_once('models/db.php');
	require_once('core/main.dfm.php');
	require_once('core/session.php');

	if(isset($_POST['btn-login']))
	{
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['password']);



		try
		{ 
			$db = db::getInstance();
			$req = $db->prepare('SELECT u.id, u.last_login, us.salt, us.password FROM ea_users u, ea_user_settings us WHERE u.id = us.id_users AND u.email = :email');
			$req->execute(array(":email"=>$user_email));
			$row = $req->fetch();
			
			//$password = md5($user_password);
			$password = dfm::hash_password($row['salt'], $user_password);		

			// Login Success
			if($row['password'] == $password)
			{
				// Pass 1 to AJAX Script
				echo '1'; 
				
				// Set session
				$_SESSION['dfm_auth'] = $row['id'].":".$password;
				$_SESSION['lastlogin'] = $row['last_login'];
				$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

				// Set cookie
				setcookie("dfm_auth", $row['id'].":".$password, time()+(Session::session_duration()*60*60),'/');	

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