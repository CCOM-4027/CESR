<?php
require('./fpdf17/fpdf.php');
	class PDF extends FPDF
	{

	function LoadData($file){
    // Read file lines
    $lines = $file;
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
	}

	function FancyTable($header, $data){
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    
  
    // Header
    $w = array(30, 20, 80, 17, 40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],5,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],4,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],4,$row[1],'LR',0,'C',$fill);
        $this->Cell($w[2],4,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],4,$row[3],'LR',0,'L',$fill);
        $this->Cell($w[4],4,$row[4],'LR',0,'L',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
	}
}
?>