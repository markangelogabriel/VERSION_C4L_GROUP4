<?php
	//start session
	session_start();	
	
	//include the class libraries created in class_lib.php
	include("class_lib.php");	
	
	//instantiate allaccounts variable
	$allannouncements = new allAnnouncements();
	$allannouncementtitles = new allAnnouncements();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Eyes Crime</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/jquery.toastmessage.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src = "js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src = "js/jquery.toastmessage.js"></script>
  	<script type="text/javascript" src = "js/main.js"></script>
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
						<?php include 'navbar_module.php'; ?>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row-fluid">
			<section class="span3">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<li class="nav-header">Announcements</li>
						<!--form for delete accounts-->
						
							
							<?php		
									//get all accounts in database
									$allannouncementtitles->getAnnouncements();
									//displays all accounts according to filter (if any)
									$allannouncementtitles->filterAnnouncementTitles();
								?>	
						
						
						
					</ul>
				</div>
			</section>
			<section class="span9">
				<h1>Announcements</h1>
				<form  method="post" name="frm1" id="frm1" onsubmit="return confirmAction();" action="confirmdeleteannouncement.php">
				<?php		
							//get all accounts in database
							$allannouncements->getAnnouncements();
							//displays all accounts according to filter (if any)
							$allannouncements->filterAnnouncements();
				?>
				</form>
			</section>
		</div>
		<hr class="featurette-divider">

	</div>
    <script src="js/bootstrap.min.js"></script>
	<?php
		
		if(isset($_SESSION['welcome'])){
			echo "<script>$().toastmessage('showSuccessToast', \"Welcome {$_SESSION['username']}! You have successfully logged in!\");</script>";
			unset($_SESSION['welcome']);
		}else if(isset($_SESSION['logout'])){
			echo "<script>$().toastmessage('showSuccessToast', \"You have successfully logged out!\");</script>";
			unset($_SESSION['logout']);
		}
    ?> 
  </body>
</html>
