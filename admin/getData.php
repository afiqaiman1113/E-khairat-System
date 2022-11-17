<?php
//$nilai = $_GET['nilai'];

$table = 'khairat_kematian';
$primaryKey = 'khairat_id';
$columns = array(
    array('db' => 'khairat_id', 'dt' => 0),
    array('db' => 'total', 'dt' => 1),
);


$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'khairat',
    'host' => 'localhost'
);



$table = <<<EOT
 (
    SELECT * FROM khairat_kematian WHERE status_id = 1 ORDER BY khairat_id DESC
 ) temp
EOT;




//require('ssp.php');

require('ssp.class.php');

// echo json_encode(
//     SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, null, )
// );

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    // SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns)

);
