<?php
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

if (isset($_GET['kariah_id'])) {
    // include('config.php');
    include_once 'database/connect.php';
    $kariah_id = $_GET['kariah_id'];
    try {
        $pdo->beginTransaction();
        $sql = "DELETE ahli_kariah, tbl_tanggung FROM ahli_kariah INNER JOIN tbl_tanggung ON
        ahli_kariah.kariah_id = tbl_tanggung.kariah_id WHERE ahli_kariah.kariah_id = $kariah_id ";
        $delete = $pdo->prepare($sql);
        $delete->execute();

        $sql2 = "DELETE ahli_kariah FROM ahli_kariah WHERE ahli_kariah.kariah_id = $kariah_id ";
        $delete2 = $pdo->prepare($sql2);
        $delete2->execute();

        $pdo->commit();
        echo 'Success';
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo 'Error';
    }
}
