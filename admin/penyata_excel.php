<?php

include_once 'database/db.php';

$filename = 'khairat_kematian_' . time() . '.csv';

$query = "SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE status_id = 1 ";


$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$records = mysqli_query($conn, "SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE tarikh_bayar >= '$date1' AND tarikh_bayar <= '$date2' and status_id = 1  ");


$result = mysqli_query($conn, $query);
$employee_arr = array();

$file = fopen($filename, "w");

$employee_arr = array("No Ahli", "Nama", "No K/P", "Kariah", "Tarikh Bayar", "Jumlah Kesemua", "Jumlah Dibayar", "Baki", "Jenis Bayaran", "Kaedah Bayaran");
fputcsv($file, $employee_arr);

while ($row = mysqli_fetch_assoc($records)) {
    $no_ahli = $row['no_ahli'];
    $kariah_name = $row['kariah_name'];
    $khairat_ic = $row['kariah_ic'];
    $kawasan = $row['kawasan'];
    $tarikh_bayar = $row['tarikh_bayar'];
    $total = $row['total'];
    $paid = $row['paid'];
    $due = $row['due'];
    $product_name = $row['product_id'];
    $p_method = $row['p_method'];

    $employee_arr = array($no_ahli, $kariah_name, $khairat_ic, $kawasan, $tarikh_bayar, $total, $paid, $due, $product_name, $p_method);
    fputcsv($file, $employee_arr);
}

fclose($file);

header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/csv; ");

readfile($filename);

// deleting file
unlink($filename);
exit();
