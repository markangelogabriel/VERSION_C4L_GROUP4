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

						<form method="post" action="search.php">
							<b>SEARCH:</b><br/>
							<select name="category">
								<option value="crime">Crime</option>
								<option value="crime_type">Crime Type</option>
								<option value="criminal">Criminal</option>
							</select>
							<input type="text" id="to_search" name="to_search" />
							<input type="submit" name="search"/>
						</form>									
				
				</div>

						<?php
						//If logged in as an Admin
						if(isset($_SESSION['log'])){
							if(isset($_POST['search'])){
								$category = $_POST['category'];
								$to_search = $_POST['to_search'];
								
								
								echo '<table>';
								
								//Enables admin to view unverified crime reports
								if($category == "crime"){
									$search = pg_query($conn, "select * from crime where crime_id like '%{$to_search}%' or description like '%{$to_search}%' or place like '%{$to_search}%'");
									while ($searchrow = pg_fetch_array($search))
										echo '<tr>' . '<td>' . $searchrow[0] . '</td><td>' . $searchrow[1] . '</td><td>' . $searchrow[2]. '</td><td>' . $searchrow[3] . $searchrow[4] . '</td></tr>';
								}
								if($category == "crime_type"){
									$search = pg_query($conn, "select * from crime_type where crime_id like '%{$to_search}%' or type like '%{$to_search}%'");
									while ($searchrow = pg_fetch_array($search))
										echo '<tr><td>' . $searchrow[1] . '</td></tr>';
								}
								if($category == "criminal"){
									$search = pg_query($conn, "select * from criminal where criminal_id like '%{$to_search}%' or name like '%{$to_search}%' or sex like '%{$to_search}%'");
									while ($searchrow = pg_fetch_array($search))
										echo '<tr>' . '<td>' . $searchrow[0] . '</td><td>' . $searchrow[1] . '</td><td>' . $searchrow[2]. '</td><td>' . $searchrow[3] . '</td></tr>';}
								
								echo '</table>';
								
								//pg_free_result($searchrow);
								pg_free_result($search);
							}
							//Guest
						} else {
							if(isset($_POST['search'])){
								$category = $_POST['category'];
								$to_search = $_POST['to_search'];
								
								
								echo '<table>';
								
								//Only views verified crime reports
								if($category == "crime"){
									$search = pg_query($conn, "select * from crime where (crime_id like '%{$to_search}%' or description like '%{$to_search}%' or place like '%{$to_search}%') and is_verified is TRUE");
									while ($searchrow = pg_fetch_array($search))
										echo '<tr>' . '<td>' . $searchrow[0] . '</td><td>' . $searchrow[1] . '</td><td>' . $searchrow[2]. '</td><td>' . $searchrow[3] . $searchrow[4] . '</td></tr>';
								}
								if($category == "crime_type"){
									$search = pg_query($conn, "select * from crime_type where crime_id like '%{$to_search}%' or type like '%{$to_search}%'");
									while ($searchrow = pg_fetch_array($search))
										echo '<tr><td>' . $searchrow[1] . '</td></tr>';
								}
								if($category == "criminal"){
									$search = pg_query($conn, "select * from criminal where criminal_id like '%{$to_search}%' or name like '%{$to_search}%' or sex like '%{$to_search}%'");
									while ($searchrow = pg_fetch_array($search))
										echo '<tr>' . '<td>' . $searchrow[0] . '</td><td>' . $searchrow[1] . '</td><td>' . $searchrow[2]. '</td><td>' . $searchrow[3] . '</td></tr>';}
								
								echo '</table>';
								
								//pg_free_result($searchrow);
								pg_free_result($search);
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
