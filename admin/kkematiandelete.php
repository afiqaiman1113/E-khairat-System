<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

$id = $_POST['pidd'];
$select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE khairat_id = $id ");
$select->execute();
$select->bindParam(':kariah_name', $kariah_name);
$row = $select->fetch(PDO::FETCH_ASSOC);

$kariah_name = $row['kariah_name'];
$product_name = $row['product_name'];

//delete guna kaedah inner join
// $sql = "DELETE khairat_kematian, cubaan FROM khairat_kematian INNER JOIN cubaan ON
// khairat_kematian.khairat_id = cubaan.khairat_id WHERE khairat_kematian.khairat_id = $id ";
// $delete=$pdo->prepare($sql);

$sql = "DELETE khairat_kematian FROM khairat_kematian WHERE khairat_kematian.khairat_id = $id ";
$delete=$pdo->prepare($sql);

$sql3 = "UPDATE ahli_kariah set ahli_kariah.approvement = 'Belum Daftar' FROM ahli_kariah INNER JOIN khairat_kematian ON ahli_kariah.kariah_id = khairat_kematian.kariah_id WHERE khairat_kematian.khairat_id = $id";
// $sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar' WHERE kariah_id = $id ";
//             $update = $pdo->prepare($sql);
//             $update->execute();

//             $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tuntut ON ahli_kariah.kariah_id = tuntut.kariah_id WHERE mati = 'Mati' ");


// $sql = "DELETE FROM tbl_product WHERE product_id = $id";

if ($delete->execute()) {

} else {
    echo 'Error';
}
$activity = "Bayaran {$product_name} dari {$kariah_name} berjaya dihapuskan";
$time_loged = date("Y-m-d H:i:s", strtotime("now"));
$stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
$stmt->bindParam(1, $_SESSION['user_id']);
$stmt->bindParam(2, $activity);
$stmt->bindParam(3, $time_loged);
$stmt->execute();
?>
