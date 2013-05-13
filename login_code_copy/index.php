<?php 
	session_start();  	 // Start the session:     //$_SESSION = array(); // To fake logging out.
	if (isset($_GET['logout'])){
		session_destroy();
	}
	// Check for a form submission.
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = array();   // Array for storing errors:
		
		// Validate!
		if (isset($_POST['user'])) {
			$e = $_POST['user'];
		} else {
			$errors['user'] = true;
		}
		if (isset($_POST['password']) && !empty($_POST['password'])) {
			$p = $_POST['password'];
		} else {
			$errors['password'] = true;
		}
			
	} // End of form submission IF.
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>
	<style type="text/css" media="screen">
		.error { color: red;}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="login.js" charset="utf-8"></script>
	<LINK href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div id="banner">
			<h2>CESR <font size="5" color="white">Center for Evaluation and Sociomedical Reaserch</font></h2>
		</div>

<?php // Decide what content to display.
	if (isset($_SESSION['user']) && !isset($_GET['logout'])) { // Show logged-in content.
		echo '<h2>Welcome</h2>';

		echo '<br><form action="index.php" method="get" >
			      <button name="logout" type="submit" value="true">logout</button></from><br>';

		if ($_SESSION['perm'] == 1)
			include 'timesheet.php';
		if ($_SESSION['perm'] == 2){
			include 'timesheet.php';
			include 'perm2.php';
		}
		if ($_SESSION['perm'] == 3){
			include 'admin.php';
		}
		if ($_SESSION['perm'] == 4){
			include 'superuser.php';
		}

	} 
	else { // Show login form.
		
		echo '<div id="flexArea"><h1>Login</h1>
		<form action="index.php" method="post" id="loginForm">';    // Start the form:  
		
		if (isset($errors['incorrect'])) {      // Check for a general error:
			echo '<p class="error">The user address and password submitted do not match those on file.</p>';
		}

		echo '<p id="userP">Username: <input type="text" name="user" id="user"';  // Start the user input:
		
		if (isset($_POST['user'])) echo ' value="' . $_POST['user'] . '"';	// Make it sticky, if applicable:
		
		echo ' />';    // Complete the input:
			
		if (isset($errors['user'])) {    // Check for an error:
			echo ' <span class="error" id="userError">Please enter your user address!</span>';
		}
		
		echo '</p>';	// Complete the paragraph:
			
		echo '<p id="passwordP">Password: <input type="password" name="password" id="password"'; // Start the password:
		
		if (isset($_POST['password'])) echo ' value="' . $_POST['password'] . '"'; // Make it sticky, if applicable:
			
		echo ' />';  // Complete the input:
			
		if (isset($errors['password'])) { // Check for an error:
			echo ' <span class="error" id="passwordError">Please enter your password!</span>';
		}
		
		echo '</p>'; // Complete the paragraph:
			
		// Complete the form:
		echo '<p><input type="submit" name="submit" value="Login!" /></p>
		</form></div>';
		
	}

?>
</body>
</html>