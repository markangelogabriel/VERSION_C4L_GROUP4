<?php
//start session
session_start();	
	//prevents unautorized access, rootadmin can only access this page
		if(!isset($_SESSION['log'])){
		header("Location: index.php");
		exit;
	}

	//put values sent to an array delete_list
	$delete_list = $_POST['announcements'];
    $N = count($delete_list); //counts number of items to delete
			
	//connect to database
	$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
			if (!$conn) {
			  echo "An error occured.\n";
			  exit;
			}
	
	//query to database for delete
	for($i=0; $i < $N; $i++){
		$id = $delete_list[$i];
		$query = "DELETE FROM announcement where announcement_id='$id'"; 
		$result = pg_query($query);
		//if delete failed
		if (!$result) { 
			printf ("ERROR"); 
			$errormessage = pg_errormessage($db); 
			echo $errormessage; 
			exit(); 
		} 
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
						<?php include 'navbar_module.php'; ?>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row-fluid">
			<section class="span12">
				<div class="hero-unit">
					<h3>Announcements were successfully deleted!</h3>
					<a href="viewannouncements.php">Back to Delete Announcements </a>
				</div>
			</section>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>