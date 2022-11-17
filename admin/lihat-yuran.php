<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
include_once 'header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tetapan Yuran</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary"><br>
                        <div class="col-md-12">
                            <?php
                            $id = $_POST['product_id'];
                            $select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = $id ");
                            $select->execute();

                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                echo '
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <div class="col-md-12">
                                                <a href="senarai-yuran.php" class="btn btn-primary" role="button"> Senarai Yuran</a>
                                            <div><br>
                                            <center><p class="list-group-item list-group-item-success"><b>Yuran</b></p></center>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <b>Jenis Yuran</b>
                                                <span class="badge badge-primary badge-pill">' . $row->product_name . '</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <b>Jumlah</b>
                                                <span class="badge badge-primary badge-pill">RM ' . $row->jumlah . '</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <b>Tahun</b>
                                                <span class="badge badge-danger badge-pill">' . $row->tahun . '</span>
                                            </li>

                                        </ul>
                                    </div><br>


                                ';
                            }
                            ?>
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