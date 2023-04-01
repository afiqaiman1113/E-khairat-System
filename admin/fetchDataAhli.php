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
$table = 'ahli_kariah';
$table = <<<EOT
 (
    SELECT *
    FROM $table
    ORDER BY kariah_id DESC
 ) temp
EOT;

// Table's primary key
$primaryKey = 'kariah_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database.
// The `dt` parameter represents the DataTables column identifier.
$columns = array(
    array('db' => 'kariah_id', 'dt' => 0),
    array('db' => 'no_ahli', 'dt' => 1),
    array(
        'db'        => 'kariah_name',
        'dt'        => 2,
        'formatter' => function ($d, $row) {
            return strtoupper($d);
        }
    ),

    array('db' => 'kawasan', 'dt' => 3),
    array(
        'db'        => 'tarikh_daftar',
        'dt'        => 4,
        'formatter' => function ($d, $row) {
            return date('d-m-Y', strtotime($d));
        }
    ),
    array(
        'db'        => 'approvement',
        'dt'        => 5,
        'formatter' => function ($d, $row) {
            if ($d == 'Telah Daftar') {
                return '<span class="badge bg-success">' . $d . '</span>';
            } elseif ($d == 'Digantung') {
                return '<span class="badge bg-warning">' . $d . '</span>';
            } else {
                return '<span class="badge bg-info">' . $d . '</span>';
            }
        }
    ),
    array(
        'db'        => 'tarikh_expired',
        'dt'        => 6,
        'formatter' => function ($d, $row) {
            if (strtotime(date("d-m-Y")) <= strtotime($d)) {
                return '<span class="badge bg-success">Aktif</span>';
            } elseif ($d == NULL) {
                return '<span class="badge bg-danger">Tamat Tempoh</span>';
            } else {
                return '<span class="badge bg-danger">Tamat Tempoh</span>';
            }
        }
    ),
    array(
        'db'        => 'mati',
        'dt'        => 7,
        'formatter' => function ($d, $row) {
            if ($d == 'Mati') {
                return '<span class="badge bg-danger">Meninggal</span>';
            } elseif ($d == 'Hidup') {
                return '<span class="badge bg-success">Hidup</span>';
            } else {
                return '<span class="badge bg-warning">Telah Pindah</span>';
            }
        }
    ),
    array(
        'db' => 'status_sms',
        'dt' => 8,
        'formatter' => function ($d, $row) {
            if ($d == 0) {
                return '<span class="badge bg-danger">Belum Hantar</span>';
            } elseif ($d == 2) {
                return '<span class="badge bg-warning">Tiada</span>';
            } else {
                return '<span class="badge bg-success">Selesai Hantar</span>';
            }
        }
    )

);

// Include SQL query processing class
require 'ssp.class.php';

// Output data as json format
echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns, null, "kariah_id = $nilai")
);
