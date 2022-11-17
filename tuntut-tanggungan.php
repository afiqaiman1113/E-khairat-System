<?php
include_once 'admin/database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

include_once 'header-test.php';

error_reporting(0);

//fetch semula product
$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();

$select->bindColumn('kariah_name', $kariah_name);
$select->bindColumn('kariah_ic', $kariah_ic);
$select->bindColumn('user_email', $user_email);
$select->bindColumn('kariah_umur', $kariah_umur);
$select->bindColumn('jantina', $jantina);
$select->bindColumn('pekerjaan', $pekerjaan);
$select->bindColumn('alamat', $alamat);
$select->bindColumn('alamat2', $alamat2);
$select->bindColumn('poskod', $poskod);
$select->bindColumn('bandar', $bandar);
$select->bindColumn('negeri', $negeri);
$select->bindColumn('s_menetap', $s_menetap);
$select->bindColumn('tel_rumah', $tel_rumah);
$select->bindColumn('tel_hp', $tel_hp);
$select->bindColumn('tahun_menetap', $tahun_menetap);
$select->bindColumn('status_perkahwinan', $status_perkahwinan);
$select->bindColumn('penerima_bantuan', $penerima_bantuan);
$select->bindColumn('password', $password);
$select->bindColumn('role', $role);
$select->bindColumn('approvement', $approvement);

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
$tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
$role = $row['role'];
$approvement = $row['approvement'];

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

function tunggak($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    // $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tbl_tanggung ON ahli_kariah.kariah_id = tbl_tanggung.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
    $select = $pdo->prepare("SELECT tbl_tanggung.* FROM tbl_tanggung LEFT JOIN ahli_kariah ON tbl_tanggung.kariah_id = ahli_kariah.kariah_id WHERE mati_tanggung = 'tak' AND ahli_kariah.kariah_id = " . $id . " ");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["id"] . '">' . $row["nama"] . '</option>';
    }
    return $output;
}

function tunggak1($pdo)
{
    //$id = $_GET['kariah_id'];
    $output = '';
    $output .= '<option value="" disabled>Tiada Tanggungan</option>';

    return $output;
}


// $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tbl_tanggung ON ahli_kariah.kariah_id = tbl_tanggung.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
$select = $pdo->prepare("SELECT tbl_tanggung.* FROM tbl_tanggung LEFT JOIN ahli_kariah ON tbl_tanggung.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = " . $id . " ");
$select->execute();
//$row2 = $select->fetch(PDO::FETCH_ASSOC);
$row2 = $select->fetch(PDO::FETCH_OBJ);

