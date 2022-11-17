<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();

$select->bindColumn('kariah_name', $kariah_name);
$select->bindColumn('kariah_ic', $kariah_ic);
$select->bindColumn('user_email', $user_email);
$select->bindColumn('kariah_umur', $kariah_umur);
$select->bindColumn('jantina', $jantina);
$select->bindColumn('pekerjaan', $pekerjaan);
$select->bindColumn('alamat', $alamat);
$select->bindColumn('alamat2', $alamat2);
$select->bindColumn('poskod', $poskod);
$select->bindColumn('bandar', $bandar);
$select->bindColumn('negeri', $negeri);
$select->bindColumn('s_menetap', $s_menetap);
$select->bindColumn('tel_rumah', $tel_rumah);
$select->bindColumn('tel_hp', $tel_hp);
$select->bindColumn('tahun_menetap', $tahun_menetap);
$select->bindColumn('status_perkahwinan', $status_perkahwinan);
$select->bindColumn('penerima_bantuan', $penerima_bantuan);
$select->bindColumn('password', $password);
$select->bindColumn('role', $role);
$select->bindColumn('approvement', $approvement);
$select->bindColumn('mati', $mati);

$row = $select->fetch(PDO::FETCH_ASSOC);

$kariah_name = $row['kariah_name'];
$kariah_ic = $row['kariah_ic'];
$user_email = $row['user_email'];
$kariah_umur = $row['kariah_umur'];
$jantina = $row['jantina'];
$pekerjaan = $row['pekerjaan'];
$alamat = $row['alamat'];
$alamat2 = $row['alamat2'];
$poskod = $row['poskod'];
$bandar = $row['bandar'];
$negeri = $row['negeri'];
$s_menetap = $row['s_menetap'];
$tel_rumah = $row['tel_rumah'];
$tel_hp = $row['tel_hp'];
$kawasan = $row['kawasan'];
$tahun_menetap = $row['tahun_menetap'];
$status_perkahwinan = $row['status_perkahwinan'];
$penerima_bantuan = $row['penerima_bantuan'];
$password = $row['password'];
$tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
$role = $row['role'];
$approvement = $row['approvement'];
$mati = $row['mati'];

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
// $khairat_id = $row['khairat_id'];

function tunggak($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    // $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tbl_tanggung ON ahli_kariah.kariah_id = tbl_tanggung.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
    //$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
    $select = $pdo->prepare("SELECT sum(paid) as paid FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["kariah_id"] . '">' . $row["paid"] . '</option>';
    }
    return $output;
}

$select = $pdo->prepare("SELECT penama.* FROM penama LEFT JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE penama.kariah_id = " . $id . " ");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$penama_id = $row['penama_id'];
$penama_name = $row['penama_name'];


