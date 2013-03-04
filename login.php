<?php
	session_start();
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
					<!--data if logged in-->
					<?php 	if(isset($_SESSION['username'])){?>
					<center>
					<h3>Welcome <?php $uname=$_SESSION['username']; echo htmlspecialchars($uname) ?>, You are now logged in</h3>
					<a href="index.php">Go to homepage </a>
					</center>
					<?php
						}
					?>
				
					<!--display log-in pane if not logged in-->
					<?php  if(!(isset($_SESSION['username']))){?>
					<form name="loginform" method="post" action="login_process.php">
					<center><table>
					<th colspan="2">Login to your account</th>
						<tr>
								<td>Username: </td><td><input type=text  name=username size="40" required=required></td>
								<!--if entered username and password does not find a match-->		
						</tr>
						
						<tr>
								<td>Password: </td><td><input type=password name=password size="40" required=required></td>
						</tr>
						<?php if(isset($_SESSION['flag'])){?>
								<tr><td></td><td><center><h6>Username and password does not match.</h6></center></td></tr>
									<script type="text/javascript">
									var form = document.loginform;
									form.username.focus();</script>
								<?php
								}?>
						<?php if(!isset($_SESSION['flag'])){?>
								<tr><td></td><td><h6>    </h6></td></tr>
								<?php
								}?>
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
