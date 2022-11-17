<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
// if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
//     header('Location: index.php');
// }

include_once 'header.php';

if (isset($_POST['add'])) {
    $product_name = $_POST['product_name'];
    $jumlah = $_POST['jumlah'];
    $tahun = $_POST['tahun'];
    $stat = $_POST['stat'];


    if ($product_name == 'Yuran Pendaftaran') {
        $insert = $pdo->prepare("INSERT INTO tbl_product(product_name, jumlah, tahun, stat)
        VALUES(:product_name,:jumlah,:tahun, 0)");

        $insert->bindParam(':product_name', $product_name);
        $insert->bindParam(':jumlah', $jumlah);
        $insert->bindParam(':tahun', $tahun);
        // $insert->bindParam(0, $stat);

        if ($insert->execute()) {
            echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                        title: "Berjaya Simpan",
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
                        title: "Gagal Simpan",
                        icon: "error",
                        button: "Ok",
                        }).then(function() {
                            window.location = "senarai-yuran.php";
                            });
                        });
                     </script>';
        }
        $activity = "{$product_name} berjaya ditambahkan";
        $time_loged = date("Y-m-d H:i:s", strtotime("now"));
        $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
        $stmt->bindParam(1, $_SESSION['user_id']);
        $stmt->bindParam(2, $activity);
        $stmt->bindParam(3, $time_loged);
        $stmt->execute();
    } else {
        $insert = $pdo->prepare("INSERT INTO tbl_product(product_name, jumlah, tahun, stat)
        VALUES(:product_name,:jumlah,:tahun, 1)");

        $insert->bindParam(':product_name', $product_name);
        $insert->bindParam(':jumlah', $jumlah);
        $insert->bindParam(':tahun', $tahun);
        // $insert->bindParam(':1', $stat);

        if ($insert->execute()) {
            echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                        title: "Berjaya Simpan",
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
                        title: "Gagal Simpan",
                        icon: "error",
                        button: "Ok",
                        });
                    });
                </script>';
        }
        $activity = "{$product_name} berjaya ditambahkan";
        $time_loged = date("Y-m-d H:i:s", strtotime("now"));
        $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
        $stmt->bindParam(1, $_SESSION['user_id']);
        $stmt->bindParam(2, $activity);
        $stmt->bindParam(3, $time_loged);
        $stmt->execute();
    }
}
