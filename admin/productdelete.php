<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');

if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

$id = $_POST['pidd'];

$select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = $id");
$select->execute();
$select->bindParam(':product_name', $product_name);
$row = $select->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'];

$sql = "DELETE FROM tbl_product WHERE product_id = $id";
$delete=$pdo->prepare($sql);

if($delete->execute()) {

} else {
    echo 'Error';
}

$activity = "{$product_name} berjaya dihapuskan";
$time_loged = date("Y-m-d H:i:s", strtotime("now"));
$stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
$stmt->bindParam(1, $_SESSION['user_id']);
$stmt->bindParam(2, $activity);
$stmt->bindParam(3, $time_loged);
$stmt->execute();
?>