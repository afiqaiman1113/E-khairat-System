<?php
include_once 'database/connect.php';

$select = $pdo->prepare("SELECT sum(jumlah) as jumlah, count(tid_tanggung) as tid_tanggung FROM tuntut_tanggungan");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);
$tuntut_jumlah_tanggung = $row->jumlah;

//
$select = $pdo->prepare("SELECT sum(jumlah) as jumlah, count(kariah_id) as kariah_id FROM tuntut");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);
$total_jumlah = $row->jumlah; //based on berapa jumlah id
$total_semua = ($total_jumlah + $tuntut_jumlah_tanggung);
echo json_encode(
    number_format($total_semua, 2)
);

// //
// $select = $pdo->prepare("SELECT sum(paid) as paid, count(kariah_id) as kariah_id FROM khairat_kematian WHERE status_id = 1");
// $select->execute();
// $row = $select->fetch(PDO::FETCH_OBJ);
// $net_total = $row->paid;
// $net_total = $net_total - $total_semua;
// echo json_encode(
//     (number_format($net_total, 2))
// );

// //total ahli kariah
// $select = $pdo->prepare("SELECT count(kariah_id) as kariah_id FROM ahli_kariah");
// $select->execute();
// $row = $select->fetch(PDO::FETCH_OBJ);
// $total_ahli = $row->kariah_id;
// echo json_encode(
//     $total_ahli
// );

// //total mati
// $select = $pdo->prepare("SELECT count(tuntut_name) as tuntut_name FROM tuntut");
// $select->execute();
// $row = $select->fetch(PDO::FETCH_OBJ);
// $total_tuntut = $row->tuntut_name;

// $select = $pdo->prepare("SELECT count(nama) as nama FROM tuntut_tanggungan");
// $select->execute();
// $row = $select->fetch(PDO::FETCH_OBJ);
// $total_tuntut_tanggung = $row->nama;
// $total_mati = $total_tuntut + $total_tuntut_tanggung;
// echo json_encode(
//     $total_mati
// );


?>