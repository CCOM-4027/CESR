<?php
	include 'database.php';
	include 'table_pdf.php';   // EXTENTION TO DRAW TABLES ON PDF

// POST VARIABLES FROM INDEX
	$project = $_POST['Project2'];
	$worker = $_POST['consultant'];
	$month = $_POST['month'];

// DATA BASE CONNECTION
	$link = mysql_connect($host, $usernamedb, $password_db)or die("cannot connect");
	mysql_select_db($db_name)or die("cannot select DB");

// QUERY TO RETRIVE INFORMATION ABOUT THE CONSULTANT
	$cons_query = "SELECT * FROM Worker WHERE w_id= $worker ";
	$result = mysql_query($cons_query) or die("1".mysql_error($link));
	$cons_info = mysql_fetch_array($result, MYSQL_ASSOC);

// QUERY TO RETRIVE INFORMATION ABOUT THE PROJECT
	$project_query = "SELECT * FROM Project WHERE p_id= '$project' ";
	$result2 = mysql_query($project_query) or die("2".mysql_error($link));
	$project_info = mysql_fetch_array($result2, MYSQL_ASSOC);

// QUERY TO RETRIVE ALL THE INFOMATION OF TIMESHEETS
	$info_query =  "SELECT WT.date, T.taskcode, WT.comment, WT.hours, Ph.ph_name
				   	FROM Worktime AS WT
				   	INNER JOIN Project AS Pr ON WT.p_id = Pr.p_id
					INNER JOIN Phase AS Ph ON WT.ph_id = Ph.ph_id
					INNER JOIN Task AS T ON WT.t_id = T.t_id
					WHERE WT.w_id = $worker AND WT.p_id = '$project' and MONTH(WT.date) = $month
					Order by T.taskcode ASC";
	$result3 = mysql_query($info_query) or die(mysql_error($link));
	$S_entry = array();
	$A_entry = array();
	$SC =0;
	$AC =0;
	
	while ($row = mysql_fetch_array($result3, MYSQL_ASSOC)) {
   		 $worktime[] = $row['date'].";".$row['taskcode'].";".$row['comment'].";".$row['hours'].";".$row['ph_name']; 
   		 if ($row['taskcode'] == "SC"){
   		 		$S_entry[] = $row['date'].";".$row['taskcode'].";".$row['comment'].";".$row['hours'].";".$row['ph_name'];
   				$SC+= $row['hours'];
   				}
   		 if ($row['taskcode'] == "AC"){
   		 		$A_entry[]= $row['date'].";".$row['taskcode'].";".$row['comment'].";".$row['hours'].";".$row['ph_name'];
   				$AC+= $row['hours'];
   			}
	}


//CONSULTANT NAME AND PROJECT NAME
	$n = $cons_info['name'];
	$p =$project_info['p_name'];
	$m = date("F", mktime(0, 0, 0, $month, 10));


// CREATE PDF DOCUMENT
	$pdf = new PDF();
	$pdf->SetFont('Arial','',8);
	// TABLE HEADER 
	$header = array('Date', 'Activity', 'Comments', 'Hours', 'Phase');
	$header2 = array('', 'AC Total', " ", "$AC", "");
	$header3 = array('', 'SC Total', " ", "$SC", "");
	// LOAD DATA FROM ARRAY
	$data_A = $pdf->LoadData($A_entry);
	$data_S = $pdf->LoadData($S_entry);
	$pdf->AddPage();
	$pdf->Cell(35); // Move to the right
    $pdf->Cell(50,5,"Project: $p ",0,1,'L');
    $pdf->Cell(35);
    $pdf->Cell(0,5,"Consultant: $n ",0,1,'L');
    $pdf->Cell(35);
    $pdf->Cell(0,5,"Month: $m ",0,1,'L');
	$pdf->Image('logo.jpeg',10,6,30);
	$pdf->Ln(20);
	$pdf->FancyTable($header,$data_A);
	$pdf->Ln();
	$pdf->FancyTable($header2,$data_S);
	$pdf->Ln();
	$pdf->FancyTable($header3,array());
	$pdf->Output();

?>