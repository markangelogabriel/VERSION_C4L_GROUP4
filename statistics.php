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
					<form name="loginform" method="post" action="chart_viewer.php"> <!--form for making a chart-->
					<center><table>
					<th colspan="2">View Statistics</th>
						<tr>
								<td>Chart Base: </td>
								<td>
								<select id = "chart_base" name="chart_base">
									<option value="crime_type">Crime Type</option>
									<option value="place">Location</option>
									<option value="date">Year</option>
								</select>
								</td>
						</tr>
						<tr>
								<td>Chart Data: </td>
								<td><input id = "chart_data" type="text" name="chart_data" size="40"></td>
						</tr>
						<tr>
								<td>Chart Order: </td>
								<td>
								<select id = "chart_order" name="chart_order">
									<option value="crime_type">Crime Type</option>
									<option value="place">Location</option>
									<option value="date">Year</option>
								</select>
								</td>
						</tr>
						<tr>
								<td>Chart Order Value (keep empty if you want a graph) : </td>
								<td>
									<input id = "chart_order_value" type="text" name="chart_order_value" size="40"></td>	
								</td>
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
