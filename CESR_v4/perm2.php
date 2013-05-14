CONSULTANT REPORT :<br>
<form name="input" action="informe.php" method="post">
	<table>
		<tr>
			<td>Project :</td>
			<td><select name="Project2">
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
			<td><select name="consultant">
			<?php 
				$query = "SELECT * FROM Worker";
				$result = mysql_query($query) or die(mysql_error($link));
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    				echo ("<option value= ".$row["w_id"]."> ".$row['name']."</option>");  
				}
				mysql_free_result($result);
				
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
			<td>Year: </td>
			<td>
			<select name="year">
				<?php
					$date = date("Y");
					for ($x=-3; $x < 4; $x++){
						$year = $date + $x;
						echo "<option value=".$year.">".$year."</option>";
					}
				?>
			</select>
			</td>	
			<td>
				<input type="checkbox" name="external" value="true">External Report<br>
			</td>
	 	<tr>
	 </table>
<input type="submit" value="Submit">
</form>
<br>
<form id="rep" action="per_report.php" method="post">
Worker :<select name="w_id">
			<?php 
				$query = "SELECT * FROM Worker";
				$result = mysql_query($query) or die(mysql_error($link));
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    				echo ("<option value= ".$row["w_id"]."> ".$row['name']."</option>");  
				}
				mysql_free_result($result);
				mysql_close($link);
			?>
		</select>
		Date: <input type= "month" name="date" id="date">
		<input type="submit">
</form><br>