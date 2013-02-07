<?php
	//start session
	session_start();	
	//prevents unautorized access, rootadmin can only access this page
	if($_SESSION['rootadmin']!=1){
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
			
			//query to database to get all the accounts
			$result = pg_query($conn, "SELECT username FROM admin");
			if (!$result) {
			  echo "An error occured.\n";
			  exit;
			}
			
			//checks if the new account is a duplicate
			$checkduplicate=0; //var for checking for duplicates
			$admin_accounts = array(); //admin_accounts array
			//gets row per row
			while ($line = pg_fetch_array($result)) {
				//if the sent username already exists in the database set checkduplicate to 1
				if(($_POST['username']==$line['username'])){
				$checkduplicate=1;?>
				<!--alert user that username exists-->
				<script type="text/javascript">
					alert("Username already exists.");
					form.username.focus();
				</script>
				<?php	
				}
				
			}
			//if the sent account details has no duplicate in the database
			if($checkduplicate==0){
				//store details first in variables
				$username=$_POST["username"];
				$pwd=(md5($_POST["password"]));
				//insert in db
				$insert=pg_exec($conn, "INSERT INTO admin VALUES('$username', '$pwd')");?>
				<script type="text/javascript">
					alert("Admin account added to database.");
				</script>
				<?php
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
	<script type="text/javascript">
		<!--function that validates values sent through POST-->
		function validateForm(){
			var form = document.createaccountform;
			//checks if the root entered a username
			if(!form.username.value){
				alert("Username required.");
				form.username.focus();
				return false;
			}
			//checks if the root entered a password
			if(!form.password.value){
				alert("Password required.");
				form.password.focus();
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
						<!--navbar if root admin-->	
							<li><a href="manageaccounts.php">Manage Admin Accounts</a></li>		
							<li><a href="announcements.php">Announcements </a></li>
							<li><a href="view.php">View </a></li>
							<li><a href="search.php">Search </a></li>
							<li><a href="logout.php">Logout</a><br /></li>	
							<li>
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
					<form name="createaccountform" method="post" onsubmit="return validateForm();" action="createaccounts.php">
					<center><table>
					<th colspan="2">CREATE ADMINISTRATOR ACCOUNT</th>
						<tr>
							<td></br></td>
						</tr>
						<tr>
								<td>Username: </td><td><input type=text  name=username size="40"></td>
						</tr>
						<tr>
								<td>Password: </td><td><input type=password name=password size="40"></td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
								<td colspan="2"><center><input type=submit name=submit value="create account"></center></td>
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