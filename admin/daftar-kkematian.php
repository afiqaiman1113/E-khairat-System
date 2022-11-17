<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->bindParam('kariah_name', $kariah_name);
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
$select->bindColumn('status', $status);
$select->bindColumn('tel_rumah', $tel_rumah);
$select->bindColumn('tel_hp', $tel_hp);
$select->bindColumn('tahun_menetap', $tahun_menetap);
$select->bindColumn('status_perkahwinan', $status_perkahwinan);
$select->bindColumn('penerima_bantuan', $penerima_bantuan);
$select->bindColumn('password', $password);
$select->bindColumn('role', $role);

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
$status = $row['status'];
$tel_rumah = $row['tel_rumah'];
$tel_hp = $row['tel_hp'];
$kawasan = $row['kawasan'];
$tahun_menetap = $row['tahun_menetap'];
$status_perkahwinan = $row['status_perkahwinan'];
$penerima_bantuan = $row['penerima_bantuan'];
$password = $row['password'];
$tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
$role = $row['role'];

$select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id = $id");
$select->execute();

$row_tanggung = $select->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['btn_simpan'])) {

    // $kariah_id = $_POST['kariah_id'];
    $khairat_name = $_POST['khairat_name'];
    $khairat_ic = $_POST['khairat_ic'];
    $khairat_email = $_POST['khairat_email'];
    $khairat_umur = $_POST['khairat_umur'];
    $jantina = $_POST['jantina'];
    $pekerjaan = $_POST['pekerjaan'];
    $alamat = $_POST['alamat'];
    $alamat2 = $_POST['alamat2'];
    $poskod = $_POST['poskod'];
    $bandar = $_POST['bandar'];
    $negeri = $_POST['negeri'];
    $status = $_POST['status'];
    $tel_rumah = $_POST['tel_rumah'];
    $tel_hp = $_POST['tel_hp'];
    $kawasan = $_POST['kawasan'];
    $tahun_menetap = $_POST['tahun_menetap'];
    $status_perkahwinan = $_POST['status_perkahwinan'];
    $penerima_bantuan = $_POST['penerima_bantuan'];
    $tarikh_bayar = date("Y-m-d");

    if (isset($_POST['khairat_ic'])) {

        // $select = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email='$user_email'");
        // $select->execute();

        $ic = $pdo->prepare("SELECT khairat_ic FROM khairat_kematian WHERE khairat_ic='$khairat_ic'");
        $ic->execute();

        if ($ic->rowCount() > 0) {
            echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "No kad pengenalan dah terdaftar",
                        icon: "warning",
                        button: "Ok",
                      });
                });
                </script>';
        } else {

            //bwh ni pulak utk masuk dekat tbl_tanggung
            // $kariah_id = $_POST['kariah_id'];
            $nama = $_POST['nama'];
            $ic = $_POST['ic'];
            $umur = $_POST['umur'];
            $tel = $_POST['tel'];
            $pertalian = $_POST['pertalian'];
            $khairat_pekerjaan = $_POST['khairat_pekerjaan'];

            // $delete_tanggungan = $pdo->prepare("DELETE FROM tbl_tanggung WHERE kariah_id = $id");
            // $delete_tanggungan->execute();

            $kariah_id = $pdo->lastInsertId();
            if ($kariah_id != null) {

                $insert = $pdo->prepare("INSERT INTO khairat_kematian(kariah_id, khairat_name, khairat_ic, khairat_email, khairat_umur, jantina, pekerjaan, alamat, alamat2, poskod, bandar, negeri, status, tel_rumah, tel_hp, kawasan, tahun_menetap, status_perkahwinan, penerima_bantuan,tarikh_bayar)
                VALUES(:kariah_id, :khairat_name, :khairat_ic, :khairat_email, :khairat_umur, :jantina, :pekerjaan, :alamat, :alamat2, :poskod, :bandar, :negeri, :status, :tel_rumah, :tel_hp, :kawasan, :tahun_menetap, :status_perkahwinan, :penerima_bantuan, :tarikh_bayar)");

                $insert->bindParam(':kariah_id', $id);
                $insert->bindParam(':khairat_name', $khairat_name);
                $insert->bindParam(':khairat_ic', $khairat_ic);
                $insert->bindParam(':khairat_email', $khairat_email);
                $insert->bindParam(':khairat_umur', $khairat_umur);
                $insert->bindParam(':jantina', $jantina);
                $insert->bindParam(':pekerjaan', $pekerjaan);
                $insert->bindParam(':alamat', $alamat);
                $insert->bindParam(':alamat2', $alamat2);
                $insert->bindParam(':poskod', $poskod);
                $insert->bindParam(':bandar', $bandar);
                $insert->bindParam(':negeri', $negeri);
                $insert->bindParam(':status', $status);
                $insert->bindParam(':tel_rumah', $tel_rumah);
                $insert->bindParam(':tel_hp', $tel_hp);
                $insert->bindParam(':kawasan', $kawasan);
                $insert->bindParam(':tahun_menetap', $tahun_menetap);
                $insert->bindParam(':status_perkahwinan', $status_perkahwinan);
                $insert->bindParam(':penerima_bantuan', $penerima_bantuan);
                $insert->bindParam(':tarikh_bayar', $tarikh_bayar);

                if ($insert->execute()) {
                    echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Pendaftaran berjaya",
                            icon: "success",
                            button: "Ok",
                          });
                    });
                    </script>';
                    // header('refresh:2;kariahlist.php');
                } else {
                    echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Pendaftaran gagal",
                            icon: "error",
                            button: "Ok",
                          });
                    });
                    </script>';
                }

                $khairat_id = $pdo->lastInsertId();
                if ($khairat_id != null) {

                    for ($i = 0; $i < count($nama); $i++) {
                        $insert = $pdo->prepare("INSERT INTO cubaan(khairat_id, kariah_id, nama, ic, umur, tel, pertalian, khairat_pekerjaan)
                        VALUES(:khairat_id, :kariah_id, :nama, :ic, :umur, :tel, :pertalian, :khairat_pekerjaan)");

                        $insert->bindParam(':khairat_id', $khairat_id);
                        $insert->bindParam(':kariah_id', $id);
                        $insert->bindParam(':nama', $nama[$i]);
                        $insert->bindParam(':ic', $ic[$i]);
                        $insert->bindParam(':umur', $umur[$i]);
                        $insert->bindParam(':tel', $tel[$i]);
                        $insert->bindParam(':pertalian', $pertalian[$i]);
                        $insert->bindParam(':khairat_pekerjaan', $khairat_pekerjaan[$i]);

                        $insert->execute();
                    }
                    // header('location:kariahlist.php');
                }
            }
        }
    }
}




