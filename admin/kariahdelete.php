<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

$id = $_POST['pidd'];
//$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();
$select->bindParam(':kariah_name', $kariah_name);
$row = $select->fetch(PDO::FETCH_ASSOC);

$no_ahli = $row['no_ahli'];
$kariah_name = $row['kariah_name'];

//delete guna kaedah inner join
$sql = "DELETE ahli_kariah, tbl_tanggung, penama FROM ahli_kariah INNER JOIN tbl_tanggung ON
ahli_kariah.kariah_id = tbl_tanggung.kariah_id JOIN penama ON penama.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = $id ";
$delete=$pdo->prepare($sql);

$sql2 = "DELETE ahli_kariah, penama FROM ahli_kariah INNER JOIN penama ON penama.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = $id ";
$delete2=$pdo->prepare($sql2);

$sql3 = "DELETE ahli_kariah FROM ahli_kariah WHERE ahli_kariah.kariah_id = $id ";
$delete3=$pdo->prepare($sql3);

if ($delete->execute() && $delete2->execute() && $delete3->execute()) {

} else {
    echo 'Error';
}

$activity = "ahli " .strtoupper($kariah_name). " berjaya dihapuskan";
$time_loged = date("Y-m-d H:i:s", strtotime("now"));
$stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
$stmt->bindParam(1, $_SESSION['user_id']);
$stmt->bindParam(2, $activity);
$stmt->bindParam(3, $time_loged);
$stmt->execute();
