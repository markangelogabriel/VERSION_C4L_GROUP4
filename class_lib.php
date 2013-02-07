<?php
	
class Account{
	var $username;
	var $password;
		
	//constructor	
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
	
class allAccounts{
	
	public $accounts_list = array();
	
	function getAccounts(){
		//connect to database
		$conn = pg_pconnect("host=localhost port =5432 dbname=eyescrime user=postgres password=root");
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
				/*stores the product in an array of products*/
				$this->accounts_list[] = new Account($username,$password);
			}
		}//while
			
			
		
	}//end of getProducts
		
	function displayAccount($account){
?>	
			<div>
				<td><h5><?php echo $account->username; ?></h5></td>
				<td><center><input type="checkbox" name="accounts[]" id="check1" value="<?php echo $account->username ?>"></center></td>
				
			</div>
<?php
	}//end of displayProduct
	
	function filterAccounts(){
		?>
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
	}//end of filterProducts
		
	

	
}//end of class allProducts


?>
		
	