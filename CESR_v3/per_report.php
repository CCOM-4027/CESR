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


print $catch = $_POST['date'];

$pieces = explode("-", $catch);

$result= mysqli_query($con, "SELECT Pr.p_name, SUM(hours) AS time
FROM Worktime AS WT
INNER JOIN Project AS Pr ON WT.p_id = Pr.p_id
INNER JOIN Phase AS Ph ON WT.ph_id = Ph.ph_id
INNER JOIN Task AS T ON WT.t_id = T.t_id
WHERE WT.w_id = 7 and MONTH(WT.date) = '$pieces[1]' and YEAR(WT.date) = '$pieces[0]'
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
WHERE WT.w_id = 7 and MONTH(WT.date) = '$pieces[1]' and YEAR(WT.date) = '$pieces[0]'
group by T.taskcode");

while ($row = mysqli_fetch_array($going, MYSQL_ASSOC)) {
    printf($row["taskcode"]);
    echo ": ";
    printf($row["time"]);
    echo "<br>";
}

mysqli_free_result($going);
?>




</body>

</html>