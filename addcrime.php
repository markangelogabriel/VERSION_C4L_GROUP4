<?php
	session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Eyes Crime</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.toastmessage.css" rel="stylesheet" type="text/css"/>
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
    <script type="text/javascript" src = "js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src = "js/jquery.toastmessage.js"></script>
  	<script type="text/javascript" src = "js/main.js"></script>
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
					<?php 
					if(isset($_SESSION['log'])){
						echo "<th colspan=\"2\">Add a crime</th>";
					}else echo "<th colspan=\"2\">Add a report</th>";
					?>
						<tr>
								<td>Crime Description: </td>
						</tr>
						<tr><td colspan = "2"><textarea id = "description" name="description" size="100" rows = "4" cols = "68"></textarea></td></tr>
						<tr>
								<td>Crime Type: </td>
								<td class = "crime_type_td">
									&ensp;<input type="checkbox" name="type_group[]" value="Assault" />&ensp;Assault&emsp;&emsp;&emsp;&emsp;&ensp;
									<input type="checkbox" name="type_group[]" value="Arson" />&ensp;Arson
								</td>
						</tr>
								<tr><td></td>
								<td class = "crime_type_td">
									&ensp;<input type="checkbox" name="type_group[]" value="Rape" />&ensp;Theft&emsp;&emsp;&emsp;&emsp;&emsp;
									&ensp;<input type="checkbox" name="type_group[]" value="Burglary" />&ensp;Murder
								</td></tr>
								<tr><td></td>
								<td class = "crime_type_td">
									&ensp;<input type="checkbox" name="type_group[]" value="Murder" />&ensp;Rape&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;
									&ensp;<input type="checkbox" name="type_group[]" value="Theft" />&ensp;Burglary
								</td></tr>
								<tr><td></td><td class = "crime_type_td">&ensp;<input type="checkbox" name="type_group[]" value="Robbery" />&ensp;Robbery</td></tr>
								
						</tr>
						<tr>
								<td>Witness: </td><td><input class = "witness" type="text" name="witness[]" size="40"></td>
						</tr>
						<tr class = "addtr"><td></td>
								<td><a class = "awitness"href = "#" onclick = addTableRow()>add another...</a></td>
						</tr>
						<tr>
								<td>Date: </td><td><input id = "date" type="date" name="date" size="40" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" max="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>"></td>
						</tr>
						<tr>
								<td>Place: </td><td><input id = "place" type="text"  name="place" size="40" required = "required"></td>
						</tr>
						<tr>
								<td colspan="2"><center><input type="submit" name="submit" value="submit"></center></td>
						</tr>
					</table></center>
					</form>
				</div>
			</section>
		</div>
	</div>
    <script src="js/bootstrap.min.js"></script>
    <?php
    	if(isset($_SESSION['log'])){
	    	if(isset($_SESSION['added'])){
				echo "<script>window.onload=showSuccessCrime();</script>";
				unset($_SESSION['added']);
			}
		}else{
			if(isset($_SESSION['added'])){
				echo "<script>window.onload=showSuccessReport();</script>";
				unset($_SESSION['added']);
			}
		}
    ?>
  </body>
</html>
