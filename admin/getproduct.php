<?php
include_once 'database/connect.php';

$id = $_GET["id"];
$ids =implode(',',$id);


$select=$pdo->prepare("SELECT sum(jumlah) AS jumlah FROM tbl_product WHERE product_id IN (".$ids.")");
//tutor kata u can place any name , so.. aku letak la pproduct_id
//$select->bindParam(":pproduct_id" , $id); //then passing dari syntax SELECT ke sini
//part ni ko try cri cara mcm mna nk bind,aku dh lupa lama x guna PDO

$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$response=$row;

$data=[
    'product_id' => $id,
    'jumlah'=> $response['jumlah'],
];
header('Content-Type: application/json'); //dia akan tukarkan kpd json data

echo json_encode($data);
