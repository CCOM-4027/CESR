<HTML>
<head>
<title>FINAL PROJECT</title>
<LINK href="style.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script>
$(document).ready(function() {
$('#phase').change(function() {

$('#task').empty();
    //determining which tasks will appear in the drop down based on phase
    if($('#phase').val() == "1"){
        var PT = new Array(1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
    }
    else if($('#phase').val() == "2"){
        var PT = new Array(1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1);
    }
    else if($('#phase').val() == "3"){
        var PT = new Array(1, 1, 0, 1, 0, 9, 0, 0, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1);
    }
    else if($('#phase').val() == "4"){
        var PT = new Array(1, 1, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1);
    }
    else if($('#phase').val() == "5") {
        var PT = new Array(1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1);
    }
    else 
    $('#task').empty();
    //list of all possible tasks
    var tasks = new Array("Communication with client", "Consulting team meeting", "Development of proposal", "Lit review", "Networking", "Contracting", "Budget", "IRB", "Data Management", "Data Collection", "Development/Editing of documents", "Project Staff Training", "Training", "Technical or Programmatic Assistance", "Evaluation", "Program Development", "Invoicing-Fiscal Report", "Dissemination");

    //creating dropdown
    for(var k=0; k<18; k++){
        if(PT[k]==1)
            $('#task').append('<option value="' + (k+1) + '">' + (k+1) + ": "  + tasks[k] + '</option>');
        }
     });

$('#task').change(function(){

$('#other').empty();
var temp = $('#task').val();

    if(temp=="1" || temp=="2" || temp=="3" || temp=="4" || temp=="5" || temp=="7" || temp=="12" || temp=="17" || temp=="18" || temp=="19"){
  
     $('#other').append('Topic: <input type="text" id="topic" name="topic" form="tsform"/>');
     }

    else{

     if(temp=="6"){
         var choices = new Array("New", "Renewal");
     }
     else if(temp=="8"){
         var choices = new Array("Application", "Amendment", "Renewal");
     }
     else if(temp=="9"){
         var choices = new Array("Develop Data Base", "Data Entry", "Data Cleaning", "Data Analysis");
     }
     else if(temp=="10"){
         var choices = new Array("Observation", "Focus Groups", "Interviews", "Surveys");
     }
     else if(temp=="11"){
         var choices = new Array("Manuscripts", "White Papers", "Reports", "Presentations", "Press Releases", "MOU", "Memos", "Letters", "Calendar", "Work Plan", "Minutes", "Timesheets", "Other");
     }
     else if(temp=="13"){
         var choices = new Array("Need Assesment", "Strategic Planning", "Logic Models", "EBP", "Prevention", "Cultural Competence", "Organizational Development", "Leadership", "Sustainability", "Data Management", "Data Collection", "Other");
     }
     else if(temp=="14"){
         var choices = new Array("Coaching", "Observation", "Other");
     }
     else if(temp=="15"){
         var choices = new Array("Evaluation Plans", "Logic Models", "Development/Revision of Instruments");
     }
     else if(temp=="16"){
         var choices = new Array("Theoretical/Logic Models", "Curriculum Development", "Other");
    }

     //  $('#other').append('Topic: <select id="topic" form="project"><option value="1">1</option><option value="2">2</option></select>');
    
    //creating dropdown
    $('#other').append('Topic: <select id="topic" name="topic" form="tsform"></select>');
    for(var k=0; k<choices.length; k++){
        $('#topic').append('<option value="' + choices[k] + '">' + choices[k] + '</option>');
        }
    }
    });

});
</script>

</head>
<div id="banner">
<h1>CESR <font size="5" color="white">Center for Evaluation and Sociomedical Reaserch</font></h1>
</div>
<div id="container">
<form method="POST" action="insert_data.php" id="tsform" onSubmit="alert('Data is being inserted');">

<div id="first">

Project:
<select id="project" name="project" form="tsform">
<?php

$username="jmedina";
$passwd="jom901@gmail.com";
$db = "jmedinadb";
$host="localhost"; //change this!!!!

$con=mysqli_connect($host, $username, $passwd , $db);

//$result=mysqli_query($con, "SELECT * from Project");
//while($row=mysqli_fetch_array($result))
//  echo '<option value="'.$row[0].'">'.$row[1].'</option>';

$result=mysqli_query($con, "SELECT p_id, p_name from Project WHERE p_id IN (SELECT p_id from WorkerPro WHERE w_id = '$_SESSION[id]')");
while($row=mysqli_fetch_array($result))
  echo '<option value"'.$row[0].'">'.$row[1].'</option>';

mysqli_close($con);

?>
</select>

Phase:
<select id="phase" name="phase" form="tsform">
<option value="1">1: Contracting Process</option>
<option value="2">2: Program Management Design </option>
<option value="3">3: Implementation</option>
<option value="4">4: Report</option>
<option value="5">5: Close Project</option>
</select>

Task:
<select id="task" name="task" form="tsform">
</select>
</div>

<br/><br/>
<div id="second">
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
</div>
<br/><br/>

<div id="other">
</div>

<br/><br/>

<input type="submit" value="Submit">
</form>

</div>
<div id="footer">
</div>
</HTML>
