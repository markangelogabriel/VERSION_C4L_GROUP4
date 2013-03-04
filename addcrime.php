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
					<form name="loginform" method="post" action="addcrime_process.php"> <!--form for adding a crime-->
					<center><table>
					<th colspan="2">Add a report</th>
						<tr>
								<td>Crime Description: </td><td><input id = "description" type="text"  name="description" size="40"></td>
						</tr>
						<tr>
								<td>Crime Type: </td>
							
								<td>
								<select id = "type" name="type">
									<option value="Assault">Assault</option>
									<option value="Rape">Rape</option>
									<option value="Murder">Murder</option>
									<option value="Robbery">Robbery</option>
									<option value="Arson">Arson</option>
									<option value="Burglary">Burglary</option>
									<option value="Theft">Theft</option>
								</select>
								</td>
						</tr>
						<tr>
								<td>Witness: </td><td><input id = "witness" type="text" name="witness" size="40"></td>
						</tr>
						<tr>
								<td>Date: </td><td><input id = "date" type="date" name="date" size="40" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" max="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>"></td>
						</tr>
						<tr>
								<td>Place: </td><td><input id = "place" type="text"  name="place" size="40" required = "required"></td>
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
