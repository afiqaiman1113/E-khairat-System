<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

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
  } elseif ($user > 0 && password_verify($password, $user['password']) != $password) {
    echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kata Laluan Salah",
                text: "No K/P Wujud Dalam Rekod",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
  } else {
    echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "No K/P Belum Berdaftar",
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
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C500%2C600%2C700%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik">
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
                  " href="log-masuk-backup.php">Log Masuk</a>
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
                  " href="log-masuk-backup.php">Log Masuk</a>
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
    <section class="container g-py-40">
      <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-5">
          <div class="g-brd-around g-brd-gray-light-v4 rounded g-py-40 g-px-30">
            <header class="text-center mb-4">
              <h2 class="h2 g-color-black g-font-weight-600">Log Masuk</h2>
            </header>

            <!-- Form -->
            <form class="g-py-15" action="log-masuk-backup.php" method="post">
              <div class="mb-4">
                <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="text" name="kariah_ic" id="kariah_ic" placeholder="No Kad Pengenalan" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')">
              </div>
              <div class="g-mb-35">
                <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15 mb-3" type="password" name="password" id="password" placeholder="Kata Laluan" required="" oninvalid="this.setCustomValidity('Masukkan Kata Laluan')" oninput="setCustomValidity('')">
                <div class="row justify-content-between">
                  <div class="col align-self-center">
                    <label class="form-check-inline u-check g-color-gray-dark-v5 g-font-size-12 g-pl-25 mb-0">
                      <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" id="lihat" onclick="myFunction()">
                      <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                        <i class="fa" data-check-icon="&#xf00c"></i>
                      </div>
                      Lihat Kata Laluan
                    </label>
                  </div>
                  <div class="col align-self-center text-right">
                    <a class="g-font-size-12" href="set-semula.php?forgot=<?php echo uniqid(true); ?>">Lupa Kata Laluan?</a>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <button class="btn btn-md btn-block u-btn-primary g-rounded-50 g-py-13" type="submit" name="btn_login">Log Masuk</button>
              </div>
            </form>
            <!-- End Form -->

            <footer class="text-center">
              <p class="g-color-gray-dark-v5 g-font-size-13 mb-0">Belum Daftar? <a class="g-font-weight-600" href="daftar.php">Daftar Sini</a>
              </p>
            </footer>
          </div>
        </div>
      </div>
    </section>
    <!-- End Login -->

  </main>

  <div class="u-outer-spaces-helper"></div>


  <!-- JS Global Compulsory -->
  <script src="assets/vendor/popper.js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/js/jquery.mask.min.js"></script>


  <!-- JS Implementing Plugins -->
  <script src="assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>

  <!-- JS Unify -->
  <script src="assets/js/hs.core.js"></script>
  <script src="assets/js/components/hs.header.js"></script>
  <script src="assets/js/components/hs.tabs.js"></script>
  <script src="assets/js/components/hs.go-to.js"></script>

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
      $('#kariah_ic').mask('000000-00-0000');
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