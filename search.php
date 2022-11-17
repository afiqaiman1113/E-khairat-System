<?php
include_once 'admin/database/connect.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Search Bar using PHP</title>
</head>

<body>
	<form method="post">
		<label>Search</label>
		<input type="text" name="search">
		<input type="submit" name="submit">

	</form>
</body>

</html>
<?php


if (isset($_POST["submit"])) {
	$str = $_POST["search"];
	$sth = $pdo->prepare("SELECT * FROM `ahli_kariah` WHERE kariah_ic = '$str'");

	$sth->setFetchMode(PDO::FETCH_OBJ);
	$sth->execute();

	if ($row = $sth->fetch()) {
?>
		<br><br><br>
		<table>
			<tr>

				<th>Name</th>
				<th>No Kad Pengenalan</th>
			</tr>
			<tr>
				<td><?php echo $row->kariah_name; ?></td>
				<td><?php echo $row->kariah_ic; ?></td>
			</tr>

		</table>
<?php
	} else {
		echo "Name Does not exist";
	}
}

?>