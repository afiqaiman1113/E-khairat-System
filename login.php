<!-- jQuery -->
<script src="admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/adminlte.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

<!-- input mask -->
<script src="assets/js/jquery.mask.min.js"></script>

<?php
include_once 'admin/database/connect.php';
session_start();

//method kat bawah ni adalah PDO method, jgn gabra2, cer fahamkan dulu code dia
if (isset($_POST['btn_login'])) {

    $kariah_ic = !empty($_POST['kariah_ic']) ? trim($_POST['kariah_ic']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $sql = "SELECT * FROM ahli_kariah WHERE kariah_ic = :kariah_ic ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':kariah_ic', $kariah_ic);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($kariah_ic === false) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Tiada Rekod",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($password === false) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kata Laluan Salah",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
    } else {

        $validEmail = $user['kariah_ic'];
        $validPassword = password_verify($password, $user['password']);
        $validRole = $user['role'];

        if ($validEmail and $validPassword and $validRole == "Admin") {

            $_SESSION['kariah_id'] = $user['kariah_id'];
            $_SESSION['kariah_name'] = $user['kariah_name'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['role'] = $user['role'];

            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Berjaya",
                    icon: "success",
                    button: "Ok",
                  });
            });
            </script>';
            header('refresh:2;dashboard.php');
        } elseif ($validEmail and $validPassword and $validRole == "User") {

            $_SESSION['kariah_id'] = $user['kariah_id'];
            $_SESSION['kariah_name'] = $user['kariah_name'];
            $_SESSION['kariah_ic'] = $user['kariah_ic'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['role'] = $user['role'];

            echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Berjaya",
                icon: "success",
                button: "Ok",
              });
        });
        </script>';
            header('refresh:2;user.php?p=utama');
        } else {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Kad Pengenalan atau kata laluan salah",
                    icon: "error",
                    button: "Ok",
                  });
            });
            </script>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-Khairat Al Wustha</title>
    <link rel="shortcut icon" type="image/png" href="admin/dist/img/logo.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css" />


</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="admin/dist/img/logo.png" width="115" height="98" /><br>
            <a href="login.php"><b>E-Khairat<br></b> Masjid Al-Wustha</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Log Masuk</p>
                <form action="login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="kariah_ic" id="kariah_ic" class="form-control" placeholder="No Kad Pengenalan" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Kata Laluan" required="" oninvalid="this.setCustomValidity('Masukkan Kata Laluan')" oninput="setCustomValidity('')" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" onclick="myFunction()" />
                                <label for="remember"> Lihat Kata Laluan </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="btn_login" class="btn btn-primary btn-block">
                                Log Masuk
                            </button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="#" onclick="swal('', 'Please Contact The Service Provider', 'error');">Lupa Kata Laluan?</a>
                    <br> <a href="register.php" class="text-center">Daftar Sini</a>
                </p>
                <p class="mb-0">
                    <!-- <a href="#" class="text-center">Register a new membership</a> -->
                </p>
            </div>
        </div>
    </div>
    <!-- /.login-box -->
</body>

</html>

<script>
    $(document).ready(function() {
        $('#kariah_ic').mask('000000-00-0000');
    });

    // var state = false;
    // function toggle() {
    //     if(state) {
    //         document.getElementById("password").setAttribute("type", "password");
    //         document.getElementById("eye").style.color = '#7a797e';
    //         state = false;
    //     } else { 
    //         document.getElementById("password").setAttribute("type", "text");
    //         document.getElementById("eye").style.color = '#5887ef';
    //         state = true;
    //     }
    // }

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>