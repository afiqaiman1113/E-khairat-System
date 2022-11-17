<?php
// Include the main TCPDF library (search for installation path).

use PhpOffice\PhpSpreadsheet\Cell\Cell;

require_once('admin/TCPDF-main/tcpdf.php');
include_once 'admin/database/connect.php';

session_start();
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

$id = $_GET['khairat_id'];

$select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.* FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE khairat_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);

//$select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN tbl_product ON khairat_kematian.product_id = tbl_product.product_id WHERE khairat_id = $id");
$select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.*FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE khairat_id = $id");
$select->execute();
$row2 = $select->fetch(PDO::FETCH_OBJ);


if ($row2->product_name == 'Yuran Pendaftaran') {
    class PDF extends TCPDF
    {
        public function Header()
        {
            // require_once('admin/TCPDF-main/tcpdf.php');
            // include_once 'admin/database/connect.php';

            // $id = $_GET['khairat_id'];
            // $select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN tbl_product ON khairat_kematian.product_id = tbl_product.product_id WHERE khairat_id = $id");
            // $select->execute();
            // $row2 = $select->fetch(PDO::FETCH_OBJ);

            $bMargin = $this->getBreakMargin();
            // get current auto-page-break mode
            $auto_page_break = $this->AutoPageBreak;
            // disable auto-page-break
            $this->SetAutoPageBreak(false, 0);
            $this->SetAutoPageBreak($auto_page_break, $bMargin);
            // set the starting point for the page content
            $this->setPageMark();

            //ni code utk background
            // $img_file = K_PATH_IMAGES.'ekhairat.png';
            // $this->Image($img_file, 0, 0, 256, 298, '', '', '', false, 300, '', false, false, 0);

            //ni code utk logo
            $imageFile = K_PATH_IMAGES . 'ntah.png';
            $this->Image($imageFile, 14, 17, 80, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $this->Ln(5); //font size
            $this->SetFont('helvetica', 'B', 12);
            //189 is total width of A4 page, height, border, line
            $this->Ln(-3);
            $this->Cell(170, 5, 'PENYATA RASMI', 0, 1, 'R');
            // $pdf->Cell(59, 5, 'NO K/P       :   9808200205729', '', 0, 1);
            $this->SetFont('helvetica', '', 10);
            $this->Cell(178, 3, 'BAYARAN YURAN PENDAFTARAN', 0, 1, 'R');
            // $this->Cell(189, 3, 'GUAR CHEMPEDAK', 0, 1, 'C');
            // $this->Cell(189, 3, '08800 ', 0, 1, 'C');
            // $this->Cell(189, 3, 'Phone : 04-4682321', 0, 1, 'C');
            // $this->Cell(189, 3, 'E-mail - alwusto.com.my', 0, 1, 'C');
            $this->Ln(4);
            $this->Cell(20, 1, '___________________________________________________________________________________________', 0, 0);
            // $this->SetFont('helvetica', 'B', 11);
            // $this->Ln(2);
            // $this->Cell(189, 3, 'BUY & SALE ORDER', 0, 1, 'C');

        }

        public function Footer()
        {
            // Position at 15 mm from bottom
            $this->SetY(-148);
            // Set font
            $this->SetFont('helvetica', 'B', 8);

            // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
            $this->Ln(120);
            // Page number
            $this->Cell(189, 5, 'TERIMA KASIH KERANA MENDAFTAR', 0, 1, 'C');
            $this->Ln(3);
            $this->SetFont('helvetica', 'I', 7);
            $this->Cell(189, 5, 'CETAKAN KOMPUTER TIDAK MEMERLUKAN TANDATANGAN', 0, 1, 'C');
            $this->Ln(2);
            $this->Cell(20, 1, '___________________________________________________________________________________________________________________________________', 0, 0);
            $this->Ln(2);
            // $this->Cell(20, 1, '_______________', 0, 0);
            // $this->Cell(118, 1, '', 0, 0);
            // $this->Cell(51, 1, '_______________', 0, 1);
            // $this->Cell(20, 5, 'Authorized Signature', 0, 0);
            // $this->Cell(118, 5, '', 0, 0);
            // $this->Cell(51, 5, 'Customer/POA Signature', 0, 1);

            // $this->Cell(8, 1, '', 0, 0);
            // $this->Cell(118, 5, 'Office Use', 0, 1);
            // $this->Ln(5);
            // $this->Cell(100, 5, 'Transaction Instruction Form (PAY IN)', 0, 1, 'R');
            // $this->Cell(89, 5, '', 0, 1, 'C');

            // $this->Cell(100, 5, 'Please Transfer the above noted sold securities to the clearing', 0, 1, 'C');
            // $this->Cell(79, 5, '', 0, 1, 'C');

            // $this->Cell(110, 5, 'DSE CLEARING ___________________________', 0, 0);
            // $this->Cell(79, 5, 'EXCHANGE ID __________________', 0, 1, 'C');
            // $this->Ln(5);

            // $this->Cell(110, 5, 'DSE CLEARING ___________________________', 0, 0);
            // $this->Cell(79, 5, 'EXCHANGE ID __________________', 0, 1, 'C');
            // $this->Ln(4);

            // $this->SetFont('times', 'B', 10);
            // $this->Cell(189, 5, 'DECLARATION', 0, 1, 'L');

            // $this->SetFont('times', '', 10);
            // $html = '<p style="text-align:justify"> The rules & regulation of the Depository & CDBL participant pertaining to accounts which are in force </p>';
            // $this->writeHTML($html, true, false, true, false, '');

            // $this->Ln(8);
            // $this->SetFont('times', 'B', 10);
            // $this->Cell(20, 1, '______________________', 0, 0);
            // $this->Cell(118, 1, '', 0, 0);
            // $this->Cell(51, 1, '__________________', 0, 1);

            // $this->Cell(20, 5, 'Authorized Signature', 0, 0);
            // $this->Cell(118, 5, '', 0, 0);
            // $this->Cell(51, 5, 'Customer/POA Signature', 0, 1);

            // $this->Cell(8, 1, '', 0, 0);
            // $this->Cell(118, 5, 'Office Use', 0, 1);
            // $this->Ln(7);

            // $this->SetFont('helvetica', 'I', 10);
            // date_default_timezone_set("Asia/Kuala_Lumpur");
            // $today = date("F j, Y/ g:i A", time());

            // $this->Cell(25, 5, 'Generation Date/Time: '.$today, 0, 0, 'L');
            // $this->Cell(164, 5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        }
    }
} else {
    class PDF extends TCPDF
    {
        public function Header()
        {
            // require_once('admin/TCPDF-main/tcpdf.php');
            // include_once 'admin/database/connect.php';

            // $id = $_GET['khairat_id'];
            // $select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN tbl_product ON khairat_kematian.product_id = tbl_product.product_id WHERE khairat_id = $id");
            // $select->execute();
            // $row2 = $select->fetch(PDO::FETCH_OBJ);

            $bMargin = $this->getBreakMargin();
            // get current auto-page-break mode
            $auto_page_break = $this->AutoPageBreak;
            // disable auto-page-break
            $this->SetAutoPageBreak(false, 0);
            $this->SetAutoPageBreak($auto_page_break, $bMargin);
            // set the starting point for the page content
            $this->setPageMark();

            //ni code utk background
            // $img_file = K_PATH_IMAGES.'ekhairat.png';
            // $this->Image($img_file, 0, 0, 256, 298, '', '', '', false, 300, '', false, false, 0);

            //ni code utk logo
            $imageFile = K_PATH_IMAGES . 'ntah.png';
            $this->Image($imageFile, 14, 17, 80, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $this->Ln(5); //font size
            $this->SetFont('helvetica', 'B', 12);
            //189 is total width of A4 page, height, border, line
            $this->Ln(-3);
            $this->Cell(170, 5, 'PENYATA RASMI', 0, 1, 'R');
            // $pdf->Cell(59, 5, 'NO K/P       :   9808200205729', '', 0, 1);
            $this->SetFont('helvetica', '', 10);
            $this->Cell(178, 3, 'BAYARAN KHAIRAT KEMATIAN', 0, 1, 'R');
            // $this->Cell(189, 3, 'GUAR CHEMPEDAK', 0, 1, 'C');
            // $this->Cell(189, 3, '08800 ', 0, 1, 'C');
            // $this->Cell(189, 3, 'Phone : 04-4682321', 0, 1, 'C');
            // $this->Cell(189, 3, 'E-mail - alwusto.com.my', 0, 1, 'C');
            $this->Ln(4);
            $this->Cell(20, 1, '___________________________________________________________________________________________', 0, 0);
            // $this->SetFont('helvetica', 'B', 11);
            // $this->Ln(2);
            // $this->Cell(189, 3, 'BUY & SALE ORDER', 0, 1, 'C');

        }

        public function Footer()
        {

            // Position at 15 mm from bottom
            $this->SetY(-148);
            // Set font
            $this->SetFont('helvetica', 'B', 8);

            // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
            $this->Ln(120);
            // Page number
            $this->Cell(189, 5, 'TERIMA KASIH ATAS PEMBAYARAN', 0, 1, 'C');
            $this->Ln(3);
            $this->SetFont('helvetica', 'I', 7);
            $this->Cell(189, 5, 'CETAKAN KOMPUTER TIDAK MEMERLUKAN TANDATANGAN', 0, 1, 'C');
            $this->Ln(2);
            $this->Cell(20, 1, '___________________________________________________________________________________________________________________________________', 0, 0);
            $this->Ln(2);
            // $this->Cell(20, 1, '_______________', 0, 0);
            // $this->Cell(118, 1, '', 0, 0);
            // $this->Cell(51, 1, '_______________', 0, 1);
            // $this->Cell(20, 5, 'Authorized Signature', 0, 0);
            // $this->Cell(118, 5, '', 0, 0);
            // $this->Cell(51, 5, 'Customer/POA Signature', 0, 1);

            // $this->Cell(8, 1, '', 0, 0);
            // $this->Cell(118, 5, 'Office Use', 0, 1);
            // $this->Ln(5);
            // $this->Cell(100, 5, 'Transaction Instruction Form (PAY IN)', 0, 1, 'R');
            // $this->Cell(89, 5, '', 0, 1, 'C');

            // $this->Cell(100, 5, 'Please Transfer the above noted sold securities to the clearing', 0, 1, 'C');
            // $this->Cell(79, 5, '', 0, 1, 'C');

            // $this->Cell(110, 5, 'DSE CLEARING ___________________________', 0, 0);
            // $this->Cell(79, 5, 'EXCHANGE ID __________________', 0, 1, 'C');
            // $this->Ln(5);

            // $this->Cell(110, 5, 'DSE CLEARING ___________________________', 0, 0);
            // $this->Cell(79, 5, 'EXCHANGE ID __________________', 0, 1, 'C');
            // $this->Ln(4);

            // $this->SetFont('times', 'B', 10);
            // $this->Cell(189, 5, 'DECLARATION', 0, 1, 'L');

            // $this->SetFont('times', '', 10);
            // $html = '<p style="text-align:justify"> The rules & regulation of the Depository & CDBL participant pertaining to accounts which are in force </p>';
            // $this->writeHTML($html, true, false, true, false, '');

            // $this->Ln(8);
            // $this->SetFont('times', 'B', 10);
            // $this->Cell(20, 1, '______________________', 0, 0);
            // $this->Cell(118, 1, '', 0, 0);
            // $this->Cell(51, 1, '__________________', 0, 1);

            // $this->Cell(20, 5, 'Authorized Signature', 0, 0);
            // $this->Cell(118, 5, '', 0, 0);
            // $this->Cell(51, 5, 'Customer/POA Signature', 0, 1);

            // $this->Cell(8, 1, '', 0, 0);
            // $this->Cell(118, 5, 'Office Use', 0, 1);
            // $this->Ln(7);

            // $this->SetFont('helvetica', 'I', 10);
            // date_default_timezone_set("Asia/Kuala_Lumpur");
            // $today = date("F j, Y/ g:i A", time());

            // $this->Cell(25, 5, 'Generation Date/Time: '.$today, 0, 0, 'L');
            // $this->Cell(164, 5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        }
    }
}



// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
if ($row2->product_name == 'Yuran Pendaftaran') {
    $pdf->SetTitle('Penyata Yuran Pendaftaran');
} else {
    $pdf->SetTitle('Penyata Khairat Kematian');
}

$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('Helvetica', '', 10, '', true);

// Add a page
$pdf->AddPage();

$pdf->Ln(14);

$html = '

	<table>
	<tbody>
	<tr>
	<td>
	<strong>NAMA</strong> : <span style="text-transform:uppercase">' . $row->kariah_name . '</span><br/>
    <strong>ALAMAT</strong> : <br><span style="text-transform:uppercase">' . $row->alamat . '</span><br><span style="text-transform:uppercase">' . $row->alamat2 . '</span><br><span style="text-transform:uppercase">' . $row->poskod . '</span><br><span style="text-transform:uppercase">' . $row->bandar . '</span><br><span style="text-transform:uppercase">' . $row->negeri . '</span>
	</td>
	<td align="right">
	<strong>NO K/P</strong> : ' . $row->kariah_ic . ' <br/>
	<strong>TARIKH BAYAR</strong>: ' . date('d/m/Y', strtotime($row->tarikh_bayar)) . '
	</td>
	</tr>
	</tbody>
	</table>
    ___________________________________________________________________________________________
	';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(3);
// $pdf->SetFont('Helvetica', 'B', 10);
// $pdf->Cell(189, 5, $row2->tahun, 0, 1, 'C');
$html = '
<head>
<style>
h4 {text-align: center;}
</style>
</head>
';

if ($row2->product_name == 'Yuran Pendaftaran') {
    $html = '
   <style>
   h4 {text-align: center;}
   </style>
   <h4><strong>PENYATA RASMI BAYARAN YURAN PENDAFTARAN</strong></h4>
   ';
} else {
    $html = '
    <style>
    h4 {text-align: center;}
    </style>
    <h4><strong>PENYATA RASMI BAYARAN KHAIRAT KEMATIAN</strong></h4>
    ';
}
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(5);

$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 9, 'BIL', 1, 0, 'C', 1);
$pdf->Cell(50, 9, 'BAYARAN', 1, 0, 'C', 1);
$pdf->Cell(40, 9, 'NO RESIT', 1, 0, 'C', 1);
$pdf->Cell(40, 9, 'CARA PEMBAYARAN', 1, 0, 'C', 1);
$pdf->Cell(40, 9, 'AMAUN', 1, 0, 'C', 1);

function displayYuranName($produk, $pdo)
{
    include_once 'admin/database/connect.php';
    $string = [];
    $array = explode(",", $produk);

    $clause = implode(',', array_fill(0, count($array), '?'));
    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id IN ($clause)");
    $stmt->execute($array);
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        $string[] = $row['product_name'];
    }

    return implode(", ", $string);
}

$products = explode(',', displayYuranName($row->product_id, $pdo));
$totals =  explode(',', $row->jumlah);

foreach ($products as $key => $product) {
    $pdf->Ln(9);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(10, 9, $key + 1, 1, 0, 'C', 1);
    $pdf->Cell(50, 9, '' . $product . '', 1, 0, 'C', 1);
    $pdf->Cell(40, 9, $row->invoice_no, 1, 0, 'C', 1);
    $pdf->Cell(40, 9, $row->p_method, 1, 0, 'C', 1);
    $pdf->Cell(40, 9, 'RM ' .number_format($totals[$key], 2) . '', 1, 0, 'C', 1);
}


$pdf->Ln(9);

$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(140, 9, 'JUMLAH BAYARAN', 1, 0, 'C', 1);
$pdf->Cell(40, 9, 'RM ' . number_format($row->paid, 2) . '', 1, 0, 'C', 1);


if ($row->due > 0) {
    $pdf->Ln(9);

    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(140, 9, 'BAKI', 1, 0, 'C', 1);
    $pdf->Cell(40, 9, 'RM ' . number_format($row->due, 2) . '', 1, 0, 'C', 1);
}


// $pdf->SetFont('times', 'B', 10);
// $pdf->Cell(189, 3, 'Report as on :- Date', 0, 1, 'C');
// $pdf->Ln(5);

// $pdf->SetFont('times', 'B', 10);
// $pdf->Cell(130, 5, 'NAMA:Muhammad Syahril Ashraf bin Mohd Amer', '', 0, 1);

// $pdf->Cell(59, 5, 'NO K/P       :   9808200205729', '', 0, 1);
// $pdf->Ln(5);
// // $pdf->Cell(130, 5, 'NAMA:Muhammad Syahril Ashraf bin Mohd Amer', '', 0, 1);

// $pdf->Cell(130, 5, 'ALAMAT: NO 4', '', 0, 1);
// $pdf->Cell(59, 5, '                    LORONG PERMNAI UTAMA', '', 0, 1);
// // $pdf->Cell(189, 3, '                    TAMAN PERMAI UTAMA', 0, 1, 'L');
// // $pdf->Cell(189, 3, '                    08300 GURUN', 0, 1, 'L');
// // $pdf->Cell(189, 3, '                    KEDAH DARUL AMAN', 0, 1, 'L');

// $pdf->Cell(59, 5, 'TARIKH     :     20/07/2021', '', 0, 1);
// $pdf->Ln(5);


// $pdf->SetFont('dejavusans', '', 8);
// $pdf->Cell(80, 5, 'NAMA : Muhammad Syahril Ashraf bin Mohd Amer', 0, 0, '');

// $pdf->SetFont('dejavusans', '', 10);
// $pdf->Cell(112, 5, 'No penyata :' , 0, 1, 'C');

// $pdf->SetFont('dejavusans', '', 8);
// $pdf->Cell(80, 5, 'No Tel : 013-5077314', 0, 0, '');

// $pdf->SetFont('dejavusans', '', 10);
// $pdf->Cell(112, 5, 'Tarikh : ' , 0, 1, 'C');

// $pdf->SetFont('dejavusans', '', 8);
// $pdf->Cell(80, 5, 'E-mel : alwustha@gmail.com', 0, 1, '');
// $pdf->Cell(80, 5, 'Laman Web : www.alwustha.com', 0, 1, '');



// $pdf->Cell(189, 5, 'Mobile No:     0135077314', '', 0, 1);

// Close and output PDF document
if ($row2->product_name == 'Yuran Pendaftaran') {
    $pdf->Output('penyata_yuran_pendaftaran.pdf', 'I');
} else {
    $pdf->Output('penyata_khairat_kematian.pdf', 'I');
}
