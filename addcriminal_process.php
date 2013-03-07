<?php
	session_start();
	
	$criminal_name = $_POST['name'];
	$criminal_birth = $_POST['birthday'];
	$criminal_sex = $_POST['sex'];
		
	//connect to database

		$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
		if (!$conn) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//query to database
		if(isset($_SESSION['log'])){ //adds the values in the crime table, if root or admin -> set verified to true
			$query1 = "INSERT INTO criminal (name, birthday, sex) VALUES ('{$criminal_name}','{$criminal_birth}','{$criminal_sex}');";
			$result = pg_query($conn, $query1);
			
		}
	$_SESSION['added']=1;
	pg_close($conn); //close conenction
	header("Location: addcriminal.php"); 
?>