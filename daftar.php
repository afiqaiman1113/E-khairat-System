<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

<?php
include_once 'admin/database/connect.php';
session_start();

$select = $pdo->prepare("SELECT * FROM ahli_kariah ORDER BY kariah_id DESC");
$select->bindParam(':kariah_id', $kariah_id);
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$lastid = $row['no_ahli'];
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

if (isset($_POST['register'])) {

  $no_ahli = $_POST['no_ahli'];
  $kariah_name = $_POST['kariah_name'];
  $kariah_ic = $_POST['kariah_ic'];
  $user_email = $_POST['user_email'];
  //$kariah_umur = date('Y') - $_POST['kariah_umur'];
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
  $mati = $_POST['mati'];
  $token = $_POST['token'];
  $status_sms = $_POST['status_sms'];

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

    $sql = "SELECT * FROM penama WHERE penama_ic = :penama_ic ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':penama_ic', $kariah_ic);
    $stmt->execute();
    $penama = $stmt->fetch(PDO::FETCH_ASSOC);

    $email = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email ='$user_email' ");
    $email->execute([$user_email]);
    $em = $email->fetch();

    $sql = "SELECT * FROM penama WHERE penama_email = :penama_email ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':penama_email', $user_email);
    $stmt->execute();
    $penamaemail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($i) {
      echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "No kad pengenalan telah berdaftar",
                    icon: "warning",
                    button: "Ok",
                  });
            });
            </script>';
    } elseif ($penama > 0) {
      echo '<script type="text/javascript">
      jQuery(function validation() {
          swal({
              title: "Tidak Sah",
              text: "No K/P Sama Dengan No K/P Penama Yang Telah Berdaftar",
              icon: "warning",
              button: "Ok",
            });
      });
      </script>';
    } elseif ($penamaemail > 0) {
      echo '<script type="text/javascript">
      jQuery(function validation() {
          swal({
              title: "Tidak Sah",
              text: "Emel Sama Dengan Emel Penama Berdaftar",
              icon: "warning",
              button: "Ok",
            });
      });
      </script>';
    } elseif ($em) {
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
      $stmt = $pdo->prepare("INSERT INTO ahli_kariah(no_ahli, kariah_name, kariah_ic, user_email, jantina, pekerjaan, alamat, alamat2, poskod, bandar, negeri, s_menetap, tel_rumah, tel_hp, kawasan, tahun_menetap, status_perkahwinan, penerima_bantuan, password, tarikh_daftar, role, approvement, mati, token, status_sms)
            VALUES(:no_ahli, :kariah_name, :kariah_ic, :user_email, :jantina, :pekerjaan, :alamat, :alamat2, :poskod, :bandar, :negeri, :s_menetap, :tel_rumah, :tel_hp, :kawasan, :tahun_menetap, :status_perkahwinan, :penerima_bantuan, :password, :tarikh_daftar, :role, :approvement, :mati, :token, 0)");

      $stmt->bindParam(':no_ahli', $no_ahli);
      $stmt->bindParam(':kariah_name', $kariah_name);
      $stmt->bindParam(':kariah_ic', $kariah_ic);
      $stmt->bindParam(':user_email', $user_email);
      //$stmt->bindParam(':kariah_umur', $kariah_umur);
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
      $stmt->bindParam(':mati', $mati);
      $stmt->bindParam(':token', $token);

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
        header('refresh:2;log-masuk.php');
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
  <!-- Title -->
  <title>E-Khairat Al Wustha - Daftar</title>

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
          <div class="container g-py-10 col-md-8">
            <!-- Card -->
            <div class="card card-shadow card-login">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="card-body">
                    <!-- Form -->
                    <form class="g-py-15" action="" method="POST">
                      <?php
                      $kariah_name = $_POST['kariah_name'];
                      $kariah_ic = $_POST['kariah_ic'];
                      $user_email = $_POST['user_email'];
                      // $tel_hp = $_POST['tel_hp'];
                      ?>
                      <input type="hidden" name="no_ahli" class="form-control" value="<?php echo $empid; ?>" readonly />
                      <input type="hidden" name="status_sms" class="form-control" />
                      <div class="text-center">
                        <div class="mb-5">
                          <h3 class="card-title">Daftar Ahli</h3>
                        </div>
                      </div>

                      <div class="mb-4">
                        <label class="form-label" for="kariah_name">Nama</label>
                        <input type="text" class="form-control form-control-lg" name="kariah_name" onKeyUP="this.value = this.value.toUpperCase();" value="<?php echo $kariah_name; ?>" id="kariah_name" tabindex="1" placeholder="Nama Penuh" aria-label="Nama Penuh" required="" oninvalid="this.setCustomValidity('Isi Nama')" oninput="setCustomValidity('')" />
                        <!-- <span class="invalid-feedback">Sila isi format NRIC yang betul</span> -->
                      </div>
                      <div class="mb-4">
                        <label class="form-label" for="kariah_ic">No Kad Pengenalan / No Pasport</label>
                        <input type="text" class="form-control form-control-lg" name="kariah_ic" id="kariah_ic" value="<?php echo $kariah_ic; ?>" tabindex="1" placeholder="xxxxxx-xx-xxxx" aria-label="xxxxxx-xx-xxxx" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                        <!-- <span class="invalid-feedback">Sila isi format NRIC yang betul</span> -->
                      </div>
                      <div class="mb-4">
                        <label class="form-label" for="user_email">Emel</label>
                        <input type="email" class="form-control form-control-lg" name="user_email" id="user_email" value="<?php echo $user_email; ?>" tabindex="1" placeholder="Masukkan Emel" aria-label="Masukkan Emel" required="required" oninvalid="InvalidEmail(this);" />
                        <!-- <span class="invalid-feedback">Sila isi format NRIC yang betul</span> -->
                      </div>
                      <!-- <div class="mb-4">
                        <label class="form-label" for="tel_hp">No Tel Bimbit</label>
                        <input type="text" name="tel_hp" id="tel_hp" class="form-control" value="<?php //echo $tel_hp; ?>" placeholder="Tiada Dash (-)" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhonePenama(this);" oninput="InvalidPhonePenama(this);" />
                      </div> -->
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
                      <input type="hidden" name="kariah_umur" class="form-control" placeholder="Umur" />
                      <select name="jantina" class="form-control" id="" hidden>
                        <option value="">Jantina</option>
                        <option value="Lelaki"> Lelaki</option>
                        <option value="Perempuan"> Perempuan</option>
                      </select>
                      <input type="hidden" name="pekerjaan" class="form-control" placeholder="Pekerjaan" />
                      <input type="hidden" name="alamat" class="form-control" placeholder="" />
                      <input type="hidden" name="alamat2" class="form-control" placeholder="" />
                      <input type="hidden" name="poskod" class="form-control" placeholder="" />
                      <input type="hidden" name="bandar" class="form-control" placeholder="" />
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
                      <select name="s_menetap" class="form-control" id="" hidden>
                        <option value="">Status Menetap</option>
                        <option value="Sendiri">Sendiri</option>
                        <option value="Sewa">Sewa</option>
                      </select>
                      <input type="hidden" name="tel_rumah" class="form-control" placeholder="No Tel Rumah" />
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
                      <input type="hidden" name="tahun_menetap" class="form-control" placeholder="" />
                      <select name="status_perkahwinan" class="form-control" id="" hidden>
                        <option value="">Status</option>
                        <option value="Bujang"> Bujang</option>
                        <option value="Kahwin"> Kahwin</option>
                        <option value="Duda"> Duda</option>
                        <option value="Janda"> Janda</option>
                        <option value="Ibu Tunggal"> Ibu Tunggal</option>
                      </select>
                      <input type="hidden" name="penerima_bantuan" class="form-control" placeholder="" />
                      <select class="form-control" name="approvement" id="" hidden>
                        <option value="Belum Daftar">Belum Daftar</option>
                      </select>
                      <div class="form-group">
                        <select class="form-control" name="role" id="" hidden>
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
                      <div class="d-grid gap-4">
                        <button type="submit" name="register" class="btn btn-primary btn-lg">
                          Daftar
                        </button>
                        <p class="card-text text-muted">
                          Telah Daftar?
                          <a class="link" href="log-masuk.php">Log Masuk</a>
                        </p>
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
    })();

    function InvalidEmail(textbox) {

      if (textbox.value == '') {
        textbox.setCustomValidity('Wajib isi');
      } else if (textbox.validity.typeMismatch) {
        textbox.setCustomValidity('Sertakan @ untuk e-mel');
      } else {
        textbox.setCustomValidity('');
      }
      return true;
    }

    function InvalidPhonePenama(textbox) {

      if (textbox.value == '') {
        textbox.setCustomValidity('Wajib isi');
      } else if (textbox.validity.patternMismatch) {
        textbox.setCustomValidity('Tiada Dash (-)');
      } else {
        textbox.setCustomValidity('');
      }
      return true;
    }
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