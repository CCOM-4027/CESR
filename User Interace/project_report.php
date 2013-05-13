<html>
<?php

echo "printing POST array <br/>";

foreach($_POST as $key => $value)
    echo "Key: {$key}, Value: {$value} <br/>";

$username="jmedina";
$passwd="jom901@gmail.com";
$db = "jmedinadb";
$host="localhost";

echo "printing date: ". $date;
echo "<br/>";

$con=mysqli_connect($host, $username, $passwd , $db);

if(mysqli_connect_errno($con)){
  echo "Failed to connect to MySQL: ". mysqli_connect_error();
  }
else{
  echo "Congratulations! You connected to MySQL";
  }
echo "<br/>";

$sql="SELECT * from Worktime where p_id='$_POST[project]' and date<='$_POST[start]' and date>='$_POST[end]'";
$hrs=0.0;

$result = mysqli_query($con, $sql);

echo "<table border='1'>";

while($row = mysqli_fetch_array($result)){
    $hrs+=$row['hours'];
    echo "<tr>"
    foreach($row as $value){
        echo "<td>".$value."</td>";
    }
    echo "</tr>";
}
echo "</table>";


mysqli_close($con);

?>
</html>
