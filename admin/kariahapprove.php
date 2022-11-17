<?php
include_once 'database/connect.php';

if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

$id = $_POST['pidd'];

$sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar' WHERE kariah_id = $id ";

$delete=$pdo->prepare($sql);

if($delete->execute()) {

} else {
    echo 'Error';
}
?>