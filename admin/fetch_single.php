<?php
include_once 'database/connect.php';
include('function.php');
if (isset($_POST["product_id"])) {
    $output = array();
    $statement = $connection->prepare(
        "SELECT * FROM tbl_product WHERE product_id = '" . $_POST["product_id"] . "' LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output["product_id"] = $row["product_id"];
        $output["product_name"] = $row["product_name"];
        $output["jumlah"] = $row["jumlah"];
        $output["tahun"] = $row["tahun"];
    }
    echo json_encode($output);
}