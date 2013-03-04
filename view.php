<?php
	//start session
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

	<?php
			$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=root");
			if (!$conn) {
				die("Error in connection: " . pg_last_error());
			}
	?>

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

					<form method="post" action="view.php">
						<b>VIEW:</b><br/>
							<select name="view_by">
								<option value="crime">Crime</option>
								<option value="crime_type">Crime Type</option>
								<option value="criminal">Criminal</option>
							</select>
							<input type="submit" name="view"/>
						</form>				
				</div>
 	
						<?php
						// If logged in as Admin
						if(isset($_SESSION['log'])){
						
							if(isset($_POST['view'])){
								$view_by = $_POST['view_by'];
								$view = pg_query($conn, "select * from " . $view_by);
								
								echo '<table>';
								
								// Admin enables to view unverified Crime reports
								if($view_by == "crime"){
									while ($viewrow = pg_fetch_array($view))
										echo '<tr>' . '<td>' . $viewrow[0] . '</td><td>' . $viewrow[1] . '</td><td>' . $viewrow[2]. '</td><td>' . $viewrow[3] . $viewrow[4] . '</td></tr>';
								}
								if($view_by == "crime_type"){
									while ($viewrow = pg_fetch_array($view))
										echo '<tr><td>' . $viewrow[1] . '</td></tr>';
								}
								if($view_by == "criminal"){
									while ($viewrow = pg_fetch_array($view))
										echo '<tr>' . '<td>' . $viewrow[0] . '</td><td>' . $viewrow[1] . '</td><td>' . $viewrow[2]. '</td><td>' . $viewrow[3] . '</td></tr>';}
								
								echo '</table>';
								
								//pg_free_result($viewrow);
								pg_free_result($view);
							}
						}
						//if Guest
						else{

							if(isset($_POST['view'])){
								$view_by = $_POST['view_by'];
								$view = pg_query($conn, "select * from " . $view_by);
								
								echo '<table>';
								
								//Guest only able to view verified crime
								if($view_by == "crime"){
									$view = pg_query($conn, "select * from " . $view_by . " where is_verified is TRUE");								
									while ($viewrow = pg_fetch_array($view))
										echo '<tr>' . '<td>' . $viewrow[0] . '</td><td>' . $viewrow[1] . '</td><td>' . $viewrow[2]. '</td><td>' . $viewrow[3] . $viewrow[4] . '</td></tr>';
								}
								if($view_by == "crime_type"){
									while ($viewrow = pg_fetch_array($view))
										echo '<tr><td>' . $viewrow[1] . '</td></tr>';
								}
								if($view_by == "criminal"){
									while ($viewrow = pg_fetch_array($view))
										echo '<tr>' . '<td>' . $viewrow[0] . '</td><td>' . $viewrow[1] . '</td><td>' . $viewrow[2]. '</td><td>' . $viewrow[3] . '</td></tr>';}
								
								echo '</table>';
								
								//pg_free_result($viewrow);
								pg_free_result($view);
							}
						
						}
						?>
				

			</section>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <?php 	
	pg_close($conn);
  ?>
  </body>
</html>
