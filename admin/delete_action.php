<?php
if (isset($_GET['product_id'])) {
	// include('config.php');
	include_once 'database/connect.php';
	$product_id = $_GET['product_id'];
	$query = $pdo->prepare("DELETE FROM tbl_product WHERE product_id=:product_id");
	$query->bindParam(":product_id", $_GET['product_id']);
	$query->execute();
	if ($query) {
		echo "Success";
	} else {
		echo "Failed!";
	}
}
