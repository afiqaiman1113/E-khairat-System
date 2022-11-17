<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$id = $_GET['kariah_id'];
// $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
// $select->execute();

// $select->bindColumn('kariah_name', $kariah_name);
// $select->bindColumn('kariah_ic', $kariah_ic);
// $select->bindColumn('user_email', $user_email);
// $select->bindColumn('kariah_umur', $kariah_umur);
// $select->bindColumn('jantina', $jantina);
// $select->bindColumn('pekerjaan', $pekerjaan);
// $select->bindColumn('alamat', $alamat);
// $select->bindColumn('alamat2', $alamat2);
// $select->bindColumn('poskod', $poskod);
// $select->bindColumn('bandar', $bandar);
// $select->bindColumn('negeri', $negeri);
// $select->bindColumn('s_menetap', $s_menetap);
// $select->bindColumn('tel_rumah', $tel_rumah);
// $select->bindColumn('tel_hp', $tel_hp);
// $select->bindColumn('tahun_menetap', $tahun_menetap);
// $select->bindColumn('status_perkahwinan', $status_perkahwinan);
// $select->bindColumn('penerima_bantuan', $penerima_bantuan);
// $select->bindColumn('password', $password);
// $select->bindColumn('role', $role);
// $select->bindColumn('approvement', $approvement);
// $select->bindColumn('mati', $mati);

// $row = $select->fetch(PDO::FETCH_ASSOC);

// $kariah_name = $row['kariah_name'];
// $kariah_ic = $row['kariah_ic'];
// $user_email = $row['user_email'];
// $kariah_umur = $row['kariah_umur'];
// $jantina = $row['jantina'];
// $pekerjaan = $row['pekerjaan'];
// $alamat = $row['alamat'];
// $alamat2 = $row['alamat2'];
// $poskod = $row['poskod'];
// $bandar = $row['bandar'];
// $negeri = $row['negeri'];
// $s_menetap = $row['s_menetap'];
// $tel_rumah = $row['tel_rumah'];
// $tel_hp = $row['tel_hp'];
// $kawasan = $row['kawasan'];
// $tahun_menetap = $row['tahun_menetap'];
// $status_perkahwinan = $row['status_perkahwinan'];
// $penerima_bantuan = $row['penerima_bantuan'];
// $password = $row['password'];
// $tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
// $role = $row['role'];
// $approvement = $row['approvement'];
// $mati = $row['mati'];

// $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
// $select->execute();
// $row = $select->fetch(PDO::FETCH_ASSOC);
// $khairat_id = $row['khairat_id'];

// function tunggak($pdo)
// {
//     $id = $_GET['kariah_id'];
//     $output = '';
//     // $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tbl_tanggung ON ahli_kariah.kariah_id = tbl_tanggung.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
//     //$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
//     $select = $pdo->prepare("SELECT sum(paid) as paid FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
//     $select->execute();
//     $result = $select->fetchAll();
//     foreach ($result as $row) {
//         $output .= '<option value="' . $row["kariah_id"] . '">' . $row["paid"] . '</option>';
//     }
//     return $output;
// }

if (isset($_POST['btn_penama'])) {

    $kariah_id = $_POST['kariah_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];


    $insert = $pdo->prepare("INSERT INTO penama(kariah_id, firstname, lastname, address)
                VALUES(:kariah_id, :firstname, :lastname, :address)");

    $insert->bindParam(':kariah_id', $id);
    // $insert->bindParam(':khairat_id', $khairat_id);
    $insert->bindParam(':firstname', $firstname);
    $insert->bindParam(':lastname', $lastname);
    $insert->bindParam(':address', $address);


    if ($insert->execute()) {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Berjaya Tuntut",
                        icon: "success",
                        button: "Ok",
                      }).then(function() {
                          window.location = "ahli-kariah.php";
                      });
                });
                </script>';
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
                            <h3 class="card-title">Penama</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="">

                                <input type="text" name="kariah_id" class="form-control" value="<?php echo $id; ?>" placeholder="" />

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Nama First</label>
                                            <div class="input-group">
                                                <input type="text" name="firstname" style="text-transform: uppercase" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Nama Second</label>
                                            <div class="input-group">
                                                <input type="text" name="lastname" style="text-transform: uppercase" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Address</label>
                                            <div class="input-group">
                                                <input type="text" name="address" style="text-transform: uppercase" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div align="center">
                                    <input type="submit" name="btn_penama" value="Tuntut" class="btn btn-info">
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


<?php
include_once 'footer.php';
?>