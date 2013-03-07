<?php

	$verify_ID = $_GET['verid'];
	$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
	if (!$conn) {
	  echo "An error occured.\n";
	  exit;
	}
	
	$query1 = "UPDATE crime SET is_verified = 'true' where crime_id = {$verify_ID}";;
	$result = pg_query($conn, $query1);
	
	pg_close($conn); //close conenction
	header("Location: view.php"); 
?>