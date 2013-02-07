<?php

	//start session
	session_start();	
	
	//prevents unautorized access, rootadmin can only access this page
	if($_SESSION['rootadmin']!=1){
		header("Location: index.php");
		exit;
	}
	
	//include the class libraries created in class_lib.php
	include("class_lib.php");	
	
	//instantiate allaccounts variable
	$allaccounts = new allAccounts();

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
		<!--method that checks the checkbox according to root actions-->
			checked=false;
				function checkedAll (frm1) {
				var aa= document.getElementById('frm1');
				 if (checked == false)
					  {
					   checked = true
					  }
					else
					  {
					  checked = false
					  }
				for (var i =0; i < aa.elements.length; i++) 
				{
				 aa.elements[i].checked = checked;
				}
				  }
	
	</script>
	<script>
			//confirm prompt for user root action
			function confirmAction(){
				var check=0;
				var aa= document.getElementById('frm1');
				<!--checks if root checked accounts to delete-->	
				for (var i =0; i < aa.elements.length; i++) {
					if(aa.elements[i].checked ==true){
						check=1;
					}
				}
				<!--alerts root if it did not select any account to delete-->
				if(check==0){
					alert("Nothing to delete!");
					return false;
				}
				//confirm message
				var r=confirm("Are you sure you want to Delete?");
				if (r==true){
					return true; //if user confirms
				}
				else if(r!=true){
					return false; //if user cancels
				}
				  
			}
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
				<center>
				<h3>Delete Administrators</h3><br />
				<!--form for delete accounts-->
				<form  method="post" name="frm1" id="frm1" onsubmit="return confirmAction();" action="confirmdelete.php">
					
					<?php		
							//get all accounts in database
							$allaccounts->getAccounts();
							//displays all accounts according to filter (if any)
							$allaccounts->filterAccounts();
					?>
		
				</center>
				</form>
				</div>
			</section>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>