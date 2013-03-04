<?php
	//start session
	session_start();	
	//prevents unautorized access, rootadmin can only access this page
		if (!isset($_SESSION['log'])){
		header("Location: index.php");
		exit;
	}
	//if the user sent validates accounts to insert into the database
	if(isset($_POST['submit'])){
		//connect to database
		$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
			if (!$conn) {
			  echo "An error occured.\n";
			  exit;
			}
		
		//query to database to get the announcement_id in the db
		$result = pg_query($conn, "SELECT announcement_id FROM announcement");
		if (!$result) {
			echo "An error occured.\n";
			exit;
		}


		$announcement_list = array(); //list of announcements array	
		
			//gets the last announcement_id
			while ($line = pg_fetch_array($result)) {
				$announcement_id=$line['announcement_id'];
			}//while
		
		if(!(isset($announcement_id))){
			$announcement_id=0;
		}
		else{
			$announcement_id++;
		}
		
		//store details first in variables
			$title=$_POST["title"];
			$announcement=$_POST["announcement"];
			//insert announcement in db
				$insert=pg_exec($conn, "INSERT INTO announcement VALUES('$announcement_id', '$title', '$announcement', CURRENT_TIMESTAMP)");?>
				<?php
				header("Location: confirmaddannouncement.php");
				exit;
				
	
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
	<script type="text/javascript">
		<!--function that validates values sent through POST method-->
		function validateForm(){
			var form = document.createannouncementform;
			//checks if the root entered a username
			if(!form.title.value){
				alert("You have not entered a title.");
				form.title.focus();
				return false;
			}
			//checks if the root entered a password
			if(!form.announcement.value){
				alert("You have not entered an announcement.");
				form.announcement.focus();
				return false;
			}
		}//end function validate form(); 
		
		</script>
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
					<!--create account form-->
					<form name="createannouncementform" method="post" onsubmit="return validateForm();" action="createannouncements.php">
					<center><table>
					<th colspan="2">Add New Announcement</th>
						<tr>
							<td></br></td>
						</tr>
						<tr>
								<td>Title: </td><td><input type=text  name=title size="100" required=required></td>
						</tr>
						<tr>
								<td>Announcement: </td><td rowspan="10"><textarea name="announcement" rows="10" cols="102" required=required></textarea></td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
						<tr>
								<td></td>
								<td><input type=submit name=submit value="add announcement"></td>
						</tr>
						
					</table></center>
					</form>
				</div>
			</section>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>