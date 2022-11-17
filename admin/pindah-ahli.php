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


error_reporting(0);

//fetch semula product
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
$role = $row['role'];
$approvement = $row['approvement'];
$mati = $row['mati'];

$select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id = $id");
$select->execute();
$row_tanggung = $select->fetchAll(PDO::FETCH_ASSOC);

$select3 = $pdo->prepare("SELECT * FROM penama WHERE kariah_id = $id");
$select3->execute();
$row_penama = $select3->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn_update_kariah'])) {

    $kariah_name1 = $_POST['kariah_name'];
    $kariah_ic1 = $_POST['kariah_ic'];
    $user_email1 = $_POST['user_email'];
    // $kariah_umur = date('Y') - $_POST['kariah_umur'];
    $kariah_umur1 = date('Y-m-d', strtotime($_POST['kariah_umur']));
    $jantina = $_POST['jantina'];
    $pekerjaan1 = $_POST['pekerjaan'];
    $alamat1 = $_POST['alamat'];
    $alamat21 = $_POST['alamat2'];
    $poskod1 = $_POST['poskod'];
    $bandar1 = $_POST['bandar'];
    $negeri = $_POST['negeri'];
    $s_menetap = $_POST['s_menetap'];
    $tel_rumah1 = $_POST['tel_rumah'];
    $tel_hp1 = $_POST['tel_hp'];
    $kawasan = $_POST['kawasan'];
    $tahun_menetap1 = $_POST['tahun_menetap'];
    $status_perkahwinan = $_POST['status_perkahwinan'];
    $penerima_bantuan1 = $_POST['penerima_bantuan'];
    $password = str_replace('-', '', $_POST['kariah_ic']);
    $approvement = $_POST['approvement'];
    $mati = $_POST['mati'];
    $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
    // $password = $_POST['password'];
    // $role = $_POST['role'];

    // $select = $pdo->prepare("SELECT password FROM ahli_kariah WHERE kariah_id = $id");
    // $select->execute();

    // $row_password = $select->fetchAll(PDO::FETCH_ASSOC);

    // $db_user_password = $row['password'];

    // if ($db_user_password != $password) {
    //     $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    // }

    //table penama
    $penama_name = $_POST['penama_name'];
    $penama_ic = $_POST['penama_ic'];
    $penama_no = $_POST['penama_no'];
    $penama_email = $_POST['penama_email'];
    $penama_pass = substr($_POST['penama_ic'], 0, 6);
    $penama_pass = password_hash($penama_pass, PASSWORD_BCRYPT, array("cost" => 12));

    if (isset($_POST['kariah_ic'])) {

        $select_email = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email='$user_email1'");
        $select_email->execute();

        $ic = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic='$kariah_ic1'");
        $ic->execute();

        $ic_penama = $pdo->prepare("SELECT penama_ic FROM penama WHERE penama_ic='$penama_ic'");
        $ic_penama->execute();

        $email_penama = $pdo->prepare("SELECT penama_email FROM penama WHERE penama_email='$penama_email'");
        $email_penama->execute();

        $ici = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = :kariah_ic");
        $ici->bindParam(':kariah_ic', $penama_ic);
        $ici->execute();
        $iciuser = $ici->fetch();

        $sql = "SELECT * FROM penama WHERE penama_ic = :penama_ic ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':penama_ic', $kariah_ic);
        $stmt->execute();
        $penamaici = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($select_email->rowCount() > 0) {
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
        } elseif ($ic->rowCount() > 0) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "No kad pengenalan telah berdaftar",
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
        } elseif ($penama_ic == $kariah_ic1) {
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
        } else {

            //bwh ni pulak utk masuk dekat tbl_tanggung
            // $kariah_id = $_POST['kariah_id'];
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
            poskod=:poskod, bandar=:bandar, negeri=:negeri, s_menetap=:s_menetap, tel_rumah=:tel_rumah, tel_hp=:tel_hp, kawasan=:kawasan, tahun_menetap=:tahun_menetap, status_perkahwinan=:status_perkahwinan, penerima_bantuan=:penerima_bantuan, password=:password, approvement=:approvement, mati=:mati WHERE kariah_id = $id ");

            $update_kariah->bindParam(':kariah_name', $kariah_name1);
            $update_kariah->bindParam(':kariah_ic', $kariah_ic1);
            $update_kariah->bindParam(':user_email', $user_email1);
            $update_kariah->bindParam(':kariah_umur', $kariah_umur1);
            $update_kariah->bindParam(':jantina', $jantina);
            $update_kariah->bindParam(':pekerjaan', $pekerjaan1);
            $update_kariah->bindParam(':alamat', $alamat1);
            $update_kariah->bindParam(':alamat2', $alamat21);
            $update_kariah->bindParam(':poskod', $poskod1);
            $update_kariah->bindParam(':bandar', $bandar1);
            $update_kariah->bindParam(':negeri', $negeri);
            $update_kariah->bindParam(':s_menetap', $s_menetap);
            $update_kariah->bindParam(':tel_rumah', $tel_rumah1);
            $update_kariah->bindParam(':tel_hp', $tel_hp1);
            $update_kariah->bindParam(':kawasan', $kawasan);
            $update_kariah->bindParam(':tahun_menetap', $tahun_menetap1);
            $update_kariah->bindParam(':status_perkahwinan', $status_perkahwinan);
            $update_kariah->bindParam(':penerima_bantuan', $penerima_bantuan1);
            $update_kariah->bindParam(':password', $password);
            $update_kariah->bindParam(':approvement', $approvement);
            $update_kariah->bindParam(':mati', $mati);
            // $update_kariah->bindParam(':password', $password);

            $update_penama = $pdo->prepare("UPDATE penama SET penama_name=:penama_name, penama_ic=:penama_ic, penama_no=:penama_no, penama_email=:penama_email, penama_pass=:penama_pass WHERE kariah_id = $id ");
            $update_penama->bindParam(':penama_name', $penama_name);
            $update_penama->bindParam(':penama_ic', $penama_ic);
            $update_penama->bindParam(':penama_no', $penama_no);
            $update_penama->bindParam(':penama_email', $penama_email);
            $update_penama->bindParam(':penama_pass', $penama_pass);

            if ($update_kariah->execute() && $update_penama->execute()) {

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

                        $mail->setFrom('bajuhitam400@gmail.com', 'EKhairat Al-Wustha');
                        $mail->addAddress($penama_email);

                        $mail->Subject = 'Pendaftaran Penama Berjaya';

                        $mail->Body = "<p>$penama_name berjaya didaftarkan sebagai penama kepada $kariah_name. Kata laluan adalah 6 digit terawal no kad pengenalan anda. Contoh:<br/><br/>

                            Log Masuk<br/>
                            No Kad Pengenalan: 123456-78-9102<br/>
                            Kata Laluan: 123456
                            <br/><br/>
                            Terima Kasih

                            </p>";
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

                $sql = "UPDATE tuntut SET pindah_milik = 'Selesai' WHERE kariah_id = $id ";
                $update = $pdo->prepare($sql);
                $update->execute();

                echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Pemindahan Berjaya",
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
                            title: "Pemindahan Gagal",
                            icon: "error",
                            button: "Ok",
                        }).then(function() {
                            window.location = "ahli-kariah.php";
                        });
                    });
                    </script>';
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
                        <h3 class="card-title">Maklumat Ahli Pemindahan Milik</h3>
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
                                        <input type="text" name="kariah_name" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $kariah_name1;
                                                                                                                                                            ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">No Kad Pengenalan / No Pasport</span></label>
                                    <!-- <span id="check-kariah_ic"></span> -->
                                    <div class="input-group">
                                        <input type="text" name="kariah_ic" id="kariah_ic" class="form-control" placeholder="" value="<?php echo $kariah_ic1; ?>" required="" oninvalid="checkICInvalid(this)" onInput="checkIC()" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Tarikh Lahir</span></label>
                                    <input type="date" name="kariah_umur" class="form-control" required="" value="<?php echo $kariah_umur1; ?>" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Emel</label>
                                    <div class="input-group">
                                        <input type="email" name="user_email" class="form-control" placeholder="" value="<?php echo $user_email1; ?>" oninvalid="InvalidEmail(this);" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                        <input type="text" name="pekerjaan" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $pekerjaan1; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Alamat</span></label>
                                    <div class="input-group">
                                        <input type="text" name="alamat" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $alamat1; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div><br>
                                    <div class="input-group">
                                        <input type="text" name="alamat2" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $alamat21; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Poskod</span></label>
                                    <div class="input-group">
                                        <input type="text" name="poskod" class="form-control" placeholder="" value="<?php echo $poskod1; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Bandar</span></label>
                                    <div class="input-group">
                                        <input type="text" name="bandar" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $bandar1; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Negeri</span></label>
                                    <select name="negeri" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
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
                                    <select name="s_menetap" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
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
                                    <label>Tel Rumah (Jika Ada)</label>
                                    <div class="input-group">
                                        <input type="text" name="tel_rumah" class="form-control" value="<?php echo $tel_rumah1; ?>" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tel Bimbit (Jika Ada)</label>
                                    <div class="input-group">
                                        <input type="text" name="tel_hp" class="form-control" value="<?php echo $tel_hp1; ?>" placeholder="Tiada Dash (-)" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhone(this);" oninput="InvalidPhone(this);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Kawasan Kariah</span></label>
                                    <select name="kawasan" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
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
                                        <input type="text" name="tahun_menetap" class="form-control" placeholder="Kosongkan Jika Luar Kawasan" value="<?php echo $tahun_menetap1; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Status Perkahwinan</span></label>
                                    <select name="status_perkahwinan" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
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
                                        <input type="text" name="penerima_bantuan" id="penerima_bantuan" class="form-control" value="<?php echo $penerima_bantuan1; ?>" placeholder="Kosongkan jika tiada" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="mati" hidden>
                                    <option value="Hidup">Hidup</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <input type="text" name="penama_name" class="form-control" style="text-transform: uppercase" value="<?php echo $penama_name; ?>" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
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
                                    <label style="color:red;"><span style="color:black;">Emel</span></label>
                                    <div class="input-group">
                                        <input type="email" id="penama_email" name="penama_email" class="form-control" placeholder="" value="<?php echo $penama_email; ?>" oninvalid="InvalidMsg(this);" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color:red;">* <span style="color:black;">Tel Bimbit</span></label>
                                    <div class="input-group">
                                        <input type="text" name="penama_no" id="penama_no" class="form-control" placeholder="Tiada Dash (-)" value="<?php echo $penama_no; ?>" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhonePenama(this);" oninput="InvalidPhonePenama(this);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <hr>
                <div align="center">
                    <input type="submit" name="btn_update_kariah" value="Pindah Ahli" class="btn btn-info">
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

    function InvalidEmail(textbox) {

        if (textbox.validity.typeMismatch) {
            textbox.setCustomValidity('Isi format yang betul');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }

    function InvalidPhone(textbox) {

        if (textbox.validity.patternMismatch) {
            textbox.setCustomValidity('Isi format yang betul');
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

    function InvalidMsg(textbox) {

        if (textbox.validity.typeMismatch) {
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

            html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" placeholder="Nama" /><br><input type="text" name="ic[]" id="ic" class="form-control ic" placeholder="No K/P" /><br><input type="text" name="tel[]" class="form-control tel" placeholder="No Tel (Jika Ada)" /><br><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" placeholder="Pertalian" /><br><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" placeholder="Pekerjaan" /><input type="hidden" name="umur[]" class="form-control umur" placeholder="Umur" /><input type="hidden" name="mati_tanggung[]" value="tak" id="mati_tanggung" class="form-control mati_tanggung" placeholder="" /><br><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></td>';
            // html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="ic[]" class="form-control ic" placeholder="No K/P" /></td>';
            // html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="ic[]" class="form-control ic" placeholder="No K/P" /></td>';



            // html += '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></center></td>';
            $('#producttable').append(html);
            $('.ic').mask('000000-00-0000');
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

    // $('#producttable').append(html);
    // $('#kariah_ic').mask('000000-00-0000');

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