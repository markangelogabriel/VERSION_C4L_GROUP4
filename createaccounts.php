<?php
	//start session
	session_start();	
	//prevents unautorized access, rootadmin can only access this page
	if($_SESSION['log']!=1){
		header("Location: index.php");
		exit;
	}
	$checkduplicate=0; //var for checking for duplicates
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
				<?php
				$_SESSION['account_username']=$username;
				$_SESSION['account_password']=$pass;
				header("Location: createdaccount.php");
				exit;
				
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
					<!--create account form-->
					<form name="createaccountform" method="post" action="createaccounts.php">
					<center><table>
					<th colspan="2">CREATE ADMINISTRATOR ACCOUNT</th>
						<tr>
							<td></br></td>
						</tr>
						<tr>
								<td>Username: </td><td><input type=text  name=username size="40" required=required></td>
						</tr>
						<tr>
								<td>Password: </td><td><input type=password name=password size="40" required=required></td>
						</tr>
						<?php if(isset($checkduplicate) && $checkduplicate==1){?>
								<tr><td></td><td><h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username already exists.</h6></center></td></tr>
									<script type="text/javascript">
									var form = document.createaccountform;
									form.username.focus();</script>
								<?php
								}?>
						<?php if($checkduplicate==0){?>
								<tr><td></td><td><h6>    </h6></td></tr>
								<?php
								}?>
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