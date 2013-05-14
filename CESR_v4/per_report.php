<html>
<head>
</head>
<body>
<?php
$username="jmedina";
$passwd="jom901@gmail.com";
$db="jmedinadb";
$host="localhost"; //change!!!!

$con=mysqli_connect($host, $username, $passwd , $db);
if(mysqli_connect_errno($con)){
  echo "Failed to connect to MySQL: ". mysqli_connect_error();
  }

echo "<br/>";

$worker =$_POST['w_id'];
$catch = $_POST['date'];

$pieces = explode("-", $catch);

$result= mysqli_query($con, "SELECT Pr.p_name, SUM(hours) AS time
FROM Worktime AS WT
INNER JOIN Project AS Pr ON WT.p_id = Pr.p_id
INNER JOIN Phase AS Ph ON WT.ph_id = Ph.ph_id
INNER JOIN Task AS T ON WT.t_id = T.t_id
WHERE WT.w_id = $worker and MONTH(WT.date) = '$pieces[1]' and YEAR(WT.date) = '$pieces[0]'
group by Pr.p_name");

while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    printf($row["p_name"]);
    echo ": ";
    printf($row["time"]);
    echo "<br>";
}

mysqli_free_result($result);

$going = mysqli_query($con, "SELECT T.taskcode, SUM(WT.hours) AS time
FROM Worktime AS WT
INNER JOIN Project AS Pr ON WT.p_id = Pr.p_id
INNER JOIN Phase AS Ph ON WT.ph_id = Ph.ph_id
INNER JOIN Task AS T ON WT.t_id = T.t_id
WHERE WT.w_id = $worker and MONTH(WT.date) = '$pieces[1]' and YEAR(WT.date) = '$pieces[0]'
group by T.taskcode");

while ($row = mysqli_fetch_array($going, MYSQL_ASSOC)) {
    printf($row["taskcode"]);
    echo ": ";
    printf($row["time"]);
    echo "<br>";
}

mysqli_free_result($going);


$query = "SELECT WT.date, WT.w_id, T.t_name, WT.comment, WT.hours, Ph.ph_name, Pr.p_name, WT.modality, WT.audience
		FROM Worktime AS WT
		INNER JOIN Project AS Pr ON WT.p_id = Pr.p_id
		INNER JOIN Phase AS Ph ON WT.ph_id = Ph.ph_id
		INNER JOIN Task AS T ON WT.t_id = T.t_id
		WHERE WT.w_id = $worker 
		AND MONTH(WT.date) = $pieces[1] and YEAR(WT.date) = $pieces[0] 
		ORDER BY Pr.p_name ASC";

$result = mysqli_query($con, $query) or die (mysqli_error($con));
?>
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