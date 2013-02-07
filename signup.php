<?php
	
	if(isset($_POST['submit'])){
	$connect=pg_connect("host=localhost port =5432 dbname=postgres user=postgres password=root") or die ("unable to connect");
	$username=$_POST["uname"];
	$pwd=(md5($_POST["pwd"]));
	
	$insert=pg_exec($connect, "INSERT INTO admin VALUES('$username', '$pwd')");
	
	}
?>

<html>
	<head>
		<title>Sign-Up</title>
	</head>
	<body>
		<form name="signup" onsubmit="" method="POST" action="signup.php">
			Username <input type="text" name="uname"></ br>
			Password <input type="password" name="pwd"></ br>	
			<input type="submit" name="submit" value="submit">
		</form>
	</body>
</html>