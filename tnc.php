<?php
include_once 'admin/database/connect.php';
session_start();
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

include_once 'header-test.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'Classes/Config.php';

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

$select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id = $id");
$select->execute();
$row_tanggung = $select->fetchAll(PDO::FETCH_ASSOC);

$select3 = $pdo->prepare("SELECT * FROM penama WHERE kariah_id = $id");
$select3->execute();
$row_penama = $select3->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn_update_kariah'])) {

    $kariah_name = $_POST['kariah_name'];
    $kariah_ic = $_POST['kariah_ic'];
    $user_email = $_POST['user_email'];
    $kariah_umur = date('Y-m-d', strtotime($_POST['kariah_umur']));
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
    // $approvement = $_POST['approvement'];

    $penama_name = $_POST['penama_name'];
    $penama_ic = $_POST['penama_ic'];
    $penama_no = $_POST['penama_no'];
    $penama_email = $_POST['penama_email'];
    $penama_pass = substr($_POST['penama_ic'], 0, 6);
    $penama_pass = password_hash($penama_pass, PASSWORD_BCRYPT, array("cost" => 12));

    $select_email = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email='$user_email'");
    $select_email->execute();

    $select_email1 = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email='$penama_email'");
    $select_email1->execute();

    $email_penama = $pdo->prepare("SELECT penama_email FROM penama WHERE penama_email='$penama_email'");
    $email_penama->execute();

    $email_penama1 = $pdo->prepare("SELECT penama_email FROM penama WHERE penama_email='$user_email'");
    $email_penama1->execute();

    $ic = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_id = $id");
    $ic->execute();

    $ic1 = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = '$penama_ic' ");
    $ic1->execute();

    $ic_penama = $pdo->prepare("SELECT penama_ic FROM penama WHERE penama_ic='$penama_ic'");
    $ic_penama->execute();

    $sql = "SELECT * FROM penama WHERE penama_email = :penama_email ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':penama_email', $user_email);
    $stmt->execute();
    $penamaemail = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql1 = "SELECT * FROM ahli_kariah WHERE user_email = :user_email ";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->bindParam(':user_email', $penama_email);
    $stmt1->execute();
    $useremail = $stmt1->fetch(PDO::FETCH_ASSOC);

    $ici = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = :kariah_ic");
    $ici->bindParam(':kariah_ic', $penama_ic);
    $ici->execute();
    $iciuser = $ici->fetch();

    if ($ic_penama->rowCount() > 0) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "No kad pengenalan penama telah berdaftar",
                icon: "warning",
                button: "Ok",
            });
        });
        </script>';
    }
    // elseif ($select_email->rowCount() > 0) {
    //     echo '<script type="text/javascript">
    //     jQuery(function validation() {
    //         swal({
    //             title: "Emel ahli telah berdaftar",
    //             text: "Sila masukkan emel lain",
    //             icon: "warning",
    //             button: "Ok",
    //           });
    //     });
    //     </script>';
    // }
    elseif ($email_penama->rowCount() > 0) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Emel penama telah berdaftar",
                text: "Sila masukkan emel lain",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($penama_ic == $kariah_ic) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "No K/P Penama Sama Dengan No K/P Ahli",
                icon: "warning",
                button: "Ok",
            });
        });
        </script>';
    } elseif ($user_email == $penama_email) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Tidak Sah",
                text: "Email Adalah Sama",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($email_penama1->rowCount() > 0) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Tidak Sah",
                text: "Email Tersebut Telah Berdaftar Sebagai Penama",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($select_email1->rowCount() > 0) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Tidak Sah",
                    text: "Email Tersebut Telah Berdaftar Sebagai Ahli Kariah",
                    icon: "warning",
                    button: "Ok",
                  });
            });
            </script>';
    } elseif ($ic1->rowCount() > 0) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "No K/P Penama Tidak Sah",
                    text: "No K/P Tersebut Telah Berdaftar Sebagai Ahli Kariah",
                    icon: "warning",
                    button: "Ok",
                });
            });
            </script>';
    } else {

        $nama = $_POST['nama'];
        $ic = $_POST['ic'];
        $umur = $_POST['umur'];
        $tel = $_POST['tel'];
        $kariah_pertalian = $_POST['kariah_pertalian'];
        $kariah_pekerjaan = $_POST['kariah_pekerjaan'];
        $mati_tanggung = $_POST['mati_tanggung'];

        $delete_tanggungan = $pdo->prepare("DELETE FROM tbl_tanggung WHERE kariah_id = $id");
        $delete_tanggungan->execute();

        $update_kariah = $pdo->prepare("UPDATE ahli_kariah SET kariah_name=:kariah_name, kariah_ic=:kariah_ic, user_email=:user_email, kariah_umur=:kariah_umur, jantina=:jantina, pekerjaan=:pekerjaan, alamat=:alamat, alamat2=:alamat2,
        poskod=:poskod, bandar=:bandar, negeri=:negeri, s_menetap=:s_menetap, tel_rumah=:tel_rumah, tel_hp=:tel_hp, kawasan=:kawasan, tahun_menetap=:tahun_menetap, status_perkahwinan=:status_perkahwinan, penerima_bantuan=:penerima_bantuan WHERE kariah_id = $id ");

        $update_kariah->bindParam(':kariah_name', $kariah_name);
        $update_kariah->bindParam(':kariah_ic', $kariah_ic);
        $update_kariah->bindParam(':user_email', $user_email);
        $update_kariah->bindParam(':kariah_umur', $kariah_umur);
        $update_kariah->bindParam(':jantina', $jantina);
        $update_kariah->bindParam(':pekerjaan', $pekerjaan);
        $update_kariah->bindParam(':alamat', $alamat);
        $update_kariah->bindParam(':alamat2', $alamat2);
        $update_kariah->bindParam(':poskod', $poskod);
        $update_kariah->bindParam(':bandar', $bandar);
        $update_kariah->bindParam(':negeri', $negeri);
        $update_kariah->bindParam(':s_menetap', $s_menetap);
        $update_kariah->bindParam(':tel_rumah', $tel_rumah);
        $update_kariah->bindParam(':tel_hp', $tel_hp);
        $update_kariah->bindParam(':kawasan', $kawasan);
        $update_kariah->bindParam(':tahun_menetap', $tahun_menetap);
        $update_kariah->bindParam(':status_perkahwinan', $status_perkahwinan);
        $update_kariah->bindParam(':penerima_bantuan', $penerima_bantuan);

        // $update_kariah->bindParam(':approvement', $approvement);

        if ($update_kariah->execute()) {

            $kariah_id = $pdo->lastInsertId();
            if ($kariah_id != null) {
                for ($i = 0; $i < count($nama); $i++) {
                    $insert = $pdo->prepare("INSERT INTO tbl_tanggung(kariah_id, nama, ic, umur, tel, kariah_pertalian, kariah_pekerjaan, mati_tanggung)
                        VALUES(:kariah_id, :nama, :ic, :umur, :tel, :kariah_pertalian, :kariah_pekerjaan, :mati_tanggung)");
                    $insert->bindParam(':kariah_id', $id);
                    $insert->bindParam(':nama', $nama[$i]);
                    $insert->bindParam(':ic', $ic[$i]);
                    $insert->bindParam(':umur', $umur[$i]);
                    $insert->bindParam(':tel', $tel[$i]);
                    $insert->bindParam(':kariah_pertalian', $kariah_pertalian[$i]);
                    $insert->bindParam(':kariah_pekerjaan', $kariah_pekerjaan[$i]);
                    $insert->bindParam(':mati_tanggung', $mati_tanggung[$i]);
                    $insert->execute();
                }
            }

            if ($row_penama['kariah_id'] == null) {
                //table penama
                $insert = $pdo->prepare("INSERT INTO penama(kariah_id, penama_name, penama_ic, penama_no, penama_email, penama_pass)
                VALUES(:kariah_id, :penama_name, :penama_ic, :penama_no, :penama_email, :penama_pass)");

                $insert->bindParam(':kariah_id', $id);
                $insert->bindParam(':penama_name', $penama_name);
                $insert->bindParam(':penama_ic', $penama_ic);
                $insert->bindParam(':penama_no', $penama_no);
                $insert->bindParam(':penama_email', $penama_email);
                $insert->bindParam(':penama_pass', $penama_pass);
                $insert->execute();

                //config phpmailer
               
            }

            echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Kemaskini Berjaya",
                        icon: "success",
                        button: "Ok",
                      }).then(function() {
                        window.location = "user.php?p=utama";
                    });
                });
                </script>';
        } else {
            echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Kemaskini Gagal",
                        icon: "error",
                        button: "Ok",
                      });
                });
                </script>';
        }
    }





    // else {
    //     for ($i = 0; $i < count($nama); $i++) {
    //         $update_tanggung = $pdo->prepare("UPDATE tbl_tanggung SET nama=:nama, ic=:ic, umur=:umur, tel=:tel, kariah_pertalian=:kariah_pertalian, kariah_pekerjaan=:kariah_pekerjaan WHERE kariah_id = $id ");
    //         $update_tanggung->bindParam(':nama', $nama[$i]);
    //         $update_tanggung->bindParam(':ic', $ic[$i]);
    //         $update_tanggung->bindParam(':umur', $umur[$i]);
    //         $update_tanggung->bindParam(':tel', $tel[$i]);
    //         $update_tanggung->bindParam(':kariah_pertalian', $kariah_pertalian[$i]);
    //         $update_tanggung->bindParam(':kariah_pekerjaan', $kariah_pekerjaan[$i]);
    //         $update_tanggung->execute();
    //     }

    // }


    // else {
    //     $update_penama = $pdo->prepare("UPDATE penama SET penama_name=:penama_name, penama_ic=:penama_ic, penama_no=:penama_no, penama_email=:penama_email, penama_pass=:penama_pass WHERE kariah_id = $id ");
    //     $update_penama->bindParam(':penama_name', $penama_name);
    //     $update_penama->bindParam(':penama_ic', $penama_ic);
    //     $update_penama->bindParam(':penama_no', $penama_no);
    //     $update_penama->bindParam(':penama_email', $penama_email);
    //     $update_penama->bindParam(':penama_pass', $penama_pass);
    //     $update_penama->execute();
    // }
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
        <?php include_once 'form.php'; ?>

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
        $(document).ready(function() {
            $(document).on('click', '.btnadd1', function() {
                var html = '';

                html += '<tr>';

                html += '<td class="form-control"><hr><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" placeholder="Nama" /><br><input type="text" name="ic[]" id="ic" class="form-control ic" placeholder="No K/P" /><br><input type="number" name="tel[]" class="form-control tel" placeholder="No Tel (Jika Ada)" /><br><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" placeholder="Pertalian" /><br><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" placeholder="Pekerjaan" /><input type="hidden" name="mati_tanggung[]" value="tak" id="mati_tanggung" class="form-control mati_tanggung" placeholder="" /><br><button type="button" name="btn_remove" class="btn btn-danger btn-xs btnremove"><span class="fas fa-trash"></span></button><br><br></td>';
                // html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="ic[]" class="form-control ic" placeholder="No K/P" /></td>';
                // html += '<td class="d-md-none d-sm-table-cell"><input type="text" name="ic[]" class="form-control ic" placeholder="No K/P" /></td>';
                // html += '<td><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-trash"></span></button></td>';
                $('#producttable').append(html);

                $('.ic').mask('000000-00-0000');

                // $('#nama').keyup(function() {
                //     $(this).val($(this).val().toUpperCase());
                // });

                // $('#kariah_pertalian').keyup(function() {
                //     $(this).val($(this).val().toUpperCase());
                // });

                // $('#kariah_pekerjaan').keyup(function() {
                //     $(this).val($(this).val().toUpperCase());
                // });
            })

            $(document).on('click', '.btnremove', function() {
                $(this).closest('tr').remove();
                calculate(0, 0);
                $("#paid").val(0);
            })
        });

        function InvalidEmail(textbox) {

            if (textbox.value == '') {
                textbox.setCustomValidity('Wajib isi');
            } else if (textbox.validity.typeMismatch) {
                textbox.setCustomValidity('Isi format yang betul');
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }

        function InvalidMsg(textbox) {

            if (textbox.validity.typeMismatch) {
                textbox.setCustomValidity('Isi format yang betul');
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }

        function InvalidPhone(textbox) {

            if (textbox.value == '') {
                textbox.setCustomValidity('Wajib isi');
            } else if (textbox.validity.patternMismatch) {
                textbox.setCustomValidity('Tiada Dash (-)');
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


        $(document).ready(function() {
            $(document).on('click', '.btnadd', function() {
                var html = '';
                html += '<tr>';
                html += '<td class="d-none d-md-table-cell"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control1 nama" placeholder="Nama" /></td>';
                html += '<td class="d-none d-md-table-cell"><input type="text" name="ic[]" id="ic" class="form-control2 ic" placeholder="No K/P" /></td>';
                html += '<input type="hidden" name="umur[]" class="form-control3 umur" placeholder="Umur" /></td>';
                html += '<td class="d-none d-md-table-cell"><input type="number" name="tel[]" class="form-control2 tel" placeholder="No Tel (Jika Ada)" /></td>';
                html += '<td class="d-none d-md-table-cell"><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control2 kariah_pertalian" placeholder="Pertalian" /></td>';
                html += '<td class="d-none d-md-table-cell"><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control2 kariah_pekerjaan" placeholder="Pekerjaan" /></td>';
                html += '<input type="hidden" name="mati_tanggung[]" value="tak" id="mati_tanggung" class="form-control mati_tanggung" placeholder="" />';
                html += '<td><button type="button" name="btn_remove" class="btn btn-danger btn-xs btnremove"><span class="fas fa-trash"></span></button></td>';

                $('#producttable').append(html);

                $('.ic').mask('000000-00-0000');

                // $('#nama').keyup(function() {
                //     $(this).val($(this).val().toUpperCase());
                // });

                // $('#kariah_pertalian').keyup(function() {
                //     $(this).val($(this).val().toUpperCase());
                // });

                // $('#kariah_pekerjaan').keyup(function() {
                //     $(this).val($(this).val().toUpperCase());
                // });
            })

            $(document).on('click', '.btnremove', function() {
                $(this).closest('tr').remove();
                calculate(0, 0);
                $("#paid").val(0);
            })
        });

        $(document).ready(function() {
            $('.ic').mask('000000-00-0000');
        });

        $(document).ready(function() {
            var masks = ["A00000000000", '000000-00-0000'];
            var options = {
                onKeyPress: function(cep, e, field, options) {
                    var mask = (cep.length == 12) ? masks[1] : masks[0];
                    $('#penama_ic').mask(mask, options);
                }
            };

            $('#penama_ic').mask(masks[1], options);
        });

        // $("input[name='tel_hp']").keyup(function() {
        //     $(this).val($(this).val().replace(/^(\d{3})(\d{3})$/, "$1-$2"));
        // });

        // $("input[name='penama_no']").keyup(function() {
        //     $(this).val($(this).val().replace(/^(\d{3})(\d{3})$/, "$1-$2"));
        // });


        // $(document).ready(function() {
        //     $('#nama').keyup(function() {
        //         $(this).val($(this).val().toUpperCase());
        //     });
        // });

        // $(document).ready(function() {
        //     $('#kariah_pertalian').keyup(function() {
        //         $(this).val($(this).val().toUpperCase());
        //     });
        // });

        // $(document).ready(function() {
        //     $('#kariah_pekerjaan').keyup(function() {
        //         $(this).val($(this).val().toUpperCase());
        //     });
        // });

        $(document).ready(function() {
            $('#penerima_bantuan').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
</body>