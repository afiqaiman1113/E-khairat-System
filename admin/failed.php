<?php
include_once 'database/connect.php';

$id = $_GET['tuntut_id'];

$select = $pdo->prepare("SELECT * FROM tuntut INNER JOIN penama ON tuntut.penama_id = penama.penama_id WHERE tuntut.tuntut_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$penama_no = $row['penama_no'];
$tuntut_name = $row['tuntut_name'];

$form_data = [
    'token_uid' => "746210583",
    'token_key' => "utwe2qsd5r7acgvx8ozi",
    'receipients' => $penama_no,
    'message' => "Waris failed"
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_URL, 'https://sms.ala.my/api/v1/send');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);
$result = curl_exec($curl);
$obj = json_decode($result);

$update_kariah = $pdo->prepare("UPDATE tuntut SET status_tuntut = 'Gagal' WHERE tuntut_id = $id");
$update_kariah->execute();

header('Location: tuntutan-kematian.php');
