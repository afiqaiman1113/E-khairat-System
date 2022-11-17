<?php
include_once 'admin/database/connect.php';
session_start();
//bab code kat bwh ni, aku ada hurai dlm nota kat kertas
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "Admin") {
    header('Location: index.php');
}
// $id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE ahli_kariah.kariah_ic = '" . $_SESSION['kariah_ic'] . "' ");
$select->execute();

$select->bindParam(':kariah_name', $kariah_name);
$select->bindParam(':kariah_ic', $kariah_ic);
$select->bindParam(':user_email', $user_email);
$select->bindParam(':kariah_umur', $kariah_umur);
$select->bindParam(':jantina', $jantina);
$select->bindParam(':pekerjaan', $pekerjaan);
$select->bindParam(':alamat', $alamat);
$select->bindParam(':alamat2', $alamat2);
$select->bindParam(':poskod', $poskod);
$select->bindParam(':bandar', $bandar);
$select->bindParam(':negeri', $negeri);
$select->bindParam(':s_menetap', $s_menetap);
$select->bindParam(':tel_rumah', $tel_rumah);
$select->bindParam(':tel_hp', $tel_hp);
$select->bindParam(':kawasan', $kawasan);
$select->bindParam(':tahun_menetap', $tahun_menetap);
$select->bindParam(':status_perkahwinan', $status_perkahwinan);
$select->bindParam(':penerima_bantuan', $penerima_bantuan);
$select->bindParam(':password', $password);
$select->bindParam(':tarikh_daftar', $tarikh_daftar);
$select->bindParam(':role', $role);
$select->bindParam(':approvement', $approvement);

$row = $select->fetch(PDO::FETCH_ASSOC);

$kariah_name = $row['kariah_name'];
$kariah_ic = $row['kariah_ic'];
$user_email = $row['user_email'];
$kariah_umur = $row['kariah_umur'];
$jantina = $row['jantina'];
$pekerjaan = $row['pekerjaan'];
$alamat = $row['alamat'];
$alamat2 = $row['alamat2'];
$poskod = $row['poskod'];
$bandar = $row['bandar'];
$negeri = $row['negeri'];
$s_menetap = $row['s_menetap'];
$tel_rumah = $row['tel_rumah'];
$tel_hp = $row['tel_hp'];
$kawasan = $row['kawasan'];
$tahun_menetap = $row['tahun_menetap'];
$status_perkahwinan = $row['status_perkahwinan'];
$penerima_bantuan = $row['penerima_bantuan'];
$password = $row['password'];
//front end display in format yg kita nak. Cuba bca balik chat dgn abg haezal
$tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
$role = $row['role'];
$approvement = $row['approvement'];
?>

<!DOCTYPE html>
<html lang="en" class="topbar_open">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>E-Khairat Al Wustha</title>
    <link rel="shortcut icon" type="image/png" href="admin/dist/img/logo.png">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="admin/dist/img/logo.png" type="image/x-icon" />

    <style>
        body {
            margin-top: 20px;
        }

        .modal[data-modal-color] {
            color: #fff;
        }

        .modal .modal-header {
            padding: 23px 26px;
            border-bottom: 1px solid transparent;
        }

        .modal .modal-content {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.31);
            border-radius: 3px;
            border: 0;
        }

        .modal-footer {
            padding: 15px;
            text-align: right;
            border-top: 1px solid transparent;
        }

        .modal[data-modal-color] .modal-footer {
            background: rgba(0, 0, 0, 0.1);
        }

        .modal[data-modal-color] .modal-footer .btn-link {
            font-weight: 400;
        }

        .modal[data-modal-color] .modal-title,
        .modal[data-modal-color] .modal-footer .btn-link {
            color: #fff;
        }

        .modal .modal-footer .btn-link {
            font-size: 14px;
            color: #000;
            font-weight: 500;
        }

        .btn-link {
            color: #797979;
            text-decoration: none;
            border-radius: 2px;
        }

        .modal[data-modal-color] .modal-footer .btn-link:hover {
            background-color: rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .modal[data-modal-color] .modal-footer .btn-link {
            font-weight: 400;
        }

        /* ========== MODAL COLORS ===============================*/
        .modal[data-modal-color="blue"] .modal-content {
            background: #2196f3;
        }

        .modal[data-modal-color="lightblue"] .modal-content {
            background: #03a9f4;
        }

        .modal[data-modal-color="cyan"] .modal-content {
            background: #00bcd4;
        }

        .modal[data-modal-color="green"] .modal-content {
            background: #4caf50;
        }

        .modal[data-modal-color="lightgreen"] .modal-content {
            background: #8bc34a;
        }

        .modal[data-modal-color="red"] .modal-content {
            background: #f44336;
        }

        .modal[data-modal-color="amber"] .modal-content {
            background: #ffc107;
        }

        .modal[data-modal-color="orange"] .modal-content {
            background: #ff9800;
        }

        .modal[data-modal-color="teal"] .modal-content {
            background: #009688;
        }

        .modal[data-modal-color="bluegray"] .modal-content {
            background: #607d8b;
        }
    </style>

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>





    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link rel="stylesheet" href="assets/css/demo.css"> -->

    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <script src="admin/dist/js/jquery.mask.min.js"></script>
    <script src="admin/plugins/inputmask/jquery.inputmask.min.js"></script>

    <!-- Atlantis JS -->
    <script src="assets/js/atlantis.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php
        include_once 'main-header.php';
        include_once 'sidebar.php';
        include_once 'main-panel.php';
        ?>
    </div>

    <script>
        Circles.create({
            id: 'circles-1',
            radius: 45,
            value: 60,
            maxValue: 100,
            width: 7,
            text: 5,
            colors: ['#f1f1f1', '#FF9E27'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })
        Circles.create({
            id: 'circles-2',
            radius: 45,
            value: 70,
            maxValue: 100,
            width: 7,
            text: 36,
            colors: ['#f1f1f1', '#2BB930'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })
        Circles.create({
            id: 'circles-3',
            radius: 45,
            value: 40,
            maxValue: 100,
            width: 7,
            text: 12,
            colors: ['#f1f1f1', '#F25961'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        // var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

        // var mytotalIncomeChart = new Chart(totalIncomeChart, {
        //     type: 'bar',
        //     data: {
        //         labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
        //         datasets: [{
        //             label: "Total Income",
        //             backgroundColor: '#ff9e27',
        //             borderColor: 'rgb(23, 125, 255)',
        //             data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
        //         }],
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         legend: {
        //             display: false,
        //         },
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     display: false //this will remove only the label
        //                 },
        //                 gridLines: {
        //                     drawBorder: false,
        //                     display: false
        //                 }
        //             }],
        //             xAxes: [{
        //                 gridLines: {
        //                     drawBorder: false,
        //                     display: false
        //                 }
        //             }]
        //         },
        //     }
        // });

        $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });
    </script>
</body>

</html>