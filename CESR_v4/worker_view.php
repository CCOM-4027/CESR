<html>
<body>
<div>
<?php
session_start();

$username="jmedina";
$passwd="jom901@gmail.com";
$db = "jmedinadb";
$host="localhost";

$con=mysqli_connect($host, $username, $passwd , $db);

if(mysqli_connect_errno($con)){
  echo "Failed to connect to MySQL: ". mysqli_connect_error();
  }
else{
  echo "<br>";
  }
echo "<br/>";


$pr=$_POST['proyecto'];
$year=$_POST['anho'];
$month=$_POST['mes'];

$info_query = "SELECT WT.date, WT.w_id, T.t_name, WT.comment, WT.hours, Ph.ph_name, Pr.p_name, WT.modality, WT.audience
				FROM Worktime AS WT
				INNER JOIN Project AS Pr ON WT.p_id = Pr.p_id
				INNER JOIN Phase AS Ph ON WT.ph_id = Ph.ph_id
				INNER JOIN Task AS T ON WT.t_id = T.t_id
				WHERE Pr.p_id = '$pr' AND w_id=$_SESSION[id]
				AND MONTH(date) = $month AND YEAR(date)= $year ";

$result = mysqli_query($con, $info_query) or die (mysqli_error($con));
?>
</div>

<div align="center">
<table border="1">

<tr>
  <td>DATE</td><td>PROJECT</td><td>PHASE</td><td>TASK</td>
  <td>COMMENT</td><td>HOURS</td><td>MODALITY</td><td>AUDIENCE</td>
</tr>
<?php while($row=mysqli_fetch_array($result, MYSQL_ASSOC)): ?>
<tr>
<td><?php echo $row['date'] ?></td>
<td><?php echo $row['p_name'] ?></td>
<td><?php echo $row['ph_name'] ?></td>
<td><?php echo $row['t_name'] ?></td>
<td><?php echo $row['comment'] ?></td>
<td><?php echo $row['hours'] ?></td>
<td><?php echo $row['modality'] ?></td>
<td><?php echo $row['audience'] ?></td>
</tr>
<?php endwhile ?>
</table>
</div>
<?php mysqli_close($con);
?>

<br><br><br>

<div align="center">
<form method="POST" action="index.php" >
<input type="submit" value="Return">
</form>
</div>

</body>
</html>