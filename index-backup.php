<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/plugins/sweetalert/sweetalert.js"></script>

<?php include_once 'admin/database/db.php'; ?>
<?php include_once 'functions.php'; ?>

<?php
if (ifItIsMethod('post')) {
  if (isset($_POST['kariah_ic'])) {
    $ic_no = $_POST['kariah_ic'];

    if (ic_exists($ic_no)) {
      echo '<script type="text/javascript">
      jQuery(function validation() {
          swal({
              title: "Rekod anda wujud",
              icon: "success",
              button: "Ok",
            });
      });
      </script>';
      header('refresh:2;index.php');
      exit;
    } else {
      echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Rekod tidak wujud",
                text: "Sila Daftar",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
      header('refresh:2;index.php');
      exit;
    }
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
  <!-- Google Fonts -->
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C500%2C600%2C700%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik" />
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css" />
  <!-- CSS Global Icons -->
  <link rel="stylesheet" href="assets/vendor/icon-awesome/css/font-awesome.min.css" />
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

  <!-- CSS Customization -->
  <link rel="stylesheet" href="assets/css/custom.css" />
</head>

<body>
  <main>
    <!-- Header -->
    <header id="js-header" class="u-header u-header--static">
      <div class="
            u-header__section u-header__section--light
            g-bg-white
            g-transition-0_3
            g-py-10
          ">
        <nav class="
              js-mega-menu
              navbar navbar-expand-lg
              hs-menu-initialized hs-menu-horizontal
            ">
          <div class="container">

            <!-- Logo -->
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
            <!-- End Logo -->

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

    <!-- Promo Block -->
    <section class="u-bg-overlay g-bg-img-hero g-bg-bluegray-opacity-0_3--after" style="background-image: url(kariah.jpg)">
      <div class="container u-bg-overlay__inner text-center g-pt-150 g-pb-250">
        <div class="g-pos-abs g-left-0 g-right-0 g-z-index-2 g-bottom-30">
          <a class="
                js-go-to
                btn
                u-btn-outline-white
                g-color-white
                g-bg-white-opacity-0_1
                g-color-black--hover
                g-bg-white--hover
                g-font-weight-600
                text-uppercase
                g-rounded-50 g-px-30 g-py-11
              " href="#" data-target="#content">
            <i class="fa fa-angle-down"></i>
          </a>
        </div>
      </div>
    </section>
    <!-- End Promo Block -->

    <section class="container g-py-30">
      <div class="row justify-content-center">
        <div class="col-sm-7 col-lg-7">
          <div class="g-brd-around g-brd-gray-light-v4 rounded g-py-40 g-px-30">
            <header class="text-center mb-4">

              <h2 class="h2 g-color-black g-font-weight-600">Semak Rekod Keahlian</h2>
              <p class="h5 g-color-black g-font-weight-100">Contoh: XXXXXX-XX-XXXX</p>
            </header>

            <!-- Form -->
            <form class="g-py-15" method="post">
              <div class="mb-4">
                <div class="input-group g-brd-primary--focus">
                  <div class="input-group-prepend">
                    <span class="input-group-text g-width-45 g-brd-right-none g-brd-gray-light-v4 g-color-gray-dark-v5"><i class="icon-communication-109"></i></span>
                  </div>
                  <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="text" name="kariah_ic" id="kariah_ic" placeholder="No Kad Pengenalan" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')">
                </div>
              </div>

              <div class="mb-4">
                <button class="btn btn-md btn-block u-btn-primary g-rounded-50 g-py-13 col" type="submit" name="btn_semak">SEMAK</button>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section id="content" class="g-bg-secondary">
      <div class="container g-pt-50 g-pb-50">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="text-center">
              <span class="
                    g-color-gray-dark-v2 g-font-size-90 g-pos-abs g-top-minus-40
                  ">
                &#8220;
              </span>
            </div>

            <div class="js-carousel text-center g-pt-60" data-infinite="true" data-autoplay="true" data-fade="true" data-speed="4000">
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

    <!-- Footer -->
    <footer class="container g-pt-20 g-pb-20">
      <div class="row">
        <div class="col-sm-6 col-lg-3 g-mb-30">
          <h3 class="h6 g-color-black g-font-weight-600 text-uppercase mb-4">
            Hubungi Kami
          </h3>
          <!-- Links -->
          <ul class="list-unstyled g-color-gray-dark-v4 g-font-size-13">
            <li class="media mb-4">
              <i class="
                    d-flex
                    mt-1
                    mr-3
                    icon-communication-062
                    u-line-icon-pro
                  "></i>
              <div class="media-body">
                <a class="
                      u-link-v5
                      g-color-gray-dark-v4
                      g-color-primary--hover
                    " href="#">bendaharimawgc@gmail.com</a>
              </div>
            </li>
            <li class="media mb-4">
              <i class="
                    d-flex
                    mt-1
                    mr-3
                    icon-communication-033
                    u-line-icon-pro
                  "></i>
              <div class="media-body">04-468 0301</div>
            </li>
          </ul>
          <!-- End Links -->
        </div>
        <div class="col-sm-6 col-lg-3 g-mb-30">
          <h3 class="h6 g-color-black g-font-weight-600 text-uppercase mb-4">
            Perkembangan Kami
          </h3>
          <!-- Links -->
          <ul class="list-unstyled g-color-gray-dark-v4 g-font-size-13">
            <li class="my-3">
              <i class="mr-2 fa fa-angle-right"></i>
              <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="https://www.facebook.com/MAWGCOFFICIAL">Facebook</a>
            </li>
          </ul>
          <!-- End Links -->
        </div>
      </div>
      <p class="g-color-gray-dark-v4 g-font-size-13">
        2022 &copy; Hak Cipta Terpelihara , Masjid Al-Wustha Guar Chempedak
      </p>
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

  <!-- JS Implementing Plugins -->
  <script src="assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
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

  <!-- JS Customization -->
  <script src="assets/js/custom.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    //format ic
    $(document).ready(function() {
      $('#kariah_ic').mask('000000-00-0000');
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
</body>

</html>