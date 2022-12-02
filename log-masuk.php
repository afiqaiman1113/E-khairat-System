<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

<?php
include_once 'admin/database/connect.php';
session_start();
if (isset($_SESSION['kariah_id']) != "") {
  header("Location:user.php?p=utama");
  //exit();
}

//method kat bawah ni adalah PDO method, jgn gabra2, cer fahamkan dulu code dia
if (isset($_POST['btn_login'])) {

  $kariah_ic = !empty($_POST['kariah_ic']) ? trim($_POST['kariah_ic']) : null;
  $password = !empty($_POST['password']) ? trim($_POST['password']) : null;

  $sql = "SELECT * FROM ahli_kariah WHERE kariah_ic = :kariah_ic ";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':kariah_ic', $kariah_ic);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql = "SELECT * FROM penama WHERE penama_ic = :penama_ic ";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':penama_ic', $kariah_ic);
  $stmt->execute();
  $penama = $stmt->fetch(PDO::FETCH_ASSOC);

  // $validEmail = $user['kariah_ic'];
  // $validPassword = password_verify($password, $user['password']);
  // $validRole = $user['role'];

  // if ($user == false) {
  //   echo '<script type="text/javascript">
  //   jQuery(function validation() {
  //       swal({
  //           title: "No K/P Tiada Dalam Rekod",
  //           icon: "error",
  //           button: "Ok",
  //         });
  //   });
  //   </script>';
  // } else {
  if ($user > 0 && password_verify($password, $user['password']) == $password) {

    $_SESSION['kariah_id'] = $user['kariah_id'];
    $_SESSION['kariah_name'] = $user['kariah_name'];
    $_SESSION['kariah_ic'] = $user['kariah_ic'];
    $_SESSION['user_email'] = $user['user_email'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['tarikh_daftar'] = $user['tarikh_daftar'];

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
  } elseif ($penama > 0 && password_verify($password, $penama['penama_pass']) == $password) {

    $_SESSION['penama_id'] = $penama['penama_id'];

    echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Berjaya",
                icon: "success",
                button: "Ok",
              });
        });
        </script>';
    header('refresh:2;penama/penama.php?p=utama1');
  } elseif ($penama > 0 && password_verify($password, $penama['penama_pass']) != $password) {
    echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kata Laluan Salah",
                text: "No K/P Penama Wujud Dalam Rekod",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
  } elseif ($user > 0 && password_verify($password, $user['password']) != $password) {
    echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kata Laluan Salah",
                text: "No K/P Ahli Wujud Dalam Rekod",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
  } else {
    echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Rekod Tidak Wujud",
                text: "Sila Daftar",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
  }
  //}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Title -->
  <title>E-Khairat Al Wustha - Ahli</title>

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


          <a class="navbar-brand mx-auto" href="/khairat">
            <img src="admin/dist/img/logo.png" alt="Image Description" width="110" />
          </a>


          <!-- End Header -->

          <!-- Login -->
          <div class="position-relative">
            <!-- Card -->
            <div class="card card-shadow card-login">
              <div class="row">
                <div class="col-md-8">
                  <div class="card-body">
                    <!-- Form -->
                    <form class="g-py-15" action="log-masuk.php" method="post">
                      <div class="text-center">
                        <div class="mb-5">
                          <h3 class="card-title">Log Masuk</h3>
                        </div>
                      </div>

                      <!-- Form -->
                      <div class="mb-4">
                        <label class="form-label" for="kariah_ic">No Kad Pengenalan / No Pasport</label>
                        <?php $kariah_ic = !empty($_POST['kariah_ic']) ? trim($_POST['kariah_ic']) : null; ?>
                        <input type="text" class="form-control form-control-lg" name="kariah_ic" id="kariah_ic" value="<?php echo $kariah_ic; ?>" tabindex="1" placeholder="No Kad Pengenalan / No Pasport" aria-label="No Kad Pengenalan / No Pasport" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                        <span class="invalid-feedback">Sila isi format NRIC yang betul</span>
                      </div>
                      <!-- End Form -->

                      <!-- Form -->
                      <div class="mb-4">
                        <label class="form-label" for="signupSrPassword" tabindex="0">Kata Laluan</label>
                        <div class="input-group-merge">
                          <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="password" placeholder="Kata Laluan" aria-label="Kata Laluan" required="" oninvalid="this.setCustomValidity('Masukkan Kata Laluan')" oninput="setCustomValidity('')" data-hs-toggle-password-options='{
                                   "target": "#changePassTarget",
                                   "defaultClass": "bi-eye-slash",
                                   "showClass": "bi-eye",
                                   "classChangeTarget": "#changePassIcon"
                                 }' />
                          <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                            <i id="changePassIcon" class="bi-eye"></i>
                          </a>

                          <span class="invalid-feedback">Sila masukkan kata laluan yang betul</span>
                        </div>
                      </div>
                      <!-- End Form -->

                      <div class="d-flex justify-content-end mb-4">
                        <a class="form-label-link" href="set-semula.php?forgot=<?php echo uniqid(true); ?>">Lupa kata laluan?</a>
                      </div>

                      <div class="d-grid gap-4">
                        <button type="submit" name="btn_login" class="btn btn-primary btn-lg">
                          Log Masuk
                        </button>
                        <p class="card-text text-muted">
                          Belum Daftar?
                          <a class="link" href="daftar">Daftar Sini</a>
                        </p>
                      </div>
                    </form>
                    <!-- End Form -->
                  </div>
                </div>
                <!-- End Col -->

                <div class="col-md-4 d-md-flex justify-content-center flex-column bg-soft-primary p-8 p-md-5" style="
                      background-image: url(img/wave-pattern.svg);
                    ">
                  <h5 class="mb-4">Peringatan sebelum log masuk:</h5>
                  <!-- List Checked -->
                  <ul class="list-checked list-checked-primary list-py-2">
                    <li class="list-checked-item">Pastikan mengikut format NRIC yang telah ditetapkan</li>
                    <li class="list-checked-item">Pastikan rekod anda telah berdaftar</li>
                  </ul>
                  <!-- End List Checked -->
                </div>
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
    })();
  </script>

  <script>
    window.history.forward();
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