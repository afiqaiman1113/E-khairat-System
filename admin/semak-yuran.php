<?php
include_once 'database/connect.php';
session_start();

if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

$id = $_GET['product_id'];

$select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC); //aku rasa dia mcm fetch data la, cuma ini cara PDO

$id_db = $row['product_id'];
$product_name = $row['product_name'];
$jumlah = $row['jumlah'];
$tahun = $row['tahun'];

if (isset($_POST['btn_update_product'])) {

    $product_name = $_POST['product_name'];
    $jumlah = $_POST['jumlah'];
    $tahun = $_POST['tahun'];

    $update = $pdo->prepare("UPDATE tbl_product SET product_name=:product_name, jumlah=:jumlah, tahun=:tahun WHERE product_id = $id");

    $update->bindParam(':product_name', $product_name);
    $update->bindParam(':jumlah', $jumlah);
    $update->bindParam(':tahun', $tahun);

    if ($update->execute()) {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                    title: "Kemaskini Berjaya",
                    icon: "success",
                    button: "Ok",
                    }).then(function() {
                        window.location = "senarai-yuran.php";
                        });
                    });
                </script>';
    } else {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                    title: "Kemaskini Gagal",
                    icon: "error",
                    button: "Ok",
                    });
                    });
            </script>';
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Yuran Tahunan</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Yuran Tahunan</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="formproduct" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <a href="senarai-yuran.php" class="btn btn-primary" role="button"> Senarai Yuran</a><br><br>
                                            <label for="exampleInputUsername">Nama Yuran</label>
                                            <input type="text" name="product_name" value="<?php echo $product_name; ?>" class="form-control" placeholder="" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername">Jumlah (RM)</label>
                                            <input type="number" min="1" step="1" name="jumlah" value="<?php echo $jumlah; ?>" class="form-control" placeholder="" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername">Tahun</label>
                                            <input type="text" name="tahun" value="<?php echo $tahun; ?>" class="form-control" placeholder="" required />
                                        </div>
                                        <button type="submit" class="btn btn-warning" name="btn_update_product">Kemaskini</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include_once 'footer.php';
?>