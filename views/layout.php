<DOCTYPE html>
<html>
	<head>
		<!-- META TAGS -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>TCS Application</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- BOOTSTRAP CSS -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
		
		<!-- MVC CSS -->
		<link href="css/style.css" rel="stylesheet" media="screen">
		
		<!-- AJAX LOGIN SCRIPTS -->
		<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
		<script type="text/javascript" src="js/validation.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		
	</head>
	<body>
		<div id="page-wrap">
			<header style="margin-bottom: 10px">
				<ul> 
				
					<li><a href='index.php'>Home</a></li>

					<?php if( empty(User::userID()) ) { ?> 
					<li><a href='?controller=login&action=index'>Login</a></li>
					<?php } else { ?> 
					<li><a href='?controller=user&action=index'>Users</a></li>
					<li><a href='?controller=logged&action=index'>Admin</a></li>
					
					<!-- BEGIN PROJECT MENU -->
					<li><a href='?controller=client&action=index'>Clients</a></li>
					<li><a href='?controller=site&action=index'>Sites</a></li>
					<!-- END PROJECT MENU -->
					
					<li><a href='logout.php'>Logout</a></li>
					<?php } ?> 
				
				</ul>
				
			</header>

			<?php require_once('routes.php'); ?>
			
			<!-- BOOTSTRAP JS -->
			<script src="bootstrap/js/bootstrap.min.js"></script>
			
			<hr />
			<footer>
				<ul> 
					<li>Footer</li>
				</ul>
			</footer>
		</div>
  </body>
  
</html>