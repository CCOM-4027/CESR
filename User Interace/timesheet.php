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
            $('#task').append('<option value="' + (k+1) + '">' + tasks[k] + '</option>');
        }
     });

$('#task').change(function(){

var temp = $('#task').val();

$('#topic').empty();

//  if(temp=="1" || temp=="2" || temp=="3" || temp=="4" || temp=="5" || temp=="7" || temp=="12" || temp=="17" || temp=="18" || temp=="19"){
   //text box
//  else{

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

    //creating dropdown
    for(var k=0; k<choices.length; k++){
        $('#topic').append('<option value="' + choices[k] + '">' + choices[k] + '</option>');
        }
 // }
    });

});
</script>


</head>
<body>
<div id="banner">
<h1>CESR <font size="5" color="white">Center for Evaluation and Sociomedical Reaserch</font></h1>
</div>
<div id="container">
<form method="Post" action="insert_data.php" id="carform">

Project:
<select name="project" form="project">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>

Phase:
<select name="phase" form="project">
<option value="1">1: Contracting Process</option>
<option value="2">2: Program Management Design </option>
<option value="3">3: Implementation</option>
<option value="4">4: Report</option>
<option value="5">5: Close Project</option>
</select>

Task:
<select id="task" form="project">
</select>


<br><br>

Hours:
<select name ="Hours" form ="project">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option><br><br>
</select>
<select name = "Fractions" form="project">
<option value=".00">.00</option>
<option value=".25">.25</option>
<option value=".50">.50</option>
<option value=".75">.75</option><br><br>
</select>

Topic/Detail:
<select id="topic" form="project">
</select>

Audience:
<select name="Audience" form="project">
<option value="NA">N/A</option>
<option value="Client">Client</option>
<option value="Stakeholder">Stakeholder</option>
<option value="CIES staff">CIES staff</option>
<option value="Participant">Participant</option>
<option value="Other">Other</option>
</select>

Modality:
<select name="Modality" form="project">
<option value="NA">N/A</option>
<option value="F2F">Face to Face</option>
<option value="Phone">Phone</option>
<option value="Email">Email</option>
<option value="Web Base">Web Base</option>
<option value="Other">Other</option>
</select>

<input type="submit" value="Submit">
</form>

</div>
<div id="footer">
</div>
</body>
</HTML>
