<?php
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

if (isset($_GET['khairat_id'])) {
    // include('config.php');
    include_once 'database/connect.php';
    $khairat_id = $_GET['khairat_id'];
    $select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE khairat_id = $khairat_id ");
    $select->execute();
    $select->bindParam(':kariah_name', $kariah_name);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    $kariah_name = $row['kariah_name'];
    $product_name = $row['product_name'];

    $query = $pdo->prepare("DELETE FROM khairat_kematian WHERE khairat_id=:khairat_id");
    $query->bindParam(":khairat_id", $_GET['khairat_id']);
    $query->execute();
    if ($query) {
        echo "Success";
        $activity = "Bayaran {$product_name} dari {$kariah_name} berjaya dihapuskan";
        $time_loged = date("Y-m-d H:i:s", strtotime("now"));
        $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
        $stmt->bindParam(1, $_SESSION['user_id']);
        $stmt->bindParam(2, $activity);
        $stmt->bindParam(3, $time_loged);
        $stmt->execute();
    } else {
        echo "Failed!";
    }
}
