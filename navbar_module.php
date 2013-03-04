<?php

if(isset($_SESSION['log'])){
	if ($_SESSION['log']===1) {		//--navbar for root
		echo "<li><a href=\"manageaccounts.php\">Manage Admin Accounts</a></li>		
		<li><a href=\"announcements.php\">Announcements </a></li>
		<li><a href=\"search.php\">View & Search</a></li>
		<li><a href=\"addcrime.php\">Add Crime </a></li>
		<li><a href=\"addcriminal.php\">Add Criminal </a></li>
		<li><a href=\"statistics.php\">View Statistics </a></li>
		<li><a href=\"logout.php\">Logout</a></li>";	
	}else {
		//----navbar if admin
		echo "<li><a href=\"announcements.php\">Announcements </a></li>
		<li><a href=\"search.php\">View & Search</a><li>
		<li><a href=\"addcrime.php\">Add Crime </a></li>
		<li><a href=\"addcriminal.php\">Add Criminal </a></li>
		<li><a href=\"statistics.php\">View Statistics </a></li>
		<li><a href=\"logout.php\">Logout</a><li>";	
	}
}else {
		//--navbar if guests
	echo "
	<li><a href=\"announcements.php\">Announcements </a><li>
	<li><a href=\"search.php\">View & Search</a><li>
	<li><a href=\"addcrime.php\">Add Report </a></li>
	<li><a href=\"statistics.php\">View Statistics </a></li>
	<li><a href=\"login.php\">Log in </a><li>";
}

?>