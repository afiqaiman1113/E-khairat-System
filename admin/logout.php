<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

$activity = "Log keluar berjaya";
$time_loged = date("Y-m-d H:i:s", strtotime("now"));
$stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
$stmt->bindParam(1, $_SESSION['user_id']);
$stmt->bindParam(2, $activity);
$stmt->bindParam(3, $time_loged);
$stmt->execute();


session_destroy();

header('Location: index.php');
?>