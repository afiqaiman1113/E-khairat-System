<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();

// $select->bindParam(':kariah_name', $kariah_name);
// $select->bindParam(':kariah_ic', $kariah_ic);
// $select->bindParam(':user_email', $user_email);
// $select->bindParam(':kariah_umur', $kariah_umur);
// $select->bindParam(':jantina', $jantina);
// $select->bindParam(':pekerjaan', $pekerjaan);
// $select->bindParam(':alamat', $alamat);
// $select->bindParam(':alamat2', $alamat2);
// $select->bindParam(':poskod', $poskod);
// $select->bindParam(':bandar', $bandar);
// $select->bindParam(':negeri', $negeri);
// $select->bindParam(':s_menetap', $s_menetap);
// $select->bindParam(':tel_rumah', $tel_rumah);
// $select->bindParam(':tel_hp', $tel_hp);
// $select->bindParam(':kawasan', $kawasan);
// $select->bindParam(':tahun_menetap', $tahun_menetap);
// $select->bindParam(':status_perkahwinan', $status_perkahwinan);
// $select->bindParam(':penerima_bantuan', $penerima_bantuan);
// $select->bindParam(':password', $password);
// $select->bindParam(':tarikh_daftar', $tarikh_daftar);
// $select->bindParam(':role', $role);
// $select->bindParam(':approvement', $approvement);

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
$mati = $row['mati'];

$select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id = $id");
$select->execute();
$row_tanggung = $select->fetchAll(PDO::FETCH_ASSOC);

function fill_product($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    $selecPaid = $pdo->prepare("SELECT tbl_product.* FROM tbl_product LEFT JOIN khairat_kematian ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id = 1 AND khairat_kematian.kariah_id = " . $id . " ORDER BY product_name ASC");
    $selecPaid->execute();
    $resultPaid = $selecPaid->fetchAll();
    $allPaid = [];
    foreach ($resultPaid as $rowPaid) {
        $allPaid[] = $rowPaid['product_id'];
    }
    $resultPaid = implode(",", $allPaid);

    if ($resultPaid != null) {
        $select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id NOT IN($resultPaid) ORDER BY product_name ASC");
    } else {
        $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
    }

    $select->execute();
    $result = $select->fetchAll();

    foreach ($result as $row) {
        $output .= '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
    }
    return $output;
}

function tunggak($pdo)
{
    $output = '';
    $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["product_id"] . '">' . $row["stat"] . '</option>';
    }
    return $output;
}


function test($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    // $select = $pdo->prepare("SELECT product_id, product_name FROM khairat_kematian WHERE kariah_id = $id");
    $select = $pdo->prepare("SELECT * FROM tbl_product INNER JOIN khairat_kematian ON tbl_product.product_id = khairat_kematian.product_id WHERE kariah_id = $id");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        if ($row) {
            $output .= '<option value="' . $row["product_id"] . '">'   . " Berjaya" .  '</option>';
        } elseif ($output .= '<option value="' . $row["product_id"] . '">'   . " Berjaya" .  '</option>' != true) {
            $output .= '<option hidden>' . "Tunggak " .  '</option>';
        }
    }
    return $output;
}

function jumlah($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT kariah_id, paid FROM khairat_kematian WHERE kariah_id = $id");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        if ($row) {

            $output .= '<option value="' . $row["kariah_id"] . '">' . number_format($row["paid"], 2)  .  '</option>';
        } else {
            $output .= '<option value="' . $row["product_id"] . '">' . "Tunggak " .  '</option>';
        }
    }
    return $output;
}

function baki($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT kariah_id, due FROM khairat_kematian WHERE kariah_id = $id");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        if ($row) {

            $output .= '<option value="' . $row["kariah_id"] . '">' . number_format($row["due"], 2)  .  '</option>';
        } else {
            $output .= '<option value="' . $row["product_id"] . '">' . "Tunggak " .  '</option>';
        }
    }
    return $output;
}


