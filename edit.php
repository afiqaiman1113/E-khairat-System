<?php
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
include_once 'admin/database/connect.php';

include_once 'header-test.php';

if (isset($_POST['edit'])) {

    $id = $_GET['penama_id'];
    $penama_name = $_POST['penama_name'];
    // $penama_ic = $_POST['penama_ic'];
    $penama_no = $_POST['penama_no'];
    $penama_email = $_POST['penama_email'];
    // $penama_pass = substr($_POST['penama_ic'], 0, 6);
    // $penama_pass = password_hash($penama_pass, PASSWORD_BCRYPT, array("cost" => 12));

    $update = $pdo->prepare("UPDATE penama SET penama_name=:penama_name, penama_no=:penama_no, penama_email=:penama_email WHERE penama_id = $id");

    $update->bindParam(':penama_name', $penama_name);
    // $update->bindParam(':penama_ic', $penama_ic);
    $update->bindParam(':penama_no', $penama_no);
    $update->bindParam(':penama_email', $penama_email);
    // $update->bindParam(':penama_pass', $penama_pass);

    if ($update->execute()) {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                    title: "Kemaskini Berjaya",
                    icon: "success",
                    button: "Ok",
                    }).then(function() {
                        window.location = "user.php?p=senarai-penama";
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
                        window.location = "user.php?p=senarai-penama";
                        });
                    });
            </script>';
    }
    // $activity = "{$product_name} berjaya dikemaskini";
    // $time_loged = date("Y-m-d H:i:s", strtotime("now"));
    // $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
    // $stmt->bindParam(1, $_SESSION['user_id']);
    // $stmt->bindParam(2, $activity);
    // $stmt->bindParam(3, $time_loged);
    // $stmt->execute();
}
