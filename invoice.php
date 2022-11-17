<?php

//call the pdf library
require('fpdf/fpdf.php');

//A4 size


//create pdf object. Potrait , mm unit and A4
$pdf = new FPDF('P','mm','A4');

//add new page
$pdf->AddPage();

// $pdf->SetFillColor(123, 255, 234);

//setfont method
$pdf->SetFont('Arial', 'B', 16);

//write code for printing the string using Cell method and it will call the parameter
$pdf->Cell(80, 10, 'Masjid Al-Wustho', 0, 0, '');

$pdf->SetFont('Arial', '', 13);
$pdf->Cell(112, 10, 'PENYATA RASMI', 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80, 5, 'Pekan Guar Chempedak, Kedah', 0, 0, '');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(112, 5, 'No penyata : #12345', 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80, 5, 'No Tel : 013-5077314', 0, 0, '');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(112, 5, 'Tarikh : 26-6-2021', 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80, 5, 'E-mel : alwustha@gmail.com', 0, 1, '');
$pdf->Cell(80, 5, 'Laman Web : www.alwustha.com', 0, 1, '');

//using method line
$pdf->Line(5, 45, 205, 45);

$pdf->Ln(10); //line break

$pdf->SetFont('Arial', 'BI', 12);
$pdf->Cell(20, 10, 'Bil Kepada :', 0, 0);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, 'Syahril Ashraf', 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1, '');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(208,208,208);
$pdf->Cell(100, 8, 'Produk', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'Kuantiti', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Harga', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Jumlah', 1, 1, 'C', true);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, 'Iphone', 1, 0, 'C');
$pdf->Cell(20, 8, '1', 1, 0, 'C');
$pdf->Cell(30, 8, '2500', 1, 0, 'C');
$pdf->Cell(40, 8, '2500', 1, 1, 'C');


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, 'Xiaomi', 1, 0, 'C');
$pdf->Cell(20, 8, '1', 1, 0, 'C');
$pdf->Cell(30, 8, '2500', 1, 0, 'C');
$pdf->Cell(40, 8, '2500', 1, 1, 'C');


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, 'Huawei', 1, 0, 'C');
$pdf->Cell(20, 8, '1', 1, 0, 'C');
$pdf->Cell(30, 8, '2500', 1, 0, 'C');
$pdf->Cell(40, 8, '2500', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'SubTotal', 1, 0, 'C', true);
$pdf->Cell(40, 8, '600', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Tax', 1, 0, 'C', true);
$pdf->Cell(40, 8, '60', 1, 1, 'C');


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Discount', 1, 0, 'C', true);
$pdf->Cell(40, 8, '30', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'GrandTotal', 1, 0, 'C', true);
$pdf->Cell(40, 8, '$'. '6600', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Paid', 1, 0, 'C', true);
$pdf->Cell(40, 8, '7000', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Due', 1, 0, 'C', true);
$pdf->Cell(40, 8, '400', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Payment Method', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Cash', 1, 1, 'C');

$pdf->Cell(50, 113, '', 0, 1, '');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(32, 10, 'Importance Notice', 0, 0, 'C', true);


$pdf->SetFont('Arial', '', 9);
$pdf->Cell(148, 10, 'JOM KHAIRAT', 0, 0, '');






//output the result using output method
$pdf->Output();

?>
