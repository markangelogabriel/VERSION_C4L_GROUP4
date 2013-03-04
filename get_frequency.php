<?php
	session_start();
	
	$chart_base = $_SESSION['chart_base'];
	$chart_data = $_SESSION['chart_data'];
	$chart_order = $_SESSION['chart_order'];
	$order_value = $_SESSION['chart_order_value'];
	
	//connect to database
	$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
	if (!$conn) {
	  echo "An error occured.\n";
	  exit;
	}
	
	if($chart_base=="crime_type" && $chart_order=="place"){
		$data_query = "SELECT crime.crime_id 
				FROM crime,crime_type 
				WHERE 
					crime_type.crime_id=crime.crime_id AND 
					crime_type.crime_type='{$chart_data}' AND 
					crime.place='{$order_value}'
				";
				
		//echo "<br/>",$chart_query;
		$data_result = pg_query($data_query);
		$data_array = pg_fetch_all($data_result);
		
		$frequency=count($data_array);
	}
	else if($chart_base=="crime_type" && $chart_order=="date"){
		$data_query = "SELECT c1.crime_id 
				FROM crime as c1,crime_type as c2
				WHERE 
					c2.crime_id=c1.crime_id AND 
					c2.crime_type='{$chart_data}' AND 
					(SELECT extract(year FROM date) FROM crime as c3 WHERE c1.crime_id=c3.crime_id)='{$order_value}'
				";
				
		//echo "<br/>",$chart_query;
		$data_result = pg_query($data_query);
		$data_array = pg_fetch_all($data_result);
		
		$frequency=count($data_array);
	}
	else if($chart_base=="place" && $chart_order=="crime_type"){
		$data_query = "SELECT c1.crime_id 
			FROM crime as c1, crime_type as c2
			WHERE 
				c2.crime_id=c1.crime_id AND 
				c1.place='{$chart_data}' AND 
				c2.crime_type='{$order_value}'
			";
			
			
		$data_result = pg_query($data_query);
		$data_array = pg_fetch_all($data_result);
		
		$frequency=count($data_array);
	}
	else if($chart_base=="place" && $chart_order=="date"){
		$data_query = "SELECT c1.crime_id 
			FROM crime as c1
			WHERE 
				c1.place='{$chart_data}' AND 
				(SELECT extract(year FROM date) FROM crime as c2 WHERE c1.crime_id=c2.crime_id)='{$order_value}'
			";
			
			
		$data_result = pg_query($data_query);
		$data_array = pg_fetch_all($data_result);
		
		$frequency=count($data_array);
	}
	else if($chart_base=="date" && $chart_order=="crime_type"){
		$data_query = "SELECT c1.crime_id 
			FROM crime as c1, crime_type as c2
			WHERE 
				c1.crime_id=c2.crime_id AND
				(SELECT extract(year FROM date) FROM crime as c3 WHERE c1.crime_id=c3.crime_id)='{$chart_data}' AND
				c2.crime_type='{$order_value}'
			";
			
			
		$data_result = pg_query($data_query);
		$data_array = pg_fetch_all($data_result);
		
		$frequency=count($data_array);
	}
	else if($chart_base=="date" && $chart_order=="place"){
		$data_query = "SELECT c1.crime_id 
			FROM crime as c1, crime_type as c2
			WHERE 
				c1.crime_id=c2.crime_id AND
				(SELECT extract(year FROM date) FROM crime as c2 WHERE c1.crime_id=c2.crime_id)='{$chart_data}' AND
				c1.place='{$order_value}'
			";
			
			
		$data_result = pg_query($data_query);
		$data_array = pg_fetch_all($data_result);
		
		$frequency=count($data_array);
	}
	
	pg_close($conn); //close connection
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
					<?php
						if($data_array){
							echo "Frequency : ",$frequency;
						}
						else{
							echo "No rows!";
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