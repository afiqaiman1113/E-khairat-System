<!-- jQuery -->
<script src="admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
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

if (ifItIsMethod('post')) {
  if (isset($_POST['user_email'])) {
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
      header('refresh:2');
      exit;
    }
  }
}

?>

<!-- if (ifItIsMethod('post')) {
    if (isset($_POST['user_email'])) {
        $email = $_POST['user_email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if (email_exists($email)) {
            if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }
} -->





<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Title -->
  <title>E-Khairat Al Wustha - Set Semula</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="shortcut icon" href="admin/dist/img/logo.png">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C500%2C600%2C700%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik">
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendor/icon-line-pro/style.css">
  <link rel="stylesheet" href="assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="assets/vendor/animate.css">
  <link rel="stylesheet" href="assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="assets/vendor/hamburgers/hamburgers.min.css">

  <!-- CSS Unify -->
  <link rel="stylesheet" href="assets/css/unify-core.css">
  <link rel="stylesheet" href="assets/css/unify-components.css">
  <link rel="stylesheet" href="assets/css/unify-globals.css">

  <!-- CSS Customization -->
  <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
  <main>


    <!-- Header -->
    <header id="js-header" class="u-header u-header--static">
      <div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10">
        <nav class="js-mega-menu navbar navbar-expand-lg hs-menu-initialized hs-menu-horizontal">
          <div class="container">

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

            <?php
            if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
              echo '
              <div class="d-inline-block g-pl-0--lg" style="margin:0 auto;">
                <a class="
                  btn
                  u-btn-outline-primary
                  g-font-size-13
                  text-uppercase
                  g-py-10 g-px-15
                  " href="daftar.php">Daftar</a>&nbsp&nbsp&nbsp
                <a class="
                  btn
                  u-btn-outline-primary
                  g-font-size-13
                  text-uppercase
                  g-py-10 g-px-15
                  " href="log-masuk.php">Log Masuk</a>
              </div>
              ';
            } else {
              echo '
              <div class="d-inline-block g-pl-0--lg">
                <a class="
                  btn
                  u-btn-outline-primary
                  g-font-size-13
                  text-uppercase
                  g-py-10 g-px-15
                  " href="daftar.php">Daftar</a>&nbsp&nbsp&nbsp
                <a class="
                  btn
                  u-btn-outline-primary
                  g-font-size-13
                  text-uppercase
                  g-py-10 g-px-15
                  " href="log-masuk.php">Log Masuk</a>
              </div>
              ';
            }
            ?>

          </div>
        </nav>
      </div>
    </header>
    <!-- End Header -->

    <!-- Login -->
    <section class="container g-py-150">
      <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-6">
          <div class="g-brd-around g-brd-gray-light-v4 rounded g-py-40 g-px-30">
            <header class="text-center mb-4">

              <?php if (!isset($emailSent)) : ?>
                <h2 class="h2 g-color-black g-font-weight-600">Terlupa Kata Laluan?</h2>
                <p class="h5 g-color-black g-font-weight-100">Kemaskini semula di sini</p>
            </header>

            <!-- Form -->
            <form class="g-py-15" method="post">
              <div class="mb-4">
                <div class="input-group g-brd-primary--focus">
                  <div class="input-group-prepend">
                    <span class="input-group-text g-width-45 g-brd-right-none g-brd-gray-light-v4 g-color-gray-dark-v5"><i class="icon-communication-061"></i></span>
                  </div>
                  <input class="form-control g-color-black g-bg-white g-brd-gray-light-v4 g-py-15 g-px-15" type="email" name="user_email" placeholder="Emel Anda" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')">
                </div>
              </div>

              <div class="mb-4">
                <button class="btn btn-md btn-block u-btn-primary g-rounded-50 g-py-13" type="submit">Kemaskini Semula</button>
              </div>

              <input type="hidden" class="hide" name="token" id="token" value="">

            </form>
            <!-- End Form -->

          <?php else : ?>
            <footer class="text-center">
              <p class="h2 g-color-black g-font-weight-600">Berjaya! Semak emel anda</p>
              <?php
              header( "refresh:3;url=index.php" );
              ?>
            </footer>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- End Login -->

  </main>


</body>

</html>