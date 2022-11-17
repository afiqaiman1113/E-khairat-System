<?php
include_once '../admin/database/connect.php';
session_start();
if ($_SESSION['penama_id'] == "") {
    header('Location: index.php');
}

include_once 'header-test.php';

error_reporting(0);

//fetch semula product
$id = $_GET['penama_id'];
$select = $pdo->prepare("SELECT * FROM penama WHERE penama_id = $id");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

$penama_name = $row['penama_name'];
$penama_ic = $row['penama_ic'];
$penama_no = $row['penama_no'];

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$select = $pdo->prepare("SELECT * FROM tuntut WHERE penama_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$penama_id = $row['penama_id'];
$status_tuntut1 = $row['status_tuntut'];

$select = $pdo->prepare("SELECT * FROM penama LEFT JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE penama_id = " . $id . " ");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$kariah_id = $row['kariah_id'];
$kariah_name = $row['kariah_name'];
$kariah_ic = $row['kariah_ic'];
//$penama_name = $row['penama_name'];

if (isset($_POST['btn_tuntut'])) {

    // $khairat_id = $_POST['khairat_id'];
    $tuntut_name = strtoupper($_POST['tuntut_name']);
    $tuntut_ic = $_POST['tuntut_ic'];
    //$penuntut = strtoupper($_POST['penuntut']);
    $hubungan = $_POST['hubunganpenuntut'];
    $tarikh_mati = date('Y-m-d', strtotime($_POST['tarikh_mati']));
    $tarikh_tuntut = date("Y-m-d");
    $no_surat = $_POST['no_surat'];
    $jumlah = $_POST['jumlah'];
    $bank = $_POST['bank'];
    $no_akaun = $_POST['no_akaun'];
    $cara_bayar = $_POST['cara_bayar'];
    $no_cek = $_POST['no_cek'];
    $nota = $_POST['nota'];
    $pindah_milik = $_POST['pindah_milik'];
    $invoice = $_POST['invoice'];
    $status_tuntut = $_POST['status_tuntut'];

    $f_name = $_FILES['myfile']['name'];

    $f_tmp = $_FILES['myfile']['tmp_name'];

    $f_size =  $_FILES['myfile']['size'];

    $f_extension = explode('.', $f_name);
    $f_extension = strtolower(end($f_extension));

    $f_newfile =  uniqid() . '.' . $f_extension;

    $store = "../admin/productimages/" . $f_newfile;

    if ($f_extension == 'jpg' || $f_extension == 'jpeg' ||  $f_extension == 'png' || $f_extension == 'gif') {
        if ($f_size >= 1000000) {
            $error = '<script type="text/javascript">
                        jQuery(function validation(){
                        swal({
                            title: "Error!",
                            text: "Max file should be 1MB!",
                            icon: "warning",
                            button: "Ok",
                        });
                        });
                    </script>';
            echo $error;
        } else {
            if (move_uploaded_file($f_tmp, $store)) {
                $productimage = $f_newfile;
                if (!isset($error)) {
                    $insert = $pdo->prepare("INSERT INTO tuntut(kariah_id, penama_id, tuntut_name, tuntut_ic, hubungan, tarikh_mati, tarikh_tuntut, no_surat, tuntut_image, jumlah, bank, no_akaun, cara_bayar, no_cek, nota, pindah_milik, invoice, status_tuntut)
                    VALUES(:kariah_id, :penama_id, :tuntut_name, :tuntut_ic, :hubungan, :tarikh_mati, :tarikh_tuntut, :no_surat, :tuntut_image, :jumlah, :bank, :no_akaun, :cara_bayar, :no_cek, :nota, :pindah_milik, :invoice, :status_tuntut)");

                    $insert->bindParam(':kariah_id', $kariah_id);
                    $insert->bindParam(':penama_id', $id);
                    // $insert->bindParam(':khairat_id', $khairat_id);
                    $insert->bindParam(':tuntut_name', $tuntut_name);
                    $insert->bindParam(':tuntut_ic', $tuntut_ic);
                    //$insert->bindParam(':penuntut', $penuntut);
                    $insert->bindParam(':hubungan', $hubungan);
                    $insert->bindParam(':tarikh_mati', $tarikh_mati);
                    $insert->bindParam(':tarikh_tuntut', $tarikh_tuntut);
                    $insert->bindParam(':no_surat', $no_surat);
                    $insert->bindParam(':tuntut_image', $productimage);
                    $insert->bindParam(':jumlah', $jumlah);
                    $insert->bindParam(':bank', $bank);
                    $insert->bindParam(':no_akaun', $no_akaun);
                    $insert->bindParam(':cara_bayar', $cara_bayar);
                    $insert->bindParam(':no_cek', $no_cek);
                    $insert->bindParam(':nota', $nota);
                    $insert->bindParam(':pindah_milik', $pindah_milik);
                    $insert->bindParam(':invoice', $invoice);
                    $insert->bindParam(':status_tuntut', $status_tuntut);

                    if ($insert->execute()) {
                        echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Tuntutan Berjaya",
                            text: "Proses tuntutan akan mengambil masa 2-3 hari bekerja untuk pembayaran semula. Harap maklum dan terima kasih",
                            icon: "success",
                            button: "Ok",
                          }).then(function() {
                            window.location = "penama.php?p=penyata-tuntutan";
                        });
                    });
                    </script>';

                        // $sql = "UPDATE ahli_kariah SET mati = 'Mati' WHERE kariah_id = $id ";
                        // $update = $pdo->prepare($sql);
                        // $update->execute();

                        // $activity = "ahli " . strtoupper($kariah_name) . " dituntut oleh {$penuntut}";
                        // $time_loged = date("Y-m-d H:i:s", strtotime("now"));
                        // $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
                        // $stmt->bindParam(1, $_SESSION['user_id']);
                        // $stmt->bindParam(2, $activity);
                        // $stmt->bindParam(3, $time_loged);
                        // $stmt->execute();
                    } else {
                        echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Tuntutan Gagal",
                            icon: "error",
                            button: "Ok",
                          });
                    });
                    </script>';
                    }
                }
            }
        }
    } else {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Peringatan",
                text: "Hanya format jpg, jpeg dan png sahaja!",
                icon: "warning",
                button: "Ok",
            });
        });
        </script>';
    }
}

