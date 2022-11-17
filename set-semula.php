<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/dist/js/adminlte.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

<!-- input mask -->
<script src="assets/js/jquery.mask.min.js"></script>

<?php include_once 'admin/database/db.php'; ?>
<?php include_once 'functions.php'; ?>

<?php
// if (ifItIsMethod('post')) {
//   if (isset($_POST['user_email'])) {
//     $email = $_POST['user_email'];
//     $length = 50;
//     $token = bin2hex(openssl_random_pseudo_bytes($length));

//     if (email_exists($email)) {
//       if ($stmt = $pdo->prepare("UPDATE ahli_kariah SET token=:token WHERE user_email= ?")) {
//         $stmt->bindParam(':token', $email);
//         $stmt->execute();
//       }
//     } else {
//       echo "tak wujud";
//     }
//   }
// }

if (!isset($_GET['forgot'])) {
  redirect('log-masuk.php');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'Classes/Config.php';

// if (ifItIsMethod('post')) {
if (isset($_POST['submit'])) {

  $email = $_POST['user_email'];
  $length = 50;
  $token = bin2hex(openssl_random_pseudo_bytes($length));

  if (email_exists($email)) {
    if ($stmt = mysqli_prepare($conn, "UPDATE ahli_kariah SET token='{$token}' WHERE user_email= ?")) {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);


      //config phpmailer
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
        $mail->addAddress($email);

        $mail->Subject = 'This is a testing email';

        $mail->Body = '<p>Sila klik untuk set semula kata laluan anda

          <a href="http://localhost/khairat/reset.php?email=' . $email . '&token=' . $token . ' ">http://localhost/khairat/reset.php?email=' . $email . '&token=' . $token . '</a>

          </p>';

        if ($mail->send()) {
          $emailSent = true;
        } else {
          echo "not sent";
        }
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
  } elseif (email_penama($email)) {

    //   $email_penama = $_POST['user_email'];
    // $length = 50;
    // $token = bin2hex(openssl_random_pseudo_bytes($length));

    if ($stmt = mysqli_prepare($conn, "UPDATE penama SET penama_token='{$token}' WHERE penama_email= ?")) {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);


      //config phpmailer
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
        $mail->addAddress($email);

        $mail->Subject = 'This is a testing email untuk penama';

        $mail->Body = '<p>Sila klik untuk set semula kata laluan anda

          <a href="http://localhost/khairat/resetpenama.php?email=' . $email . '&token=' . $token . ' ">http://localhost/khairat/resetpenama.php?email=' . $email . '&token=' . $token . '</a>

          </p>';

        if ($mail->send()) {
          $emailSent = true;
        } else {
          echo "not sent";
        }
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
  } else {
    echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Emel tidak wujud",
                text: "Sila Daftar atau Kemaskini Butiran Anda",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
    header('refresh:2;log-masuk');
    // exit;
  }
}
//}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Title -->
  <title>E-Khairat Al Wustha - Set Semula</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Favicon -->
  <link rel="shortcut icon" href="admin/dist/img/logo.png">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="assets/vendor/animate.css">
  <link rel="stylesheet" href="assets/vendor/hs-megamenu/src/hs.megamenu.css">

  <!-- CSS Unify -->
  <link rel="stylesheet" href="assets/css/unify-core.css">
  <link rel="stylesheet" href="assets/css/unify-components.css">
  <link rel="stylesheet" href="assets/css/unify-globals.css">
  <link rel="stylesheet" href="assets/vendor/bootstrap-icons/font/bootstrap-icons.css" />

  <!-- CSS Customization -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="stylesheet" href="assets/css/theme.min.css" />
</head>

<body class="d-flex align-items-center min-h-100 bg-dark">
  <main id="content" role="main" class="flex-grow-1 overflow-hidden">
    <div class="container content-space-t-1 content-space-b-2">
      <div class="mx-lg-auto" style="max-width: 55rem">
        <div class="d-flex justify-content-center align-items-center flex-column min-vh-lg-100">

          <!-- Header -->


          <a class="navbar-brand mx-auto" href="index.php">
            <img src="admin/dist/img/logo.png" alt="Image Description" width="110" />
          </a>


          <!-- End Header -->

          <!-- Login -->
          <div class="container g-py-10 col-md-8">
            <!-- Card -->
            <div class="card card-shadow card-login">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="card-body">
                    <?php if (!isset($emailSent)) : ?>
                      <!-- Form -->
                      <form class="g-py-15" method="POST">

                        <input type="hidden" class="hide" name="token" id="token" value="">

                        <div class="text-center">
                          <div class="mb-5">
                            <h3 class="card-title">Kemaskini Semula</h3>
                          </div>
                        </div>
                        <div class="mb-4">
                          <label class="form-label" for="user_email">Emel</label>
                          <input type="email" class="form-control form-control-lg" name="user_email" id="user_email" tabindex="1" placeholder="Masukkan Emel" aria-label="Masukkan Emel" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                          <!-- <span class="invalid-feedback">Sila isi format NRIC yang betul</span> -->
                        </div>
                        <div class="d-grid gap-4">
                          <button type="submit" name="submit" class="btn btn-primary btn-lg">
                            Kemaskini Kata Laluan
                          </button>
                          <p class="card-text text-muted">
                            Ingat Kata Laluan?
                            <a class="link" href="log-masuk.php">Log Masuk</a>
                          </p>
                        </div>
                      </form>
                    <?php else : ?>
                      <footer class="text-center">
                        <p class="h2 g-color-black g-font-weight-600">Berjaya! Semak emel anda</p>
                        <?php
                        header("refresh:3;url=index.php");
                        ?>
                      </footer>
                    <?php endif; ?>
                    <!-- End Form -->
                  </div>
                </div>
                <!-- End Col -->


                <!-- End Col -->
              </div>
              <!-- End Row -->
            </div>
            <!-- End Card -->

            <!-- SVG Shape -->
            <figure class="position-absolute top-0 end-0 zi-n1 d-none d-sm-block mt-n7 me-n10" style="width: 4rem">
              <img class="img-fluid" src="img/pointer-up.svg" alt="Image Description" />
            </figure>
            <!-- End SVG Shape -->

            <!-- SVG Shape -->
            <figure class="position-absolute bottom-0 start-0 d-none d-sm-block ms-n10 mb-n10" style="width: 15rem">
              <img class="img-fluid" src="img/curved-shape.svg" alt="Image Description" />
            </figure>
            <!-- End SVG Shape -->
          </div>
          <!-- End Login -->
        </div>
      </div>
    </div>
  </main>

  <div class="u-outer-spaces-helper"></div>


</body>

</html>