if (isset($_POST['btn_simpan'])) {

    // $kariah_id = $_POST['kariah_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $jumlah = $_POST['jumlah'];
    $quantity = $_POST['quantity'];
    $arr_total = $_POST['total'];
    $khairat_name = $_POST['khairat_name'];
    $khairat_ic = $_POST['khairat_ic'];
    $khairat_email = $_POST['khairat_email'];
    $khairat_umur = $_POST['khairat_umur'];
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
    // $tarikh_bayar = date("Y-m-d");
    $tarikh_bayar = date('Y-m-d', strtotime($_POST['tarikh_bayar']));
    // $expired = date('Y-m-d', strtotime('+1 years'));
    $expired = date("Y-m-d", strtotime(date("Y-m-d", strtotime($tarikh_bayar)) . " + 365 day"));
    $approvement = $_POST['approvement'];
    $total = $_POST['total'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $invoice_no = $_POST['invoice_no'];
    $p_method = $_POST['p_method'];
    $status_id = $_POST['status_id'];
    $mati = $_POST['mati'];
    $stat = $_POST['stat'];

    if ($khairat_umur == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini maklumat",
                    icon: "warning",
                    button: "Ok",
                  });
            });
            </script>';
    } elseif ($jantina == null) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila kemaskini jantina",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    }
    // elseif ($pekerjaan == null) {
    //     echo '<script type="text/javascript">
    //     jQuery(function validation() {
    //         swal({
    //             title: "Sila kemaskini pekerjaan",
    //             icon: "warning",
    //             button: "Ok",
    //           });
    //     });
    //     </script>';
    // }
    elseif ($alamat == null) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila kemaskini alamat",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($poskod == null) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila kemaskini poskod",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($bandar == null) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila kemaskini bandar",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($negeri == null) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila kemaskini negeri",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($s_menetap == null) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila kemaskini status menetap",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    }
    // elseif ($tel_hp == null) {
    //     echo '<script type="text/javascript">
    //     jQuery(function validation() {
    //         swal({
    //             title: "Sila kemaskini no telefon bimbit",
    //             icon: "warning",
    //             button: "Ok",
    //           });
    //     });
    //     </script>';
    // }
    elseif ($kawasan == null) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila kemaskini kawasan kariah",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($status_perkahwinan == null) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila kemaskini status perkahwinan",
                icon: "warning",
                button: "Ok",
              });
        });
        </script>';
    } elseif ($product_name == 'Yuran Pendaftaran') {
        // $kariah_id = $_POST['kariah_id'];
        $nama = $_POST['nama'];
        $ic = $_POST['ic'];
        $umur = $_POST['umur'];
        $tel = $_POST['tel'];
        $pertalian = $_POST['pertalian'];
        $khairat_pekerjaan = $_POST['khairat_pekerjaan'];

        // $product_id = $_POST['product_id'];
        // $product_name = $_POST['product_name'];
        // $jumlah = $_POST['jumlah'];
        // $quantity = $_POST['quantity'];
        // $arr_total = $_POST['total'];

        // $delete_tanggungan = $pdo->prepare("DELETE FROM tbl_tanggung WHERE kariah_id = $id");
        // $delete_tanggungan->execute();

        $kariah_id = $pdo->lastInsertId();
        if ($kariah_id != null) {

            $insert = $pdo->prepare("INSERT INTO khairat_kematian(kariah_id, product_id, product_name, jumlah, quantity, khairat_name, khairat_ic, khairat_email, khairat_umur, jantina, pekerjaan, alamat, alamat2, poskod, bandar, negeri, s_menetap, tel_rumah, tel_hp, kawasan, tahun_menetap, status_perkahwinan, penerima_bantuan, tarikh_bayar, expired, approvement, total, paid, due, invoice_no, p_method, status_id, mati, stat)
                 VALUES(:kariah_id, :product_id, :product_name, :jumlah, :quantity, :khairat_name, :khairat_ic, :khairat_email, :khairat_umur, :jantina, :pekerjaan, :alamat, :alamat2, :poskod, :bandar, :negeri, :s_menetap, :tel_rumah, :tel_hp, :kawasan, :tahun_menetap, :status_perkahwinan, :penerima_bantuan, :tarikh_bayar, :expired, :approvement, :total, :paid, :due, :invoice_no, :p_method, :status_id, :mati, 0)");

            $insert->bindParam(':kariah_id', $id);
            $insert->bindParam(':product_id', $product_id);
            $insert->bindParam(':product_name', $product_name);
            $insert->bindParam(':jumlah', $jumlah);
            $insert->bindParam(':quantity', $quantity);
            $insert->bindParam(':khairat_name', $khairat_name);
            $insert->bindParam(':khairat_ic', $khairat_ic);
            $insert->bindParam(':khairat_email', $khairat_email);
            $insert->bindParam(':khairat_umur', $khairat_umur);
            $insert->bindParam(':jantina', $jantina);
            $insert->bindParam(':pekerjaan', $pekerjaan);
            $insert->bindParam(':alamat', $alamat);
            $insert->bindParam(':alamat2', $alamat2);
            $insert->bindParam(':poskod', $poskod);
            $insert->bindParam(':bandar', $bandar);
            $insert->bindParam(':negeri', $negeri);
            $insert->bindParam(':s_menetap', $s_menetap);
            $insert->bindParam(':tel_rumah', $tel_rumah);
            $insert->bindParam(':tel_hp', $tel_hp);
            $insert->bindParam(':kawasan', $kawasan);
            $insert->bindParam(':tahun_menetap', $tahun_menetap);
            $insert->bindParam(':status_perkahwinan', $status_perkahwinan);
            $insert->bindParam(':penerima_bantuan', $penerima_bantuan);
            $insert->bindParam(':tarikh_bayar', $tarikh_bayar);
            $insert->bindParam(':expired', $expired);
            $insert->bindParam(':approvement', $approvement);
            $insert->bindParam(':total', $total);
            $insert->bindParam(':paid', $paid);
            $insert->bindParam(':due', $due);
            $insert->bindParam(':invoice_no', $invoice_no);
            $insert->bindParam(':p_method', $p_method);
            $insert->bindParam(':status_id', $status_id);
            $insert->bindParam(':mati', $mati);

            if ($insert->execute()) {
                echo '<script type="text/javascript">
                 jQuery(function validation() {
                     swal({
                         title: "Berjaya Bayar",
                         icon: "success",
                         button: "Ok",
                       }).then(function() {
                           window.location = "senarai-khairat-kematian.php";
                       });
                 });
                 </script>';
            } else {
                echo '<script type="text/javascript">
                 jQuery(function validation() {
                     swal({
                         title: "Gagal Bayar",
                         icon: "error",
                         button: "Ok",
                       });
                 });
                 </script>';
            }

            $khairat_id = $pdo->lastInsertId();
            if ($khairat_id != null) {
                for ($i = 0; $i < count($nama); $i++) {
                    $insert = $pdo->prepare("INSERT INTO cubaan(khairat_id, kariah_id, nama, ic, umur, tel, pertalian, khairat_pekerjaan)
                         VALUES(:khairat_id, :kariah_id, :nama, :ic, :umur, :tel, :pertalian, :khairat_pekerjaan)");

                    $insert->bindParam(':khairat_id', $khairat_id);
                    $insert->bindParam(':kariah_id', $id);
                    $insert->bindParam(':nama', $nama[$i]);
                    $insert->bindParam(':ic', $ic[$i]);
                    $insert->bindParam(':umur', $umur[$i]);
                    $insert->bindParam(':tel', $tel[$i]);
                    $insert->bindParam(':pertalian', $pertalian[$i]);
                    $insert->bindParam(':khairat_pekerjaan', $khairat_pekerjaan[$i]);

                    $insert->execute();
                }
            }

            $sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar' WHERE kariah_id = $id ";
            $update = $pdo->prepare($sql);
            $update->execute();

            // if ($khairat_id != null) {

            //     $insert = $pdo->prepare("INSERT INTO tbl_invois(khairat_id, kariah_id, product_id, product_name, jumlah, quantity, order_date)
            //         VALUES(:khairat_id, :kariah_id, :product_id, :product_name, :jumlah, :quantity, :order_date)");

            //     $insert->bindParam(':khairat_id', $khairat_id);
            //     $insert->bindParam(':kariah_id', $id);
            //     $insert->bindParam(':product_id', $product_id);
            //     $insert->bindParam(':product_name', $product_name);
            //     $insert->bindParam(':jumlah', $jumlah);
            //     $insert->bindParam(':quantity', $quantity);
            //     $insert->bindParam(':order_date', $order_date);

            //     $insert->execute();
            // }
        }
    } else {

        // $kariah_id = $_POST['kariah_id'];
        $nama = $_POST['nama'];
        $ic = $_POST['ic'];
        $umur = $_POST['umur'];
        $tel = $_POST['tel'];
        $pertalian = $_POST['pertalian'];
        $khairat_pekerjaan = $_POST['khairat_pekerjaan'];

        // $product_id = $_POST['product_id'];
        // $product_name = $_POST['product_name'];
        // $jumlah = $_POST['jumlah'];
        // $quantity = $_POST['quantity'];
        // $arr_total = $_POST['total'];

        // $delete_tanggungan = $pdo->prepare("DELETE FROM tbl_tanggung WHERE kariah_id = $id");
        // $delete_tanggungan->execute();

        $kariah_id = $pdo->lastInsertId();
        if ($kariah_id != null) {

            $insert = $pdo->prepare("INSERT INTO khairat_kematian(kariah_id, product_id, product_name, jumlah, quantity, khairat_name, khairat_ic, khairat_email, khairat_umur, jantina, pekerjaan, alamat, alamat2, poskod, bandar, negeri, s_menetap, tel_rumah, tel_hp, kawasan, tahun_menetap, status_perkahwinan, penerima_bantuan, tarikh_bayar, expired, approvement, total, paid, due, invoice_no, p_method, status_id, mati, stat)
                VALUES(:kariah_id, :product_id, :product_name, :jumlah, :quantity, :khairat_name, :khairat_ic, :khairat_email, :khairat_umur, :jantina, :pekerjaan, :alamat, :alamat2, :poskod, :bandar, :negeri, :s_menetap, :tel_rumah, :tel_hp, :kawasan, :tahun_menetap, :status_perkahwinan, :penerima_bantuan, :tarikh_bayar, :expired, :approvement, :total, :paid, :due, :invoice_no, :p_method, :status_id, :mati, 1)");

            $insert->bindParam(':kariah_id', $id);
            $insert->bindParam(':product_id', $product_id);
            $insert->bindParam(':product_name', $product_name);
            $insert->bindParam(':jumlah', $jumlah);
            $insert->bindParam(':quantity', $quantity);
            $insert->bindParam(':khairat_name', $khairat_name);
            $insert->bindParam(':khairat_ic', $khairat_ic);
            $insert->bindParam(':khairat_email', $khairat_email);
            $insert->bindParam(':khairat_umur', $khairat_umur);
            $insert->bindParam(':jantina', $jantina);
            $insert->bindParam(':pekerjaan', $pekerjaan);
            $insert->bindParam(':alamat', $alamat);
            $insert->bindParam(':alamat2', $alamat2);
            $insert->bindParam(':poskod', $poskod);
            $insert->bindParam(':bandar', $bandar);
            $insert->bindParam(':negeri', $negeri);
            $insert->bindParam(':s_menetap', $s_menetap);
            $insert->bindParam(':tel_rumah', $tel_rumah);
            $insert->bindParam(':tel_hp', $tel_hp);
            $insert->bindParam(':kawasan', $kawasan);
            $insert->bindParam(':tahun_menetap', $tahun_menetap);
            $insert->bindParam(':status_perkahwinan', $status_perkahwinan);
            $insert->bindParam(':penerima_bantuan', $penerima_bantuan);
            $insert->bindParam(':tarikh_bayar', $tarikh_bayar);
            $insert->bindParam(':expired', $expired);
            $insert->bindParam(':approvement', $approvement);
            $insert->bindParam(':total', $total);
            $insert->bindParam(':paid', $paid);
            $insert->bindParam(':due', $due);
            $insert->bindParam(':invoice_no', $invoice_no);
            $insert->bindParam(':p_method', $p_method);
            $insert->bindParam(':status_id', $status_id);
            $insert->bindParam(':mati', $mati);

            if ($insert->execute()) {
                echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Berjaya Bayar",
                        icon: "success",
                        button: "Ok",
                      }).then(function() {
                          window.location = "senarai-khairat-kematian.php";
                      });
                });
                </script>';
            } else {
                echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Gagal Bayar",
                        icon: "error",
                        button: "Ok",
                      });
                });
                </script>';
            }

            $khairat_id = $pdo->lastInsertId();
            if ($khairat_id != null) {
                for ($i = 0; $i < count($nama); $i++) {
                    $insert = $pdo->prepare("INSERT INTO cubaan(khairat_id, kariah_id, nama, ic, umur, tel, pertalian, khairat_pekerjaan)
                        VALUES(:khairat_id, :kariah_id, :nama, :ic, :umur, :tel, :pertalian, :khairat_pekerjaan)");

                    $insert->bindParam(':khairat_id', $khairat_id);
                    $insert->bindParam(':kariah_id', $id);
                    $insert->bindParam(':nama', $nama[$i]);
                    $insert->bindParam(':ic', $ic[$i]);
                    $insert->bindParam(':umur', $umur[$i]);
                    $insert->bindParam(':tel', $tel[$i]);
                    $insert->bindParam(':pertalian', $pertalian[$i]);
                    $insert->bindParam(':khairat_pekerjaan', $khairat_pekerjaan[$i]);

                    $insert->execute();
                }
            }

            $sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar' WHERE kariah_id = $id ";
            $update = $pdo->prepare($sql);
            $update->execute();

            // if ($khairat_id != null) {

            //     $insert = $pdo->prepare("INSERT INTO tbl_invois(khairat_id, kariah_id, product_id, product_name, jumlah, quantity, order_date)
            //         VALUES(:khairat_id, :kariah_id, :product_id, :product_name, :jumlah, :quantity, :order_date)");

            //     $insert->bindParam(':khairat_id', $khairat_id);
            //     $insert->bindParam(':kariah_id', $id);
            //     $insert->bindParam(':product_id', $product_id);
            //     $insert->bindParam(':product_name', $product_name);
            //     $insert->bindParam(':jumlah', $jumlah);
            //     $insert->bindParam(':quantity', $quantity);
            //     $insert->bindParam(':order_date', $order_date);

            //     $insert->execute();
            // }
        }
    }
}

