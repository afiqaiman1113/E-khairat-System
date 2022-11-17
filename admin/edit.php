<?php
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
include_once 'database/connect.php';

include_once 'header.php';

if (isset($_POST['edit'])) {

    $id = $_GET['product_id'];
    $product_name = $_POST['product_name'];
    $jumlah = $_POST['jumlah'];
    $tahun = $_POST['tahun'];

    $update = $pdo->prepare("UPDATE tbl_product SET product_name=:product_name, jumlah=:jumlah, tahun=:tahun WHERE product_id = $id");

    $update->bindParam(':product_name', $product_name);
    $update->bindParam(':jumlah', $jumlah);
    $update->bindParam(':tahun', $tahun);

    if ($update->execute()) {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                    title: "Kemaskini Berjaya",
                    icon: "success",
                    button: "Ok",
                    }).then(function() {
                        window.location = "senarai-yuran.php";
                        });
                    });
                </script>';
    } else {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                    title: "Kemaskini Gagal",
                    icon: "error",
                    button: "Ok",
                    }).then(function() {
                        window.location = "senarai-yuran.php";
                        });
                    });
            </script>';
    }
    $activity = "{$product_name} berjaya dikemaskini";
    $time_loged = date("Y-m-d H:i:s", strtotime("now"));
    $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
    $stmt->bindParam(1, $_SESSION['user_id']);
    $stmt->bindParam(2, $activity);
    $stmt->bindParam(3, $time_loged);
    $stmt->execute();
}
