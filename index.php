<?php
	//start session
	session_start();

	//initialize login variable
	if(!isset($_SESSION['login'])){
		$_SESSION['login']=0; //checks if the user is logged in
		$_SESSION['rootadmin']=0; //checks if the user is the root admin
		$_SESSION['username']=NULL; //variable for username
	}


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Eyes Crime</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet" />
	<style type="text/css">
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}
		.sidebar-nav {
			padding: 9px 0;
		}
		section, article, nav, header, footer, figure, figcaption {
			display: block;
		}
	</style>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php">Eyes Crime</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<!--navbar if root admin-->	
						<?php 	if($_SESSION['login']==1 && $_SESSION['rootadmin']==1){?>
							<li><a href="manageaccounts.php">Manage Admin Accounts</a></li>		
							<li><a href="announcements.php">Announcements </a></li>
							<li><a href="view.php">View </a></li>
							<li><a href="search.php">Search </a></li>
							<li><a href="logout.php">Logout</a><br /></li>	
							<li>
							<?php
								}
							?>
						<!--navbar if admin-->
						<?php 	if($_SESSION['login']==1 && $_SESSION['rootadmin']!=1){?>
							<li><a href="announcements.php">Announcements </a></li>
							<li><a href="view.php">View </a><li>
							<li><a href="search.php">Search </a></li>
							<li><a href="logout.php">Logout</a><br /><li>	
							
							<?php
								}
							?>
						<!--navbar if guests-->
						<?php 	if($_SESSION['login']!=1){?>
							<li><a href="login.php">Log in </a><li>
							<li><a href="announcements.php">Announcements </a><li>
							<li><a href="view.php">View </a><li>
							<li><a href="search.php">Search </a></li>
							<?php
								}
							?>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row-fluid">
			<section class="span12">
				<div class="hero-unit">
					<h1>Welcome!</h1>
				</div>
			</section>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
