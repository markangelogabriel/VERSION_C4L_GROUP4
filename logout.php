<?php 

session_start();

unset($_SESSION['log']);
session_destroy();
//ends session
session_start();
$_SESSION['logout'] = 1;
header("Location: viewannouncements.php"); 	


?>