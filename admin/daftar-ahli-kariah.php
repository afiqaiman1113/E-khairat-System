<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'Classes/Config.php';

// error_reporting(0);

$select = $pdo->prepare("SELECT * FROM ahli_kariah ORDER BY kariah_id DESC");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$lastid = $row['no_ahli'];
$kariahic = $row['kariah_ic'];
// if ($lastid == " ") {
//     $empid = "000001";
// } else {
//     $empid = substr($lastid, 3);
//     $empid = intval($empid);
//     $empid = "000" . ($empid + 1);
// }

$select3 = $pdo->prepare("SELECT * FROM penama ORDER BY penama_id DESC");
$select3->execute();
$row_penama = $select3->fetch(PDO::FETCH_ASSOC);
$penamaic = $row_penama['penama_ic'];

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


    //table penama
    $penama_name = $_POST['penama_name'];
    $penama_ic = $_POST['penama_ic'];
    $penama_no = $_POST['penama_no'];
    $penama_email = $_POST['penama_email'];
    $penama_pass = substr($_POST['penama_ic'], 0, 6);
    $penama_pass = password_hash($penama_pass, PASSWORD_BCRYPT, array("cost" => 12));

    // $nama = $_POST['nama'];
    // $ic = $_POST['ic'];
    // $umur = $_POST['umur'];
    // $tel = $_POST['tel'];
    // $kariah_pertalian = $_POST['kariah_pertalian'];
    // $kariah_pekerjaan = $_POST['kariah_pekerjaan'];
    // $mati_tanggung = $_POST['mati_tanggung'];

    if (isset($_POST['kariah_ic'])) {

        $select_email = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email='$user_email'");
        $select_email->execute();

        $email_penama = $pdo->prepare("SELECT penama_email FROM penama WHERE penama_email='$penama_email'");
        $email_penama->execute();

        $ic1 = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic='$kariah_ic'");
        $ic1->execute();

        // $ictanggung = $pdo->prepare("SELECT ic FROM tbl_tanggung WHERE ic='$ic'");
        // $ictanggung->execute();

        $ic_penama = $pdo->prepare("SELECT penama_ic FROM penama WHERE penama_ic='$penama_ic'");
        $ic_penama->execute();

        $sql = "SELECT * FROM penama WHERE penama_ic = :penama_ic ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':penama_ic', $kariah_ic);
        $stmt->execute();
        $penamaici = $stmt->fetch(PDO::FETCH_ASSOC);

        $ici = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = :kariah_ic");
        $ici->bindParam(':kariah_ic', $penama_ic);
        $ici->execute();
        $iciuser = $ici->fetch();

        if ($ic1->rowCount() > 0) {
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
                    title: "Emel ahli telah berdaftar",
                    text: "Sila masukkan emel lain",
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
        } elseif ($ic_penama->rowCount() > 0) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "No kad pengenalan penama telah berdaftar",
                    icon: "warning",
                    button: "Ok",
                  });
            });
            </script>';
        } elseif ($penama_ic == $kariah_ic) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Tidak Sah",
                    text: "No K/P Adalah Sama",
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
        } elseif ($penama_ic == $iciuser > 0) {
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
        } elseif ($kariah_ic == $penamaici > 0) {
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
        }
        // elseif ($ictanggung->rowCount() > 0) {
        //     echo '<script type="text/javascript">
        //     jQuery(function validation() {
        //         swal({
        //             title: "No K/P Tanggungan Telah wujud",
        //             icon: "warning",
        //             button: "Ok",
        //           });
        //     });
        //     </script>';
        // }
        else {

            //bwh ni pulak utk masuk dekat tbl_tanggung
            $nama = $_POST['nama'];
            $ic = $_POST['ic'];
            $umur = $_POST['umur'];
            $tel = $_POST['tel'];
            $kariah_pertalian = $_POST['kariah_pertalian'];
            $kariah_pekerjaan = $_POST['kariah_pekerjaan'];
            $mati_tanggung = $_POST['mati_tanggung'];

            // $toEmail = "bajuhitam400@gmail.com";

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

                    //config phpmailer
                    if ($penama_email == null) {
                        $form_data = [
                            'token_uid' => "746210583",
                            'token_key' => "utwe2qsd5r7acgvx8ozi",
                            'receipients' => $penama_no,
                            'message' => "Penama Success didaftarkan"
                        ];

                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_POST, 1);
                        curl_setopt($curl, CURLOPT_URL, 'https://sms.ala.my/api/v1/send');
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);
                        $result = curl_exec($curl);
                        $obj = json_decode($result);
                    } else {
                        $mail = new PHPMailer(true);
                        try {
                            //Server settings
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                            $mail->isSMTP();
                            $mail->Host       = Config::SMTP_HOST;
                            $mail->SMTPAuth   = true;
                            $mail->Username   = 'bajuhitam400@gmail.com';
                            $mail->Password   = 'iiehxikntcamkegu'; //pass for App, ni cara baru utk bypass send using gmail
                            $mail->SMTPSecure = 'tls';
                            $mail->Port       = Config::SMTP_PORT;
                            $mail->CharSet = 'UTF-8';
                            $mail->isHTML(true);

                            $mail->setFrom('bajuhitam400@gmail.com', 'Syahril Ashraf');
                            $mail->addAddress($penama_email);

                            $mail->Subject = 'Pendaftaran Penama Berjaya';

                            $mail->Body = "<p>$penama_name berjaya didaftarkan sebagai penama kepada $kariah_name</p>";
                            $mail->send();

                            // if ($mail->send()) {
                            //   $emailSent = true;
                            // } else {
                            //   echo "not sent";
                            // }
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                    }

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
                                    <label style="color:red;">* <span style="color:black;">No. Kad Pengenalan / No. Pasport</span></label>
                                    <!-- <span id="check-kariah_ic"></span> -->
                                    <div class="input-group">
                                        <input type="text" name="kariah_ic" id="kariah_ic" class="form-control" placeholder="" value="<?php echo $kariah_ic; ?>" required="" oninvalid="checkICInvalid(this)" onInput="checkIC()" />
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
                                    <span id="check-user_email"></span>
                                    <div class="input-group">
                                        <!-- <input type="email" name="user_email" class="form-control" placeholder="Kosongkan Jika Tiada" /> -->
                                        <input type="email" id="user_email" name="user_email" class="form-control" value="<?php echo $user_email; ?>" placeholder="Kosongkan Jika Tiada" oninvalid="InvalidEmail(this);" onInput="checkEmail()" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Jantina</span></label>
                                    <select name="jantina" class="form-control" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
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
                                    <select name="s_menetap" class="form-control" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
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
                                    <label>Tel Rumah</label>
                                    <div class="input-group">
                                        <input type="text" name="tel_rumah" class="form-control" value="<?php echo $tel_rumah; ?>" placeholder="Kosongkan Jika Tiada" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tel Bimbit</label>
                                    <span id="check-tel_hp"></span>
                                    <div class="input-group">
                                        <input type="text" name="tel_hp" id="tel_hp" class="form-control" value="<?php echo $tel_hp; ?>" placeholder="Kosongkan Jika Tiada" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhone(this);" onInput="checkTelBimbit()" />
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
                                        <input type="number" name="tahun_menetap" class="form-control" value="<?php echo $tahun_menetap; ?>" placeholder="Kosongkan Jika Luar Kawasan Kariah" />
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
                                        <input type="text" name="penama_name" onKeyUP="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $penama_name; ?>" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">No Kad Pengenalan / No Pasport</span></label>
                                    <span id="check-penama_ic"></span>
                                    <div class="input-group">
                                        <input type="text" name="penama_ic" id="penama_ic" class="form-control" placeholder="" value="<?php echo $penama_ic; ?>" required="" oninvalid="checkICPenamaInvalid(this)" onInput="checkICPenama()" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;"><span style="color:black;">Emel</span></label>
                                    <span id="check-penama_email"></span>
                                    <div class="input-group">
                                        <input type="email" id="penama_email" name="penama_email" class="form-control" placeholder="" value="<?php echo $penama_email; ?>" oninvalid="InvalidMsg(this);" onInput="checkEmelPenama()" />
                                        <!-- <input id="email" oninvalid="InvalidMsg(this);" name="email" oninput="InvalidMsg(this);"  type="email" required="required" /> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Tel Bimbit</span></label>
                                    <span id="check-penama_no"></span>
                                    <div class="input-group">
                                        <input type="text" name="penama_no" id="penama_no" class="form-control" placeholder="Tiada Dash (-)" value="<?php echo $penama_no; ?>" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhonePenama(this);" onInput="checkTelPenama()" />
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
                                                <input type="button" name="btn_add" class="d-none btn-success d-md-table-cell btnadd" value="Tambah" style="margin-left: auto; display: block;">
                                                <input type="button" name="btn_add" class="d-md-none d-sm btn-success btnadd1" value="Tambah" style="margin-left: auto; display: block;">
                                            </tr>
                                        </thead>
                                        <?php
                                        $useragent = $_SERVER['HTTP_USER_AGENT'];
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- div card keempat abes -->
                <hr>
                <div align="center">
                    <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="btn btn-info">
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

    //start checkIc
    function checkIC() {
        jQuery.ajax({
            url: "check_availability.php",
            data: 'kariah_ic=' + $("#kariah_ic").val(),
            type: "POST",
            success: function(data) {
                $("#check-kariah_ic").html(data);
            },
            error: function() {}
        });
    }

    function checkICInvalid(textbox) {
        if (textbox.value == '') {
            textbox.setCustomValidity('Wajib isi');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    //end checkIc

    //start checkEmail
    function checkEmail() {
        jQuery.ajax({
            url: "check_availability.php",
            data: 'user_email=' + $("#user_email").val(),
            type: "POST",
            success: function(data) {
                $("#check-user_email").html(data);
            },
            error: function() {}
        });
    }

    function InvalidEmail(textbox) {

        if (textbox.validity.typeMismatch) {
            textbox.setCustomValidity('Isi format yang betul');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    //end checkEmail

    //Start checkICPenama
    function checkICPenama() {
        jQuery.ajax({
            url: "check_availability.php",
            data: 'penama_ic=' + $("#penama_ic").val(),
            type: "POST",
            success: function(data) {
                $("#check-penama_ic").html(data);
            },
            error: function() {}
        });
    }

    function checkICPenamaInvalid(textbox) {
        if (textbox.value == '') {
            textbox.setCustomValidity('Wajib isi');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    //End checkICPenama

    //Start checkEmelPenama
    function checkEmelPenama() {
        jQuery.ajax({
            url: "check_availability.php",
            data: 'penama_email=' + $("#penama_email").val(),
            type: "POST",
            success: function(data) {
                $("#check-penama_email").html(data);
            },
            error: function() {}
        });
    }

    function InvalidMsg(textbox) {
        if (textbox.validity.typeMismatch) {
            textbox.setCustomValidity('Isi format yang betul');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    //End checkEmelPenama

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    //start check tel bimbit
    function checkTelBimbit() {
        jQuery.ajax({
            url: "check_availability.php",
            data: 'tel_hp=' + $("#tel_hp").val(),
            type: "POST",
            success: function(data) {
                $("#check-tel_hp").html(data);
            },
            error: function() {}
        });
    }

    function InvalidPhone(textbox) {
        if (textbox.validity.patternMismatch) {
            textbox.setCustomValidity('Tiada Dash -');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    //end check tel bimbit

    //start check tel bimbit penama
    function checkTelPenama() {
        jQuery.ajax({
            url: "check_availability.php",
            data: 'penama_no=' + $("#penama_no").val(),
            type: "POST",
            success: function(data) {
                $("#check-penama_no").html(data);
            },
            error: function() {}
        });
    }

    function InvalidPhonePenama(textbox) {
        if (textbox.value == '') {
            textbox.setCustomValidity('Wajib isi');
        } else if (textbox.validity.patternMismatch) {
            textbox.setCustomValidity('Tiada Dash -');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    //end check tel bimbit penama

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

    $(document).ready(function() {
        $('#penerima_bantuan').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    });
</script>

<?php
include_once 'footer.php';
?>