<?php
	session_start();
	
	$chart_base = $_POST['chart_base'];
	$chart_data = $_POST['chart_data'];
	$chart_order = $_POST['chart_order'];
	$chart_order_value = $_POST['chart_order_value'];
	$chart_point = array();
	$data_label = array(); // title for each set of points in chart_points
	
	//if chart order value is not null, then get frequency
	if($chart_order_value!=""){
		$_SESSION['chart_base']=$chart_base;
		$_SESSION['chart_data']=$chart_data;
		$_SESSION['chart_order']=$chart_order;
		$_SESSION['chart_order_value']=$chart_order_value;
		header("Location: get_frequency.php");
	}
	
	//connect to database
	$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
	if (!$conn) {
	  echo "An error occured.\n";
	  exit;
	}
		
	//put all $chart_order existences in $order_array with no duplicates
	if($chart_order=="place"){
		$order_query = "SELECT place FROM crime";
		
		$order_result = pg_query($order_query);
		$order_array = array();
		
		//remove duplicates part
		while($line = pg_fetch_array($order_result)){
			if(!in_array($line['place'],$order_array)){ //if $line does not exist in $order_array, add
				array_push($order_array,$line['place']);
				//echo $line['place'];
			}
		}
	}
	else if($chart_order=="date"){
		$order_query = "SELECT extract(year FROM date) as year FROM crime";
		
		$order_result = pg_query($order_query);
		$order_array = array();
		
		//remove duplicates part
		while($line = pg_fetch_array($order_result)){
			if(!in_array($line['year'],$order_array)){ //if $line does not exist in $order_array, add
				array_push($order_array,$line['year']);
				//echo "<br/>",$line['year'];
			}
		}
	}
	else if($chart_order=="crime_type"){
		$order_query = "SELECT crime_type FROM crime_type";
		
		$order_result = pg_query($order_query);
		$order_array = array();
		
		//remove duplicates part
		while($line = pg_fetch_array($order_result)){
			if(!in_array($line['crime_type'],$order_array)){ //if $line does not exist in $order_array, add
				array_push($order_array,$line['crime_type']);
				//echo "<br/>",$line['year'];
			}
		}
	}
	
	//put all sets of points in $chart_point
	//put all name labels in $data_label
	
	if($chart_base=="crime_type" && $chart_order=="place"){
		foreach($order_array as $order_type){
			$chart_query = "SELECT crime.crime_id 
				FROM crime,crime_type 
				WHERE 
					crime_type.crime_id=crime.crime_id AND 
					crime_type.crime_type='{$chart_data}' AND 
					crime.place='{$order_type}'
				";
				
			//echo "<br/>",$chart_query;
			$chart_result = pg_query($chart_query);
			$chart_array = pg_fetch_all($chart_result);
			if($chart_array){
				array_push($chart_point, count($chart_array));
				array_push($data_label, $order_type);
			}
		}
	}
	else if($chart_base=="crime_type" && $chart_order=="date"){
		foreach($order_array as $order_type){
			$chart_query = "SELECT c1.crime_id 
				FROM crime as c1, crime_type as c2
				WHERE 
					c2.crime_id=c1.crime_id AND 
					c2.crime_type='{$chart_data}' AND 
					(SELECT extract(year FROM date) FROM crime as c3 WHERE c1.crime_id=c3.crime_id)='{$order_type}'
				";
				
			//echo "<br/>",$chart_query;
			$chart_result = pg_query($chart_query);
			$chart_array = pg_fetch_all($chart_result);
			if($chart_array){
				array_push($chart_point, count($chart_array));
				array_push($data_label, $order_type);
			}
		}
	}
	else if($chart_base=="place" && $chart_order=="crime_type"){
		foreach($order_array as $order_type){
			$chart_query = "SELECT c1.crime_id 
				FROM crime as c1, crime_type as c2
				WHERE 
					c2.crime_id=c1.crime_id AND 
					c1.place='{$chart_data}' AND 
					c2.crime_type='{$order_type}'
				";
				
			//echo "<br/>",$chart_query;
			$chart_result = pg_query($chart_query);
			$chart_array = pg_fetch_all($chart_result);
			if($chart_array){
				array_push($chart_point, count($chart_array));
				array_push($data_label, $order_type);
			}
		}
	}
	else if($chart_base=="place" && $chart_order=="date"){
		foreach($order_array as $order_type){
			$chart_query = "SELECT crime_id 
				FROM crime as c1
				WHERE 
					c1.place='{$chart_data}' AND 
					(SELECT extract(year FROM date) FROM crime as c2 WHERE c1.crime_id=c2.crime_id)='{$order_type}'
				";
				
			//echo "<br/>",$chart_query;
			$chart_result = pg_query($chart_query);
			$chart_array = pg_fetch_all($chart_result);
			if($chart_array){
				array_push($chart_point, count($chart_array));
				array_push($data_label, $order_type);
			}
		}
	}
	else if($chart_base=="date" && $chart_order=="crime_type"){
		foreach($order_array as $order_type){
			$chart_query = "SELECT c1.crime_id 
				FROM crime as c1, crime_type as c2
				WHERE 
					(SELECT extract(year FROM date) FROM crime as c3 WHERE c1.crime_id=c3.crime_id)='{$chart_data}' AND
					c1.crime_id=c2.crime_id AND
					c2.crime_type='{$order_type}'
				";
				
			//echo "<br/>",$chart_query;
			$chart_result = pg_query($chart_query);
			$chart_array = pg_fetch_all($chart_result);
			if($chart_array){
				array_push($chart_point, count($chart_array));
				array_push($data_label, $order_type);
			}
		}
	}
	else if($chart_base=="date" && $chart_order=="place"){
		foreach($order_array as $order_type){
			$chart_query = "SELECT c1.crime_id 
				FROM crime as c1
				WHERE 
					(SELECT extract(year FROM date) FROM crime as c2 WHERE c1.crime_id=c2.crime_id)='{$chart_data}' AND
					c1.place='{$order_type}'
				";
				
			$chart_result = pg_query($chart_query);
			$chart_array = pg_fetch_all($chart_result);
			if($chart_array){
				array_push($chart_point, count($chart_array));
				array_push($data_label, $order_type);
			}
		}
	}
	
	$_SESSION["chart_point"]=$chart_point;
	$_SESSION["data_label"]=$data_label;
	$_SESSION["chart_data"]=$chart_data;
	$_SESSION["chart_order"]=$chart_order;
	
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
					<center>
					<?php
						if($chart_point){
							echo "<img src=\"chart_maker.php\" />";
						}
						else{
							echo "No rows!";
						}
					?>
					</center>
				</div>
			</section>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>