if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}

?>
<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bayar</h1>
                </div>
            </div>
        </div>
    </section> -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bayaran Yuran Tunai</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="">
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Status</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="status_id" class="form-control" placeholder="" value="1" />
                                <!-- </div>
                                        </div>
                                    </div>
                                </div> -->
                                <td style="display:none;"><input type="hidden" name="product_name" class="form-control pname" placeholder="" readonly /></td>
                                <td>
                                    <select name="product_id" style="width: 250px" class="form-control productid">
                                        <option value="">Pilih Yuran</option><?php echo fill_product($pdo); ?>
                                    </select>
                                </td>
                                <td><input type="hidden" name="jumlah" class="form-control jumlah" placeholder="" readonly /></td>
                                <td><input type="hidden" name="quantity" class="form-control quantity" placeholder="" />
                                </td>
                                <td><input type="hidden" name="total" class="form-control total" placeholder="" readonly /></td>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        RM
                                                    </span>
                                                </div>
                                                <input type="text" name="total" class="form-control" id="total" placeholder="" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bayar</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        RM
                                                    </span>
                                                </div>
                                                <input type="number" name="paid" class="form-control" id="paid" placeholder="" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Baki</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        RM
                                                    </span>
                                                </div>
                                                <input type="text" name="due" class="form-control" id="due" placeholder="" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Pembayaran</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>

                                                <!-- <td style="font-size:87%;">' . date('d-m-Y', strtotime($row->tarikh_daftar)) . '</td> -->
                                                <input type="text" class="form-control datetimepicker-input" name="tarikh_bayar" value="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd" data-target="#reservationdate">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                                <!-- <input name="invoice_no" type="hidden" class="form-control" value="<?php //$b = rand(10,10000);
                                                                                                        //$c = $b;
                                                                                                        //echo $c;
                                                                                                        ?>" autofocus="on" readonly="readonly" /> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Invois</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="invoice_no" class="form-control" value="" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Payment Method</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="p_method" class="form-control" placeholder="" value="CASH" />
                                <!-- </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Nama Ahli</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="khairat_name" class="form-control" placeholder="" value="<?php echo $kariah_name; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" readonly />
                                <!-- </div>
                                        </div>
                                    </div>
                                </div> -->
                                <input type="hidden" name="approvement" class="form-control" placeholder="" value="Telah Daftar" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" readonly />
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* No K/P</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="khairat_ic" class="form-control" placeholder="" value="<?php echo $kariah_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" readonly />
                                <!-- </div>
                                        </div>
                                    </div> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Umur</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="khairat_umur" class="form-control" placeholder="" value="<?php echo $kariah_umur; ?>" readonly />
                                <!-- </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Emel</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="khairat_email" class="form-control" placeholder="" value="<?php echo $user_email; ?>" readonly />
                                <!-- </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row"> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="journey">* Jantina</label> -->
                                <select name="jantina" class="form-control" id="" readonly hidden>
                                    <option value='<?php echo $jantina; ?>'><?php echo $jantina; ?></option>
                                    <?php
                                    if ($jantina == '') {
                                        echo "<option value='Perempuan'>Perempuan</option>";
                                        echo "<option value='Lelaki'>Lelaki</option>";
                                    } elseif ($jantina == 'Lelaki') {
                                        echo "<option value='Perempuan'>Perempuan</option>";
                                    } else {
                                        echo "<option value='Lelaki'>Lelaki</option>";
                                    }
                                    ?>
                                </select>
                                <!-- </div>
                                    </div> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Pekerjaan</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="pekerjaan" class="form-control" placeholder="" value="<?php echo $pekerjaan; ?>" readonly />
                                <!-- </div>
                                        </div>
                                    </div> -->
                                <!-- </div> -->
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>* Alamat</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="alamat" class="form-control" placeholder="" value="<?php echo $alamat; ?>" readonly />
                                <!-- </div><br> -->
                                <!-- <div class="input-group"> -->
                                <input type="hidden" name="alamat2" class="form-control" placeholder="" value="<?php echo $alamat2; ?>" readonly />
                                <!-- </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row"> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Poskod</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="poskod" class="form-control" placeholder="" value="<?php echo $poskod; ?>" readonly />
                                <!-- </div>
                                        </div>
                                    </div> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Bandar</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="bandar" class="form-control" placeholder="" value="<?php echo $bandar; ?>" readonly />
                                <!-- </div>
                                        </div>
                                    </div> -->
                                <!-- </div> -->
                                <!-- <div class="row"> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="journey">* Negeri</label> -->
                                <select name="negeri" class="form-control" id="" readonly hidden>
                                    <option value='<?php echo $negeri; ?>'><?php echo $negeri; ?></option>
                                    <?php
                                    if ($negeri == '') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Johor') {
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Kedah') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Kelantan') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Melaka') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Negeri Sembilan') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Pahang') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Pulau Pinang') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Perak') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Perlis') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Selangor') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Sabah') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Sarawak') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Terengganu') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Wilayah Persekutuan Labuan') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } elseif ($negeri == 'Wilayah Persekutuan Kuala Lumpur') {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                    } else {
                                        echo "<option value='Johor'>Johor</option>";
                                        echo "<option value='Kedah'>Kedah</option>";
                                        echo "<option value='Kelantan'>Kelantan</option>";
                                        echo "<option value='Melaka'>Melaka</option>";
                                        echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                        echo "<option value='Pahang'>Pahang</option>";
                                        echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                        echo "<option value='Perak'>Perak</option>";
                                        echo "<option value='Perlis'>Perlis</option>";
                                        echo "<option value='Selangor'>Selangor</option>";
                                        echo "<option value='Sabah'>Sabah</option>";
                                        echo "<option value='Sarawak'>Sarawak</option>";
                                        echo "<option value='Terengganu'>Terengganu</option>";
                                        echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                        echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                    }
                                    ?>
                                </select>
                                <!-- </div>
                                    </div> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="journey">* Status Menetap</label> -->
                                <select name="s_menetap" class="form-control" id="" readonly hidden>
                                    <option value='<?php echo $s_menetap; ?>'><?php echo $s_menetap; ?></option>
                                    <?php
                                    if ($s_menetap == '') {
                                        echo "<option value='Sewa'>Sewa</option>";
                                        echo "<option value='Sendiri'>Sendiri</option>";
                                    } elseif ($s_menetap == 'Sendiri') {
                                        echo "<option value='Sewa'>Sewa</option>";
                                    } else {
                                        echo "<option value='Sendiri'>Sendiri</option>";
                                    }
                                    ?>
                                </select>
                                <!-- </div>
                                    </div> -->
                                <!-- </div> -->
                                <!-- <div class="row"> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tel Rumah (Jika Ada)</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="tel_rumah" class="form-control" value="<?php echo $tel_rumah; ?>" placeholder="" readonly />
                                <!-- </div>
                                        </div>
                                    </div> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tel Bimbit (Jika Ada)</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="tel_hp" class="form-control" value="<?php echo $tel_hp; ?>" placeholder="" readonly />
                                <!-- </div>
                                        </div>
                                    </div> -->
                                <!-- </div> -->
                                <!-- <div class="row"> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Kawasan Kariah</label> -->
                                <select name="kawasan" class="form-control" id="" readonly hidden>
                                    <option value='<?php echo $kawasan; ?>'><?php echo $kawasan; ?></option>
                                    <?php
                                    if ($kawasan == '') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Pondok Haji Majid') {
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Kg Jalan Baru') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Taman Markisa') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Pondok Hj Husin') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Lorong Panglima') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Ustaz Khir') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Kg Baru') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Lorong Datuk Madon') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Kg Pasir') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Hj Husin') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } elseif ($kawasan == 'Surau Haji Abdul Bt 18') {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                    } else {
                                        echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                        echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                        echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                        echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                        echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                        echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                        echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                        echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                        echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                        echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
                                        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                    }
                                    ?>
                                </select>
                                <!-- </div>
                                    </div> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Tahun Mula Menetap Dalam Kariah</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="tahun_menetap" class="form-control" value='<?php echo $tahun_menetap; ?>' placeholder="" readonly />
                                <!-- </div>
                                        </div>
                                    </div> -->
                                <!-- </div> -->
                                <!-- <div class="row"> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>* Status Perkahwinan</label> -->
                                <select name="status_perkahwinan" class="form-control" id="" readonly hidden>
                                    <option value='<?php echo $status_perkahwinan; ?>'>
                                        <?php echo $status_perkahwinan; ?></option>
                                    <?php
                                    if ($status_perkahwinan == '') {
                                        echo "<option value='Bujang'>Bujang</option>";
                                        echo "<option value='Kahwin'>Kahwin</option>";
                                        echo "<option value='Duda'>Duda</option>";
                                        echo "<option value='Janda'>Janda</option>";
                                        echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                    } elseif ($status_perkahwinan == 'Bujang') {
                                        echo "<option value='Kahwin'>Kahwin</option>";
                                        echo "<option value='Duda'>Duda</option>";
                                        echo "<option value='Janda'>Janda</option>";
                                        echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                    } elseif ($status_perkahwinan == 'Kahwin') {
                                        echo "<option value='Bujang'>Bujang</option>";
                                        echo "<option value='Duda'>Duda</option>";
                                        echo "<option value='Janda'>Janda</option>";
                                        echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                    } elseif ($status_perkahwinan == 'Duda') {
                                        echo "<option value='Bujang'>Bujang</option>";
                                        echo "<option value='Kahwin'>Kahwin</option>";
                                        echo "<option value='Janda'>Janda</option>";
                                        echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                    } elseif ($status_perkahwinan == 'Janda') {
                                        echo "<option value='Bujang'>Bujang</option>";
                                        echo "<option value='Kahwin'>Kahwin</option>";
                                        echo "<option value='Duda'>Duda</option>";
                                        echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                    } else {
                                        echo "<option value='Bujang'>Bujang</option>";
                                        echo "<option value='Kahwin'>Kahwin</option>";
                                        echo "<option value='Duda'>Duda</option>";
                                        echo "<option value='Janda'>Janda</option>";
                                    }
                                    ?>
                                </select>
                                <!-- </div>
                                    </div> -->
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Penerima Bantuan (Jika Ya, isi jenis bantuan)</label>
                                            <div class="input-group"> -->
                                <input type="hidden" name="penerima_bantuan" class="form-control" value="<?php echo $penerima_bantuan; ?>" placeholder="Kosongkan jika tiada" readonly />
                                <input type="hidden" name="mati" class="form-control" value="<?php echo $mati; ?>" readonly />
                                <input type="hidden" name="stat" class="form-control" />
                                <!-- </div>
                                        </div>
                                    </div> -->
                                <!-- </div> -->
                                <!-- <div class="card card-primary"> -->
                                <!-- <div class="card-header">
                                        <h3 class="card-title">Maklumat Tanggungan</h3>
                                    </div> -->
                                <!-- <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="overflow-x: auto;"> -->
                                <!-- <table id="producttable" class="table table-striped"> -->
                                <!-- <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th>No K/P</th>
                                                                <th>Umur</th>
                                                                <th>No Tel</th>
                                                                <th>Pertalian</th>
                                                                <th>Pekerjaan</th>
                                                                <th>
                                                                    <center><button type="button" name="btn_add" class="btn btn-success btn-sm btnadd">Add</button></center>
                                                                </th>
                                                            </tr>
                                                        </thead> -->

                                <?php
                                foreach ($row_tanggung as $item_tanggung) {
                                    $select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id =  '{$item_tanggung['kariah_id']}' ");
                                    $select->execute();

                                    $row_komitment = $select->fetchAll(PDO::FETCH_ASSOC);
                                ?>

                                    <tr>
                                        <?php
                                        echo '<td><input type="hidden" name="nama[]" class="form-control nama" value="' . $item_tanggung['nama'] . '" placeholder="" readonly /></td>';
                                        echo '<td><input type="hidden" name="ic[]" class="form-control ic" value="' . $item_tanggung['ic'] . '"  placeholder="" readonly /></td>';
                                        echo '<td><input type="hidden" name="umur[]" class="form-control umur" value="' . $item_tanggung['umur'] . '"  placeholder="" readonly /></td>';
                                        echo '<td><input type="hidden" name="tel[]" class="form-control tel" value="' . $item_tanggung['tel'] . '"  placeholder="" readonly /></td>';
                                        echo '<td><input type="hidden" name="pertalian[]" class="form-control pertalian" value="' . $item_tanggung['kariah_pertalian'] . '"  placeholder="" readonly /></td>';
                                        echo '<td><input type="hidden" name="khairat_pekerjaan[]" class="form-control khairat_pekerjaan" value="' . $item_tanggung['kariah_pekerjaan'] . '"  placeholder="" readonly /></td>';
                                        // echo '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove">Remove</button></center></td>';
                                        ?>
                                    </tr>

                                <?php } ?>

                                <!-- </table> -->
                                <!-- </div>
                                            </div>
                                        </div>
                                    </div> -->
                                <!-- </div> -->
                                <hr>
                                <div align="center">
                                    <input type="submit" name="btn_simpan" value="BAYAR" class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-exclamation-triangle"></i>
                                Penting
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Nota!</h5>
                                <ul>
                                    <li>Pastikan anda telah mengemaskini maklumat terlebih dahulu sebelum membuat
                                        pembayaran</li><br>
                                    <li>Maklumat tidak boleh dikemaskini setelah bayaran dilakukan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">
                            Transaksi Akaun
                        </h3>
                    </div>
                    <div style="overflow-x: auto;">
                        <table id="member-list" class="table table">
                            <thead>
                                <tr>
                                    <th style="font-size:90%;">Yuran</th>
                                    <th style="font-size:90%;">Status</th>
                                    <th style="font-size:90%;">Telah Bayar</th>
                                    <th style="font-size:90%;">Baki Tunggakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_ASSOC);

                                $select33 = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
                                $select33->execute();
                                $row33 = $select33->fetchAll();

                                foreach ($row33 as $product) {
                                    $selectKK =  $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.product_id = " . $product['product_id'] . " AND khairat_kematian.kariah_id = " . $id);
                                    $selectKK->execute();
                                    $KK = $selectKK->fetch(PDO::FETCH_ASSOC);
                                    if ($KK) {
                                        echo '<tr>
                                        <td style="font-size:88%;">' . $product['product_name'] . '</td>
                                        <td style="font-size:90%;"><span class="badge bg-success">' . 'Sudah Dibayar' . '</span></td>
                                        <td style="font-size:88%;">RM ' . number_format($KK['paid'], 2) . '</td>
                                        <td style="font-size:88%;">RM ' . number_format($KK['due'], 2) . '</td>
                                         ';
                                    } else {
                                        echo '<tr>
                                        <td style="font-size:88%;">' . $product['product_name'] . '</td>
                                        <td style="font-size:90%;"><span class="badge bg-danger">' . 'Tertunggak' . '</span></td>
                                        <td style="font-size:88%;">RM 0.00</td>
                                        <td style="font-size:88%;">RM ' . number_format($product['jumlah'], 2) . '</td>
                                    ';
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function() {
        $("#reservationdate").datetimepicker({
            format: "L",
            // format:'DD/MM/YYYY',
        });
    });

    $(document).ready(function() {

        $('#member-list').DataTable({
            "order": [
                [0, "asc"]
            ],

            pageLength: 2,
            lengthMenu: [
                [2],
                [2]
            ]
        });


        $('.productid').select2()
        $('.productid').select2({
            theme: 'bootstrap4'
        })

        $('.productid').on('change', function(e) {
            var productid = this.value;
            var tr = $(this).parent().parent();
            $.ajax({
                url: "getproduct2.php",
                method: "get",
                data: {
                    id: productid
                },
                success: function(data) {
                    tr.find(".pname").val(data["product_name"]);
                    tr.find(".jumlah").val(data["jumlah"]);
                    tr.find(".quantity").val(1);
                    tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah")
                        .val());
                    calculate(0, 0);
                }
            })
        })

        function calculate(paid) {
            var net_total = 0;
            var paid_amount = paid;
            var due = 0;

            $(".total").each(function() {
                net_total = net_total + ($(this).val() * 1);
            })

            net_total = net_total;
            due = net_total - paid_amount;
            $("#total").val(net_total.toFixed(2));
            $("#due").val(due.toFixed(2));
        }

        $("#paid").keyup(function() {
            var paid = $(this).val();
            // var discount = $("#discount").val();
            calculate(paid);
        })
    });
</script>

<?php
include_once 'footer.php';
?>