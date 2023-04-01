<?php
$nilai = $_GET['nilai'];
// Database connection info
$dbDetails = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db'   => 'khairat'
];

$pdo = new PDO("mysql:host=" . $dbDetails['host'] . ";dbname=" . $dbDetails['db'], $dbDetails['user'], $dbDetails['pass']);

function displayYuranName($products, $pdo)
{
    $string = [];
    $array = explode(",", $products);

    $clause = implode(',', array_fill(0, count($array), '?'));
    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id IN ($clause)");
    $stmt->execute($array);
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        $string[] = $row['product_name'];
    }

    return implode(", ", $string);
}



// DB table to use
$table = 'khairat_kematian';
$table = <<<EOT
 (
    SELECT
        a.khairat_id,
        a.kariah_id,
        a.product_id,
        a.product_name,
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
        c.tahun
    FROM khairat_kematian a
    INNER JOIN ahli_kariah b ON a.kariah_id = b.kariah_id
    INNER JOIN tbl_product c ON c.product_id = a.product_id
    WHERE status_id = 1 ORDER BY khairat_id DESC
 ) temp
EOT;

// Table's primary key
$primaryKey = 'khairat_id';

$columns = [
    ['db' => 'khairat_id', 'dt' => 0],
    [
        'db'        => 'kariah_name',
        'dt'        => 1,
        'formatter' => function ($d, $row) {
            return strtoupper($d);
        }
    ],
    [
        'db'        => 'product_id',
        'dt'        => 2,
        'formatter' => function ($d, $row) use ($pdo) {
            return displayYuranName($d, $pdo);
        },
    ],

    [
        'db'        => 'tarikh_bayar',
        'dt'        => 3,
        'formatter' => function ($d, $row) {
            return date('d-m-Y', strtotime($d));
        }
    ],
    [
        'db'        => 'total',
        'dt'        => 4,
        'formatter' => function ($d, $row) {
            return number_format($d, 2);
        }
    ],
    [
        'db'        => 'paid',
        'dt'        => 5,
        'formatter' => function ($d, $row) {
            return number_format($d, 2);
        }
    ],
    [
        'db'        => 'due',
        'dt'        => 6,
        'formatter' => function ($d, $row) {
            return number_format($d, 2);
        }
    ],
    ['db' => 'kariah_ic',     'dt' => 7],
    ['db' => 'kawasan',     'dt' => 8],
    [
        'db'        => 'expired',
        'dt'        => 9,
        'formatter' => function ($d, $row) {
            return date('d-m-Y', strtotime($d));
        }
    ],
    ['db' => 'p_method',     'dt' => 10],
    ['db' => 'invoice_no',     'dt' => 11],
    ['db' => 'approvement',     'dt' => 12],
];

// Include SQL query processing class
require 'ssp.class.php';

// Output data as json format
echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns, $pdo)
);
