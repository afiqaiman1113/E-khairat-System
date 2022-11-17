<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$id = $_GET['tid_tanggung'];
$select = $pdo->prepare("SELECT * FROM tuntut_tanggungan INNER JOIN ahli_kariah ON tuntut_tanggungan.kariah_id = ahli_kariah.kariah_id WHERE tid_tanggung = $id");
$select->execute();

$select->bindColumn('nama', $nama);
$select->bindColumn('t_tanggunghubungan', $t_tanggunghubungan);
$select->bindColumn('tarikh_mati', $tarikh_mati);
$select->bindColumn('tarikh_tuntut', $tarikh_tuntut);
$select->bindColumn('no_surat', $no_surat);
$select->bindColumn('jumlah', $jumlah);
$select->bindColumn('cara_bayar', $cara_bayar);
$select->bindColumn('no_cek', $no_cek);
$select->bindColumn('nota', $nota);

$row = $select->fetch(PDO::FETCH_ASSOC);

$nama = $row['nama'];
$kariah_name = $row['kariah_name'];
$t_tanggunghubungan = $row['t_tanggunghubungan'];
$tarikh_mati = $row['tarikh_mati'];
$tarikh_tuntut = $row['tarikh_tuntut'];
$no_surat = $row['no_surat'];
$jumlah = $row['jumlah'];
$cara_bayar = $row['cara_bayar'];
$no_cek = $row['no_cek'];
$nota = $row['nota'];
$invoice = $row['invoice'];
$tuntutan_image = $row['tuntutan_image'];

