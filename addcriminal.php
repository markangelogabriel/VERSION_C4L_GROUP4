<?php
	session_start();
	
	if(!(isset($_SESSION['log']))){
		header("Location: index.php");
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
					<form name="loginform" method="post" action="addcriminal_process.php"> <!--form for adding a criminal-->
					<center><table>
					<th colspan="2">Add a criminal</th>
						<tr>
								<td>Criminal Name: </td><td><input id = "name" type="text"  name="name" size="40" required = "required"></td>
						</tr>
						<tr>
								<td>Birthday: </td><td><input id = "birthday" type="date" name="birthday" size="40" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" max="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>"></td>
						</tr>
						<tr>
								<td>Sex: </td>
								<td>
								<select id = "sex" name="sex">
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select></td>
								
						</tr>
						<tr>
								<td colspan="2"><center><input type=submit name=submit value=submit></center></td>
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