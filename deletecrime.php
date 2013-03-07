<?php

	$delete_ID = $_GET['id'];
	$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
	if (!$conn) {
	  echo "An error occured.\n";
	  exit;
	}
	
	$query1 = "DELETE from crime_type where crime_id = {$delete_ID};";
	$result = pg_query($conn, $query1);
	
	$query2 = "DELETE from crime_witness where crime_id = {$delete_ID};";
	$result = pg_query($conn, $query2);
	
	$query3 = "DELETE from criminal_committed_crime where crime_id = {$delete_ID};";
	$result = pg_query($conn, $query3);
	
	$query4 = "DELETE from crime where crime_id = {$delete_ID};";
	$result = pg_query($conn, $query4);
	
	pg_close($conn); //close conenction
	header("Location: view.php"); 
?>