<?php
include_once 'database/connect.php';
// session_start();
// if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
//     header('Location: index.php');
// }
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM tbl_product ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE product_name LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR tahun LIKE "%' . $_POST["search"]["value"] . '%" ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id ASC ';
}

if ($_POST["length"] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {
    $sub_array = array();

    $sub_array[] = $row["product_id"];
    $sub_array[] = $row["product_name"];
    $sub_array[] = $row["jumlah"];
    $sub_array[] = $row["tahun"];
    $sub_array[] = '<button type="button" name="update" product_id="' . $row["product_id"] . '" class="btn btn-primary btn-sm update"><i class="glyphicon glyphicon-pencil"> </i>Edit</button></button>';
    $sub_array[] = '<button type="button" name="delete" product_id="' . $row["product_id"] . '" class="btn btn-danger btn-sm delete"><i class="glyphicon glyphicon-remove">  Delete</button>';
    $data[] = $sub_array;
}
$output = array(
    "draw"              =>   intval($_POST["draw"]),
    "recordsTotal"      =>   $filtered_rows,
    "recordsFiltered"   =>   get_total_all_records(),
    "data"              =>   $data
);
echo json_encode($output);