if (isset($_POST['edit_tuntut'])) {

    $nama = strtoupper($_POST['nama']);
    $t_tanggunghubungan = $_POST['t_tanggunghubungan'];
    $tarikh_mati = date('Y-m-d', strtotime($_POST['tarikh_mati']));
    $tarikh_tuntut = date('Y-m-d', strtotime($_POST['tarikh_tuntut']));
    $no_surat = $_POST['no_surat'];
    $jumlah = $_POST['jumlah'];
    $cara_bayar = $_POST['cara_bayar'];
    $no_cek = $_POST['no_cek'];
    $nota = $_POST['nota'];

    $f_name = $_FILES['myfile']['name'];

    if (!empty($f_name)) {
        $f_tmp = $_FILES['myfile']['tmp_name'];

        $f_size =  $_FILES['myfile']['size'];

        $f_extension = explode('.', $f_name);
        $f_extension = strtolower(end($f_extension));

        $f_newfile =  uniqid() . '.' . $f_extension;

        $store = "productimages/" . $f_newfile;

        if ($f_extension == 'jpg' || $f_extension == 'jpeg' ||  $f_extension == 'png' || $f_extension == 'gif') {
            if ($f_size >= 1000000) {
                $error = '<script type="text/javascript">
                        jQuery(function validation(){
                        swal({
                            title: "Error!",
                            text: "Max file should be 1MB!",
                            icon: "warning",
                            button: "Ok",
                        });
                        });
                    </script>';
                echo $error;
            } else {
                if (move_uploaded_file($f_tmp, $store)) {
                    $f_newfile;
                    if (!isset($error)) {

                        $update_tuntut = $pdo->prepare("UPDATE tuntut_tanggungan SET nama=:nama, t_tanggunghubungan=:t_tanggunghubungan,
                        tarikh_mati=:tarikh_mati, tarikh_tuntut=:tarikh_tuntut, no_surat=:no_surat, tuntutan_image=:tuntutan_image, jumlah=:jumlah, cara_bayar=:cara_bayar, no_cek=:no_cek, nota=:nota WHERE tid_tanggung = $id ");

                        $update_tuntut->bindParam(':nama', $nama);
                        $update_tuntut->bindParam(':t_tanggunghubungan', $t_tanggunghubungan);
                        $update_tuntut->bindParam(':tarikh_mati', $tarikh_mati);
                        $update_tuntut->bindParam(':tarikh_tuntut', $tarikh_tuntut);
                        $update_tuntut->bindParam(':no_surat', $no_surat);
                        $update_tuntut->bindParam(':jumlah', $jumlah);
                        $update_tuntut->bindParam(':cara_bayar', $cara_bayar);
                        $update_tuntut->bindParam(':no_cek', $no_cek);
                        $update_tuntut->bindParam(':nota', $nota);

                        $update_tuntut->bindParam(':tuntutan_image', $f_newfile);

                        if ($update_tuntut->execute()) {
                            echo '<script type="text/javascript">
                                    jQuery(function validation() {
                                        swal({
                                            title: "Kemaskini Berjaya",
                                            icon: "success",
                                            button: "Ok",
                                          }).then(function() {
                                              window.location = "tuntutan-tanggungan.php";
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
                }
            }
        } else {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Peringatan",
                    text: "Hanya format jpg, jpeg dan png sahaja!",
                    icon: "warning",
                    button: "Ok",
                });
            });
            </script>';
        }
    } else {
        $update_tuntut = $pdo->prepare("UPDATE tuntut_tanggungan SET nama=:nama, t_tanggunghubungan=:t_tanggunghubungan,
        tarikh_mati=:tarikh_mati, tarikh_tuntut=:tarikh_tuntut, no_surat=:no_surat, tuntutan_image=:tuntutan_image, jumlah=:jumlah, cara_bayar=:cara_bayar, no_cek=:no_cek, nota=:nota WHERE tid_tanggung = $id ");


        $update_tuntut->bindParam(':nama', $nama);
        $update_tuntut->bindParam(':t_tanggunghubungan', $t_tanggunghubungan);
        $update_tuntut->bindParam(':tarikh_mati', $tarikh_mati);
        $update_tuntut->bindParam(':tarikh_tuntut', $tarikh_tuntut);
        $update_tuntut->bindParam(':no_surat', $no_surat);
        $update_tuntut->bindParam(':jumlah', $jumlah);
        $update_tuntut->bindParam(':cara_bayar', $cara_bayar);
        $update_tuntut->bindParam(':no_cek', $no_cek);
        $update_tuntut->bindParam(':nota', $nota);

        $update_tuntut->bindParam(':tuntutan_image', $tuntutan_image);

        if ($update_tuntut->execute()) {
            echo '<script type="text/javascript">
                jQuery(function validation() {
                swal({
                    title: "Kemaskini Berjaya",
                    icon: "success",
                    button: "Ok",
                }).then(function() {
                    window.location = "tuntutan-tanggungan.php";
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
}

$select = $pdo->prepare("SELECT * FROM tuntut_tanggungan INNER JOIN ahli_kariah ON tuntut_tanggungan.kariah_id = ahli_kariah.kariah_id WHERE tid_tanggung = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$nama = $row['nama'];
$kariah_name = $row['kariah_name'];
$t_tanggunghubungan = $row['t_tanggunghubungan'];
$tarikh_mati = $row['tarikh_mati'];
$tarikh_tuntut = $row['tarikh_tuntut'];
$no_surat = $row['no_surat'];
$jumlah = $row['jumlah'];
$cara_bayar = $row['cara_bayar'];
$no_cek = $row['no_cek'];
$nota = $row['nota'];
$invoice = $row['invoice'];
$tuntutan_image = $row['tuntutan_image'];

if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}

?>
<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Semakan Tuntutan Tanggungan</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Si Mati</span></label>
                                            <div class="input-group">
                                                <input type="text" name="nama" style="text-transform: uppercase" class="form-control" value="<?php echo $nama; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Si Penuntut</span></label>
                                            <div class="input-group">
                                                <input type="text" name="waris" style="text-transform: uppercase" class="form-control" value="<?php echo $kariah_name; ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Hubungan Penuntut Dengan Si Mati</span></label>
                                            <div class="input-group">
                                                <input type="text" name="t_tanggunghubungan" style="text-transform: uppercase" class="form-control" value="<?php echo $t_tanggunghubungan; ?>" required="" oninvalid="this.setCustomValidity('Masukkan maklumat')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Tarikh Kematian</span></label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <div class="input-group-append" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="tarikh_mati" id="tarikh_mati" value="<?php echo date('d-m-Y', strtotime($tarikh_mati)); ?>" required="" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Tarikh Tuntut</span></label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <div class="input-group-append" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="tarikh_tuntut" id="tarikh_tuntut" value="<?php echo date('d-m-Y', strtotime($tarikh_tuntut)); ?>" required="" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">No Surat Mati</span></label>
                                            <div class="input-group">
                                                <input type="text" name="no_surat" class="form-control" value="<?php echo $no_surat; ?>" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan maklumat')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($tuntutan_image == NULL) {
                                ?>
                                    <div class="form-group">
                                        <label style="color:red;"><span style="color:black;">Surat Mati</span></label><br>
                                        <input type="file" class="input-group" name="myfile">
                                        <h7>Tiada Gambar</h7>
                                        <p style="color:red;">Format: jpg, png atau jpeg</p>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="form-group">
                                        <label style="color:red;"><span style="color:black;">Surat Mati</span></label><br>
                                        <img src="productimages/<?php echo $tuntutan_image; ?>" class="img-responsive" width="50px" height="65px" />
                                        <input type="file" class="input-group" name="myfile">
                                        <p style="color:red;">Format: jpg, png atau jpeg</p>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Jumlah Dituntut</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        RM
                                                    </span>
                                                </div>
                                                <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="" value="<?php echo number_format($jumlah, 2); ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label>Cara Pembayaran</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="cara_bayar" value="Tunai" <?php echo ($cara_bayar == 'Tunai') ? 'checked' : '' ?>>
                                        <label for="radioPrimary1">Tunai</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="cara_bayar" value="Perbankan Internet" <?php echo ($cara_bayar == 'Perbankan Internet') ? 'checked' : '' ?>>
                                        <label for="radioPrimary2">Perbankan Internet</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" name="cara_bayar" value="Cek" <?php echo ($cara_bayar == 'Cek') ? 'checked' : '' ?>>
                                        <label for="radioPrimary3">Cek</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>No Resit</label>
                                            <div class="input-group">
                                                <input type="text" name="invoice" class="form-control" value="<?php echo $invoice; ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>No Cek/Baucar</label>
                                            <div class="input-group">
                                                <input type="text" name="no_cek" class="form-control" value="<?php echo $no_cek; ?>" placeholder="Jika Ada" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nota Tambahan</label>
                                            <div class="input-group">
                                                <input type="text" name="nota" class="form-control" value="<?php echo $nota; ?>" placeholder="Jika Ada" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div align="center">
                                    <input type="submit" name="edit_tuntut" value="Kemaskini" class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-exclamation-triangle"></i>
                                Penting
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Nota!</h5>
                                <ul>
                                    <li>Pastikan anda telah mengemaskini maklumat terlebih dahulu sebelum membuat pembayaran</li><br>
                                    <li>Maklumat tidak boleh dikemaskini setelah bayaran dilakukan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $("#tarikh_mati").datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });

    $(document).ready(function() {
        $("#tarikh_tuntut").datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });


    // $(function() {
    //     $("#reservationdate").datetimepicker({
    //         format: "L",
    //     });
    // });

    // $(function() {
    //     $("#reservationdate1").datetimepicker({
    //         format: "L",
    //     });
    // });

    $(function() {
        $("#hubungan").change(function() {
            var displayjumlah = $("#hubungan option:selected").val();
            $("#jumlah").val(displayjumlah);
        })
    });

    $(function() {
        $("#hubungan").change(function() {
            var displayjumlah1 = $("#hubungan option:selected").text();
            $("#hubunganpenuntut_hidden").val(displayjumlah1);
        })
    });
</script>

<?php
include_once 'footer.php';
?>