<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

error_reporting(0);

//fetch semula product
$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();

$select->bindParam(':kariah_name', $kariah_name);
$select->bindParam(':kariah_ic', $kariah_ic);
$select->bindParam(':user_email', $user_email);
$select->bindParam(':kariah_umur', $kariah_umur);
$select->bindParam(':jantina', $jantina);
$select->bindParam(':pekerjaan', $pekerjaan);
$select->bindParam(':alamat', $alamat);
$select->bindParam(':alamat2', $alamat2);
$select->bindParam(':poskod', $poskod);
$select->bindParam(':bandar', $bandar);
$select->bindParam(':negeri', $negeri);
$select->bindParam(':s_menetap', $s_menetap);
$select->bindParam(':tel_rumah', $tel_rumah);
$select->bindParam(':tel_hp', $tel_hp);
$select->bindParam(':kawasan', $kawasan);
$select->bindParam(':tahun_menetap', $tahun_menetap);
$select->bindParam(':status_perkahwinan', $status_perkahwinan);
$select->bindParam(':penerima_bantuan', $penerima_bantuan);
$select->bindParam(':password', $password);
$select->bindParam(':tarikh_daftar', $tarikh_daftar);
$select->bindParam(':role', $role);
$select->bindParam(':approvement', $approvement);

$row = $select->fetch(PDO::FETCH_ASSOC);

$no_ahli = $row['no_ahli'];
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
//front end display in format yg kita nak. Cuba bca balik chat dgn abg haezal
$tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
$tarikh_tamat = date('d-m-Y', strtotime($row['tarikh_expired']));
$role = $row['role'];
$approvement = $row['approvement'];

$select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id = $id");
$select->execute();
$row_tanggung = $select->fetchAll(PDO::FETCH_ASSOC);

