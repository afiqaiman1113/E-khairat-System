<?php
include_once 'database/connect.php';
$id = $_GET["id"];

$select=$pdo->prepare("SELECT * FROM tbl_tanggung WHERE id = :tanggung_id");
//$select = $pdo->prepare("SELECT tbl_tanggung.* FROM tbl_tanggung LEFT JOIN ahli_kariah ON tbl_tanggung.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = :kariah_id ");
$select->bindParam(':tanggung_id',$id);
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);


$respone=$row;

header('Content-Type: application/json');

echo json_encode($respone);