if ($_SESSION['penama_id'] == true) {
    include_once 'header-test.php';
} else {
    include_once 'headerphp';
}

?>

<!-- <style>
    label {
        color: white;
    }

    label span {
        color: green;
    }
</style> -->

<body>
    <div class="wrapper">
        <?php
        include_once 'main-header.php';
        include_once 'sidebar.php';
        ?>
        <br>
        <?php
        if ($penama_id == true && $status_tuntut1 == 'Berjaya') {
            echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Waris Telah Dituntut",
                            icon: "error",
                            button: "Ok",
                        }).then(function() {
                            window.location = "penama.php?p=penyata-tuntutan";
                        });
                    });
                </script>';
        } else {
            include_once 'form-tuntut.php';
        }
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

    <script>
        // $(document).ready(function() {
        //     $("#tarikh_mati").datepicker({
        //         dateFormat: 'dd-mm-yy'
        //     });
        // });

        // $(document).ready(function() {
        //     $("#tarikh_tuntut").datepicker({
        //         dateFormat: 'dd-mm-yy'
        //     });
        // });

        // $(function() {
        //     $("#reservationdate1").datetimepicker({
        //         format: "L",
        //     });
        // });

        $(function() {
            $("#hubungan").change(function() {
                var displayjumlah = $("#hubungan option:selected").val();
                $("#jumlah").val(displayjumlah);
            })
        });

        $(function() {
            $("#hubungan").change(function() {
                var displayjumlah = $("#hubungan option:selected").val();
                $("#jumlah").val(displayjumlah);
            })
        });

        $(function() {
            $("#hubungan").change(function() {
                var displayjumlah1 = $("#hubungan option:selected").text();
                $("#hubunganpenuntut_hidden").val(displayjumlah1);
            })
        });
    </script>
</body>