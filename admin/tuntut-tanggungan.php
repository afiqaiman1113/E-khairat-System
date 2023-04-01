<?php
include_once 'database/connect.php';
session_start();
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

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
// $khairat_id = $row['khairat_id'];

// function fill_product($pdo)
// {
//     $id = $_GET['kariah_id'];
//     $output = '';
//     $selecPaid = $pdo->prepare("SELECT tbl_tanggung.* FROM tbl_tanggung LEFT JOIN ahli_kariah ON tbl_tanggung.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
//     $selecPaid->execute();
//     $resultPaid = $selecPaid->fetchAll();
//     $allPaid = [];
//     foreach ($resultPaid as $rowPaid) {
//         $allPaid[] = $rowPaid['kariah_id'];
//     }
//     $resultPaid = implode(",", $allPaid);

//     if ($resultPaid != null) {
//         $select = $pdo->prepare("SELECT tbl_tanggung.* FROM tbl_tanggung LEFT JOIN ahli_kariah ON tbl_tanggung.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
//     } else {
//         $select = $pdo->prepare("SELECT * FROM tbl_tanggung INNER JOIN ahli_kariah ON tbl_tanggung.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
//     }

//     $select->execute();
//     $result = $select->fetchAll();

//     foreach ($result as $row) {
//         $output .= '<option value="' . $row["kariah_id"] . '">' . $row["nama"] . '</option>';
//     }
//     return $output;
// }

function tunggak($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    // $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tbl_tanggung ON ahli_kariah.kariah_id = tbl_tanggung.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
    $select = $pdo->prepare("SELECT tbl_tanggung.* FROM tbl_tanggung LEFT JOIN ahli_kariah ON tbl_tanggung.kariah_id = ahli_kariah.kariah_id WHERE mati_tanggung = 'tak' AND ahli_kariah.kariah_id = " . $id . " ");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["id"] . '">' . $row["nama"] . '</option>';
    }
    return $output;
}

function tunggak1($pdo)
{
    //$id = $_GET['kariah_id'];
    $output = '';
    $output .= '<option value="" disabled>Tiada Tanggungan</option>';

    return $output;
}