if (isset($_POST['btn_tuntut'])) {

    // $khairat_id = $_POST['khairat_id'];
    $tuntut_name = strtoupper($_POST['tuntut_name']);
    $tuntut_ic = $_POST['tuntut_ic'];
    // $penuntut = strtoupper($_POST['penuntut']);
    $hubungan = $_POST['hubunganpenuntut'];
    $tarikh_mati = date('Y-m-d', strtotime($_POST['tarikh_mati']));
    $tarikh_tuntut = date('Y-m-d', strtotime($_POST['tarikh_tuntut']));
    $no_surat = $_POST['no_surat'];
    $jumlah = $_POST['jumlah'];
    $cara_bayar = $_POST['cara_bayar'];
    $no_cek = $_POST['no_cek'];
    $nota = $_POST['nota'];
    $pindah_milik = $_POST['pindah_milik'];
    $invoice = $_POST['invoice'];
    $status_tuntut = $_POST['status_tuntut'];



    $insert = $pdo->prepare("INSERT INTO tuntut(kariah_id, penama_id, tuntut_name, tuntut_ic, hubungan, tarikh_mati, tarikh_tuntut, no_surat, jumlah, cara_bayar, no_cek, nota, pindah_milik, invoice, status_tuntut)
                VALUES(:kariah_id, :penama_id, :tuntut_name, :tuntut_ic, :hubungan, :tarikh_mati, :tarikh_tuntut, :no_surat, :jumlah, :cara_bayar, :no_cek, :nota, :pindah_milik, :invoice, :status_tuntut)");

    $insert->bindParam(':kariah_id', $id);
    // $insert->bindParam(':khairat_id', $khairat_id);
    $insert->bindParam(':penama_id', $penama_id);
    $insert->bindParam(':tuntut_name', $tuntut_name);
    $insert->bindParam(':tuntut_ic', $tuntut_ic);
    // $insert->bindParam(':penuntut', $penuntut);
    $insert->bindParam(':hubungan', $hubungan);
    $insert->bindParam(':tarikh_mati', $tarikh_mati);
    $insert->bindParam(':tarikh_tuntut', $tarikh_tuntut);
    $insert->bindParam(':no_surat', $no_surat);
    $insert->bindParam(':jumlah', $jumlah);
    $insert->bindParam(':cara_bayar', $cara_bayar);
    $insert->bindParam(':no_cek', $no_cek);
    $insert->bindParam(':nota', $nota);
    $insert->bindParam(':pindah_milik', $pindah_milik);
    $insert->bindParam(':invoice', $invoice);
    $insert->bindParam(':status_tuntut', $status_tuntut);

    if ($insert->execute()) {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Berjaya Tuntut",
                        icon: "success",
                        button: "Ok",
                      }).then(function() {
                          window.location = "tuntutan-kematian.php";
                      });
                });
                </script>';

        $sql = "UPDATE ahli_kariah SET mati = 'Mati', status_sms = 2 WHERE kariah_id = $id ";
        $update = $pdo->prepare($sql);
        $update->execute();

        $activity = "ahli " . strtoupper($kariah_name) . " dituntut oleh " . strtoupper($penama_name) . " ";
        $time_loged = date("Y-m-d H:i:s", strtotime("now"));
        $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
        $stmt->bindParam(1, $_SESSION['user_id']);
        $stmt->bindParam(2, $activity);
        $stmt->bindParam(3, $time_loged);
        $stmt->execute();
    } else {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Gagal Tuntut",
                        icon: "error",
                        button: "Ok",
                      });
                });
                </script>';
    }
}

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
                            <h3 class="card-title">Tuntutan Ahli</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="">

                                <input type="hidden" style="text-transform: uppercase" name="tuntut_name" class="form-control" value="<?php echo strtoupper($kariah_name); ?>" placeholder="" />
                                <input type="hidden" name="tuntut_ic" class="form-control" value="<?php echo $kariah_ic; ?>" placeholder="" />
                                <input type="hidden" name="status_tuntut" class="form-control" value="Berjaya" placeholder="" />

                                <input type="hidden" name="penama_id" class="form-control" value="<?php echo $penama_id; ?>" placeholder="" />
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Nama Penuntut Bagi Si Mati</span></label>
                                            <div class="input-group">
                                                <input type="text" name="penuntut" style="text-transform: uppercase" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tarikh</label>
                                            <div class="input-group">
                                                <input type="text" name="tarikh" id="tarikh" style="text-transform: uppercase" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <?php
                                $tarikh_mati = $_POST['tarikh_mati'];
                                $tarikh_tuntut = $_POST['tarikh_tuntut'];
                                $no_surat = $_POST['no_surat'];
                                $jumlah = $_POST['jumlah'];
                                $no_cek = $_POST['no_cek'];
                                $nota = $_POST['nota'];
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Si Penuntut/Penama</span></label>
                                            <div class="input-group">
                                                <input type="text" name="penuntut" style="text-transform: uppercase" class="form-control" value="<?php echo $penama_name; ?>" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Hubungan Penuntut Dengan Si Mati</span></label>
                                            <select name="hubungan" id="hubungan" class="form-control" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                <option value="" disabled selected>Sila Pilih</option>
                                                <option value="1000">Suami</option>
                                                <option value="1000">Isteri</option>
                                                <option value="1000">Anak</option>
                                                <option value="2000">Ayah Kandung</option>
                                                <option value="2500">Ibu Kandung</option>
                                            </select>
                                            <input type="hidden" name="hubunganpenuntut" id="hubunganpenuntut_hidden">
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
                                                <input type="text" class="form-control" name="tarikh_mati" id="tarikh_mati" value="<?php echo $tarikh_mati; ?>" required="" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')">
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
                                                <input type="text" name="tarikh_tuntut" id="tarikh_tuntut" value="<?php echo $tarikh_tuntut ?>" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Tuntut</label>
                                            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control datetimepicker-input" name="tarikh_tuntut" data-date-format="yyyy-mm-dd" data-target="#reservationdate1">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">No Surat Mati</span></label>
                                            <div class="input-group">
                                                <input type="text" name="no_surat" class="form-control" placeholder="" value="<?php echo $no_surat; ?>" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <input type="text" name="jumlah" class="form-control" id="jumlah" required="" value="<?php echo $jumlah; ?>" oninvalid="this.setCustomValidity('Isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <label>* Jumlah Dituntut (RM)</label>
                                <td style="display:none;"><input type="hidden" name="paid" class="form-control" placeholder="" readonly /></td>
                                <td>
                                    <select name="kariah_id" style="width: 300px" class="form-control">
                                        <option value="">Jumlah Dituntut</option><?php //echo tunggak($pdo);
                                                                                    ?>
                                    </select>
                                </td> -->
                                <label>Cara Pembayaran</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="cara_bayar" value="Tunai">
                                        <label for="radioPrimary1">Tunai</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="cara_bayar" value="Perbankan Internet">
                                        <label for="radioPrimary2">Perbankan Internet</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" name="cara_bayar" value="Cek">
                                        <label for="radioPrimary3">Cek</label>
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
                                <div class="form-group">
                                    <select class="form-control" name="pindah_milik" hidden>
                                        <option value="Belum">Belum</option>
                                    </select>
                                </div>
                                <input name="invoice" type="hidden" class="form-control" value="<?php $b = rand(10000, 100000);
                                                                                                $c = $b;
                                                                                                echo $c; ?>" autofocus="on" readonly="readonly" />
                                <div align="center">
                                    <input type="submit" name="btn_tuntut" value="Tuntut" class="btn btn-info">
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
    // $(function() {
    //     $("#reservationdate").datetimepicker({
    //         format: "L",
    //     });
    // });

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

    $(function() {
        $("#reservationdate1").datetimepicker({
            format: "L",
        });
    });

    $(function() {
        $("#hubungan").change(function() {
            var displayjumlah = $("#hubungan option:selected").val();
            $("#jumlah").val(displayjumlah);
        })
    });

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