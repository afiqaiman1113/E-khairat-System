<?php include_once 'database/connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-Khairat Al Wustha</title>
    <link rel="shortcut icon" type="image/png" href="/khairat/admin/dist/img/logo.png">

    <!-- jQuery -->
    <script src="/khairat/admin/plugins/jquery/jquery.min.js"></script>
    <!-- <script src="plugins/jquery-ui/jquery-ui.min.js"></script> -->

    <style type="text/css">
        input[type="date"]::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }
    </style>


    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="/khairat/admin/ajax.js"></script>

    <!-- Bootstrap 4 -->
    <script src="/khairat/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="/khairat/admin/dist/js/adminlte.min.js"></script>
    <script src="/khairat/admin/plugins/sweetalert/sweetalert.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'> -->

    <!-- overlayScrollbars -->
    <!-- <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->

    <!-- Chart JS -->
    <script src="/khairat/admin/Chart.js-3.3.2/dist/chart.min.js"></script>

    <!-- jquery-validation -->
    <script src="/khairat/admin/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/khairat/admin/plugins/jquery-validation/additional-methods.min.js"></script>

    <!-- InputMask -->
    <script src="/khairat/admin/plugins/moment/moment.min.js"></script>
    <script src="/khairat/admin/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="/khairat/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/khairat/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- daterange picker -->
    <link rel="stylesheet" href="/khairat/admin/plugins/daterangepicker/daterangepicker.css" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/khairat/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />

    <script src="plugins/select2/js/select2.full.min.js"></script>

    <!-- input mask -->
    <script src="/khairat/admin/dist/js/jquery.mask.min.js"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="/khairat/admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/khairat/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <script src="/khairat/admin/plugins/select2/js/select2.full.min.js"></script>

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/khairat/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="/khairat/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/khairat/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/khairat/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- DataTables JS & Plugins -->
    <script src="/khairat/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/khairat/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/khairat/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/khairat/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/khairat/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/khairat/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/khairat/admin/plugins/jszip/jszip.min.js"></script>
    <script src="/khairat/admin/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/khairat/admin/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/khairat/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/khairat/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/khairat/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.2.0/css/rowGroup.dataTables.min.css" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/khairat/admin/plugins/fontawesome-free/css/all.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="/khairat/admin/dist/css/adminlte.min.css" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- fixed static bwh ni-->
            <!-- <nav class="main-header navbar navbar-expand fixed-top navbar-white navbar-light"> -->
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/khairat/admin/utama" class="nav-link">Utama</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/khairat/admin/dist/img/admin.png" class="user-image" alt="User Image">
                            <?php
                            $useragent = $_SERVER['HTTP_USER_AGENT'];
                            if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
                            } else {
                                echo ' <span class="hidden-xs">' . $_SESSION['username'] . '</span>';
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="user-header">
                                <img src="/khairat/admin/dist/img/admin.png" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $_SESSION['username']; ?>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-center">
                                    <a href="/khairat/admin/logout.php" class="btn btn-default btn-flat">Log Keluar</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
            <!-- Brand Logo -->
            <a href="utama" class="brand-link">
                <img src="/khairat/admin/dist/img/logo.png" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Al-Wustha</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/khairat/admin/dist/img/admin.png" class="img-circle elevation-2" alt="User Image" />
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Welcome <?php echo $_SESSION['username']; ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/khairat/admin/utama" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/khairat/admin/senarai-penama" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Senarai Penama</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="createorder.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Order</p>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a href="addproduct.php" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Tetapan Yuran</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="productlist.php" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Senarai Yuran Tahunan</p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="/khairat/admin/senarai-yuran" class="nav-link">
                                <i class="nav-icon fas fa-donate"></i>
                                <p>Yuran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/khairat/admin/senarai-yuran-pdo" class="nav-link">
                                <i class="nav-icon fas fa-donate"></i>
                                <p>Yuran Datatable serverside PDO</p>
                            </a>
                        </li>


                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-donate"></i>
                                <p>
                                    Yuran
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="tetapan-yuran.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Tambah Yuran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="senarai-yuran.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Senarai Yuran Tahunan</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a href="list-tuntutan.php" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Tuntutan Kematian</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="khairat-kematian-list.php" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Pembayar Yuran</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Ahli Kariah
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                                // $select = $pdo->prepare("SELECT count(tuntut_name) as tuntut_name FROM tuntut");
                                $select = $pdo->prepare("SELECT count(tuntut_id) as tuntut_id FROM tuntut WHERE status_tuntut = 'Berjaya' OR status_tuntut = 'Dalam Proses' ORDER BY tuntut_id DESC");
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_OBJ);
                                $total_ahli = $row->tuntut_id;

                                $select = $pdo->prepare("SELECT count(tid_tanggung) as tid_tanggung FROM tuntut_tanggungan WHERE status = 'Berjaya' OR status = 'Dalam Proses' ORDER BY tid_tanggung DESC ");
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_OBJ);
                                $total_tanggungan = $row->tid_tanggung;
                                ?>
                                <li class="nav-item">
                                    <a href="/khairat/admin/daftar-ahli-kariah" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Daftar Ahli</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/khairat/admin/ahli-kariah" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Lihat Semua Ahli</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/khairat/admin/ahli-kariah-serverside" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Ahli Serverside</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="meninggal-dunia.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Meninggal Dunia</p>
                                        &emsp;<h10 align="right" class="badge bg-danger"><?php //echo $total_ahli;
                                                                                            ?></h10>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="/khairat/admin/tuntutan-kematian" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Meninggal (Ahli)</p>
                                        &emsp;<h10 align="right" class="badge bg-danger"><?php echo $total_ahli; ?></h10>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/khairat/admin/tuntutan-tanggungan" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Meninggal (Tanggung)</p>
                                        &emsp;<h10 align="right" class="badge bg-danger"><?php echo $total_tanggungan; ?></h10>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="khairat-kematian-list.php" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Ahli Khairat Kematian</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hands-helping"></i>
                                <p>
                                    Khairat Kematian
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                                $select = $pdo->prepare("SELECT count(kariah_name) as kariah_name FROM ahli_kariah WHERE approvement = 'Belum Daftar' ");
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_OBJ);

                                $total_ahli = $row->kariah_name;

                                $select = $pdo->prepare("SELECT count(khairat_id) as khairat_id FROM khairat_kematian WHERE status_id IN (0,2,3) ORDER BY khairat_id DESC"); //IN digunakan untuk display dua atau lebih value id
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_OBJ);

                                $failed_transaction = $row->khairat_id;
                                ?>
                                <li class="nav-item">
                                    <a href="/khairat/admin/pengesahan-khairat-kematian" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Belum Daftar</p>
                                        &emsp;<h10 align="right" class="badge bg-danger"><?php echo $total_ahli; ?></h10>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/khairat/admin/senarai-khairat-kematian" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Senarai Bayaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/khairat/admin/senarai-khairat-kematian-serverside" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Senarai Bayaran Serverside</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/khairat/admin/pembayaran-gagal" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Transaksi Gagal</p>
                                        &emsp;<h10 align="right" class="badge bg-danger"><?php echo $failed_transaction; ?></h10>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Laporan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/khairat/admin/tablereport" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Rekod Transaksi</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="graphreport.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Graph Report</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="/khairat/admin/muat-turun-ahli" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Muat Turun Excel</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Tetapan Admin
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/khairat/admin/sunting-profile" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Kemaskini Profil</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/khairat/admin/kata-laluan" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Tukar Kata Laluan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/khairat/admin/daftar-admin" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size:90%;">Daftar Admin Baru</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/khairat/admin/log-aktiviti" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>Log Aktiviti</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>Log Keluar</p>
                            </a>
                        </li> -->
                    </ul>
                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <script type="text/javascript">
            $(document).ready(function() {

                $('.notification').load('count_noti.php');
                $('.counter').text('0').hide();
                var counter = 0;

                $('#noti_count').on('click', function() {
                    counter = 0;
                    $('.counter').text('0').hide();
                });

            });

            $(function() {
                var url = window.location;
                // for single sidebar menu
                $('ul.nav-sidebar a').filter(function() {
                    return this.href == url;
                }).addClass('active');

                // for sidebar menu and treeview
                $('ul.nav-treeview a').filter(function() {
                        return this.href == url;
                    }).parentsUntil(".nav-sidebar > .nav-treeview")
                    .css({
                        'display': 'block'
                    })
                    .addClass('menu-open').prev('a')
                    .addClass('active');
            });
        </script>