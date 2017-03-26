<DOCTYPE html>
<html>
	<head>
		<title>TCS Application</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!--	CSS		-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="css/mvc.css" rel="stylesheet" media="screen">
		<link href="css/style.min.css" rel="stylesheet" media="screen">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
		<!--	lATEST JQUERY + VALIDATION		-->
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
		<!--[if lt IE 9]>
			<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<header id="header">
			<div class="container">
				<a href='?controller=login&action=index'><div class="logo"></div></a>

				<!-- The overlay -->
				<div id="nav" class="overlay">

				  <!-- Button to close the overlay navigation -->
				  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

				  <!-- Overlay content -->
				  <nav class="menu-content">
					  <?php if( empty(User::userID()) ) { ?>
					  <a href='?controller=login&action=index'>Home</a>
					  <?php } else { ?>
					  <a href='?controller=user&action=index'>Users</a>
					  <a href='?controller=logged&action=index'>Admin</a>

					  <!-- BEGIN PROJECT MENU -->
					  <a href='?controller=client&action=index'>Clients</a>
					  <a href='?controller=site&action=index'>Sites</a>
					  <!-- END PROJECT MENU -->

					  <a href='logout.php'>Logout</a>
					  <?php } ?>
				  </nav>

				</div>


				<div id="menu-icon" onclick="openNav()">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
				</div>


			</div>
		</header>

		<?php require_once('routes.php'); ?>

		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="left">
						<p>© 2017 TCS Application</p>
					</div>
					<div class="right">
						<p>Developed by <a href="#">DevelopForMe</a></p>
					</div>
				</div>
			</div>
		</footer>

		<!--	LATEST BOOTSTRAP JS	-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<!--	MINIFIED JS	 -->
		<script src="js/build/vendor.min.js"></script>
		<script src="js/build/main.min.js"></script>
	</body>

</html>
