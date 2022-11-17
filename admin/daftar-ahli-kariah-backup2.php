<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$select = $pdo->prepare("SELECT * FROM ahli_kariah ORDER BY kariah_id DESC");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$lastid = $row['no_ahli'];
// if ($lastid == " ") {
//     $empid = "000001";
// } else {
//     $empid = substr($lastid, 3);
//     $empid = intval($empid);
//     $empid = "000" . ($empid + 1);
// }
if ($lastid == null) {
    $firstReg = 0;
    $memberId = $firstReg + 1;
    if ($memberId < 10) {
        $empid = '00000' . $memberId;
    } elseif ($memberId < 100) {
        $empid = '0000' . $memberId;
    } elseif ($memberId < 1000) {
        $empid = '000' . $memberId;
    }
} else {
    $memberId = $lastid + 1;
    if ($memberId < 10) {
        $empid = '00000' . $memberId;
    } elseif ($memberId < 100) {
        $empid = '0000' . $memberId;
    } elseif ($memberId < 1000) {
        $empid = '000' . $memberId;
    } elseif ($memberId < 10000) {
        $empid = '00' . $memberId;
    }
}

// $select3 = $pdo->prepare("SELECT * FROM penama WHERE kariah_id = $id");
// $select3->execute();
// $row_penama = $select3->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn_simpan'])) {

    $no_ahli = $_POST['no_ahli'];
    $kariah_name = $_POST['kariah_name'];
    $kariah_ic = $_POST['kariah_ic'];
    $user_email = $_POST['user_email'];
    // $kariah_umur = date('Y') - $_POST['kariah_umur'];
    $kariah_umur = date('Y-m-d', strtotime($_POST['kariah_umur']));
    //date('Y') - $_POST['umur'];
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
    //$password = $_POST['password'];
    $password = str_replace('-', '', $_POST['kariah_ic']);
    $tarikh_daftar = date("Y-m-d");
    // strtotime($_POST['tarikh_daftar'] = $tarikh_daftar);
    $role = $_POST['role'];
    $approvement = $_POST['approvement'];
    $mati = $_POST['mati'];
    $token = $_POST['token'];
    $status_sms = $_POST['status_sms'];

    $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    if (isset($_POST['kariah_ic'])) {

        $select_email = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email='$user_email'");
        $select_email->execute();

        $ic = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic='$kariah_ic'");
        $ic->execute();

        if ($ic->rowCount() > 0) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "No kad pengenalan telah berdaftar",
                    icon: "warning",
                    button: "Ok",
                  });
            });
            </script>';
        } elseif ($select_email->rowCount() > 0) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Emel telah berdaftar",
                    text: "Sila masukkan emel lain",
                    icon: "warning",
                    button: "Ok",
                  });
            });
            </script>';
        } else {

            //bwh ni pulak utk masuk dekat tbl_tanggung
            $nama = $_POST['nama'];
            $ic = $_POST['ic'];
            $umur = $_POST['umur'];
            $tel = $_POST['tel'];
            $kariah_pertalian = $_POST['kariah_pertalian'];
            $kariah_pekerjaan = $_POST['kariah_pekerjaan'];
            $mati_tanggung = $_POST['mati_tanggung'];

            //table penama
            $penama_name = $_POST['penama_name'];
            $penama_ic = $_POST['penama_ic'];
            $penama_no = $_POST['penama_no'];
            $penama_email = $_POST['penama_email'];
            $penama_pass = substr($_POST['penama_ic'], 0, 6);
            $penama_pass = password_hash($penama_pass, PASSWORD_BCRYPT, array("cost" => 12));


            $insert = $pdo->prepare("INSERT INTO ahli_kariah(no_ahli, kariah_name, kariah_ic, user_email, kariah_umur, jantina, pekerjaan, alamat, alamat2, poskod, bandar, negeri, s_menetap, tel_rumah, tel_hp, kawasan, tahun_menetap, status_perkahwinan, penerima_bantuan, password, tarikh_daftar, role, approvement, mati, token, status_sms)
            VALUES(:no_ahli, :kariah_name, :kariah_ic, :user_email, :kariah_umur, :jantina, :pekerjaan, :alamat, :alamat2, :poskod, :bandar, :negeri, :s_menetap, :tel_rumah, :tel_hp, :kawasan, :tahun_menetap, :status_perkahwinan, :penerima_bantuan, :password, :tarikh_daftar, :role, :approvement, :mati, :token, 0)");

            $insert->bindParam(':no_ahli', $no_ahli);
            $insert->bindParam(':kariah_name', $kariah_name);
            $insert->bindParam(':kariah_ic', $kariah_ic);
            $insert->bindParam(':user_email', $user_email);
            $insert->bindParam(':kariah_umur', $kariah_umur);
            $insert->bindParam(':jantina', $jantina);
            $insert->bindParam(':pekerjaan', $pekerjaan);
            $insert->bindParam(':alamat', $alamat);
            $insert->bindParam(':alamat2', $alamat2);
            $insert->bindParam(':poskod', $poskod);
            $insert->bindParam(':bandar', $bandar);
            $insert->bindParam(':negeri', $negeri);
            $insert->bindParam(':s_menetap', $s_menetap);
            $insert->bindParam(':tel_rumah', $tel_rumah);
            $insert->bindParam(':tel_hp', $tel_hp);
            $insert->bindParam(':kawasan', $kawasan);
            $insert->bindParam(':tahun_menetap', $tahun_menetap);
            $insert->bindParam(':status_perkahwinan', $status_perkahwinan);
            $insert->bindParam(':penerima_bantuan', $penerima_bantuan);
            $insert->bindParam(':password', $password);
            $insert->bindParam(':tarikh_daftar', $tarikh_daftar);
            $insert->bindParam(':role', $role);
            $insert->bindParam(':approvement', $approvement);
            $insert->bindParam(':mati', $mati);
            $insert->bindParam(':token', $token);
            //$insert->bindParam(':status_sms', $status_sms);

            if ($insert->execute()) {
                echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Pendaftaran Berjaya",
                        icon: "success",
                        button: "Ok",
                      }).then(function() {
                          window.location = "ahli-kariah.php";
                      });
                });
                </script>';
                // header('refresh:2;kariahlist.php');
            } else {
                echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Pendaftaran Gagal",
                        icon: "error",
                        button: "Ok",
                      });
                });
                </script>';
            }

            $kariah_id = $pdo->lastInsertId();
            if ($kariah_id != null) {

                for ($i = 0; $i < count($nama); $i++) {
                    $insert = $pdo->prepare("INSERT INTO tbl_tanggung(kariah_id, nama, ic, umur, tel, kariah_pertalian, kariah_pekerjaan, mati_tanggung)
                    VALUES(:kariah_id, :nama, :ic, :umur, :tel, :kariah_pertalian, :kariah_pekerjaan, :mati_tanggung)");

                    $insert->bindParam(':kariah_id', $kariah_id);
                    $insert->bindParam(':nama', $nama[$i]);
                    $insert->bindParam(':ic', $ic[$i]);
                    $insert->bindParam(':umur', $umur[$i]);
                    $insert->bindParam(':tel', $tel[$i]);
                    $insert->bindParam(':kariah_pertalian', $kariah_pertalian[$i]);
                    $insert->bindParam(':kariah_pekerjaan', $kariah_pekerjaan[$i]);
                    $insert->bindParam(':mati_tanggung', $mati_tanggung[$i]);

                    $insert->execute();
                }

                //table penama
                $insert = $pdo->prepare("INSERT INTO penama(kariah_id, penama_name, penama_ic, penama_no, penama_email, penama_pass)
                VALUES(:kariah_id, :penama_name, :penama_ic, :penama_no, :penama_email, :penama_pass)");

                $insert->bindParam(':kariah_id', $kariah_id);
                $insert->bindParam(':penama_name', $penama_name);
                $insert->bindParam(':penama_ic', $penama_ic);
                $insert->bindParam(':penama_no', $penama_no);
                $insert->bindParam(':penama_email', $penama_email);
                $insert->bindParam(':penama_pass', $penama_pass);
                $insert->execute();

                $activity = "ahli {$kariah_name} berjaya didaftarkan";
                $time_loged = date("Y-m-d H:i:s", strtotime("now"));
                $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
                $stmt->bindParam(1, $_SESSION['user_id']);
                $stmt->bindParam(2, $activity);
                $stmt->bindParam(3, $time_loged);
                $stmt->execute();
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
<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <form action="" method="POST" name="">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pendaftaran Ahli Kariah</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $kariah_name = $_POST['kariah_name'];
                        $kariah_ic = $_POST['kariah_ic'];
                        $kariah_umur = $_POST['kariah_umur'];
                        $user_email = $_POST['user_email'];
                        $pekerjaan = $_POST['pekerjaan'];
                        $alamat = $_POST['alamat'];
                        $alamat2 = $_POST['alamat2'];
                        $poskod = $_POST['poskod'];
                        $bandar = $_POST['bandar'];
                        $tel_rumah = $_POST['tel_rumah'];
                        $tel_hp = $_POST['tel_hp'];
                        $tahun_menetap = $_POST['tahun_menetap'];
                        $penerima_bantuan = $_POST['penerima_bantuan'];

                        $penama_name = $_POST['penama_name'];
                        $penama_ic = $_POST['penama_ic'];
                        $penama_no = $_POST['penama_no'];
                        $penama_email = $_POST['penama_email'];
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Ahli :- Auto generate</span></label>
                                    <div class="input-group">
                                        <input type="text" name="no_ahli" class="form-control" value="<?php echo $empid; ?>" placeholder="Contoh : 0XXXXX" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Nama Ahli</span></label>
                                    <div class="input-group">
                                        <input type="text" name="kariah_name" style="text-transform: uppercase" class="form-control" value="<?php echo $kariah_name; ?>" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">No K/P</span></label>
                                    <div class="input-group">
                                        <input type="text" name="kariah_ic" id="kariah_ic" class="form-control" placeholder="" value="<?php echo $kariah_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Tarikh Lahir</span></label>
                                    <input type="date" name="kariah_umur" class="form-control" required="" value="<?php echo $kariah_umur; ?>" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Emel</label>
                                    <div class="input-group">
                                        <!-- <input type="email" name="user_email" class="form-control" placeholder="Kosongkan Jika Tiada" /> -->
                                        <input type="email" id="user_email" name="user_email" class="form-control" value="<?php echo $user_email; ?>" placeholder="Kosongkan Jika Tiada" oninvalid="InvalidEmail(this);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Jantina</span></label>
                                    <select name="jantina" class="form-control">
                                        <option value="" disabled selected>Sila Pilih</option>
                                        <option value="Lelaki"> Lelaki</option>
                                        <option value="Perempuan"> Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <div class="input-group">
                                        <input type="text" name="pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" value="<?php echo $pekerjaan; ?>" class="form-control" placeholder="Kosongkan Jika Tiada" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Alamat</span></label>
                                    <div class="input-group">
                                        <input type="text" name="alamat" style="text-transform: uppercase" class="form-control" placeholder="" required="" value="<?php echo $alamat; ?>" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div><br>
                                    <div class="input-group">
                                        <input type="text" name="alamat2" style="text-transform: uppercase" value="<?php echo $alamat2; ?>" class="form-control" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Poskod</span></label>
                                    <div class="input-group">
                                        <input type="text" name="poskod" class="form-control" placeholder="" required="" value="<?php echo $poskod; ?>" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Bandar</span></label>
                                    <div class="input-group">
                                        <input type="text" name="bandar" style="text-transform: uppercase" class="form-control" value="<?php echo $bandar; ?>" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Negeri</span></label>
                                    <select name="negeri" class="form-control">
                                        <option value="" disabled selected>Sila Pilih</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Pulau Pinang">Pulau Pinang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Terengganu">Terengganu</option>
                                        <option value="Wilayah Persekutuan Labuan">Wilayah Persekutuan Labuan</option>
                                        <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                                        <option value="Wilayah Persekutuan Putrajaya">Wilayah Persekutuan Putrajaya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Status Menetap</span></label>
                                    <select name="s_menetap" class="form-control">
                                        <option value="" disabled selected>Sila Pilih</option>
                                        <option value="Sendiri">Sendiri</option>
                                        <option value="Sewa">Sewa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tel Rumah</label>
                                    <div class="input-group">
                                        <input type="text" name="tel_rumah" class="form-control" value="<?php echo $tel_rumah; ?>" placeholder="Kosongkan Jika Tiada" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tel Bimbit</label>
                                    <div class="input-group">
                                        <input type="text" name="tel_hp" class="form-control" value="<?php echo $tel_hp; ?>" placeholder="Kosongkan Jika Tiada" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" oninvalid="InvalidPhone(this);" oninput="InvalidPhone(this);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Kawasan Kariah</span></label>
                                    <select name="kawasan" class="form-control">
                                        <option value="" disabled selected>Sila Pilih</option>
                                        <option value="Surau Pondok Haji Majid">Surau Pondok Haji Majid</option>
                                        <option value="Surau Kg Jalan Baru">Surau Kg Jalan Baru</option>
                                        <option value="Surau Nurul Huda Bt 18 1/2">Surau Nurul Huda Bt 18 1/2 </option>
                                        <option value="Surau Taman Markisa">Surau Taman Markisa</option>
                                        <option value="Surau Pondok Hj Husin">Surau Pondok Hj Husin</option>
                                        <option value="Surau Lorong Panglima">Surau Lorong Panglima</option>
                                        <option value="Surau Ustaz Khir">Surau Ustaz Khir</option>
                                        <option value="Surau Kg Baru">Surau Kg Baru</option>
                                        <option value="Surau Lorong Datuk Madon">Surau Lorong Datuk Madon</option>
                                        <option value="Surau Kg Pasir">Surau Kg Pasir</option>
                                        <option value="Surau Kg Titi Lahar">Surau Kg Titi Lahar</option>
                                        <option value="Surau Haji Abdul Bt 18">Surau Haji Abdul Bt 18</option>
                                        <option value="Surau Kg Tok Kau">Surau Kg Tok Kau</option>
                                        <option value="Taman Keranji">Taman Keranji</option>
                                        <option value="Taman Delima">Taman Delima</option>
                                        <option value="Taman Halaman Damai">Taman Halaman Damai</option>
                                        <option value="Taman Desa Indah">Taman Desa Indah</option>
                                        <option value="Perumahan Awam(Rumah Murah)">Perumahan Awam (Rumah Murah)</option>
                                        <option value="Luar Kawasan Kariah">Luar Kawasan Kariah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Mula Menetap Dalam Kariah</label>
                                    <div class="input-group">
                                        <input type="number" name="tahun_menetap" class="form-control" value="<?php echo $tahun_menetap; ?>" placeholder="Kosongkan Jika Luar Kawasan Kariah" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Status Perkahwinan</span></label>
                                    <select name="status_perkahwinan" class="form-control">
                                        <option value="" disabled selected>Sila Pilih</option>
                                        <option value="Bujang"> Bujang</option>
                                        <option value="Kahwin"> Kahwin</option>
                                        <option value="Duda"> Duda</option>
                                        <option value="Janda"> Janda</option>
                                        <option value="Ibu Tunggal"> Ibu Tunggal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penerima Bantuan (Jika Ya, isi jenis bantuan)</label>
                                    <div class="input-group">
                                        <input type="text" name="penerima_bantuan" id="penerima_bantuan" class="form-control" value="<?php echo $penerima_bantuan; ?>" placeholder="Kosongkan Jika Tiada" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" name="role" hidden>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="mati" hidden>
                                        <option value="Hidup">Hidup</option>
                                    </select>
                                </div>
                                <div class="input-group" hidden>
                                    <input type="text" name="token" id="token" class="form-control" placeholder="" />
                                </div>
                                <input type="hidden" name="status_sms" class="form-control" />
                                <div class="form-group">
                                    <select class="form-control" name="approvement" hidden>
                                        <option value="Belum Daftar">Belum Daftar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- div card kedua -->
                <!-- <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Wajib : Isi kata laluan (default password) menggunakan no kad pengenalan</h3>
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
                                    <label style="color:red;">* <span style="color:black;">Kata Laluan</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="" />
                                    </div>
                                    <label class="form-check-inline u-check g-color-gray-dark-v5 g-font-size-12 g-pl-25 mb-0">
                                        <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" id="lihat" onclick="myFunction()">
                                        <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                                            <i class="fa" data-check-icon="&#xf00c"></i>
                                        </div>
                                        &nbsp;Lihat Kata Laluan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- div card kedua abes -->

                <!-- div card ketiga -->
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
                                        <input type="text" name="penama_name" style="text-transform: uppercase" class="form-control" value="<?php echo $penama_name; ?>" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">No K/P</span></label>
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
                                        <!-- <input id="email" oninvalid="InvalidMsg(this);" name="email" oninput="InvalidMsg(this);"  type="email" required="required" /> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Tel Bimbit</span></label>
                                    <div class="input-group">
                                        <input type="text" name="penama_no" class="form-control" placeholder="Tiada Dash (-)" value="<?php echo $penama_no; ?>" required="required" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" oninvalid="InvalidPhonePenama(this);" oninput="InvalidPhonePenama(this);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- div card ketiga abes -->

                <!-- div card keempat -->
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
                                    <table id="producttable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <!-- <th>Nama</th>
                                                                <th>No K/P</th>
                                                                <th>Umur</th>
                                                                <th>No Tel</th>
                                                                <th>Pertalian</th>
                                                                <th>Pekerjaan</th>
                                                                <th> -->
                                                <!-- <center><button type="button" name="btn_add" class="btn btn-success btn-sm btnadd">Tambah</button></center> -->
                                                <input type="button" name="btn_add" class="d-none btn-success d-md-table-cell btnadd" value="Tambah" style="margin-left: auto; display: block;">
                                                <input type="button" name="btn_add" class="d-md-none d-sm btn-success btnadd1" value="Tambah" style="margin-left: auto; display: block;">
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- div card keempat abes -->
                <hr>
                <div align="center">
                    <input type="submit" name="btn_simpan" value="Simpan" class="btn btn-info">
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
    $(document).ready(function() {
        $("#kariah_umur").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
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

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function InvalidPhone(textbox) {

        if (textbox.validity.patternMismatch) {
            textbox.setCustomValidity('Tiada Dash -');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }

    function InvalidPhonePenama(textbox) {

        if (textbox.value == '') {
            textbox.setCustomValidity('Wajib isi');
        } else if (textbox.validity.patternMismatch) {
            textbox.setCustomValidity('Isi format yang betul');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }

    $(document).ready(function() {
        $(document).on('click', '.btnadd1', function() {
            var html = '';

            html += '<tr>';

            html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" placeholder="Nama" /><br><input type="text" name="ic[]" id="ic" class="form-control ic" placeholder="No K/P" /><input type="hidden" name="umur[]" class="form-control umur" placeholder="Umur" /><br><input type="text" name="tel[]" class="form-control tel" placeholder="No Tel (Jika Ada)" /><br><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" placeholder="Pertalian" /><br><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" placeholder="Pekerjaan" /><input type="hidden" name="mati_tanggung[]" value="tak" id="mati_tanggung" class="form-control mati_tanggung" placeholder="" /></td>';
            // html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="ic[]" class="form-control ic" placeholder="No K/P" /></td>';
            // html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="ic[]" class="form-control ic" placeholder="No K/P" /></td>';

            html += '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></center></td>';
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
            html += '<input type="hidden" name="mati_tanggung[]" value="tak" id="mati_tanggung" class="form-control mati_tanggung" placeholder="" />';
            html += '<input type="hidden" name="umur[]" id="umur" class="form-control umur" placeholder="Umur" />';


            html += '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></center></td>';
            $('#producttable').append(html);

            //disable sat atas kehendak nurin
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
        $('#kariah_ic').mask('000000-00-0000');
    });

    $(document).ready(function() {
        $('#penama_ic').mask('000000-00-0000');
    });

    $(document).ready(function() {
        $('#penerima_bantuan').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    });
</script>

<?php
include_once 'footer.php';
?>