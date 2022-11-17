<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

<?php include_once 'admin/database/db.php'; ?>
<?php //include_once 'functions.php';
?>

<?php
if (isset($_POST['btn_semak'])) {
  $ic_no = $_POST['kariah_ic'];
  $query = "SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = '$ic_no' ";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    echo '<script type="text/javascript">
      jQuery(function validation() {
          swal({
              title: "Rekod Wujud",
              icon: "success",
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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Title -->
  <title>E-Khairat Al Wustha</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="admin/dist/img/logo.png" />
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css" />
  <!-- CSS Global Icons -->
  <link rel="stylesheet" href="assets/vendor/icon-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="assets/vendor/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="assets/vendor/icon-line/css/simple-line-icons.css" />
  <link rel="stylesheet" href="assets/vendor/icon-etlinefont/style.css" />
  <link rel="stylesheet" href="assets/vendor/icon-line-pro/style.css" />
  <link rel="stylesheet" href="assets/vendor/icon-hs/style.css" />
  <link rel="stylesheet" href="assets/vendor/animate.css" />
  <link rel="stylesheet" href="assets/vendor/dzsparallaxer/dzsparallaxer.css" />
  <link rel="stylesheet" href="assets/vendor/dzsparallaxer/dzsscroller/scroller.css" />
  <link rel="stylesheet" href="assets/vendor/dzsparallaxer/advancedscroller/plugin.css" />
  <link rel="stylesheet" href="assets/vendor/slick-carousel/slick/slick.css" />
  <link rel="stylesheet" href="assets/vendor/cubeportfolio-full/cubeportfolio/css/cubeportfolio.min.css" />
  <link rel="stylesheet" href="assets/vendor/hs-bg-video/hs-bg-video.css" />
  <link rel="stylesheet" href="assets/vendor/fancybox/jquery.fancybox.css" />
  <link rel="stylesheet" href="assets/vendor/hs-megamenu/src/hs.megamenu.css" />
  <link rel="stylesheet" href="assets/vendor/hamburgers/hamburgers.min.css" />

  <!-- CSS Unify -->
  <link rel="stylesheet" href="assets/css/unify-core.css" />
  <link rel="stylesheet" href="assets/css/unify-components.css" />
  <link rel="stylesheet" href="assets/css/unify-globals.css" />
  <link rel="stylesheet" href="assets/css/theme.min.css" />

  <!-- CSS Customization -->
  <link rel="stylesheet" href="assets/css/custom.css" />
</head>

<body>
  <main>
    <!-- Header -->
    <header id="header" class="navbar navbar-expand-lg navbar-end navbar-light navbar-absolute-top navbar-show-hide" data-hs-header-options='{
            "fixMoment": 0,
            "fixEffect": "slide"
          }'>
      <div class="container">
        <nav class="js-mega-menu navbar-nav-wrap">
          <!-- Default Logo -->
          <?php
          $useragent = $_SERVER['HTTP_USER_AGENT'];
          if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
            echo '
                <a href="/khairat" class="navbar-brand d-flex">
                  <center>
                   <img src="ntah.png" width="65%"  />
                  </center>
                </a>
                 ';
          } else {
            echo '
                <a href="/khairat" class="navbar-brand d-flex">
                  <img src="ntah.png" width="70%"  />
                </a>
                ';
          }
          ?>
          <!-- End Default Logo -->


          <!-- Collapse -->
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-absolute-top-scroller">
              <ul class="navbar-nav nav-pills">
                <li class="nav-item ms-lg-auto">
                  <a class="btn btn-primary" href="log-masuk">Log Masuk</a>
                  <a class="btn btn-ghost-dark" href="daftar">Daftar</a>
                </li>

              </ul>
            </div>
          </div>
          <!-- End Collapse -->
        </nav>
      </div>
    </header>
    <!-- End Header -->
    <main id="content" role="main">
      <!-- Hero -->
      <div class="container content-space-t-3">
        <div class="row justify-content-lg-between align-items-lg-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="mb-5">
              <img class="img-fluid" src="img/khat2.png" alt="Image Description" width="500" />
              <h1 class="display-6 text-dark mb-5">
                Selamat Datang ke Portal Pengurusan E-Khairat Masjid Al-Wustha
              </h1>
            </div>

            <?php
            $useragent = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
              echo '

            <div class="d-grid d-sm-flex gap-3 mb-5">
            <a class="btn btn-primary" href="log-masuk">Log Masuk</a>
            <a class="btn btn-ghost-dark btn-pointer" href="daftar">Daftar</a>
          </div>
                 ';
            } else {
              echo '

                ';
            }
            ?>

          </div>
          <!-- End Col -->

          <div class="col-lg-6">
            <div class="g-brd-around g-brd-gray-light-v4 rounded g-py-40 g-px-30">
              <header class="text-center mb-4">

                <h2 class="h2 g-color-black g-font-weight-600">Semak Rekod Ahli Kariah</h2>
                <!-- <p class="h5 g-color-black g-font-weight-100">Contoh: XXXXXX-XX-XXXX</p> -->
              </header>

              <!-- Form -->
              <form class="g-py-15" method="post">
                <div class="mb-4">
                  <div class="input-group g-brd-primary--focus">
                    <div class="input-group-prepend">
                      <span class="input-group-text g-width-45 g-brd-right-none g-brd-gray-light-v4 g-color-gray-dark-v5"><i class="icon-communication-109"></i></span>
                    </div>
                    <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="text" name="kariah_ic" id="kariah_ic" placeholder="No Kad Pengenalan / No Pasport" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')">
                  </div>
                </div>

                <div class="mb-4">
                  <button class="btn btn-primary btn-block g-rounded-50 g-py-13 col" type="submit" name="btn_semak">SEMAK</button>
                </div>
              </form>
              <!-- End Form -->
            </div>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Hero -->
      <br><br>
      <!-- Testimonials -->
      <section id="content" class="g-bg-secondary">
        <div class="container g-pt-30 g-pb-30">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="text-center">
                <h2>Dalil Khairat Kematian</h2>
              </div>
              <div class="js-carousel text-center g-pt-30" data-infinite="true" data-autoplay="true" data-fade="true" data-speed="4000">
                <div class="js-slide">
                  <blockquote class="
                      lead
                      g-color-black g-font-size-22 g-line-height-2
                      mb-4
                    ">
                    كُلُّ نَفْسٍ ذَائِقَةُ الْمَوْتِ ۖ ثُمَّ إِلَيْنَا
                    تُرْجَعُونَ
                  </blockquote>
                  <blockquote class="
                      lead
                      g-color-black g-font-size-18 g-line-height-2
                      mb-4
                    ">
                    “Tiap-tiap diri (sudah tetap) akan merasai mati, kemudian
                    kamu akan dikembalikan kepada Kami (untuk menerima balasan)”
                  </blockquote>
                  <span class="d-block g-color-black g-font-size-17 mb-4">Surah al-‘Ankabut: 57</span>
                </div>
                <div class="js-slide">
                  <blockquote class="
                      lead
                      g-color-black g-font-size-22 g-line-height-2
                      mb-4
                    ">
                    فإن تعذر فعلى أغنياء المسلمين وأهل الخير، احتراما لإنسانيته،
                    وتكافلاً وتضامناً معه
                  </blockquote>
                  <blockquote class="
                      lead
                      g-color-black g-font-size-18 g-line-height-2
                      mb-4
                    ">
                    “Jika tidak mampu, maka ke atas orang-orang Muslim yang kaya
                    dan ahli kebajikan (untuk membiayai kos pengurusan jenazah),
                    sebagai tanda hormat, bantu-membantu, sokong menyokong
                    sesama manusia"
                  </blockquote>
                  <span class="d-block g-color-black g-font-size-17 mb-4">Lihat: al-Mu’tamad fi al-Fiqh al-Syafi’i, 4/346</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- Icon Blocks -->
      <div class="container content-space-t-2 content-space-t-lg-1">
        <div class="row">
          <div class="col-sm-6 col-lg mb-5 mb-lg-0">
            <!-- Icon Block -->
            <div class="text-center">
              <div class="mb-3">
                <i class="bi-person fs-1 text-dark"></i>
              </div>

              <h5>Pendaftaran Ahli</h5>
              <span class="d-block">Ahli kariah boleh mendaftar dengan E-Khairat Al Wustha secara atas talian</span>
            </div>
            <!-- End Icon Block -->
          </div>
          <!-- End Col -->

          <div class="col-sm-6 col-lg mb-5 mb-lg-0">
            <!-- Icon Block -->
            <div class="text-center">
              <div class="mb-3">
                <i class="bi-people fs-1 text-dark"></i>
              </div>

              <h5>Semak Keahlian</h5>
              <span class="d-block">Ahli Kariah boleh membuat semakan status keahlian & bayaran</span>
            </div>
            <!-- End Icon Block -->
          </div>
          <!-- End Col -->

          <div class="col-sm-6 col-lg mb-5 mb-sm-0">
            <!-- Icon Block -->
            <div class="text-center">
              <div class="mb-3">
                <i class="bi-pencil-square fs-1 text-dark"></i>
              </div>

              <h5>Kemaskini Maklumat Ahli</h5>
              <span class="d-block">Ahli berdaftar boleh mengemaskini maklumat diri dan ahli keluarga</span>
            </div>
            <!-- End Icon Block -->
          </div>
          <!-- End Col -->

          <div class="col-sm-6 col-lg">
            <!-- Icon Block -->
            <div class="text-center">
              <div class="mb-3">
                <i class="bi-credit-card fs-1 text-dark"></i>
              </div>

              <h5>Pembayaran Secara Atas Talian</h5>
              <span class="d-block">Ahli kariah boleh membuat bayaran secara online menggunakan FPX</span>
            </div>
            <!-- End Icon Block -->
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Icon Blocks -->

      <!-- Features -->
      <div class="container content-space-t-2 content-space-t-lg-3">
        <div class="row justify-content-lg-between align-items-lg-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <img class="img-fluid rounded-3" src="assets/img/masjid.jpg" alt="Image Description" />
          </div>
          <!-- End Col -->

          <div class="col-lg-5">
            <div class="mb-5">
              <h2>Syarat Penyertaan Khairat Kematian Masjid Al-Wustha</h2>
              <p>
                Keahlian Badan Khairat Kematian ini dibuka kepada penduduk Islam yang bermastautin dalam kariah Masjid Al-Wustha dan kariah luar juga diterima
              </p>
            </div>

            <!-- List Checked -->
            <ul class="list-checked list-checked-soft-bg-primary list-checked-lg mb-5">
              <li class="list-checked-item">
                <span class="fw-bold">Yuran tahunan tetap 1 keluarga : RM 50.00 (Suami, Isteri & Tanggungan)
              </li>
              <li class="list-checked-item">
                <span class="fw-bold">Keahlian khairat kematian perlu diperbaharui setiap tahun apabila tamat tempohnya</span>
              </li>
              <li class="list-checked-item">
                <span class="fw-bold">Ahli khairat kematian wajib mendaftarkan penama bagi urusan tuntutan kematian</span>
              </li>
            </ul>
            <!-- End List Checked -->
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Features -->



      <!-- Card Grid -->
      <div class="container content-space-2 content-space-lg-3">
        <!-- Heading -->
        <div class="w-lg-65 text-center mx-lg-auto mb-5 mb-sm-7 mb-lg-10">
          <h2>Mengenai Kami</h2>
          <!-- <p>
            Start with award-winning templates, then customize to fit your style
            and professional needs.
          </p> -->
        </div>
        <!-- End Heading -->

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
          <div class="col mb-5 mb-md-0">
            <!-- Card -->
            <a class="card card-ghost card-transition-zoom h-100">
              <div class="card-transition-zoom-item">
                <img class="card-img" src="assets/img/taawun.jpg" alt="Image Description" />
              </div>

              <div class="card-body">
                <h4>Konsep</h4>
                <p class="card-text">
                  Tabung khairat kematian ini berdasarkan konsep Takaful & Ta'awun. Pengurusan jenazah serta pampasan manfaat kematian akan di uruskan sendiri oleh pasukan Khairat yang bernaung di bawah Masjid Al-Wustha.
                </p>
              </div>

            </a>
            <!-- End Card -->
          </div>
          <!-- End Col -->

          <div class="col mb-5 mb-md-0">
            <!-- Card -->
            <a class="card card-ghost card-transition-zoom h-100">
              <div class="card-pinned card-transition-zoom-item">
                <img class="card-img" src="assets/img/konsep.jpg" alt="Image Description" />
              </div>
              <div class="card-body">
                <h4>Objektif</h4>
                <ul class="list-checked list-checked-soft-bg-primary list-checked-lg mb-5">
                  <li class="list-checked-item">Melaksanakan tuntutan fardhu kifayah kepada seluruh ahli kariah.</li>
                  <li class="list-checked-item">Menguruskan tabungan ahli & jenazah ke arah yang lebih efisyen dan produktif.</li>
                  <li class="list-checked-item">Memudahkan urusan pembayaran dan tuntutan khairat melalui atas talian.</li>
                </ul>
              </div>
            </a>
            <!-- End Card -->
          </div>
          <!-- End Col -->

          <div class="col">
            <!-- Card -->
            <a class="card card-ghost card-transition-zoom h-100">
              <div class="card-transition-zoom-item">
                <img class="card-img" src="assets/img/masjid.png" alt="Image Description" />
              </div>

              <div class="card-body">
                <h4>Visi</h4>
                <p class="card-text">
                  Memantapkan institusi Masjid sebagai Pusat Modal Insan Masyarakat
                </p>
              </div>

            </a>
            <!-- End Card -->
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Card Grid -->
    </main>


    <div class="container content-space-b-2 content-space-b-lg-3">
      <div class="row">
        <div class="col-lg-4 mb-5 mb-lg-0">
          <h3>Soalan & Jawapan</h3>
        </div>
        <!-- End Col -->

        <div class="col-lg-8">
          <!-- Accordion -->
          <div class="accordion accordion-flush" id="accordionFAQ">
            <!-- Accordion Item -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingOne">
                <a class="accordion-button" role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Berapakah Sumbangan Yuran Tahunan tetap bagi 1 Keluarga?
                </a>
              </div>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                <div class="accordion-body">
                  Sumbangan Yuran Tahunan tetap bagi 1 Keluarga : RM 50.00 ( Suami , Isteri seorang & Tanggungan sahaja ).
                </div>
              </div>
            </div>
            <!-- End Accordion Item -->

            <!-- Accordion Item -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingTwo">
                <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Apakah kaedah pembayaran yang boleh dilakukan?
                </a>
              </div>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                <div class="accordion-body">
                  Kaedah pembayaran boleh dilakukan samada melalui tunai atau atas talian (online) menggunakan FPX
                </div>
              </div>
            </div>
            <!-- End Accordion Item -->

            <!-- Accordion Item -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingThree">
                <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana saya ingin mendapatkan resit bayaran?
                </a>
              </div>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFAQ">
                <div class="accordion-body">
                  Resit bayaran akan dicetak secara automatik apabila bayaran telah dilakukan. Sila log masuk akaun anda menggunakan no kad pengenalan dan kata laluan yang telah didaftarkan atau boleh mohon resit bayaran di pejabat masjid
                </div>
              </div>
            </div>
            <!-- End Accordion Item -->

            <!-- Accordion Item -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingFour">
                <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Siapakah yang layak mendaftar khairat kematian Masjid Al-Wustha?
                </a>
              </div>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFAQ">
                <div class="accordion-body">
                  Penyertaan sebagai ahli khairat ini terbuka kepada semua penduduk islam seluruh kariah Guar Chempedak.
                </div>
              </div>
            </div>
            <!-- End Accordion Item -->

            <!-- Accordion Item -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingFive">
                <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                  How do I get access to a theme I purchased?
                </a>
              </div>
              <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionFAQ">
                <div class="accordion-body">
                  If you lose the link for a theme you purchased, don't panic! We've got you covered. You can login to your account, tap your avatar in the upper right corner, and tap Purchases. If you didn't create a login or can't remember the information, you can use our handy Redownload page, just remember to use the same email you originally made your purchases with.
                </div>
              </div>
            </div>
            <!-- End Accordion Item -->

            <!-- Accordion Item -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingSix">
                <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                  Upgrade License Type
                </a>
              </div>
              <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionFAQ">
                <div class="accordion-body">
                  There may be times when you need to upgrade your license from the original type you purchased and we have a solution that ensures you can apply your original purchase cost to the new license purchase.
                </div>
              </div>
            </div>
            <!-- End Accordion Item -->
          </div>
          <!-- End Accordion -->
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>



    <!-- Footer -->
    <footer class="bg-dark">
      <div class="container">

        <div class="border-bottom border-white-10">
          <div class="row py-4">
            <div class="col-6 col-sm-4 col-lg mb-7 mb-sm-0">
              <span class="text-cap text-white">Hubungi Kami</span>
              <!-- List -->
              <ul class="list-unstyled list-py-1 mb-5">
                <li>
                  <a class="link link-light link-light-75" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi bi-telephone-fill"></i>
                      </div>
                      <div class="flex-grow-1 ms-2">
                        <span>04-468 0301</span>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="link link-light link-light-75" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi-envelope-open-fill"></i>
                      </div>
                      <div class="flex-grow-1 ms-2">
                        <span>bendaharimawgc@gmail.com</span>
                      </div>
                    </div>
                  </a>
                </li>

              </ul>
              <!-- End List -->
            </div>
            <!-- End Col -->

            <div class="col-6 col-sm-4 col-lg">
              <span class="text-cap text-white">Perkembangan Kami</span>
              <!-- List -->
              <ul class="list-unstyled list-py-2 mb-0">
                <li>
                  <a class="link link-light link-light-75" href="https://www.facebook.com/MAWGCOFFICIAL">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi-facebook"></i>
                      </div>
                      <div class="flex-grow-1 ms-2">
                        <span>Facebook</span>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- End List -->
            </div>
            <!-- End Col -->
          </div>
          <!-- End Row -->
        </div>

        <div class="row align-items-md-center py-4">
          <div class="col-md mb-3 mb-md-0">

            <ul class="list-inline list-px-2 mb-0">
              <li class="list-inline-item">
                <a class="link link-light link-light-75" href="#">Privacy and Policy</a>
              </li>
              <li class="list-inline-item">
                <a class="link link-light link-light-75" href="#">Terms</a>
              </li>
              <li class="list-inline-item">
                <a class="link link-light link-light-75" href="#">Status</a>
              </li>
            </ul>

          </div>
          <!-- End Col -->

          <div class="col-md-auto">
            <p class="fs-5 text-white-70 mb-0">2022 &copy; Hak Cipta Terpelihara , Masjid Al-Wustha Guar Chempedak</p>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
    </footer>
    <!-- End Footer -->

    <a class="js-go-to u-go-to-v1" href="#" data-type="fixed" data-position='{
     "bottom": 15,
     "right": 15
   }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
      <i class="hs-icon hs-icon-arrow-top"></i>
    </a>
  </main>

  <div class="u-outer-spaces-helper"></div>

  <!-- JS Global Compulsory -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
  <script src="assets/vendor/popper.js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/js/jquery.mask.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- JS Implementing Plugins -->
  <script src="assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
  <script src="assets/vendor/hs-megamenu/src/hs-mega-menu.min.js"></script>
  <script src="assets/vendor/hs-go-to/dist/hs-go-to.min.js"></script>
  <script src="assets/vendor/hs-header/dist/hs-header.min.js"></script>
  <script src="assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
  <script src="assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
  <script src="assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
  <script src="assets/vendor/slick-carousel/slick/slick.js"></script>
  <script src="assets/vendor/cubeportfolio-full/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
  <script src="assets/vendor/hs-bg-video/hs-bg-video.js"></script>
  <script src="assets/vendor/hs-bg-video/vendor/player.min.js"></script>
  <script src="assets/vendor/fancybox/jquery.fancybox.min.js"></script>

  <!-- JS Unify -->
  <script src="assets/js/hs.core.js"></script>
  <script src="assets/js/components/hs.header.js"></script>
  <script src="assets/js/helpers/hs.hamburgers.js"></script>
  <script src="assets/js/components/hs.tabs.js"></script>
  <script src="assets/js/components/hs.go-to.js"></script>
  <script src="assets/js/components/hs.carousel.js"></script>
  <script src="assets/js/components/hs.cubeportfolio.js"></script>
  <script src="assets/js/helpers/hs.bg-video.js"></script>
  <script src="assets/js/components/hs.popup.js"></script>
  <script src="assets/js/components/hs.go-to.js"></script>
  <script src="assets/js/theme.min.js"></script>

  <!-- JS Customization -->
  <script src="assets/js/custom.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    //format ic
    $(document).ready(function() {
        var masks = ["A00000000000", '000000-00-0000'];
        var options = {
            onKeyPress: function(cep, e, field, options) {
                var mask = (cep.length == 12) ? masks[1] : masks[0];
                $('#kariah_ic').mask(mask, options);
            }
        };

        $('#kariah_ic').mask(masks[0], options);
    });

    $(document).on("ready", function() {
      // initialization of carousel
      $.HSCore.components.HSCarousel.init(".js-carousel");

      // initialization of tabs
      $.HSCore.components.HSTabs.init('[role="tablist"]');

      // initialization of go to
      $.HSCore.components.HSGoTo.init(".js-go-to");

      // initialization of video on background
      $.HSCore.helpers.HSBgVideo.init(".js-bg-video");

      // initialization of popups
      $.HSCore.components.HSPopup.init(".js-fancybox");
    });

    $(window).on("load", function() {
      // initialization of header
      $.HSCore.components.HSHeader.init($("#js-header"));
      $.HSCore.helpers.HSHamburgers.init(".hamburger");

      // initialization of HSMegaMenu component
      $(".js-mega-menu").HSMegaMenu({
        event: "hover",
        pageContainer: $(".container"),
        breakpoint: 991,
      });

      // initialization of cubeportfolio
      $.HSCore.components.HSCubeportfolio.init(".cbp");
    });

    $(window).on("resize", function() {
      setTimeout(function() {
        $.HSCore.components.HSTabs.init('[role="tablist"]');
      }, 200);
    });
  </script>

  <div id="resolutionCaution" class="text-left g-max-width-600 g-bg-white g-pa-20" style="display: none">
    <button type="button" class="close" onclick="Custombox.modal.close();">
      <i class="hs-icon hs-icon-close"></i>
    </button>
    <h4 class="g-mb-20">Screen resolution less than 1400px</h4>
  </div>

  <div id="copyModal" class="text-left modal-demo g-bg-white g-color-black g-pa-20" style="display: none"></div>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css" />
  <link rel="stylesheet" href="assets/vendor/chosen/chosen.css" />
  <link rel="stylesheet" href="assets/vendor/prism/themes/prism.css" />
  <link rel="stylesheet" href="assets/vendor/custombox/custombox.min.css" />
  <link rel="stylesheet" href="assets/style-switcher/vendor/spectrum/spectrum.css" />
  <link rel="stylesheet" href="assets/style-switcher/vendor/spectrum/themes/sp-dark.css" />
  <link rel="stylesheet" href="assets/style-switcher/style-switcher.css" />
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

  <script src="assets/style-switcher/vendor/cookiejs/jquery.cookie.js"></script>
  <script src="assets/style-switcher/vendor/spectrum/spectrum.js"></script>
  <script src="assets/style-switcher/style-switcher.js"></script>
  <!-- End Scripts -->
  <!-- End Style Switcher -->

  <!-- JS Plugins Init. -->
  <script>
    (function() {
      // INITIALIZATION OF NAVBAR
      // =======================================================
      new HSHeader("#header").init();

      // INITIALIZATION OF MEGA MENU
      // =======================================================
      const megaMenu = new HSMegaMenu(".js-mega-menu", {
        desktop: {
          position: "left",
        },
      });

      // INITIALIZATION OF GO TO
      // =======================================================
      new HSGoTo(".js-go-to");

      // INITIALIZATION OF SWIPER
      // =======================================================
      var swiper = new Swiper(".js-swiper-clients", {
        slidesPerView: 2,
        breakpoints: {
          380: {
            slidesPerView: 3,
            spaceBetween: 15,
          },
          768: {
            slidesPerView: 4,
            spaceBetween: 15,
          },
          1024: {
            slidesPerView: 5,
            spaceBetween: 15,
          },
        },
      });
    })();
  </script>
</body>

</html>