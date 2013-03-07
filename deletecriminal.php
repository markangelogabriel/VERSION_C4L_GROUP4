<?php

	$delete_ID = $_GET['id'];
	$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
	if (!$conn) {
	  echo "An error occured.\n";
	  exit;
	}
	
	$query1 = "DELETE from criminal_committed_crime where criminal_id = {$delete_ID};";
	$result = pg_query($conn, $query1);
	
	$query2 = "DELETE from criminal where criminal_id = {$delete_ID};";
	$result = pg_query($conn, $query2);
	
	pg_close($conn); //close conenction
	header("Location: view.php"); 
?>