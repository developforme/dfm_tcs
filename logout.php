<?php
	session_start();
	unset($_SESSION['dfm_auth']);

	if(session_destroy())
	{
		header("Location: index.php");
	}
?>