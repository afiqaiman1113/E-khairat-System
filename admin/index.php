<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/sweetalert/sweetalert.js"></script>

<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if (isset($_SESSION['user_id']) != "") {
    header("Location:utama.php");
    //exit();
}

//method kat bawah ni adalah PDO method, jgn gabra2, cer fahamkan dulu code dia
if (isset($_POST['btn_login'])) {

    $user_email = !empty($_POST['user_email']) ? trim($_POST['user_email']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $sql = "SELECT * FROM tbl_user WHERE user_email = :user_email ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_email', $user_email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user === false) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Email atau kata laluan salah",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
    } else {

        $validEmail = $user['user_email'];
        $validPassword = password_verify($password, $user['password']);
        $validRole = $user['role'];

        if ($validEmail and $validPassword and $validRole == "Admin") {

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['role'] = $user['role'];
            // $_SESSION['tarikh_daftar'] = $user['tarikh_daftar'];

            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Berjaya",
                    icon: "success",
                    button: "Ok",
                  });
            });
            </script>';
            //$_SESSION['user_id'] = $row['user_id'];
            header('refresh:2;utama.php');

            $activity = "Log masuk berjaya";
            $time_loged = date("Y-m-d H:i:s", strtotime("now"));
            $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
            $stmt->bindParam(1, $_SESSION['user_id']);
            $stmt->bindParam(2, $activity);
            $stmt->bindParam(3, $time_loged);
            $stmt->execute();
        }
        // elseif ($validEmail and $validPassword and $validRole == "User") {

        //     $_SESSION['user_id'] = $user['user_id'];
        //     $_SESSION['username'] = $user['username'];
        //     $_SESSION['user_email'] = $user['user_email'];
        //     $_SESSION['role'] = $user['role'];

        //     echo '<script type="text/javascript">
        // jQuery(function validation() {
        //     swal({
        //         title: "Berjaya",
        //         icon: "success",
        //         button: "Ok",
        //       });
        // });
        // </script>';
        //     header('refresh:2;user.php');
        // }
        else {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Email atau kata laluan salah",
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
    <link rel="shortcut icon" type="image/png" href="dist/img/logo.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="dist/img/logo.png" width="115" height="98" /><br>
            <a href="/khairat/admin"><b style="font-size: 80%;">E-Khairat</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Log Masuk</p>
                <form action="index.php" method="post">
                    <?php $user_email = !empty($_POST['user_email']) ? trim($_POST['user_email']) : null; ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>" placeholder="Emel" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" class="form-control" name="password" placeholder="Kata Laluan" required />
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
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>