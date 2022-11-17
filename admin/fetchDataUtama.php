<?php
$nilai = $_GET['nilai'];
// Database connection info
$dbDetails = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db'   => 'khairat'
);

// DB table to use
$table = 'khairat_kematian';
$table = <<<EOT
 (
    SELECT
        a.khairat_id,
        a.kariah_id,
        a.product_id,
        a.jumlah,
        a.quantity,
        a.tarikh_bayar,
        a.expired,
        a.total,
        a.paid,
        a.due,
        a.invoice_no,
        a.p_method,
        a.status_id,
        a.stat,
        b.kariah_name,
        b.kariah_ic,
        b.kawasan,
        b.approvement,
        c.product_name
    FROM khairat_kematian a
    INNER JOIN ahli_kariah b ON a.kariah_id = b.kariah_id
    INNER JOIN tbl_product c ON a.product_id = c.product_id
    WHERE status_id = 1 ORDER BY khairat_id DESC
 ) temp
EOT;

// Table's primary key
$primaryKey = 'khairat_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database.
// The `dt` parameter represents the DataTables column identifier.
$columns = array(
    array('db' => 'khairat_id', 'dt' => 0),
    array(
        'db'        => 'kariah_name',
        'dt'        => 1,
        'formatter' => function ($d, $row) {
            return strtoupper($d);
        }
    ),
    array(
        'db'        => 'tarikh_bayar',
        'dt'        => 2,
        'formatter' => function ($d, $row) {
            return date('d-m-Y', strtotime($d));
        }
    ),
    array(
        'db'        => 'paid',
        'dt'        => 3,
        'formatter' => function ($d, $row) {
            return number_format($d, 2);
        }
    ),
    // array('db' => 'country',    'dt' => 4),
    // array(
    //     'db'        => 'created',
    //     'dt'        => 5,
    //     'formatter' => function ($d, $row) {
    //         return date('jS M Y', strtotime($d));
    //     }
    // ),
    // array(
    //     'db'        => 'status',
    //     'dt'        => 6,
    //     'formatter' => function ($d, $row) {
    //         return ($d == 1) ? 'Active' : 'Inactive';
    //     }
    // ),

);

// Include SQL query processing class
require 'ssp.class.php';

// Output data as json format
echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns, null, "kariah_id = $nilai")
);
