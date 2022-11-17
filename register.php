<!-- jQuery -->
<script src="admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/adminlte.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

<!-- input mask, ubah ic jadi 00-00 -->
<script src="assets/js/jquery.mask.min.js"></script>

<?php
include_once 'admin/database/connect.php';
session_start();

$select = $pdo->prepare("SELECT * FROM ahli_kariah ORDER BY kariah_id DESC");
$select->bindParam(':kariah_id', $kariah_id);
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$lastid = $row['no_ahli'];
if ($lastid == " ") {
    $empid = "000001";
} else {
    $empid = substr($lastid, 3);
    $empid = intval($empid);
    $empid = "00000" . ($empid + 1);
}

if (isset($_POST['register'])) {

    $no_ahli = $_POST['no_ahli'];
    $kariah_name = $_POST['kariah_name'];
    $kariah_ic = $_POST['kariah_ic'];
    $user_email = $_POST['user_email'];
    $kariah_umur = $_POST['kariah_umur'];
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
    $password = $_POST['password'];
    $tarikh_daftar = date("Y-m-d");
    $role = $_POST['role'];
    $approvement = $_POST['approvement'];

    $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    // $sql = "SELECT * FROM ahli_kariah WHERE user_email = :user_email ";
    // $stmt = $pdo->prepare($sql);

    // $stmt->bindValue(':user_email', $user_email);
    // $stmt->execute();
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);


    if (isset($_POST['kariah_ic'])) {

        // $user_email = $_POST['user_email'];
        // $select = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email='$user_email'");
        // $select->execute();

        // $ic = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic='$kariah_ic'");
        // $ic->execute();

        $ic = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = :kariah_ic");
        $ic->bindParam(':kariah_ic', $kariah_ic);
        $ic->execute();
        $i = $ic->fetch();

        // $email = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email ='$user_email' ");
        // $email->execute([$user_email]);
        // $em = $email->fetch();

        if ($i) {
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
            $stmt = $pdo->prepare("INSERT INTO ahli_kariah(no_ahli, kariah_name, kariah_ic, user_email, kariah_umur, jantina, pekerjaan, alamat, alamat2, poskod, bandar, negeri, s_menetap, tel_rumah, tel_hp, kawasan, tahun_menetap, status_perkahwinan, penerima_bantuan, password, tarikh_daftar, role, approvement)
            VALUES(:no_ahli, :kariah_name, :kariah_ic, :user_email, :kariah_umur, :jantina, :pekerjaan, :alamat, :alamat2, :poskod, :bandar, :negeri, :s_menetap, :tel_rumah, :tel_hp, :kawasan, :tahun_menetap, :status_perkahwinan, :penerima_bantuan, :password, :tarikh_daftar, :role, :approvement)");

            $stmt->bindParam(':no_ahli', $no_ahli);
            $stmt->bindParam(':kariah_name', $kariah_name);
            $stmt->bindParam(':kariah_ic', $kariah_ic);
            $stmt->bindParam(':user_email', $user_email);
            $stmt->bindParam(':kariah_umur', $kariah_umur);
            $stmt->bindParam(':jantina', $jantina);
            $stmt->bindParam(':pekerjaan', $pekerjaan);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':alamat2', $alamat2);
            $stmt->bindParam(':poskod', $poskod);
            $stmt->bindParam(':bandar', $bandar);
            $stmt->bindParam(':negeri', $negeri);
            $stmt->bindParam(':s_menetap', $s_menetap);
            $stmt->bindParam(':tel_rumah', $tel_rumah);
            $stmt->bindParam(':tel_hp', $tel_hp);
            $stmt->bindParam(':kawasan', $kawasan);
            $stmt->bindParam(':tahun_menetap', $tahun_menetap);
            $stmt->bindParam(':status_perkahwinan', $status_perkahwinan);
            $stmt->bindParam(':penerima_bantuan', $penerima_bantuan);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':tarikh_daftar', $tarikh_daftar);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':approvement', $approvement);

            if ($stmt->execute()) {
                echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Berjaya Daftar",
                        icon: "success",
                        button: "Ok",
                      });
                });
                </script>';
                header('refresh:2;index.php');
            } else {
                echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Gagal Daftar",
                        icon: "error",
                        button: "Ok",
                      });
                });
                </script>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css" />
</head>

<?php
$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
    echo '
                <a href="index.php" class="navbar-brand d-flex">
                  <center>
                   <img src="ntah.png" width="65%"  />
                  </center>
                </a>
                 ';
} else {
    echo '
                <a href="index.php" class="navbar-brand d-flex"> 
                  <img src="ntah.png" width="70%"  />
                </a>
                ';
}
?>

