<?php 
/*
 * login_ajax.php script
 * This script is called via Ajax from index.php.
 * The script expects to receive two values in the URL: an user address and a password.
 * The script returns a string indicating the results.
 * Created by Larry Ullman
 * www.LarryUllman.com
 * For an article published at www.Peachpit.com
 */

// Need two pieces of information:
if (isset($_GET['user'], $_GET['password'])) {
		
		$host="localhost"; // Host name 
		$username="jmedina"; // Mysql username 
		$password="jom901@gmail.com"; // Mysql password 
		$db_name="jmedinadb"; // Database name 
		$tbl_name="Worker"; // Table name 

		$myusername = addslashes($_GET['user']);
		$mypassword = md5(addslashes($_GET['password']));

		$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
		

		mysql_connect($host, $username, $password)or die("cannot connect"); 
		mysql_select_db($db_name)or die("cannot select DB");
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);

		// Check the database!
		if($count==1){
			session_start();
			$_SESSION['name'] = $row['username'];
			$_SESSION['user'] = true;
			$_SESSION['perm'] = $row['permission'];
			echo 'CORRECT';
		} else {
		echo 'INCORRECT';
		}

} else { // Missing one of the two variables!
	echo 'INCOMPLETE';
}

?>
