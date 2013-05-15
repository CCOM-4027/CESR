
ADD USER
<form name="input" action="add_user.php" method="post">
	<table>
		<tr>
			<td>Name: </td>
		 	<td> <input type="text" name="name"> </td>
			<td>Lastname: </td>
			<td> <input type="text" name="lastname"></td>
			<td>Username: </td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password"></td>
			<td>Password repeat: </td>
			<td><input type="password" name="password2"></td>
			<td>Permission:</td>
			<td> <select name="perm">
						<option value= 1 >Personal</option>
						<option value= 2 >Supervisor</option>
						<option value= 3 >Administrator</option>
						<option value= 4 >Super User</option>
					</select><br></td>
		</tr>
	</table>
	<input type="submit" value="Submit">
</form><br>
ADD PROJECT
<form name="input" action="add_user.php" method="post">
	<table>
		<tr>
			<td>Contract Number : </td>
			<td><input type="text" name="number"></td>
			<td>Name :</td>
			<td><input type="text" name="pname"></td> 
			<td>Client :</td>
			<td><input type="text" name="client"></td>
		</tr>
	</table>
<input type="submit" value="Submit">
</form><br>
ADD PERSONAL TO PROJECT <br>
<form name="input" action="add_user.php" method="post">
	<table>
		<tr>
			<td>Project :</td>
			<td><select name="project">
			<?php 
				include 'database.php';
				$link = mysql_connect($host, $usernamedb, $password_db)or die("cannot connect");
				mysql_select_db($db_name)or die("cannot select DB"); 
				$query = "SELECT * FROM Project";
				$result = mysql_query($query) or die(mysql_error($link));
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    				echo ("<option value= ".$row["p_id"]."> ".$row['p_name']."</option>");  
				}
				mysql_free_result($result);
			?>
			</select></td>
			<td>Worker :</td>
			<td><select name="worker">
			<?php 
				$query = "SELECT * FROM Worker";
				$result = mysql_query($query) or die(mysql_error($link));
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    				echo ("<option value= ".$row["w_id"]."> ".$row['name']."</option>");  
				}
				mysql_free_result($result);
			?>
			</select></td>
	 	<tr>
	 </table>
<input type="submit" value="Submit">
</form><br>
CONSULTANT REPORT :<br>
<form name="input" action="informe.php" method="post">
	<table>
		<tr>
			<td>Project :</td>
			<td><select name="Project2">
			<?php 
				$query = "SELECT * FROM Project";
				$result = mysql_query($query) or die(mysql_error($link));
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    				echo ("<option value= ".$row["p_id"]."> ".$row['p_name']."</option>");  
				}
				mysql_free_result($result);
			?>
			</select></td>
			<td>Worker :</td>
			<td><select name="consultant">
			<?php 
				$query = "SELECT * FROM Worker";
				$result = mysql_query($query) or die(mysql_error($link));
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    				echo ("<option value= ".$row["w_id"]."> ".$row['name']."</option>");  
				}
				mysql_free_result($result);
				mysql_close($link);
			?>
			</select></td>
			<td>Month: </td>
			<td> <select name="month">
				<option value= 1 >Jan</option><option value= 2 >Feb</option>
				<option value= 3 >Mar</option><option value= 4 >Apr</option>
				<option value= 5 >May</option><option value= 6 >Jun</option>
				<option value= 7 >Jul</option><option value= 8 >Aug</option>
				<option value= 9 >Sep</option><option value= 10 >Oct</option>
				<option value= 11 >Nov</option><option value= 12 >Dec</option>
			</select></td>	
	 	<tr>
	 </table>
<input type="submit" value="Submit">
</form><br>


