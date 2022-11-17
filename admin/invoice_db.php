<?php

//call the pdf library
require('fpdf/fpdf.php');
include_once 'database/connect.php';

$id = $_GET['khairat_id'];

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);
// $kariah_id = $row['kariah_id'];

// $select = $pdo->prepare("SELECT kariah_id, no_ahli FROM ahli_kariah WHERE ahli_kariah.kariah_id = $kariah_id ");
// $select->execute();
// $row2 = $select->fetch(PDO::FETCH_OBJ);

//A4 size

//create pdf object. Potrait , mm unit and A4
$pdf = new FPDF('P', 'mm', 'A4');

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
$pdf->Cell(112, 5, 'No penyata :' . $row->kariah_id, 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80, 5, 'No Tel : 013-5077314', 0, 0, '');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(112, 5, 'Tarikh : ' . date('d-m-Y', strtotime($row->tarikh_daftar)), 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(80, 5, 'E-mel : alwustha@gmail.com', 0, 1, '');
$pdf->Cell(80, 5, 'Laman Web : www.alwustha.com', 0, 1, '');

//using method line
$pdf->Line(5, 45, 205, 45);

$pdf->Ln(10); //line break

$pdf->SetFont('Arial', 'BI', 12);
$pdf->Cell(20, 10, 'Bil Kepada :', 0, 0);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, $row->khairat_name, 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1, '');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(208, 208, 208);
$pdf->Cell(100, 8, 'Produk', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'Kuantiti', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Harga', 1, 0, 'C', true);
// $pdf->Cell(40, 8, 'Jumlah', 1, 1, 'C', true);

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id = $id");
$select->execute();

while ($item = $select->fetch(PDO::FETCH_OBJ)) {
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(100, 8, $item->product_name, 1, 0, 'C');
    $pdf->Cell(20, 8, $item->quantity, 1, 0, 'C');
    $pdf->Cell(30, 8, $item->total, 1, 0, 'C');
    // $pdf->Cell(40, 8, $item->price * $item->quantity, 1, 1, 'C'); //ni total
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Jumlah', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->total, 1, 1, 'C');

// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(100, 8, '', 0, 0, 'L');
// $pdf->Cell(20, 8, '', 0, 0, 'C');
// $pdf->Cell(30, 8, 'Tax', 1, 0, 'C', true);
// $pdf->Cell(40, 8, $row->tax, 1, 1, 'C');

// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(100, 8, '', 0, 0, 'L');
// $pdf->Cell(20, 8, '', 0, 0, 'C');
// $pdf->Cell(30, 8, 'Discount', 1, 0, 'C', true);
// $pdf->Cell(40, 8, $row->discount, 1, 1, 'C');

// $pdf->SetFont('Arial', 'B', 14);
// $pdf->Cell(100, 8, '', 0, 0, 'L');
// $pdf->Cell(20, 8, '', 0, 0, 'C');
// $pdf->Cell(30, 8, 'GrandTotal', 1, 0, 'C', true);
// $pdf->Cell(40, 8, 'RM ' . $row->total, 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Bayar', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->paid, 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Baki', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->due, 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100, 8, '', 0, 0, 'L');
$pdf->Cell(20, 8, '', 0, 0, 'C');
$pdf->Cell(30, 8, 'Kaedah Pembayaran', 1, 0, 'C', true);
$pdf->Cell(40, 8, $row->p_method, 1, 1, 'C');

$pdf->Cell(50, 113, '', 0, 1, '');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(32, 10, 'Importance Notice', 0, 0, 'C', true);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(148, 10, 'JOM KHAIRAT', 0, 0, '');

//output the result using output method
$pdf->Output();
