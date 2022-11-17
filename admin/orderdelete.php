<?php
include_once 'database/connect.php';

if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

$id = $_POST['pidd'];

//delete guna kaedah inner join
$sql = "DELETE tbl_invoice,  tbl_invoice_details FROM tbl_invoice INNER JOIN tbl_invoice_details ON 
tbl_invoice.invoice_id = tbl_invoice_details.invoice_id WHERE tbl_invoice.invoice_id = $id ";



// $sql = "DELETE FROM tbl_product WHERE product_id = $id";
$delete=$pdo->prepare($sql);

if($delete->execute()) {

} else {
    echo 'Error';
}
?>