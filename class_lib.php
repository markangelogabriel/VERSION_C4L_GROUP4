<?php
//class for an administrator account
class Account{
	var $username; //admin username
	var $password; //admin password
		
	//constructor for account
	function Account($username,$password){
		$this->username = $username;
		$this->password = $password;
	}
		
	//setters
	function set_username($username){
		$this->username = $username;
	}
	function set_password($password){
		$this->password = $password;
	}
	
	//getters
	function get_username(){
		return $this->username;
	}
	function get_password(){
		return $this->password;
	}
}//Class Account
	
//class of all admiin accounts
class allAccounts{
	
	public $accounts_list = array(); //initialize variable accounts_list as an array
	
	//method for getting the accounts from the database
	function getAccounts(){
		//connect to database
		$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
		if (!$conn) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//query to database
		$result = pg_query($conn, "SELECT username, password FROM admin");
		if (!$result) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//places admin accounts in an array
		$accounts_list = array();
		//traverses row in query
		while ($line = pg_fetch_array($result)) {
			//stores values in array
			$username = $line['username'];
			$password = $line['password'];
			
			if($username!='root'){
				/*stores the account in an array of accounts*/
				$this->accounts_list[] = new Account($username,$password);
			}
		}//while
			
		pg_close($conn);	
		
	}//end of getAccounts
		
	//method for displaying the accounts	
	function displayAccount($account){
?>	
		<!--displays and account in a table cell and a checkbox with a corresponding value-->
			<div>
				<td><h5><?php echo $account->username; ?></h5></td>
				<td><center><input type="checkbox" name="accounts[]" id="check1" value="<?php echo $account->username ?>"></center></td>
				
			</div>
<?php
	}//end of displayProduct
	
	//method that gets all accounts according to the filter specified as parameter(if any)
	function filterAccounts(){
		?>
		<!--displays the table containg the list of accounts-->
		<center>
		<table cellpadding="10" border="1">
		<tr>
			<th colspan ="2">Username</th>
			
		<?php
		foreach($this->accounts_list as $item){
				?><tr><?php
					$this->displayAccount($item);
				?></tr><?php
		}
		?>
		<tr>
		<td width="300"><center><input type="button" value="Select All/Reset" onclick='checkedAll(frm1);'></center></td>
		<td><center><input type="submit" value="Delete"/></center></td>
		</tr>
		</table></center><?php
	}//end of filterAccounts
	
}//end of class allAccounts

class Announcement{
	var $announcement_id; //announcement id
	var $title; //announcement title
	var $details; //announcement details
	var $date_posted; //announcement date
		
	//constructor for account
	function Announcement($announcement_id, $title, $details, $date_posted){
		$this->announcement_id = $announcement_id;
		$this->title = $title;
		$this->details = $details;
		$this->date_posted =$date_posted;
	}
		
	//setters
	function set_announcement_id($announcement_id){
		$this->announcement_id = $announcement_id;
	}
	function set_title($title){
		$this->title = $title;
	}
	function set_details($details){
		$this->details = $details;
	}
	function set_date_posted($date_posted){
		$this->date_posted = $date_posted;
	}
	
	//getters
	function get_announcement_id(){
		return $this->announcement_id;
	}
	function get_title(){
		return $this->title;
	}
	function get_details(){
		return $this->details;
	}
	function get_date_posted(){
		return $this->date_posted;
	}
}//Class Announcement

//class of all announcements
class allAnnouncements{
	
	public $announcements_list = array(); //initialize variable announcements_list as an array
	
	//method for getting the accounts from the database
	function getAnnouncements(){
		//connect to database
		$conn = pg_pconnect("host=localhost port =5432 dbname=postgres user=postgres password=root");
		if (!$conn) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//query to database
		$result = pg_query($conn, "SELECT announcement_id, title, description, date FROM announcement ORDER BY announcement_id DESC");
		if (!$result) {
		  echo "An error occured.\n";
		  exit;
		}
		
		//places announcements in an array
		$announcements_list = array();
		//traverses row in query
		while ($line = pg_fetch_array($result)) {
			//stores values in array
			$announcement_id = $line['announcement_id'];
			$title = $line['title'];
			$details = $line['description'];
			$date_posted = $line['date'];
				//puts every announcement in the announcement_list array
				$this->announcements_list[] = new Announcement($announcement_id,$title,$details,$date_posted);
		}//while
		
		pg_close($conn);

	}//end of getAccounts
	
	//method for displaying the announcement titles with links	
	function displayAnnouncementTitles($announcement){
?>	
		<li><a href="#<?php $announcement_id ?>"><?php echo $announcement->title; ?></a></li>
<?php
	}//end of displayAnnouncementTitles
	
	//method that gets all accounts according to the filter specified as parameter(if any)
	function filterAnnouncementTitles(){

		foreach($this->announcements_list as $item){

					$this->displayAnnouncementTitles($item);
		}
		

	}//end of filterAnnouncementTitles
		
	//method for displaying the accounts	
	function displayAnnouncements($announcement){
?>	
		<!--displays and account in a table cell and a checkbox with a corresponding value-->
			<article id="<?php $announcement_id ?>">
				<h2><?php echo $announcement->title; ?></h2>
				<h6> posted: <?php echo $announcement->date_posted; ?></h6>
				<p><?php echo $announcement->details; ?></p>
				<?php if(isset($_SESSION['log'])){?>
				<input type="checkbox" name="announcements[]" id="check1" value="<?php echo $announcement->announcement_id ?>"> Mark this post<br />
				
				<?php } ?>
			</article><br />
<?php
	}//end of displayProduct
	
	//method that gets all accounts according to the filter specified as parameter(if any)
	function filterAnnouncements(){
		foreach($this->announcements_list as $item){
				
					$this->displayAnnouncements($item);
				
		}
		if(isset($_SESSION['log'])){?>
		<input type="button" value="Select All/Reset" onclick='checkedAll(frm1);'>
		<input type="submit" value="Delete"/>
		<?php } 
	}//end of filterAnnouncement_delete
	
	//method for displaying the accounts	
	function displayAnnouncement_delete($announcement){
?>	
		<!--displays and account in a table cell and a checkbox with a corresponding value-->
			<div>
				<td><h5><?php echo $announcement->title; ?></h5></td>
				<td><center><input type="checkbox" name="announcements[]" id="check1" value="<?php echo $announcement->announcement_id ?>"></center></td>
				
			</div>
<?php
	}//end of displayProduct
	
	//method that gets all accounts according to the filter specified as parameter(if any)
	function filterAnnouncement_delete(){
		?>
		<!--displays the table containg the list of accounts-->
		<center>
		<table cellpadding="10" border="1">
		<tr>
			<th colspan ="2">Announcements</th>
			
		<?php
		foreach($this->announcements_list as $item){
				?><tr><?php
					$this->displayAnnouncement_delete($item);
				?></tr><?php
		}
		?>
		<tr>
		<td width="300"><center><input type="button" value="Select All/Reset" onclick='checkedAll(frm1);'></center></td>
		<td><center><input type="submit" value="Delete"/></center></td>
		</tr>
		</table></center><?php
	}//end of filterAnnouncement_delete
	
}//class announcements

?>
		
	