<?php
include_once 'admin/database/connect.php';

$id = $_GET["id"]; //id ini dtgnya dari ajax dari createorder.php

$select=$pdo->prepare("SELECT * FROM tbl_product WHERE product_id = :pproduct_id"); 
//tutor kata u can place any name , so.. aku letak la pproduct_id
$select->bindParam(":pproduct_id" , $id); //then passing dari syntax SELECT ke sini
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$response=$row;
header('Content-Type: application/json'); //dia akan tukarkan kpd json data

echo json_encode($response);
?>