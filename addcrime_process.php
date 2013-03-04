<?php
	session_start();
	
	$crime_desc = $_POST['description'];
	$crime_type = $_POST['type'];
	$crime_witness = $_POST['witness'];
	$crime_date = $_POST['date'];
	$crime_place = $_POST['place'];
		
	//connect to database

		$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
		if (!$conn) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//query to database
		if(isset($_SESSION['log'])){ //adds the values in the crime table, if root or admin -> set verified to true
			$query1 = "INSERT INTO crime (is_verified, description, date, place) VALUES ('true','{$crime_desc}','{$crime_date}','{$crime_place}');";
			$result = pg_query($conn, $query1);
		}else{							//adds the values in the crime table, if guest -> set verified to true
			$query1 = "INSERT INTO crime (is_verified, description, date, place) VALUES ('false','{$crime_desc}','{$crime_date}','{$crime_place}');";
			$result = pg_query($conn, $query1);
		}
		
		/*foreach($crime_type as $Type){
			if($Type== "Assault"){
				$query = "insert into crime_type values((select max(crime_id) from crime), 'Assault');";
				pg_query($con, $query);
			}
			if($Type=="Rape"){
				$query = "insert into crime_type values((select max(crime_id) from crime), 'Rape');";
				pg_query($con, $query);
			}
			if($Type=="Murder"){
				$query = "insert into crime_type values((select max(crime_id) from crime), 'Murder');";
				pg_query($con, $query);
			}
			if($Type=="Robbery"){
				$query = "insert into crime_type values((select max(crime_id) from crime), 'Robbery');";
				pg_query($con, $query);
			}
			if($Type=="Arson"){
				$query = "insert into crime_type values((select max(crime_id) from crime), 'Arson');";
				pg_query($con, $query);
			}
			if($Type=="Burglary"){
				$query = "insert into crime_type values((select max(crime_id) from crime), 'Burglary');";
				pg_query($con, $query);
			}
		}*/
		//insert the values to crime_type table
		$query2 = "insert into crime_type values((select max(crime_id) from crime), '{$crime_type}');";
		$result = pg_query($conn, $query2);
		
		//insert the values to crime_witness table
		$query3 = "insert into crime_witness values((select max(crime_id) from crime), '{$crime_witness}');";
		$result = pg_query($conn, $query3);
		
	pg_close($conn); //close conenction
	header("Location: addcrime.php"); 
?>