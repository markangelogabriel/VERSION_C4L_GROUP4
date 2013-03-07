<!--navbar if root admin-->	
						<?php  if(isset($_SESSION['log'])){
									if ($_SESSION['log']===1) {?>
									<li><a href="manageaccounts.php">Manage Admin Accounts</a></li>		
									<li><a href="announcements.php">Announcements </a></li>
									<li><a href="view.php">View & Search </a></li>
									<li><a href="addcrime.php">Add Crime </a></li>
									<li><a href="addcriminal.php">Add Criminal </a></li>
									<li><a href="statistics.php">View Statistics </a></li>
									<li><a href="logout.php">Logout(<u><?php echo $_SESSION['username'] ?></u>)</a><li>	
									<?php
									}
									
									if ($_SESSION['log']===2)  {?>
									<!----navbar if admin-->
									<li><a href="announcements.php">Announcements </a></li>
									<li><a href="view.php">View & Search </a></li>
									<li><a href="addcrime.php">Add Crime </a></li>
									<li><a href="addcriminal.php">Add Criminal </a></li>
									<li><a href="statistics.php">View Statistics </a></li>
									<li><a href="logout.php">Logout(<u><?php echo $_SESSION['username'] ?></u>)</a><li>	
									<?php
									}
									if($_SESSION['log']===0){?>
									<!----navbar if guests-->
									<li><a href="viewannouncements.php">Announcements </a><li>
									<li><a href="view.php">View & Search </a></li>
									<li><a href="addcrime.php">Add Report </a></li>
									<li><a href="statistics.php">View Statistics </a></li>
									<li><a href="login.php">Log in </a><li>
									<?php
									}
									}
								else{?>
									<!----navbar if guests-->
									<li><a href="viewannouncements.php">Announcements </a><li>
									<li><a href="view.php">View & Search </a></li>
									<li><a href="addcrime.php">Add Report </a></li>
									<li><a href="statistics.php">View Statistics </a></li>
									<li><a href="login.php">Log in </a><li>
									<?php
									}
									
								
							?>