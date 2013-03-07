<?php

	$criminal_id = $_POST['crim_name'];
	$crime_id = $_GET['crimeid'];
	
	$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
	if (!$conn) {
	  echo "An error occured.\n";
	  exit;
	}
	
	$query1 = "INSERT INTO criminal_committed_crime VALUES ({$crime_id},{$criminal_id});";
	$result = pg_query($conn, $query1);
	
	pg_close($conn); //close conenction
	header("Location: view.php"); 
?>