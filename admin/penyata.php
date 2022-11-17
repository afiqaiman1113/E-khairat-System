<?php

use PhpOffice\PhpSpreadsheet\Cell\Cell;

require_once('TCPDF-main/tcpdf.php');
include_once 'database/connect.php';

if (isset($_GET['date1']) && isset($_GET['date2'])) {

    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];

    //remove default header and footer
    $pdf = new TCPDF('P', 'mm', 'A4');


    $select = $pdo->prepare("SELECT sum(paid) as paid FROM khairat_kematian WHERE tarikh_bayar >= '$date1' AND tarikh_bayar <= '$date2' and status_id = 1 ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
    $net_total = $row->paid;


    //remove default header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    //add page
    $pdf->AddPage();

    //add content (using cell)
    $pdf->SetFont('Helvetica', '', 14);
    $pdf->Cell(190, 10, "University of Kuala Lumpur", 0, 1, 'C');

    $pdf->SetFont('Helvetica', '', 8);
    $pdf->Cell(190, 5, "Student List", 0, 1, 'C');

    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(30, 5, "Class", 0);
    $pdf->Cell(160, 5, ":Programming 101", 0);
    $pdf->Ln();
    $pdf->Cell(30, 5, "Teacher Name", 0);
    $pdf->Cell(160, 5, ":Sir Hadi", 0);
    $pdf->Ln();
    $pdf->Ln(2);

    //make the table
    $html = "
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No K/P</th>
        <th>Kariah</th>
        <th>Tarikh Bayar</th>
        <th>Jumlah</th>
        <th>Bayar</th>
        <th>Baki</th>
    </tr>

    ";

    $i = 1;
    //load the json data
    $select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE tarikh_bayar >= '$date1' AND tarikh_bayar <= '$date2' and status_id = 1  ");
    $select->execute();
    //loop the data
    while ($row = $select->fetch(PDO::FETCH_OBJ)) {
        $html .= "
			<tr>
                <td>" . $i . "</td>
				<td>" . strtoupper($row->kariah_name) . "</td>
				<td>" . $row->kariah_ic . "</td>
				<td>" . $row->kawasan . "</td>
				<td>" . date('d-m-Y', strtotime($row->tarikh_bayar)) . "</td>
				<td>" . $row->total . "</td>
                <td>" . $row->paid . "</td>
                <td>" . $row->due . "</td>


			</tr>
			";
        $i++;
    }




    $html .= "

    <tfoot>
        <tr>
            <th>Jumlah</th>
            <th id=''></th>
            <th id=''></th>
            <th id=''></th>
            <th id=''></th>
            <th id=''></th>
            <th id=''>" . $net_total . "</th>
            <th></th>
        </tr>
   </tfoot>
</table>
<style>
table {
    border-collapse:collapse;
}
th, td {
    border:1px solid #888;
}
table tr th {
    background-color:#888;
    color:#fff;
}
</style>
";

    //writehtml cell
    $pdf->writeHTMLCell(192, 0, 9, '', $html, 0);


    //output
    $pdf->Output();
} else {
    //remove default header and footer
    $pdf = new TCPDF('P', 'mm', 'A4');


    //remove default header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    //add page
    $pdf->AddPage();

    //add content (using cell)
    $pdf->SetFont('Helvetica', '', 14);
    $pdf->Cell(190, 10, "University of Kuala Lumpur", 0, 1, 'C');

    $pdf->SetFont('Helvetica', '', 8);
    $pdf->Cell(190, 5, "Student List", 0, 1, 'C');

    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(30, 5, "Class", 0);
    $pdf->Cell(160, 5, ":Programming 101", 0);
    $pdf->Ln();
    $pdf->Cell(30, 5, "Teacher Name", 0);
    $pdf->Cell(160, 5, ":Sir Hadi", 0);
    $pdf->Ln();
    $pdf->Ln(2);

    //make the table
    $html = "
<table style='width:100%'>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No K/P</th>
        <th>Kariah</th>
        <th>Tarikh Bayar</th>
        <th>Jumlah</th>
        <th>Bayar</th>
        <th>Baki</th>
    </tr>
    ";


    $select = $pdo->prepare("SELECT sum(paid) as paid, count(kariah_id) as kariah_id FROM khairat_kematian WHERE status_id = 1");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
    $net_total = $row->paid;

    $i = 1;
    //load the json data
    $select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE status_id = 1  ");
    $select->execute();
    //loop the data
    while ($row = $select->fetch(PDO::FETCH_OBJ)) {
        $html .= "
			<tr>
                <td>" . $i . "</td>
				<td>" . strtoupper($row->kariah_name) . "</td>
				<td>" . $row->kariah_ic . "</td>
				<td>" . $row->kawasan . "</td>
				<td>" . date('d-m-Y', strtotime($row->tarikh_bayar)) . "</td>
				<td>" . $row->total . "</td>
                <td>" . $row->paid . "</td>
                <td>" . $row->due . "</td>
			</tr>
			";
        $i++;
    }

    $html .= "
    <tfoot>
        <tr>
            <th colspan='3'>Jumlah</th>
            <th id=''></th>
            <th id=''></th>
            <th id=''></th>
            <th id=''></th>
            <th id=''></th>
            <th id=''>" . $net_total . "</th>
            <th></th>
        </tr>
   </tfoot>
</table>
<style>
table {
    border-collapse:collapse;
}
th, td {
    border:1px solid #888;
}
table tr th {
    background-color:#888;
    color:#fff;
}
</style>
";

    //writehtml cell
    $pdf->writeHTMLCell(192, 0, 9, '', $html, 0);


    //output
    $pdf->Output();
}
