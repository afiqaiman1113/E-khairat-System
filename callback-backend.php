<?php
include_once 'admin/database/connect.php';

include_once 'header-test.php';

if (isset($_POST['status'])) {

    $status = $_POST['status'];
    $order_id = $_POST['order_id'];

    $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id  = $order_id");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    $khairat_id = $row['khairat_id'];
    $kariah_id = $row['kariah_id'];
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $jumlah = $row['jumlah'];
    $quantity = $row['quantity'];
    $expired = $row['expired'];
    $tarikh_bayar = date('d-m-Y', strtotime($row['tarikh_bayar']));
    $total = $row['total'];
    $paid = $row['paid'];
    $due = $row['due'];

    $update_kariah = $pdo->prepare("UPDATE khairat_kematian SET status_id=:status_id WHERE khairat_id = $order_id");
    $update_kariah->bindParam(':status_id', $status);
    $update_kariah->execute();

  
}
?>