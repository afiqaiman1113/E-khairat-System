<?php
include_once 'database/connect.php';

$id = $_GET['kariah_id'];

$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$update_kariah = $pdo->prepare("UPDATE ahli_kariah SET mati = 'Telah Pindah' WHERE kariah_id = $id");
$update_kariah->execute();

header('Location: ahli-kariah.php');
?>