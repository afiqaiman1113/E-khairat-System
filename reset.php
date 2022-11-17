<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/dist/js/adminlte.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

<?php include_once 'admin/database/db.php'; ?>
<?php include_once 'functions.php'; ?>

<?php

if (!isset($_GET['user_email']) && !isset($_GET['token'])) {
  redirect('log-masuk.php');
}

$email = $_GET['email']; //dia get dari set-semula.php dimana kat part http://localhost/khairat/reset.php?email
$token = $_GET['token']; //sama jugak

// $email = 'syahrilashraf769@gmail.com';
// $token = '0ccc725c38a0781ad5d0e197de7df331809757a579a78680bc3a8bdbf27c815b1ea7e5c05c20e92c6f98487242dc5c25bcad';

if ($stmt = mysqli_prepare($conn, 'SELECT kariah_ic, user_email, token FROM ahli_kariah WHERE token= ?')) {
  mysqli_stmt_bind_param($stmt, "s", $token);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $kariah_ic, $user_email, $token);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  // if($_GET['token'] !== $token || $_GET['user_email'] !== $user_email) {
  //   redirect('log-masuk.php');
  // }

  if (isset($_POST['btn_update_pass'])) {

    $password = $_POST['password'];
    $confirm_pass = $_POST['confirmpassword'];

    if ($password === $confirm_pass) {

      $hashpassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

      if ($stmt = mysqli_prepare($conn, "UPDATE ahli_kariah SET token= '', password='{$hashpassword}' WHERE user_email = ?")) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) >= 1) {
          echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kemaskini Berjaya",
                icon: "success",
                button: "Ok",
              });
        });
        </script>';
          header('refresh:2;log-masuk.php');
        }
      }
    } else {
      echo '<script type="text/javascript">
    jQuery(function validation(){
    swal({
      title: "Kata Laluan Tak Sama",
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
                    <!-- Form -->
                    <form class="g-py-15" method="POST">
                      <input type="hidden" class="hide" name="token" id="token" value="">
                      <div class="text-center">
                        <div class="mb-5">
                          <h3 class="card-title">Kemaskini Kata Laluan Ahli</h3>
                        </div>
                      </div>
                      <div class="mb-4">
                        <label class="form-label" for="signupSrPassword" tabindex="0">Kata Laluan</label>
                        <div class="input-group-merge">
                          <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="password" placeholder="" aria-label="Kata Laluan" required="" oninvalid="this.setCustomValidity('Masukkan Kata Laluan')" oninput="setCustomValidity('')" data-hs-toggle-password-options='{
                                   "target": "#changePassTarget",
                                   "defaultClass": "bi-eye-slash",
                                   "showClass": "bi-eye",
                                   "classChangeTarget": "#changePassIcon"
                                 }' />
                          <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                            <i id="changePassIcon" class="bi-eye"></i>
                          </a>
                        </div>
                        <div class="mb-4">
                          <label class="form-label" for="signupSrPassword" tabindex="1">Sahkan Kata Laluan</label>
                          <div class="input-group-merge">
                            <input type="password" class="js-toggle-confirmpassword form-control form-control-lg" name="confirmpassword" placeholder="" aria-label="Kata Laluan" required="" oninvalid="this.setCustomValidity('Masukkan Kata Laluan')" oninput="setCustomValidity('')" data-hs-toggle-password-options='{
                                   "target": "#changePassTarget1",
                                   "defaultClass": "bi-eye-slash",
                                   "showClass": "bi-eye",
                                   "classChangeTarget": "#changePassIcon1"
                                 }' />
                            <a id="changePassTarget1" class="input-group-append input-group-text" href="javascript:;">
                              <i id="changePassIcon1" class="bi-eye"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="d-grid gap-4">
                        <button type="submit" name="btn_update_pass" class="btn btn-primary btn-lg">
                          Kemaskini
                        </button>
                      </div>
                    </form>
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

  <!-- JS Global Compulsory -->
  <script src="assets/vendor/popper.js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/js/jquery.mask.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


  <!-- JS Implementing Plugins -->
  <script src="assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
  <script src="assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js"></script>

  <!-- JS Unify -->
  <script src="assets/js/hs.core.js"></script>
  <script src="assets/js/components/hs.header.js"></script>
  <script src="assets/js/components/hs.tabs.js"></script>
  <script src="assets/js/components/hs.go-to.js"></script>
  <script src="assets/js/theme.min.js"></script>

  <!-- JS Customization -->
  <script src="assets/js/custom.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function() {
      // initialization of tabs
      $.HSCore.components.HSTabs.init('[role="tablist"]');

      // initialization of go to
      $.HSCore.components.HSGoTo.init('.js-go-to');
    });

    $(window).on('resize', function() {
      setTimeout(function() {
        $.HSCore.components.HSTabs.init('[role="tablist"]');
      }, 200);
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

    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

  <script>
    (function() {
      // INITIALIZATION OF BOOTSTRAP VALIDATION
      // =======================================================
      HSBsValidation.init(".js-validate", {
        onSubmit: (data) => {
          data.event.preventDefault();
          alert("Submited");
        },
      });

      // INITIALIZATION OF TOGGLE PASSWORD
      // =======================================================
      new HSTogglePassword(".js-toggle-password");
      new HSTogglePassword(".js-toggle-confirmpassword");
    })();
  </script>



  <div id="resolutionCaution" class="text-left g-max-width-600 g-bg-white g-pa-20" style="display: none;">
    <button type="button" class="close" onclick="Custombox.modal.close();">
      <i class="hs-icon hs-icon-close"></i>
    </button>
    <h4 class="g-mb-20">Screen resolution less than 1400px</h4>
  </div>

  <div id="copyModal" class="text-left modal-demo g-bg-white g-color-black g-pa-20" style="display: none;"></div>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="assets/vendor/chosen/chosen.css">
  <link rel="stylesheet" href="assets/vendor/prism/themes/prism.css">
  <link rel="stylesheet" href="assets/vendor/custombox/custombox.min.css">
  <!-- End CSS -->

  <!-- Scripts -->
  <script src="assets/vendor/chosen/chosen.jquery.js"></script>
  <script src="assets/vendor/image-select/src/ImageSelect.jquery.js"></script>
  <script src="assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="assets/vendor/custombox/custombox.min.js"></script>
  <script src="assets/vendor/clipboard/dist/clipboard.min.js"></script>

  <!-- Prism -->
  <script src="assets/vendor/prism/prism.js"></script>
  <script src="assets/vendor/prism/components/prism-markup.min.js"></script>
  <script src="assets/vendor/prism/components/prism-css.min.js"></script>
  <script src="assets/vendor/prism/components/prism-clike.min.js"></script>
  <script src="assets/vendor/prism/components/prism-javascript.min.js"></script>
  <script src="assets/vendor/prism/plugins/toolbar/prism-toolbar.min.js"></script>
  <script src="assets/vendor/prism/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
  <!-- End Prism -->

  <script src="assets/js/components/hs.scrollbar.js"></script>
  <script src="assets/js/components/hs.select.js"></script>
  <script src="assets/js/components/hs.modal-window.js"></script>
  <script src="assets/js/components/hs.markup-copy.js"></script>
  <!-- End Scripts -->
  <!-- End Style Switcher -->


</body>

</html>