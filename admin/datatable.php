<?php
// include_once 'database/connect.php';
$table = 'tbl_product';
// $table = <<<EOT
//  (
//     SELECT * FROM tbl_product ORDER BY product_id DESC
//  ) temp
// EOT;
$primaryKey = 'product_id';
$columns = array(
    array('db' => 'product_id', 'dt' => 0),
    array('db' => 'product_name', 'dt' => 1),
    array('db' => 'jumlah', 'dt' => 2),
    array('db' => 'tahun', 'dt' => 3),
    // array(
    //     'db' => 'stat',
    //     'dt' => 4,
    //     'formatter' => function($d, $row) {
    //         return ($d == 1)?'Yuran 1':'Yuran 2';
    //     }
    // ),
    array('db' => 'product_id', 'dt' => 4),
    // array('db' => 'id', 'dt' => 5),
);

$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'khairat',
    'host' => 'localhost'
);
require('ssp.class.php');
echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