<body class="hold-transition register-page">



    <div class="register-box">
        <div class="register-logo">
            <img src="admin/dist/img/logo.png" width="115" height="98" /><br>
            <a href="register.php"><b>E-Khairat</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Pendaftaran Ahli Kariah</p>

                <form action="" method="POST">
                    <!-- <div class="col-md-12"> -->
                    <!-- <div class="form-group"> -->
                    <!-- <label>* No Ahli</label> -->
                    <!-- <div class="input-group"> -->
                    <input type="hidden" name="no_ahli" class="form-control" value="<?php echo $empid; ?>" placeholder="Contoh : 0XXXXX" readonly />
                    <!-- </div> -->
                    <!-- </div> -->
                    <!-- </div> -->
                    <div class="input-group mb-3">
                        <input type="text" name="kariah_name" class="form-control" placeholder="Nama Penuh" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="kariah_ic" id="kariah_ic" class="form-control" placeholder="No Kad Pengenalan" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="user_email" class="form-control" placeholder="Emel" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="kariah_umur" class="form-control" placeholder="Umur" />
                    <!-- <div class="input-group mb-3"> -->
                    <select name="jantina" class="form-control" id="" hidden>
                        <option value="">Jantina</option>
                        <option value="Lelaki"> Lelaki</option>
                        <option value="Perempuan"> Perempuan</option>
                    </select>
                    <!-- </div> -->

                    <input type="hidden" name="pekerjaan" class="form-control" placeholder="Pekerjaan" />
                    <input type="hidden" name="alamat" class="form-control" placeholder="" />
                    <input type="hidden" name="alamat2" class="form-control" placeholder="" />
                    <input type="hidden" name="poskod" class="form-control" placeholder="" />
                    <input type="hidden" name="bandar" class="form-control" placeholder="" />

                    <!-- <div class="row"> -->
                    <!-- <div class="col-md-6"> -->
                    <div class="form-group">
                        <!-- <label for="journey">* Negeri</label> -->
                        <select name="negeri" class="form-control" id="" hidden>
                            <option value="">Pilih Negeri</option>
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
                    <!-- </div> -->
                    <!-- <div class="col-md-6"> -->
                    <div class="form-group">
                        <!-- <label for="journey">* Status Menetap</label> -->
                        <select name="s_menetap" class="form-control" id="" hidden>
                            <option value="">Status Menetap</option>
                            <option value="Sendiri">Sendiri</option>
                            <option value="Sewa">Sewa</option>
                        </select>
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                    <input type="hidden" name="tel_rumah" class="form-control" placeholder="No Tel Bimbit" />
                    <div class="input-group mb-3">
                        <input type="text" name="tel_hp" class="form-control" placeholder="No Tel Bimbit (Jika Ada)" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row"> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="kawasan" class="form-control" id="" hidden>
                                <option value="">Pilih Kariah</option>
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
                                <option value="Surau Hj Husin">Surau Hj Husin</option>
                                <option value="Surau Haji Abdul Bt 18">Surau Haji Abdul Bt 18</option>
                                <option value="Surau Kg Tok Kau">Surau Kg Tok Kau</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="tahun_menetap" class="form-control" placeholder="" />
                    <!-- </div> -->
                    <!-- <div class="row"> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="status_perkahwinan" class="form-control" id="" hidden>
                                <option value="">Status</option>
                                <option value="Bujang"> Bujang</option>
                                <option value="Kahwin"> Kahwin</option>
                                <option value="Duda"> Duda</option>
                                <option value="Janda"> Janda</option>
                                <option value="Ibu Tunggal"> Ibu Tunggal</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="penerima_bantuan" class="form-control" placeholder="" />

                    <!-- <div class="form-group"> -->
                    <select class="form-control" name="role" id="" hidden>
                        <option value="User">User</option>
                    </select>
                    <!-- </div> -->
                    <!-- <div class="form-group"> -->
                    <select class="form-control" name="approvement" id="" hidden>
                        <option value="Belum Daftar">Belum Daftar</option>
                    </select>
                    <!-- </div> -->

                    <!-- </div> -->
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Kata Laluan" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="role" id="" hidden>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" name="register" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                    </div>
                </form>

                <a href="index.php" class="text-center">Sudah daftar</a>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    $(document).ready(function() {
        $('#kariah_ic').mask('000000-00-0000');
    });
</script>