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
?>
		
	