<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript">
	// FUCTION TO GO BACK TO INDEX
	$(document).ready(function() {
		$('#back').click(function(){
			window.location.replace("index.php"); 
		});
	});
</script>
<br><br>
<button id="back">Back</button><br><br>

<?php
	// Database information
	include 'database.php';

//THIS FILE ADD USER, ADD PROJECTS AND ADD PERSONAL TO PROJECT

	//Verify if all the Project fields are filled and create the project on the database
	if (isset($_POST['pname']) && isset($_POST['client']) && isset($_POST['number'])
		&&  !empty($_POST['pname'])  &&  !empty($_POST['client'])  && !empty($_POST['number'])){
			
			$link = mysql_connect($host, $usernamedb, $password_db)or die("cannot connect");
			mysql_select_db($db_name)or die("cannot select DB"); 
			$pname = addslashes($_POST['pname']);
			$contract = addslashes($_POST['number']);
			$client = addslashes($_POST['client']);

			$sql2 = "INSERT INTO Project (p_name, p_id, Client ) VALUES ('$pname','$contract','$client') ";
			$insert = mysql_query($sql2) or die(mysql_error($link));
			echo "PROJECT ADDED";
		return;
	}

	// Verify if a worker is being assing to a Project 
	if (isset($_POST['project']) && isset($_POST['worker']) && !empty($_POST['project'])  &&  !empty($_POST['worker'])){
			$link = mysql_connect($host, $usernamedb, $password_db)or die("cannot connect");
			mysql_select_db($db_name)or die("cannot select DB"); 
			$project = addslashes($_POST['project']);
			$worker = addslashes($_POST['worker']);

			$sql3 = "INSERT INTO WorkerPro (w_id, p_id ) VALUES ('$worker','$project') ";
			$insert = mysql_query($sql3) or die(mysql_error($link));
			echo "PERSONAL ADDED";
		return;
	}
	
	// If all fields of a worker are filled, a new worker is added ti de database
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['lastname']) && 
			isset($_POST['perm']) && ($_POST['password'] == $_POST['password2']) && !empty($_POST['name']) &&
			!empty($_POST['password']) && !empty($_POST['lastname']) && !empty($_POST['perm']) && !empty($_POST['username']) ){

			$username = addslashes($_POST['username']);
			$password = md5(addslashes($_POST['password']));
			$name= addslashes($_POST['name']);
			$lastname= addslashes($_POST['lastname']);
			$perm = addslashes($_POST['perm']);

			$link = mysql_connect($host, $usernamedb, $password_db)or die("cannot connect");
			mysql_select_db($db_name)or die("cannot select DB"); 
			$sql = "INSERT INTO Worker (name, lastname, username, password, permission ) VALUES ('$name','$lastname', '$username', '$password', $perm )";
			$insert = mysql_query($sql) or die(mysql_error($link));
			echo " USER ADDED COMPLETE";
		return;
	}
	
	//If a field of any of the options are left blank returns an error
	else{
	if($_POST['password'] !== $_POST['password2'])
		echo "Password don't Match"; //Verify if the password don't match
	else
		echo "ERROR : Empty Field";
}

?>