// $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tbl_tanggung ON ahli_kariah.kariah_id = tbl_tanggung.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
$select = $pdo->prepare("SELECT tbl_tanggung.* FROM tbl_tanggung LEFT JOIN ahli_kariah ON tbl_tanggung.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
$select->execute();
//$row2 = $select->fetch(PDO::FETCH_ASSOC);
$row2 = $select->fetch(PDO::FETCH_OBJ);


if (isset($_POST['btn_tuntut'])) {

    // $khairat_id = $_POST['khairat_id'];
    $id_tanggungan = $_POST['id'];
    $nama = strtoupper($_POST['namatanggungan']);
    // $penuntut = $_POST['penuntut'];
    $t_tanggunghubungan = $_POST['t_tanggunghubungan'];
    $tarikh_mati = date('Y-m-d', strtotime($_POST['tarikh_mati']));
    $tarikh_tuntut = date('Y-m-d', strtotime($_POST['tarikh_tuntut']));
    $no_surat = $_POST['no_surat'];
    $jumlah = $_POST['jumlah'];
    $cara_bayar = $_POST['cara_bayar'];
    $no_cek = $_POST['no_cek'];
    $nota = $_POST['nota'];
    $invoice = $_POST['invoice'];
    $status = $_POST['status'];


    $insert = $pdo->prepare("INSERT INTO tuntut_tanggungan(id_tanggungan, kariah_id, nama, t_tanggunghubungan, tarikh_mati, tarikh_tuntut, no_surat, jumlah, cara_bayar, no_cek, nota, invoice, status)
    VALUES(:id_tanggungan, :kariah_id, :nama, :t_tanggunghubungan, :tarikh_mati, :tarikh_tuntut, :no_surat, :jumlah, :cara_bayar, :no_cek, :nota, :invoice, :status)");

    $insert->bindParam(':id_tanggungan', $id_tanggungan);
    $insert->bindParam(':kariah_id', $id);
    // $insert->bindParam(':khairat_id', $khairat_id);
    $insert->bindParam(':nama', $nama);
    // $insert->bindParam(':penuntut', $penuntut);
    $insert->bindParam(':t_tanggunghubungan', $t_tanggunghubungan);
    $insert->bindParam(':tarikh_mati', $tarikh_mati);
    $insert->bindParam(':tarikh_tuntut', $tarikh_tuntut);
    $insert->bindParam(':no_surat', $no_surat);
    $insert->bindParam(':jumlah', $jumlah);
    $insert->bindParam(':cara_bayar', $cara_bayar);
    $insert->bindParam(':no_cek', $no_cek);
    $insert->bindParam(':nota', $nota);
    $insert->bindParam(':invoice', $invoice);
    $insert->bindParam(':status', $status);

    if ($insert->execute()) {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Berjaya Tuntut",
                        icon: "success",
                        button: "Ok",
                      }).then(function() {
                          window.location = "tuntutan-tanggungan.php";
                      });
                });
                </script>';
        // $sql = "DELETE FROM tbl_tanggung WHERE id = $id_tanggungan ";
        // $update = $pdo->prepare($sql);
        // $update->execute();
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
                            <h3 class="card-title">Tuntutan Tanggungan</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="">

                                <input type="hidden" name="status" class="form-control" value="Berjaya" placeholder="" />
                                <!-- <td style="display:none;"><input type="hidden" name="product_name" class="form-control pname" placeholder="" readonly /></td>
                                <td>
                                    <select name="id" style="width: 250px" class="form-control productid">
                                        <option value="">Pilih Yuran</option><?php //echo fill_product($pdo);
                                                                                ?>
                                    </select>
                                </td> -->
                                <!-- <input type="text" name="id_tanggungan" class="form-control" value="<?php //echo $row2->id;
                                                                                                            ?>" placeholder="" /> -->

                                <!-- <td style="display:none;"><input type="hidden" name="nama" class="form-control" placeholder="" readonly /></td> -->
                                <input type="hidden" class="form-control nama" name="namatanggungan" readonly>
                                <!-- <td>
                                    <select name="id" style="width: 300px" class="form-control">
                                        <option value="">Tanggungan Yang Meninggal Dunia</option><?php //echo tunggak($pdo);
                                                                                                    ?>
                                    </select>
                                </td> -->

                                <?php
                                $t_tanggunghubungan = $_POST['t_tanggunghubungan'];
                                $tarikh_mati = $_POST['tarikh_mati'];
                                $tarikh_tuntut = $_POST['tarikh_tuntut'];
                                $no_surat = $_POST['no_surat'];
                                $jumlah = $_POST['jumlah'];
                                $no_cek = $_POST['no_cek'];
                                $nota = $_POST['nota'];
                                ?>
                                <td>
                                    <select class="form-control id_tanggungan" name="id_tanggungan" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')" style="width: 250px" ;>
                                        <option value="" disabled selected>Pilih Tanggungan</option>
                                        <?php
                                        if (tunggak($pdo) == true) {
                                            echo tunggak($pdo);
                                        } else {
                                            echo tunggak1($pdo);
                                        }

                                        ?>
                                    </select>
                                </td>
                                <input type="hidden" class="form-control id" name="id" readonly>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Hubungan Dengan Tanggungan</span></label>
                                            <div class="input-group">
                                                <input type="text" name="t_tanggunghubungan" class="form-control" value="<?php echo $t_tanggunghubungan; ?>" placeholder="" required="" oninvalid="this.setCustomValidity('Sila Isi')" oninput="setCustomValidity('')" />
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
                                                <input type="text" name="tarikh_tuntut" id="tarikh_tuntut" style="text-transform: uppercase" value="<?php echo $tarikh_tuntut ?>" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">No Surat Mati</span></label>
                                            <div class="input-group">
                                                <input type="text" name="no_surat" class="form-control" placeholder="" required="" value="<?php echo $no_surat; ?>" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Jumlah Dituntut</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        RM
                                                    </span>
                                                </div>
                                                <input type="text" name="jumlah" class="form-control" placeholder="" value="<?php echo $jumlah; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label style="color:red;">* <span style="color:black;">Cara Pembayaran</span></label>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Cek/Baucar</label>
                                            <div class="input-group">
                                                <input type="text" name="no_cek" class="form-control" value="<?php echo $no_cek; ?>" placeholder="Jika Ada" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nota Tambahan</label>
                                            <div class="input-group">
                                                <input type="text" name="nota" class="form-control" value="<?php echo $nota; ?>" placeholder="Jika Ada" />
                                            </div>
                                        </div>
                                    </div>
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


    $(".id_tanggungan").on('change', function(e) {

        var id_tanggungan = this.value;
        var tr = $(this).parent().parent();
        $.ajax({

            url: "get-tanggungan.php",
            method: "get",
            data: {
                id: id_tanggungan
            },
            success: function(data) {

                //console.log(data);
                tr.find(".id").val(data["id"]);
                tr.find(".nama").val(data["nama"]);
            }
        })
    })
</script>

<?php
include_once 'footer.php';
?>