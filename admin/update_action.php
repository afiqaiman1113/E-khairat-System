<?php

include_once 'database/connect.php';
// include_once 'header.php';
$product_name = trim($_POST['product_name']);
$jumlah = trim($_POST['jumlah']);
$tahun = trim($_POST['tahun']);
// $kategori = trim($_POST['kategori']);
$product_id = trim($_POST['product_id']);



	$queryInsert = $pdo->prepare("UPDATE tbl_product SET product_name=:product_name, jumlah=:jumlah, tahun=:tahun WHERE product_id=:product_id");
	$queryInsert->bindParam(":product_name", $product_name);
	$queryInsert->bindParam(":jumlah", $jumlah);
	$queryInsert->bindParam(":tahun", $tahun);
	// $queryInsert->bindParam(":kategori", $kategori);
	$queryInsert->bindParam(":product_id", $product_id);
	$queryInsert->execute();
	if ($queryInsert) {
		echo "Success";
	} else {
		echo "Failed!";
	}

