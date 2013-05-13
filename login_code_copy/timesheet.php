			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
			<script>

			$("#tsform").change( function () {
				    var option = $("#phase").val();
				    if(option == 2){
				        $("#task").append('<option value="1">Meeting</option>');
				    }
				});
			</script>

			<form action="proj_report.php" id="tsform" method="post">
				Project:
	   			<select name="project" form="project">
 				  <option value="1">Data Bases</option>
				  <option value="2">High Level Programming</option>
				  <option value="3">Algorithm</option>
				  <option value="4">Modern Algebra</option>
				</select>
				Phase:
				<select name="phase" form="project">
 				  <option value="1">1</option><option value="2">2</option>
				  <option value="3">3</option><option value="4">4</option>
				  <option value="5">5</option>
				</select>
				Task:
				<select name="task" form="project">
				</select>
				Hours:
				<input type="number" name="hours" size="2"><br><br>
				Commets: <br>
				<textarea name="comments" cols="40" rows="5"></textarea><br>
				<input type="submit" value="Submit">
				<input type="checkbox" name="external" value="true">External Report 
			</form>