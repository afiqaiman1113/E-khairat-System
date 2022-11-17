<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'm_item_t';

// Table's primary key
$primaryKey = 'item_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'item_id', 'dt' => 0),
    array('db' => 'image',     'dt' => 1),
    array('db' => 'code', 'dt' => 2),
    array('db' => 'sku',  'dt' => 3),
    array('db' => 'nama',   'dt' => 4),

    array(
        'db'        => 'harga_beli', 'dt' => 5,
        'formatter' => function ($d, $row) {
            return 'Rp. ' . number_format($d);
        }
    ),
    array(
        'db'        => 'harga_jual', 'dt' => 6,
        'formatter' => function ($d, $row) {
            return 'Rp. ' . number_format($d);
        }
    ),
    array('db' => 'status_id',     'dt' => 7),
    array('db' => 'harga_beli',     'dt' => 8),
    array('db' => 'harga_jual',     'dt' => 9),

);

// SQL server connection information

include 'config.php';

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require('plugins/ssp.class.php');

echo json_encode(
    SSP::simple($_GET, $config, $table, $primaryKey, $columns)
);
