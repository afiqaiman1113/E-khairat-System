<?php
include_once 'database/connect.php';

$id = $_GET['kariah_id'];

$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$tel_hp = $row['tel_hp'];
$phone = '+60' . substr($tel_hp, 1);

$form_data = [
    '_token' => 't3CxcVmx0hw2gGfLQOOANunJQ30hCFzE',
    'phone' => $phone,
    'message' => 'Renew Plz',
    'callback_url' => 'https://myserver.com.my/callback_receive'
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_URL, 'https://terminal.adasms.com/api/v1/send');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);
$result = curl_exec($curl);
$obj = json_decode($result);

$update_kariah = $pdo->prepare("UPDATE ahli_kariah SET status_sms=1 WHERE kariah_id = $id");
$update_kariah->execute();

header('Location: ahli-kariah.php');
