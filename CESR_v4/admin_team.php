<form method="POST" action="insert_data.php" id="tsform" onSubmit="alert('Data is being inserted');">
	Project:
	<select id="project" name="project" form="tsform">
		<option value="0"></option>
		<?php
			$username="jmedina";
			$passwd="jom901@gmail.com";
			$db = "jmedinadb";
			$host="localhost"; //change this!!!!
			
			$con=mysqli_connect($host, $username, $passwd , $db);
			
			//$result=mysqli_query($con, "SELECT * from Project");
			//while($row=mysqli_fetch_array($result))
			// echo '<option value="'.$row[0].'">'.$row[1].'</option>';
			
			$result=mysqli_query($con, "SELECT p_id, p_name from Project WHERE p_id IN (SELECT p_id from WorkerPro WHERE w_id = '$_SESSION[id]')");
			while($row=mysqli_fetch_array($result))
			  echo '<option value="'.$row[0].'">'.$row[1].'</option>';
			
			mysqli_close($con);
		?>
	</select>
	
	Phase:
	<select id="phase" name="phase" form="tsform">
		<option value="6">6: Management</option>
	</select>
	
	Task:
	<select id="task" name="task" form="tsform">
		<option value="M1">Check emails</option>
		<option value="M2">Coordination of Meetings</option>
		<option value="M3">Coordination of Activities</option>
		<option value="M4">Publication Committee</option>
		<option value="M5">Marketing Committee</option>
		<option value="M6">Professional Development Committee</option>
		<option value="M7">Team Meetings</option>
		<option value="M8">Supervision</option>
	</select>
	
	<br/><br/>
	Hours:
	<select name="hours" form="tsform">
		<option value="0">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option><br/><br/>
	</select>
	<select name="fractions" form="tsform">
		<option value=".00">.00</option>
		<option value=".25">.25</option>
		<option value=".50">.50</option>
		<option value=".75">.75</option><br/><br/>
	</select>
	
	Audience:
	<select name="audience" form="tsform">
		<option value="NA">N/A</option>
		<option value="Client">Client</option>
		<option value="Stakeholder">Stakeholder</option>
		<option value="CIES staff">CIES staff</option>
		<option value="Participant">Participant</option>
		<option value="Other">Other</option>
	</select>
	
	Modality:
	<select name="modality" form="tsform">
		<option value="NA">N/A</option>
		<option value="F2F">Face to Face</option>
		<option value="Phone">Phone</option>
		<option value="Email">Email</option>
		<option value="Web Base">Web Base</option>
		<option value="Other">Other</option>
	</select>
	
	Comment:
	<input type="text" id="topic" name="topic" form="tsform"/>
	
	<input type="submit" value="Submit">
</form>
<br/><br/>
