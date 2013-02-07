<?php
	//start session
	session_start();

	//initialize session variable
	if(!isset($_SESSION['login'])){
		$_SESSION['login']=0; //checks if the user is logged in
		$_SESSION['rootadmin']=0; //checks if the user is the root admin
		$_SESSION['username']=NULL; //variable for the username
		$_SESSION['rootpwd']=NULL;
	}
		
	//connect to database
	if(isset($_POST['submit'])){
		$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
		if (!$conn) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//query to database
		$result = pg_query($conn, "SELECT username, password FROM admin");
		if (!$result) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//places admin accounts in an array
		$admin_accounts = array();
		//traverses row in query
		while ($line = pg_fetch_array($result)) {
			//authenticates entered username and password
			if(($_POST['username']==$line['username'])&&((md5($_POST['password']))==$line['password'])){
				//if authenticated, sets login variable to 1 and stores the username to variable username
				$_SESSION['login']=1;
				$_SESSION['username']=$line['username'];
				$_SESSION['rootpwd']=$line['password'];//save pwd
				//checks if the logged-in user is the root admin
				if(($_POST['username']=='root')&&(md5($_POST['password'])==$_SESSION['rootpwd'])){
					//if the root admin is logged in, set rootadmin variable to 1
					$_SESSION['rootadmin']=1;
				}
			}
		}
		//if entered username and password does not find a match
		if($_SESSION['login']!=1){?>
			<script type="text/javascript">alert("Username and password does not match.");</script>
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
	<!--javascript that checks the validity of input of user-->
	<script type="text/javascript">
		function validateForm(){
			var form = document.loginform;
			//checks if the user entered a username
			if(!form.username.value){
				alert("Username required.");
				form.username.focus();
				return false;
			}
			//checks if the user entered a password
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
					<!--data if logged in-->
					<?php 	if($_SESSION['login']==1){?>
					<center>
					<h3>Welcome <?php $uname=$_SESSION['username']; echo $uname ?>, You are now logged in</h3>
					<a href="index.php">Go to homepage </a>
					</center>
					<?php
						}
					?>
				
					<!--display log-in pane if not logged in-->
					<?php 	if($_SESSION['login']!=1){?>
					<form name="loginform" method="post" onsubmit="return validateForm();" action="login.php">
					<center><table>
					<th colspan="2">Login to your account</th>
						<tr>
								<td>Username: </td><td><input type=text  name=username size="40"></td>
						</tr>
						<tr>
								<td>Password: </td><td><input type=password name=password size="40"></td>
						</tr>
						<tr>
								<td colspan="2"><center><input type=submit name=submit value=submit></center></td>
						</tr>
					</table></center>
					</form>
					<?php
					}
					?>
				</div>
			</section>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
