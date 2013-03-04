<?php
	session_start();
	
	$username = pg_escape_string($_POST['username']);
	$password = md5($_POST['password']);
	$count = 0;
	
	//connect to database
		$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
		if (!$conn) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//query to database
		$query1 = "SELECT * from admin where username = '{$username}' and password = '{$password}';";
		$result = pg_query($conn, $query1);
		
		while ($myrow = pg_fetch_assoc($result)) {
			$_SESSION['username'] = $myrow['username'];
			$count++;
			if ($myrow['username']=='root') {			//if the username is = root
				$_SESSION['log']=1;
			}else {										//else admin
				$_SESSION['log']=2;
			}
		}
		
		if ($count===0) {								//if count == 0, sets flag to 1, -> guest
			$_SESSION['flag']=1;
		}
		pg_close($conn); 
		
		header("Location: login.php"); 					//redirects the page to login.php
		
?>