if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pendaftaran Ahli Kariah</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Maklumat Ahli</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Nama Ahli</label>
                                            <div class="input-group">
                                                <input type="text" name="khairat_name" class="form-control" placeholder="" value="<?php echo $kariah_name; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* No K/P</label>
                                            <div class="input-group">
                                                <input type="text" name="khairat_ic" class="form-control" placeholder="" value="<?php echo $kariah_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Umur</label>
                                            <div class="input-group">
                                                <input type="text" name="khairat_umur" class="form-control" placeholder="" value="<?php echo $kariah_umur; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Emel</label>
                                            <div class="input-group">
                                                <input type="email" name="khairat_email" class="form-control" placeholder="" value="<?php echo $user_email; ?>" required="" oninvalid="this.setCustomValidity('Masukkan emel')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="journey">* Jantina</label>
                                            <select name="jantina" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                <option value='<?php echo $jantina; ?>'><?php echo $jantina; ?></option>
                                                <?php
                                                if ($jantina == '') {
                                                    echo "<option value='Perempuan'>Perempuan</option>";
                                                    echo "<option value='Lelaki'>Lelaki</option>";
                                                } elseif ($jantina == 'Lelaki') {
                                                    echo "<option value='Perempuan'>Perempuan</option>";
                                                } else {
                                                    echo "<option value='Lelaki'>Lelaki</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Pekerjaan</label>
                                            <div class="input-group">
                                                <input type="text" name="pekerjaan" class="form-control" placeholder="" value="<?php echo $pekerjaan; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Alamat</label>
                                            <div class="input-group">
                                                <input type="text" name="alamat" class="form-control" placeholder="" value="<?php echo $alamat; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                            </div><br>
                                            <div class="input-group">
                                                <input type="text" name="alamat2" class="form-control" placeholder="" value="<?php echo $alamat2; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Poskod</label>
                                            <div class="input-group">
                                                <input type="text" name="poskod" class="form-control" placeholder="" value="<?php echo $poskod; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Bandar</label>
                                            <div class="input-group">
                                                <input type="text" name="bandar" class="form-control" placeholder="" value="<?php echo $bandar; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="journey">* Negeri</label>
                                            <select name="negeri" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                <option value='<?php echo $negeri; ?>'><?php echo $negeri; ?></option>
                                                <?php
                                                if ($negeri == '') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Johor') {
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Kedah') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Kelantan') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Melaka') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Negeri Sembilan') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Pahang') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Pulau Pinang') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Perak') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Perlis') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Selangor') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Sabah') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Sarawak') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Terengganu') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Wilayah Persekutuan Labuan') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } elseif ($negeri == 'Wilayah Persekutuan Kuala Lumpur') {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                } else {
                                                    echo "<option value='Johor'>Johor</option>";
                                                    echo "<option value='Kedah'>Kedah</option>";
                                                    echo "<option value='Kelantan'>Kelantan</option>";
                                                    echo "<option value='Melaka'>Melaka</option>";
                                                    echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                    echo "<option value='Pahang'>Pahang</option>";
                                                    echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                    echo "<option value='Perak'>Perak</option>";
                                                    echo "<option value='Perlis'>Perlis</option>";
                                                    echo "<option value='Selangor'>Selangor</option>";
                                                    echo "<option value='Sabah'>Sabah</option>";
                                                    echo "<option value='Sarawak'>Sarawak</option>";
                                                    echo "<option value='Terengganu'>Terengganu</option>";
                                                    echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                    echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="journey">* Status Menetap</label>
                                            <select name="status" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                <option value='<?php echo $status; ?>'><?php echo $status; ?></option>
                                                <?php
                                                if ($status == '') {
                                                    echo "<option value='Sewa'>Sewa</option>";
                                                    echo "<option value='Sendiri'>Sendiri</option>";
                                                } elseif ($status == 'Sendiri') {
                                                    echo "<option value='Sewa'>Sewa</option>";
                                                } else {
                                                    echo "<option value='Sendiri'>Sendiri</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tel Rumah (Jika Ada)</label>
                                            <div class="input-group">
                                                <input type="text" name="tel_rumah" class="form-control" value="<?php echo $tel_rumah; ?>" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tel Bimbit (Jika Ada)</label>
                                            <div class="input-group">
                                                <input type="text" name="tel_hp" class="form-control" value="<?php echo $tel_hp; ?>" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Kawasan Kariah</label>
                                            <select name="kawasan" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                <option value='<?php echo $kawasan; ?>'><?php echo $kawasan; ?></option>
                                                <?php
                                                if ($kawasan == '') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Pondok Haji Majid') {
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Kg Jalan Baru') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Taman Markisa') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Pondok Hj Husin') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Lorong Panglima') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Ustaz Khir') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Kg Baru') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Lorong Datuk Madon') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Kg Pasir') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Hj Husin') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } elseif ($kawasan == 'Surau Haji Abdul Bt 18') {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                } else {
                                                    echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                    echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                    echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                    echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                    echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                    echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                    echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                    echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                    echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                    echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                    echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                                    echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Tahun Mula Menetap Dalam Kariah</label>
                                            <div class="input-group">
                                                <input type="text" name="tahun_menetap" class="form-control" placeholder="" required="" value="<?php echo $tahun_menetap; ?>" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Status Perkahwinan</label>
                                            <select name="status_perkahwinan" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                <option value='<?php echo $status_perkahwinan; ?>'><?php echo $status_perkahwinan; ?></option>
                                                <?php
                                                if ($status_perkahwinan == '') {
                                                    echo "<option value='Bujang'>Bujang</option>";
                                                    echo "<option value='Kahwin'>Kahwin</option>";
                                                    echo "<option value='Duda'>Duda</option>";
                                                    echo "<option value='Janda'>Janda</option>";
                                                    echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                } elseif ($status_perkahwinan == 'Bujang') {
                                                    echo "<option value='Kahwin'>Kahwin</option>";
                                                    echo "<option value='Duda'>Duda</option>";
                                                    echo "<option value='Janda'>Janda</option>";
                                                    echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                } elseif ($status_perkahwinan == 'Kahwin') {
                                                    echo "<option value='Bujang'>Bujang</option>";
                                                    echo "<option value='Duda'>Duda</option>";
                                                    echo "<option value='Janda'>Janda</option>";
                                                    echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                } elseif ($status_perkahwinan == 'Duda') {
                                                    echo "<option value='Bujang'>Bujang</option>";
                                                    echo "<option value='Kahwin'>Kahwin</option>";
                                                    echo "<option value='Janda'>Janda</option>";
                                                    echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                } elseif ($status_perkahwinan == 'Janda') {
                                                    echo "<option value='Bujang'>Bujang</option>";
                                                    echo "<option value='Kahwin'>Kahwin</option>";
                                                    echo "<option value='Duda'>Duda</option>";
                                                    echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                } else {
                                                    echo "<option value='Bujang'>Bujang</option>";
                                                    echo "<option value='Kahwin'>Kahwin</option>";
                                                    echo "<option value='Duda'>Duda</option>";
                                                    echo "<option value='Janda'>Janda</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Penerima Bantuan (Jika Ya, isi jenis bantuan)</label>
                                            <div class="input-group">
                                                <input type="text" name="penerima_bantuan" class="form-control" value="<?php echo $penerima_bantuan; ?>" placeholder="Kosongkan jika tiada" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Maklumat Tanggungan</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="overflow-x: auto;">
                                                    <table id="producttable" class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th>No K/P</th>
                                                                <th>Umur</th>
                                                                <th>No Tel</th>
                                                                <th>Pertalian</th>
                                                                <th>Pekerjaan</th>
                                                                <th>
                                                                    <center><button type="button" name="btn_add" class="btn btn-success btn-sm btnadd">Add</button></center>
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <?php
                                                        foreach ($row_tanggung as $item_tanggung) {
                                                            $select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id =  '{$item_tanggung['kariah_id']}' ");
                                                            $select->execute();

                                                            $row_komitment = $select->fetchAll(PDO::FETCH_ASSOC);
                                                        ?>

                                                            <tr>
                                                                <?php
                                                                echo '<td><input type="text" name="nama[]" class="form-control nama" value="' . $item_tanggung['nama'] . '" placeholder="" /></td>';
                                                                echo '<td><input type="text" name="ic[]" class="form-control ic" value="' . $item_tanggung['ic'] . '"  placeholder="" /></td>';
                                                                echo '<td><input type="text" name="umur[]" class="form-control umur" value="' . $item_tanggung['umur'] . '"  placeholder="" /></td>';
                                                                echo '<td><input type="text" name="tel[]" class="form-control tel" value="' . $item_tanggung['tel'] . '"  placeholder="" /></td>';
                                                                echo '<td><input type="text" name="pertalian[]" class="form-control pertalian" value="' . $item_tanggung['kariah_pertalian'] . '"  placeholder="" /></td>';
                                                                echo '<td><input type="text" name="khairat_pekerjaan[]" class="form-control khairat_pekerjaan" value="' . $item_tanggung['kariah_pekerjaan'] . '"  placeholder="" /></td>';
                                                                echo '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove">Remove</button></center></td>';
                                                                ?>
                                                            </tr>

                                                        <?php } ?>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div align="center">
                                    <input type="submit" name="btn_simpan" value="Simpan" class="btn btn-info">
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
                                    <li>Ruangan bertanda * wajib diisi</li>
                                    <li>Pastikan anda mendaftar di kariah surau yang betul</li>
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
    $(function() {
        $("#reservationdate").datetimepicker({
            format: "L",
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.btnadd', function() {
            var html = '';
            html += '<tr>';
            html += '<td><input type="text" name="nama[]" class="form-control nama" placeholder="" /></td>';
            html += '<td><input type="text" name="ic[]" class="form-control ic" placeholder="" /></td>';
            html += '<td><input type="text" name="umur[]" class="form-control umur" placeholder="" /></td>';
            html += '<td><input type="text" name="tel[]" class="form-control tel" placeholder="" /></td>';
            html += '<td><input type="text" name="pertalian[]" class="form-control pertalian" placeholder="" /></td>';
            html += '<td><input type="text" name="khairat_pekerjaan[]" class="form-control khairat_pekerjaan" placeholder="" /></td>';
            html += '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove">Remove</button></center></td>';
            $('#producttable').append(html);
        })

        $(document).on('click', '.btnremove', function() {
            $(this).closest('tr').remove();
            calculate(0, 0);
            $("#paid").val(0);
        })
    });
</script>

<?php
include_once 'footer.php';
?>