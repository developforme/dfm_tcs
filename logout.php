<?php
	session_name('dfm_session');
	session_start();
	
	// unset session variables
	$_SESSION = Array();

	// remove session cookie
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	
	session_destroy();

	// remove login cookie
	if (isset($_COOKIE['dfm_auth'])) {
		setcookie('dfm_auth', '', time()-(24*60*60), '/');
	}

	header("Location: index.php?controller=login&action=index");
?>