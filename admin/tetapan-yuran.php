<?php
include_once 'database/connect.php';
session_start();

if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

if (isset($_POST['btn_add_product'])) {
    $product_name = $_POST['product_name'];
    $jumlah = $_POST['jumlah'];
    $tahun = $_POST['tahun'];
    $stat = $_POST['stat'];


    if ($product_name == 'Yuran Pendaftaran') {
        $insert = $pdo->prepare("INSERT INTO tbl_product(product_name, jumlah, tahun, stat)
        VALUES(:product_name,:jumlah,:tahun, 0)");

        $insert->bindParam(':product_name', $product_name);
        $insert->bindParam(':jumlah', $jumlah);
        $insert->bindParam(':tahun', $tahun);
        // $insert->bindParam(0, $stat);

        if ($insert->execute()) {
            echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                        title: "Berjaya Simpan",
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
                        title: "Gagal Simpan",
                        icon: "error",
                        button: "Ok",
                        });
                    });
                </script>';
        }
    } else {
        $insert = $pdo->prepare("INSERT INTO tbl_product(product_name, jumlah, tahun, stat)
        VALUES(:product_name,:jumlah,:tahun, 1)");

        $insert->bindParam(':product_name', $product_name);
        $insert->bindParam(':jumlah', $jumlah);
        $insert->bindParam(':tahun', $tahun);
        // $insert->bindParam(':1', $stat);

        if ($insert->execute()) {
            echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                        title: "Berjaya Simpan",
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
                        title: "Gagal Simpan",
                        icon: "error",
                        button: "Ok",
                        });
                    });
                </script>';
        }
    }
}
?>

<?php
include_once 'header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Yuran</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <a href="senarai-yuran.php" class="btn btn-primary" role="button"> Senarai Yuran</a>
            </div>
            <div class="card-body">
                <form action="" method="POST" name="formproduct" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputUsername">Nama Yuran</label>
                                <input type="text" name="product_name" class="form-control" placeholder="Contoh : Yuran Tahunan 2020" required />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername">Jumlah (RM)</label>
                                <input type="number" min="1" step="1" name="jumlah" value="" class="form-control" placeholder="Contoh : 30" required />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername">Tahun</label>
                                <input type="text" name="tahun" class="form-control" placeholder="Contoh : 2020" required />
                            </div>
                            <input type="hidden" name="stat" class="form-control" />
                            <input class="btn btn-primary" type="submit" name="btn_add_product" value="Simpan">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php
include_once 'footer.php';
?>