$select3 = $pdo->prepare("SELECT * FROM penama WHERE kariah_id = $id");
$select3->execute();
$row_penama = $select3->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn_update_kariah'])) {

    $kariah_name = $_POST['kariah_name'];
    $kariah_ic = $_POST['kariah_ic'];
    $user_email = $_POST['user_email'];
    // $kariah_umur = date('Y') - $_POST['kariah_umur'];
    $kariah_umur = date('Y-m-d', strtotime($_POST['kariah_umur']));
    $jantina = $_POST['jantina'];
    $pekerjaan = $_POST['pekerjaan'];
    $alamat = $_POST['alamat'];
    $alamat2 = $_POST['alamat2'];
    $poskod = $_POST['poskod'];
    $bandar = $_POST['bandar'];
    $negeri = $_POST['negeri'];
    $s_menetap = $_POST['s_menetap'];
    $tel_rumah = $_POST['tel_rumah'];
    $tel_hp = $_POST['tel_hp'];
    $kawasan = $_POST['kawasan'];
    $tahun_menetap = $_POST['tahun_menetap'];
    $status_perkahwinan = $_POST['status_perkahwinan'];
    $penerima_bantuan = $_POST['penerima_bantuan'];
    $approvement = $_POST['approvement'];
    // $password = $_POST['password'];
    // $role = $_POST['role'];

    // $select = $pdo->prepare("SELECT password FROM ahli_kariah WHERE kariah_id = $id");
    // $select->execute();

    // $row_password = $select->fetchAll(PDO::FETCH_ASSOC);

    // $db_user_password = $row['password'];

    // if ($db_user_password != $password) {
    //     $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    // }

    //bwh ni pulak utk masuk dekat tbl_tanggung
    // $kariah_id = $_POST['kariah_id'];

    $penama_name = $_POST['penama_name'];
    $penama_ic = $_POST['penama_ic'];
    $penama_no = $_POST['penama_no'];
    $penama_email = $_POST['penama_email'];
    $penama_pass = substr($_POST['penama_ic'], 0, 6);
    $penama_pass = password_hash($penama_pass, PASSWORD_BCRYPT, array("cost" => 12));

    $ic = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_id = $id");
    $ic->execute();

    $ic1 = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = '$penama_ic' ");
    $ic1->execute();

    $ic_penama = $pdo->prepare("SELECT penama_ic FROM penama WHERE penama_ic='$penama_ic'");
    $ic_penama->execute();

    $email_penama = $pdo->prepare("SELECT penama_email FROM penama WHERE penama_email='$penama_email'");
    $email_penama->execute();

    $email_penama1 = $pdo->prepare("SELECT penama_email FROM penama WHERE penama_email='$user_email'");
    $email_penama1->execute();

    $select_email1 = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email='$penama_email'");
    $select_email1->execute();

    $sql = "SELECT * FROM penama WHERE penama_ic = :penama_ic ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':penama_ic', $kariah_ic);
    $stmt->execute();
    $penamaici = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ic_penama->rowCount() > 0) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "No kad pengenalan penama telah berdaftar",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($email_penama->rowCount() > 0) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Emel penama telah berdaftar",
                text: "Sila masukkan emel lain",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($penama_ic == $kariah_ic) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "No K/P Penama Sama Dengan No K/P Ahli",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($user_email == $penama_email) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Tidak Sah",
                text: "Email Adalah Sama",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    }
    // elseif ($select_email1->rowCount() > 0) {
    //     echo '<script type="text/javascript">
    //         jQuery(function validation() {
    //             swal({
    //                 title: "Tidak Sah",
    //                 text: "Email Tersebut Telah Berdaftar Sebagai Ahli Kariah",
    //                 icon: "warning",
    //                 button: "Ok",
    //               });
    //         });
    //         </script>';
    // }
    elseif ($penamaici > 0) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "No K/P Ahli Tidak Sah",
                text: "No K/P Tersebut Telah Berdaftar Sebagai Penama",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($ic1->rowCount() > 0) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "No K/P Penama Tidak Sah",
                    text: "No K/P Tersebut Telah Berdaftar Sebagai Ahli Kariah",
                    icon: "warning",
                    button: "Ok",
                });
            });
            </script>';
    } elseif ($email_penama1->rowCount() > 0) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Tidak Sah",
                text: "Email Tersebut Telah Berdaftar Sebagai Penama",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } else {

        $nama = $_POST['nama'];
        $ic = $_POST['ic'];
        $umur = $_POST['umur'];
        $tel = $_POST['tel'];
        $kariah_pertalian = $_POST['kariah_pertalian'];
        $kariah_pekerjaan = $_POST['kariah_pekerjaan'];
        $mati_tanggung = $_POST['mati_tanggung'];

        $delete_tanggungan = $pdo->prepare("DELETE FROM tbl_tanggung WHERE kariah_id = $id");
        $delete_tanggungan->execute();

        $update_kariah = $pdo->prepare("UPDATE ahli_kariah SET kariah_name=:kariah_name, kariah_ic=:kariah_ic, user_email=:user_email, kariah_umur=:kariah_umur, jantina=:jantina, pekerjaan=:pekerjaan, alamat=:alamat, alamat2=:alamat2,
        poskod=:poskod, bandar=:bandar, negeri=:negeri, s_menetap=:s_menetap, tel_rumah=:tel_rumah, tel_hp=:tel_hp, kawasan=:kawasan, tahun_menetap=:tahun_menetap, status_perkahwinan=:status_perkahwinan, penerima_bantuan=:penerima_bantuan, approvement=:approvement WHERE kariah_id = $id ");

        $update_kariah->bindParam(':kariah_name', $kariah_name);
        $update_kariah->bindParam(':kariah_ic', $kariah_ic);
        $update_kariah->bindParam(':user_email', $user_email);
        $update_kariah->bindParam(':kariah_umur', $kariah_umur);
        $update_kariah->bindParam(':jantina', $jantina);
        $update_kariah->bindParam(':pekerjaan', $pekerjaan);
        $update_kariah->bindParam(':alamat', $alamat);
        $update_kariah->bindParam(':alamat2', $alamat2);
        $update_kariah->bindParam(':poskod', $poskod);
        $update_kariah->bindParam(':bandar', $bandar);
        $update_kariah->bindParam(':negeri', $negeri);
        $update_kariah->bindParam(':s_menetap', $s_menetap);
        $update_kariah->bindParam(':tel_rumah', $tel_rumah);
        $update_kariah->bindParam(':tel_hp', $tel_hp);
        $update_kariah->bindParam(':kawasan', $kawasan);
        $update_kariah->bindParam(':tahun_menetap', $tahun_menetap);
        $update_kariah->bindParam(':status_perkahwinan', $status_perkahwinan);
        $update_kariah->bindParam(':penerima_bantuan', $penerima_bantuan);
        $update_kariah->bindParam(':approvement', $approvement);
        // $update_kariah->bindParam(':password', $password);

        // $update_penama = $pdo->prepare("UPDATE penama SET penama_name=:penama_name, penama_ic=:penama_ic, penama_no=:penama_no WHERE kariah_id = $id ");
        // $update_penama->bindParam(':penama_name', $penama_name);
        // $update_penama->bindParam(':penama_ic', $penama_ic);
        // $update_penama->bindParam(':penama_no', $penama_no);

        if ($update_kariah->execute()) {

            $kariah_id = $pdo->lastInsertId();
            if ($kariah_id != null) {
                for ($i = 0; $i < count($nama); $i++) {
                    $insert = $pdo->prepare("INSERT INTO tbl_tanggung(kariah_id, nama, ic, umur, tel, kariah_pertalian, kariah_pekerjaan, mati_tanggung)
                        VALUES(:kariah_id, :nama, :ic, :umur, :tel, :kariah_pertalian, :kariah_pekerjaan, :mati_tanggung)");
                    $insert->bindParam(':kariah_id', $id);
                    $insert->bindParam(':nama', $nama[$i]);
                    $insert->bindParam(':ic', $ic[$i]);
                    $insert->bindParam(':umur', $umur[$i]);
                    $insert->bindParam(':tel', $tel[$i]);
                    $insert->bindParam(':kariah_pertalian', $kariah_pertalian[$i]);
                    $insert->bindParam(':kariah_pekerjaan', $kariah_pekerjaan[$i]);
                    $insert->bindParam(':mati_tanggung', $mati_tanggung[$i]);
                    $insert->execute();
                }
            }

            if ($row_penama['kariah_id'] == null) {
                $insert = $pdo->prepare("INSERT INTO penama(kariah_id, penama_name, penama_ic, penama_no, penama_email, penama_pass)
            VALUES(:kariah_id, :penama_name, :penama_ic, :penama_no, :penama_email, :penama_pass)");

                $insert->bindParam(':kariah_id', $id);
                $insert->bindParam(':penama_name', $penama_name);
                $insert->bindParam(':penama_ic', $penama_ic);
                $insert->bindParam(':penama_no', $penama_no);
                $insert->bindParam(':penama_email', $penama_email);
                $insert->bindParam(':penama_pass', $penama_pass);
                $insert->execute();
            }
            echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Berjaya Ubah",
                            icon: "success",
                            button: "Ok",
                          }).then(function() {
                              window.location = "/khairat/admin/ahli-kariah";
                          });
                    });
                    </script>';
            $activity = "ahli {$kariah_name} berjaya dikemaskini";
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
                            title: "Gagal Ubah",
                            icon: "error",
                            button: "Ok",
                          });
                    });
                    </script>';
        }
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
                                    <label>No Ahli</span></label>
                                    <div class="input-group">
                                        <input type="text" name="kariah_name" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $no_ahli; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Nama Ahli</span></label>
                                    <div class="input-group">
                                        <input type="text" name="kariah_name" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $kariah_name; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">No. Kad Pengenalan / No. Pasport</span></label>
                                    <div class="input-group">
                                        <input type="text" name="kariah_ic" id="kariah_ic" class="form-control" placeholder="" value="<?php echo $kariah_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Tarikh Lahir</span></label>
                                    <input type="date" name="kariah_umur" value="<?php echo $kariah_umur; ?>" class="form-control" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Emel</label>
                                    <div class="input-group">
                                        <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Kosongkan Jika Tiada" value="<?php echo $user_email; ?>" oninvalid="InvalidEmail(this);" />
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($kariah_umur == NULL) {
                                echo '
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label style="color:red;">* <span style="color:black;">Umur</span></label>
                                            <div class="input-group">
                                                <input type="text" name="umur" class="form-control" placeholder="Belum Dikemaskini" value="" readonly />
                                            </div>
                                        </div>
                                    </div>';
                            } else {
                                $umurkariah = date('Y') - $kariah_umur;
                                echo '
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label style="color:red;">* <span style="color:black;">Umur</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="umur" class="form-control" placeholder="" value=" ' . $umurkariah . ' " readonly  />
                                                </div>
                                            </div>
                                        </div>
                                        ';
                            }

                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="journey">Pengesahan Khairat Kematian</label>
                                    <select name="approvement" class="form-control" id="">
                                        <option value='<?php echo $approvement; ?>'><?php echo $approvement; ?></option>
                                        <?php
                                        if ($approvement == 'Belum Daftar') {
                                            echo "<option value='Telah Daftar'>Telah Daftar</option>";
                                            echo "<option value='Digantung'>Gantung Ahli</option>";
                                        } elseif ($approvement == 'Digantung') {
                                            echo "<option value='Telah Daftar'>Telah Daftar</option>";
                                            echo "<option value='Belum Daftar'>Belum Daftar</option>";
                                        } else {
                                            echo "<option value='Belum Daftar'>Belum Daftar</option>";
                                            echo "<option value='Digantung'>Gantung Ahli</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Jantina</span></label>
                                    <select name="jantina" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                        <?php
                                        if ($jantina == NULL) {
                                        ?>
                                            <option value='' disabled selected>Sila Pilih</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value='<?php echo $jantina; ?>'><?php echo $jantina; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($jantina == '') {
                                            // echo "<option value='' disabled selected>Sila Pilih</option>";
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
                                    <label>Pekerjaan</label>
                                    <div class="input-group">
                                        <input type="text" name="pekerjaan" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $pekerjaan; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Alamat</span></label>
                                    <div class="input-group">
                                        <input type="text" name="alamat" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $alamat; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div><br>
                                    <div class="input-group">
                                        <input type="text" name="alamat2" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $alamat2; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Poskod</span></label>
                                    <div class="input-group">
                                        <input type="text" name="poskod" class="form-control" placeholder="" value="<?php echo $poskod; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Bandar</span></label>
                                    <div class="input-group">
                                        <input type="text" name="bandar" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $bandar; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Negeri</span></label>
                                    <select name="negeri" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                        <?php
                                        if ($negeri == NULL) {
                                        ?>
                                            <option value='' disabled selected>Sila Pilih</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value='<?php echo $negeri; ?>'><?php echo $negeri; ?></option>
                                        <?php
                                        }
                                        ?>
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
                                    <label style="color:red;">* <span style="color:black;">Status Menetap</span></label>
                                    <select name="s_menetap" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                        <?php
                                        if ($s_menetap == NULL) {
                                        ?>
                                            <option value='' disabled selected>Sila Pilih</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value='<?php echo $s_menetap; ?>'><?php echo $s_menetap; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($s_menetap == '') {
                                            echo "<option value='Sewa'>Sewa</option>";
                                            echo "<option value='Sendiri'>Sendiri</option>";
                                        } elseif ($s_menetap == 'Sendiri') {
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
                                        <input type="text" name="tel_hp" id="tel_hp" class="form-control" value="<?php echo $tel_hp; ?>" placeholder="Tiada Dash (-)" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhone(this);" oninput="InvalidPhone(this);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Kawasan Kariah</span></label>
                                    <select name="kawasan" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                        <?php
                                        if ($kawasan == NULL) {
                                        ?>
                                            <option value='' disabled selected>Sila Pilih</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value='<?php echo $kawasan; ?>'><?php echo $kawasan; ?></option>
                                        <?php
                                        }
                                        ?>
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                        } elseif ($kawasan == 'Surau Kg Titi Lahar') {
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
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                        } elseif ($kawasan == 'Surau Kg Tok Kau') {
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                        } elseif ($kawasan == 'Taman Keranji') {
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                        } elseif ($kawasan == 'Taman Delima') {
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                        } elseif ($kawasan == 'Taman Halaman Damai') {
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                        } elseif ($kawasan == 'Taman Desa Indah') {
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                        } elseif ($kawasan == 'Perumahan Awam (Rumah Murah)') {
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
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
                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Mula Menetap Dalam Kariah</label>
                                    <div class="input-group">
                                        <input type="text" name="tahun_menetap" class="form-control" placeholder="Kosongkan Jika Luar Kawasan" value="<?php echo $tahun_menetap; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Status Perkahwinan</span></label>
                                    <select name="status_perkahwinan" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                        <?php
                                        if ($status_perkahwinan == NULL) {
                                        ?>
                                            <option value='' disabled selected>Sila Pilih</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value='<?php echo $status_perkahwinan; ?>'><?php echo $status_perkahwinan; ?></option>
                                        <?php
                                        }
                                        ?>
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
                                        <input type="text" name="penerima_bantuan" id="penerima_bantuan" class="form-control" placeholder="Kosongkan jika tiada" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $select = $pdo->prepare("SELECT * FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE penama.kariah_id = $id");
                $select->execute();
                $row = $select->fetch(PDO::FETCH_ASSOC);
                $penama_id = $row['penama_id'];


                if ($penama_id == true) {
                } else {
                ?>

                    <!-- div card kedua -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Wajib: Butiran penama untuk tuntutan khairat kematian</h3>
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
                                        <label style="color:red;">* <span style="color:black;">Nama</span></label>
                                        <div class="input-group">
                                            <input type="text" name="penama_name" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $penama_name; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color:red;">* <span style="color:black;">No Kad Pengenalan / No Pasport</span></label>
                                        <div class="input-group">
                                            <input type="text" name="penama_ic" id="penama_ic" class="form-control" placeholder="" value="<?php echo $penama_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color:red;">* <span style="color:black;">Emel</span></label>
                                        <div class="input-group">
                                            <input type="email" id="penama_email" name="penama_email" class="form-control" placeholder="" value="<?php echo $penama_email; ?>" required="required" oninvalid="InvalidMsg(this);" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color:red;">* <span style="color:black;">Tel Bimbit</span></label>
                                        <div class="input-group">
                                            <input type="text" name="penama_no" id="penama_no" class="form-control" value="<?php echo $penama_no; ?>" placeholder="Tiada Dash (-)" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhonePenama(this);" oninput="InvalidPhonePenama(this);" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!-- div card ketiga -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Maklumat Tanggungan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="overflow-x: auto;">
                                    <table id="producttable" class="table table">
                                        <thead>
                                            <tr>
                                                <!-- <th>Nama</th>
                                                                <th>No K/P</th>
                                                                <th>Umur</th>
                                                                <th>No Tel</th>
                                                                <th>Pertalian</th>
                                                                <th>Pekerjaan</th>
                                                                <th>
                                                                    <center><button type="button" name="btn_add" class="btn btn-success btn-sm btnadd">Add</button></center>
                                                                </th> -->

                                                <input type="button" name="btn_add" class="d-none btn-success d-md-table-cell btnadd" value="Tambah" style="margin-left: auto; display: block;">
                                                <input type="button" name="btn_add" class="d-md-none d-sm btn-success btnadd1" value="Tambah" style="margin-left: auto; display: block;">

                                            </tr>
                                        </thead>
                                        <?php
                                        $useragent = $_SERVER['HTTP_USER_AGENT'];
                                        if ($row_tanggung == NULL) {
                                            foreach ($_POST['nama'] as $key => $item) {
                                                // $nama = $_POST['nama'];
                                                $ic = $_POST['ic'][$key];
                                                $umur = $_POST['umur'][$key];
                                                $tel = $_POST['tel'][$key];
                                                $kariah_pertalian = $_POST['kariah_pertalian'][$key];
                                                $kariah_pekerjaan = $_POST['kariah_pekerjaan'][$key];
                                                $mati_tanggung = $_POST['mati_tanggung'][$key];
                                        ?>
                                                <tr>
                                                    <?php
                                                    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
                                                        echo '<td class="d-md-none d-sm-table-cell"><hr><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" value="' . $item . '" placeholder="Nama" /><br><input type="text" name="ic[]" id="ic" class="form-control ic" value="' . $ic . '"  placeholder="No K/P" /><br><input type="text" name="tel[]" class="form-control tel" value="' . $tel . '" placeholder="No Tel (Jika Ada)" /><br><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" value="' . $kariah_pertalian . '"  placeholder="Pertalian" /><br><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" value="' . $kariah_pekerjaan . '"  placeholder="Pekerjaan" /><input type="hidden" name="umur[]" class="form-control umur" value="' . $umur . '" placeholder="Umur" /><input type="hidden" name="mati_tanggung[]" id="mati_tanggung" class="form-control mati_tanggung" value="' . $mati_tanggung . '"  placeholder=""  /><br><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></td>';
                                                    } else {
                                                        echo '<td class="d-none d-md-table-cell col-3"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" value="' . $item . '" placeholder="Nama" /></td>';
                                                        echo '<td class="d-none d-md-table-cell col-2"><input type="text" name="ic[]" id="ic" class="form-control ic" value="' . $ic . '"  placeholder="No K/P" /></td>';
                                                        echo '<td class="d-none d-md-table-cell col-2"><input type="text" name="tel[]" class="form-control tel" value="' . $tel . '"  placeholder="No Tel (Jika Ada)"  /></td>';
                                                        echo '<td class="d-none d-md-table-cell col-2"><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" value="' . $kariah_pertalian . '"  placeholder="Pertalian"/></td>';
                                                        echo '<td class="d-none d-md-table-cell col-2"><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" value="' . $kariah_pekerjaan . '"  placeholder="Pekerjaan"  /></td>';
                                                        echo '<input type="hidden" name="umur[]" class="form-control umur" id="umur" value="' . $umur . '"  placeholder=""  />';
                                                        echo '<input type="hidden" name="mati_tanggung[]" id="mati_tanggung" class="form-control mati_tanggung" value="' . $mati_tanggung . '"  placeholder=""  />';
                                                        echo '<td class="d-none d-md-table-cell"><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></center></td>';
                                                    }

                                                    ?>
                                                </tr>
                                            <?php } ?>

                                            <?php
                                        } else {
                                            foreach ($row_tanggung as $item_tanggung) {
                                                $select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id =  '{$item_tanggung['kariah_id']}' ");
                                                $select->execute();
                                                $row_komitment = $select->fetchAll(PDO::FETCH_ASSOC);
                                            ?>

                                                <tr>
                                                    <?php
                                                    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
                                                        echo '<td class="d-md-none d-sm-table-cell"><hr><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" value="' . $item_tanggung['nama'] . '" placeholder="Nama" /><br><input type="text" name="ic[]" id="ic" class="form-control ic" value="' . $item_tanggung['ic'] . '"  placeholder="No K/P" /><br><input type="text" name="tel[]" class="form-control tel" value="' . $item_tanggung['tel'] . '" placeholder="No Tel (Jika Ada)" /><br><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" value="' . $item_tanggung['kariah_pertalian'] . '"  placeholder="Pertalian" /><br><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" value="' . $item_tanggung['kariah_pekerjaan'] . '"  placeholder="Pekerjaan" /><input type="hidden" name="umur[]" class="form-control umur" value="' . $item_tanggung['umur'] . '" placeholder="Umur" /><input type="hidden" name="mati_tanggung[]" id="mati_tanggung" class="form-control mati_tanggung" value="' . $item_tanggung['mati_tanggung'] . '"  placeholder=""  /><br><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></td>';
                                                    } else {
                                                        echo '<td class="d-none d-md-table-cell col-3"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" value="' . $item_tanggung['nama'] . '" placeholder="Nama" /></td>';
                                                        echo '<td class="d-none d-md-table-cell col-2"><input type="text" name="ic[]" id="ic" class="form-control ic" value="' . $item_tanggung['ic'] . '"  placeholder="No K/P" /></td>';
                                                        echo '<td class="d-none d-md-table-cell col-2"><input type="text" name="tel[]" class="form-control tel" value="' . $item_tanggung['tel'] . '"  placeholder="No Tel (Jika Ada)"  /></td>';
                                                        echo '<td class="d-none d-md-table-cell col-2"><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" value="' . $item_tanggung['kariah_pertalian'] . '"  placeholder="Pertalian"/></td>';
                                                        echo '<td class="d-none d-md-table-cell col-2"><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" value="' . $item_tanggung['kariah_pekerjaan'] . '"  placeholder="Pekerjaan"  /></td>';
                                                        echo '<input type="hidden" name="umur[]" class="form-control umur" id="umur" value="' . $item_tanggung['umur'] . '"  placeholder=""  />';
                                                        echo '<input type="hidden" name="mati_tanggung[]" id="mati_tanggung" class="form-control mati_tanggung" value="' . $item_tanggung['mati_tanggung'] . '"  placeholder=""  />';
                                                        echo '<td class="d-none d-md-table-cell"><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></center></td>';
                                                    }
                                                    ?>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div align="center">
                    <input type="submit" name="btn_update_kariah" value="Kemaskini" class="btn btn-info">
                </div>
                <br>
            </form>
        </div>
    </section>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>

<script>
    $(function() {
        $("#reservationdate").datetimepicker({
            format: "L",
        });
    });

    function InvalidEmail(textbox) {

        if (textbox.validity.typeMismatch) {
            textbox.setCustomValidity('Isi format yang betul');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }

    function InvalidMsg(textbox) {

        if (textbox.value == '') {
            textbox.setCustomValidity('Wajib isi');
        } else if (textbox.validity.typeMismatch) {
            textbox.setCustomValidity('Isi format yang betul');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }

    function InvalidPhone(textbox) {

        if (textbox.validity.patternMismatch) {
            textbox.setCustomValidity('Tiada Dash(-)');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }

    function InvalidPhonePenama(textbox) {

        if (textbox.value == '') {
            textbox.setCustomValidity('Wajib isi');
        } else if (textbox.validity.patternMismatch) {
            textbox.setCustomValidity('Tiada Dash(-)');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }

    $(document).ready(function() {
        $(document).on('click', '.btnadd1', function() {
            var html = '';

            html += '<tr>';

            html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" placeholder="Nama" /><br><input type="text" name="ic[]" id="ic" class="form-control ic" placeholder="No K/P" /><br><input type="text" name="tel[]" class="form-control tel" placeholder="No Tel (Jika Ada)" /><br><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" placeholder="Pertalian" /><br><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" placeholder="Pekerjaan" /><input type="hidden" name="umur[]" class="form-control umur" placeholder="Umur" /><input type="hidden" name="mati_tanggung[]" value="tak" id="mati_tanggung" class="form-control mati_tanggung" placeholder="" /><br><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></td>';
            // html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="ic[]" class="form-control ic" placeholder="No K/P" /></td>';
            // html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="ic[]" class="form-control ic" placeholder="No K/P" /></td>';

            // html += '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></center></td>';
            $('#producttable').append(html);

            $('.ic').mask('000000-00-0000');

            // $('#nama').keyup(function() {
            //     $(this).val($(this).val().toUpperCase());
            // });

            // $('#kariah_pertalian').keyup(function() {
            //     $(this).val($(this).val().toUpperCase());
            // });

            // $('#kariah_pekerjaan').keyup(function() {
            //     $(this).val($(this).val().toUpperCase());
            // });
        })

        $(document).on('click', '.btnremove', function() {
            $(this).closest('tr').remove();
            calculate(0, 0);
            $("#paid").val(0);
        })
    });

    $(document).ready(function() {
        $(document).on('click', '.btnadd', function() {
            var html = '';

            html += '<tr>';
            html += '<td class="d-none d-md-table-cell col-3"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" placeholder="Nama" /></td>';
            html += '<td class="d-none d-md-table-cell col-2"><input type="text" name="ic[]" id="ic" class="form-control ic" placeholder="No K/P" /></td>';
            html += '<td class="d-none d-md-table-cell col-2"><input type="text" name="tel[]" class="form-control tel" placeholder="No Tel (Jika Ada)" /></td>';
            html += '<td class="d-none d-md-table-cell col-2"><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" placeholder="Pertalian" /></td>';
            html += '<td class="d-none d-md-table-cell col-2"><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" placeholder="Pekerjaan" /></td>';
            html += '<input type="hidden" name="umur[]" id="umur" class="form-control umur" placeholder="" />';
            html += '<input type="hidden" name="mati_tanggung[]" value="tak" id="mati_tanggung" class="form-control mati_tanggung" placeholder="" />';

            html += '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></center></td>';
            $('#producttable').append(html);

            //terpaksa disable sat atas kehendak nurin
            // $('.ic').mask('000000-00-0000');

            // $('#nama').keyup(function() {
            //     $(this).val($(this).val().toUpperCase());
            // });

            // $('#kariah_pertalian').keyup(function() {
            //     $(this).val($(this).val().toUpperCase());
            // });

            // $('#kariah_pekerjaan').keyup(function() {
            //     $(this).val($(this).val().toUpperCase());
            // });
        })

        $(document).on('click', '.btnremove', function() {
            $(this).closest('tr').remove();
            calculate(0, 0);
            $("#paid").val(0);
        })
    });

    $(document).ready(function() {
        var masks = ["A00000000000", '000000-00-0000'];
        var options = {
            onKeyPress: function(cep, e, field, options) {
                var mask = (cep.length == 12) ? masks[1] : masks[0];
                $('#kariah_ic').mask(mask, options);
            }
        };

        $('#kariah_ic').mask(masks[1], options);
    });

    $(document).ready(function() {
        var masks = ["A00000000000", '000000-00-0000'];
        var options = {
            onKeyPress: function(cep, e, field, options) {
                var mask = (cep.length == 12) ? masks[1] : masks[0];
                $('#penama_ic').mask(mask, options);
            }
        };

        $('#penama_ic').mask(masks[1], options);
    });

    //terpaksa disable sat atas kehendak nurin
    // $(document).ready(function() {
    //     $('.ic').mask('000000-00-0000');
    // });

    // $(document).ready(function() {
    //     $('#nama').keyup(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // });

    // $(document).ready(function() {
    //     $('#kariah_pertalian').keyup(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // });

    // $(document).ready(function() {
    //     $('#kariah_pekerjaan').keyup(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // });

    $(document).ready(function() {
        $('#penerima_bantuan').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    });
</script>

<?php
include_once 'footer.php';
?>