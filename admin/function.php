<?php
function get_total_all_records()
{
    include_once 'database/connect.php';
    $statement = $connection->prepare("SELECT * FROM tbl_product");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}
