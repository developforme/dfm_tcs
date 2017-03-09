<DOCTYPE html>
<html>
	<head>
		<!-- META TAGS HERE -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
		
		<link href="css/style.css" rel="stylesheet" media="screen">
		<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
		<script type="text/javascript" src="js/validation.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</head>
	<body>
		<div id="page-wrap">
			<header style="margin-bottom: 10px">
				<ul> 
				
					<li><a href='index.php'>Home</a></li>
					<li><a href='?controller=user&action=index'>Users</a></li>
					
					<?php if( empty(User::userID()) ) { ?> 
					<li><a href='?controller=login&action=index'>Login</a></li>
					<?php } else { ?> 
					<li><a href='?controller=logged&action=index'>Admin</a></li>
					<li><a href='logout.php'>Logout</a></li>
					<?php } ?> 
				
				</ul>
				
			</header>

			<?php require_once('routes.php'); ?>
			
			<script src="bootstrap/js/bootstrap.min.js"></script>
			
			<footer>
				Copyright
			</footer>
		</div>
  </body>
  
</html>