if (isset($_POST['btn_tuntut'])) {

    // $khairat_id = $_POST['khairat_id'];
    $id_tanggungan = $_POST['id'];
    $nama = $_POST['namatanggungan'];
    // $penuntut = $_POST['penuntut'];
    $t_tanggunghubungan = $_POST['t_tanggunghubungan'];
    $tarikh_mati = date('Y-m-d', strtotime($_POST['tarikh_mati']));
    $tarikh_tuntut = date("Y-m-d");
    $no_surat = $_POST['no_surat'];
    $jumlah = $_POST['jumlah'];
    $bank = $_POST['bank'];
    $no_akaun = $_POST['no_akaun'];
    $cara_bayar = $_POST['cara_bayar'];
    $no_cek = $_POST['no_cek'];
    $nota = $_POST['nota'];
    $invoice = $_POST['invoice'];
    $status = $_POST['status'];

    $f_name = $_FILES['myfile']['name'];

    $f_tmp = $_FILES['myfile']['tmp_name'];

    $f_size =  $_FILES['myfile']['size'];

    $f_extension = explode('.', $f_name);
    $f_extension = strtolower(end($f_extension));

    $f_newfile =  uniqid() . '.' . $f_extension;

    $store = "admin/productimages/" . $f_newfile;

    if ($f_extension == 'jpg' || $f_extension == 'jpeg' ||  $f_extension == 'png' || $f_extension == 'gif') {
        if ($f_size >= 1000000) {
            $error = '<script type="text/javascript">
                        jQuery(function validation(){
                        swal({
                            title: "Peringatan!",
                            text: "Gambar hendaklah kurang dari 1MB",
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
                    $insert = $pdo->prepare("INSERT INTO tuntut_tanggungan(id_tanggungan, kariah_id, nama, t_tanggunghubungan, tarikh_mati, tarikh_tuntut, no_surat, tuntutan_image, jumlah, bank, no_akaun, cara_bayar, no_cek, nota, invoice, status)
                    VALUES(:id_tanggungan, :kariah_id, :nama, :t_tanggunghubungan, :tarikh_mati, :tarikh_tuntut, :no_surat, :tuntutan_image, :jumlah, :bank, :no_akaun, :cara_bayar, :no_cek, :nota, :invoice, :status)");

                    $insert->bindParam(':id_tanggungan', $id_tanggungan);
                    $insert->bindParam(':kariah_id', $id);
                    // $insert->bindParam(':khairat_id', $khairat_id);
                    $insert->bindParam(':nama', $nama);
                    // $insert->bindParam(':penuntut', $penuntut);
                    $insert->bindParam(':t_tanggunghubungan', $t_tanggunghubungan);
                    $insert->bindParam(':tarikh_mati', $tarikh_mati);
                    $insert->bindParam(':tarikh_tuntut', $tarikh_tuntut);
                    $insert->bindParam(':no_surat', $no_surat);
                    $insert->bindParam(':tuntutan_image', $productimage);
                    $insert->bindParam(':jumlah', $jumlah);
                    $insert->bindParam(':bank', $bank);
                    $insert->bindParam(':no_akaun', $no_akaun);
                    $insert->bindParam(':cara_bayar', $cara_bayar);
                    $insert->bindParam(':no_cek', $no_cek);
                    $insert->bindParam(':nota', $nota);
                    $insert->bindParam(':invoice', $invoice);
                    $insert->bindParam(':status', $status);

                    if ($insert->execute()) {
                        echo '<script type="text/javascript">
                                jQuery(function validation() {
                                    swal({
                                        title: "Tuntutan Berjaya",
                                        text: "Proses tuntutan akan mengambil masa 2-3 hari bekerja untuk pembayaran semula. Harap maklum dan terima kasih",
                                        icon: "success",
                                        button: "Ok",
                                      }).then(function() {
                                          window.location = "user.php?p=penyata-tuntutan-tanggungan";
                                      });
                                });
                                </script>';
                        // $sql = "DELETE FROM tbl_tanggung WHERE id = $id_tanggungan ";
                        // $update = $pdo->prepare($sql);
                        // $update->execute();

                        // $form_data = [
                        //     'token_uid' => "746210583",
                        //     'token_key' => "utwe2qsd5r7acgvx8ozi",
                        //     'receipients' => $tel_hp,
                        //     'message' => "Masjid Al-Wustha: Proses tuntutan bagi si mati yang bernama $nama akan mengambil masa 2-3 hari bekerja untuk pembayaran semula. Harap maklum dan terima kasih"
                        // ];

                        // $curl = curl_init();
                        // curl_setopt($curl, CURLOPT_POST, 1);
                        // curl_setopt($curl, CURLOPT_URL, 'https://sms.ala.my/api/v1/send');
                        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        // curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);
                        // $result = curl_exec($curl);
                        // $obj = json_decode($result);
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

if ($_SESSION['role'] == "User") {
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
        <?php include_once 'form-tuntut-tanggungan.php'; ?>

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


        $(".id_tanggungan").on('change', function(e) {

            var id_tanggungan = this.value;
            var tr = $(this).parent().parent();
            $.ajax({

                url: "admin/get-tanggungan.php",
                method: "get",
                data: {
                    id: id_tanggungan
                },
                success: function(data) {

                    //console.log(data);
                    tr.find(".id").val(data["id"]);
                    tr.find(".nama").val(data["nama"]);
                }
            })
        })
    </script>
</body>