<?php
include_once 'database/connect.php';

$id = $_GET['tuntut_id'];

$select = $pdo->prepare("SELECT * FROM tuntut INNER JOIN penama ON tuntut.penama_id = penama.penama_id WHERE tuntut.tuntut_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$penama_no = $row['penama_no'];
$tuntut_name = $row['tuntut_name'];


$select2 = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tuntut ON ahli_kariah.kariah_id = tuntut.kariah_id WHERE tuntut_id = $id");
$select2->execute();
$row2 = $select2->fetch(PDO::FETCH_ASSOC);
$kariah_id = $row2['kariah_id'];

$form_data = [
    'token_uid' => "746210583",
    'token_key' => "utwe2qsd5r7acgvx8ozi",
    'receipients' => $penama_no,
    'message' => "Waris refunded"
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_URL, 'https://sms.ala.my/api/v1/send');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);
$result = curl_exec($curl);
$obj = json_decode($result);

$update_kariah = $pdo->prepare("UPDATE tuntut SET status_tuntut = 'Berjaya' WHERE tuntut_id = $id");
$update_kariah->execute();

$update = $pdo->prepare("UPDATE ahli_kariah SET mati = 'Mati', status_sms = 2 WHERE kariah_id = $kariah_id");
$update->execute();

header('Location: tuntutan-kematian.php');
