<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

//error_reporting(0);

//fetch semula product
$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

//front end display in format yg kita nak. Cuba bca balik chat dgn abg haezal
//$tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
$tarikh_bayaran = date('d-m-Y', strtotime($row['tarikh_bayaran']));
$tarikh_tamat = date('d-m-Y', strtotime($row['tarikh_expired']));


?>
<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <form action="" method="POST" name="">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Semakan Maklumat Ahli</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Expired</span></label>
                                    <div class="input-group">
                                        <input type="text" name="kariah_name" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $tarikh_tamat; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Status</span></label>
                                    <div class="input-group">
                                        <?php
                                        if (strtotime($tarikh_bayaran) < strtotime($tarikh_tamat)) {
                                            echo "<input type='text' name='kariah_name' class='form-control' value='Active'  />";
                                            $update_kariah = $pdo->prepare("UPDATE ahli_kariah SET status_sms=2 WHERE kariah_id = $id");
                                            $update_kariah->execute();
                                        } else {
                                            echo "<input type='text' name='kariah_name' class='form-control' value='Expired'  />";
                                            $update_kariah = $pdo->prepare("UPDATE ahli_kariah SET status_sms=1 WHERE kariah_id = $id");
                                            $update_kariah->execute();
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?php
include_once 'footer.php';
?>