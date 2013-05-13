

<?php

$username="jmedina";
$passwd="jom901@gmail.com";
$db="jmedinadb";
$host="localhost"; //change!!!!
$hrs = 6; //index for hours in mysqli_query result
$date = date("Y-m-d"); //calculates the date for input

//echo "printing date: ". $date;
//echo "<br/>";

$con=mysqli_connect($host, $username, $passwd , $db);

if(mysqli_connect_errno($con)){
  echo "Failed to connect to MySQL: ". mysqli_connect_error();
  }
else{
  echo "Congratulations! You connected to MySQL";
  }
echo "<br/>";

//calculate total time
$time = $_POST['hours']*1.0 + $_POST['fractions'];

//determine if an entry with same set of key values has already been inserted
//if so, increment its hours total instead
$result=mysqli_query($con, "SELECT * from Worktime WHERE date = $date AND  p_id = '$_POST[project]' AND ph_id = '$_POST[phase]' AND t_name = '$_POST[task]'");

if(mysqli_num_rows($result)){
  $row=mysqli_fetch_array($result, MYSQLI_NUM);
  echo $row[$hrs];
  echo "<br/>";
  echo $time;
  echo "<br/>";
  $newTime=$row[$hrs] + $time;
  echo $newTime;
  echo "<br/>";
  mysqli_query($con, "UPDATE Worktime SET hours = $newTime WHERE p_id = '$_POST[project]' AND ph_id = '$_POST[phase]' AND t_name = '$_POST[task]'");
}
else{
//else, add new entry

$sql="INSERT INTO Worktime (w_id, date, p_id, ph_id, t_name, comment, hours, audience, modality)
VALUES
('$_SESSION[id]', $date,'$_POST[project]','$_POST[phase]', '$_POST[task]','$_POST[topic]',$time,'$_POST[audience]','$_POST[modality]')";

if (!mysqli_query($con,$sql)){
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";
}
mysqli_close($con);

?>

<script>

$(document).ready(
  $('button').click(
    function(){

      window.location.replace('index.php');
})

);

</script>
<button type="button">Back</button>

