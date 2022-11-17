<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();

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
    $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
    $select->execute();

    $row = $select->fetch(PDO::FETCH_ASSOC);
    $output = '';

    //$selecPaid = $pdo->prepare("SELECT tbl_product.* FROM tbl_product LEFT JOIN khairat_kematian ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id = 1 AND khairat_kematian.kariah_id = " . $id . " ORDER BY product_name ASC");
    $selecPaid = $pdo->prepare("SELECT * FROM khairat_kematian WHERE kariah_id = $id AND status_id = 1");
    $selecPaid->execute();
    $resultPaid = $selecPaid->fetchAll();
    $allPaid = [];
    foreach ($resultPaid as $rowPaid) {
        $p1 = explode(",", $rowPaid['product_id']);
        $allPaid = array_merge($allPaid, $p1);
    }

    $array = explode("-", $row['tarikh_daftar']);
    $tahun = $array[0];

    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE tahun < $tahun AND stat = 1");
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
        $allPaid[] = $row['product_id'];
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

function fill_product2($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT * FROM tbl_product");
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
    $select = $pdo->prepare("SELECT khairat_kematian.* FROM tbl_product LEFT JOIN khairat_kematian ON tbl_product.product_id = khairat_kematian.product_id WHERE kariah_id = $id");
    $select->execute();
    $result = $select->fetchAll();

    foreach ($result as $row) {
        if ($row) {
            $output .= '<option value="' . $row["product_id"] . '">'   . " Berjaya" .  '</option>';
        } elseif ($output .= '<option value="' . $row["product_id"] . '">'   . " Berjaya" .  '</option>' != true) {
            $output .= '<option hidden>' . "Tunggak " .  '</option>';
        }
    }
    $output .= '<option >' . "Tunggak " .  '</option>';

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
    $output .= '<option >' . "Tunggak " .  '</option>';
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
    $output .= '<option >' . "Tunggak " .  '</option>';
    return $output;
}


if (isset($_POST['btn_simpan'])) {

    $product_id = array();
    $product_name = array();
    $jumlah = array();

    foreach ($_POST['product_id'] as $pid) {
        $productDetails = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = $pid");
        $productDetails->execute();
        $result = $productDetails->fetchAll();

        $product_id[] = $result[0]['product_id'];
        $product_name[] = $result[0]['product_name'];
        $jumlah[] = $result[0]['jumlah'];
    }

    $product_id = implode(",", $product_id);
    $product_name = implode(",", $product_name);
    $jumlah = implode(",", $jumlah);

    $quantity = $_POST['quantity'];
    $arr_total = $_POST['total'];
    $tarikh_bayar = date('Y-m-d', strtotime($_POST['tarikh_bayar']));
    $expired = date("Y-m-d", strtotime(date("Y-m-d", strtotime($tarikh_bayar)) . " + 365 day"));
    //die($expired);
    $total = $_POST['total'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $invoice_no = $_POST['invoice_no'];
    $p_method = $_POST['p_method'];
    $status_id = $_POST['status_id'];
    $stat = $_POST['stat'];

    if ($kariah_umur == null) {
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
    } elseif ($alamat == null) {
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
    } elseif ($kawasan == null) {
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
    } else {
        $kariah_id = $pdo->lastInsertId();
        if ($kariah_id != null) {

            $insert = $pdo->prepare("INSERT INTO khairat_kematian(kariah_id, product_id, jumlah, quantity, tarikh_bayar, expired, total, paid, due, invoice_no, p_method, status_id, stat)
                VALUES(:kariah_id, :product_id, :jumlah, :quantity, :tarikh_bayar, :expired, :total, :paid, :due, :invoice_no, :p_method, :status_id, 0)");

            $insert->bindParam(':kariah_id', $id);
            $insert->bindParam(':product_id', $product_id);
            //$insert->bindParam(':product_name', $product_name);
            $insert->bindParam(':jumlah', $jumlah);
            $insert->bindParam(':quantity', $quantity);
            $insert->bindParam(':tarikh_bayar', $tarikh_bayar);
            $insert->bindParam(':expired', $expired);
            $insert->bindParam(':total', $total);
            $insert->bindParam(':paid', $paid);
            $insert->bindParam(':due', $due);
            $insert->bindParam(':invoice_no', $invoice_no);
            $insert->bindParam(':p_method', $p_method);
            $insert->bindParam(':status_id', $status_id);

            if ($insert->execute()) {
                echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Berjaya Bayar",
                            icon: "success",
                            button: "Ok",
                        }).then(function() {
                            window.location = "/khairat/admin/senarai-khairat-kematian";
                        });
                    });
                    </script>';

                $sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar', tarikh_expired = '$expired', status_sms = 2 WHERE kariah_id = $id ";
                $update = $pdo->prepare($sql);
                if (!$update->execute()) {
                    print_r($update->errorInfo());
                }
                $update->execute();
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
        }
    }



    $activity = "{$kariah_name} berjaya membayar {$product_name}";
    $time_loged = date("Y-m-d H:i:s", strtotime("now"));
    $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
    $stmt->bindParam(1, $_SESSION['user_id']);
    $stmt->bindParam(2, $activity);
    $stmt->bindParam(3, $time_loged);
    $stmt->execute();
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
                                <input type="hidden" name="status_id" class="form-control" placeholder="" value="1" />
                                <td style="display:none;">
                                </td>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Ahli</label>
                                            <div class="input-group">
                                                <input type="text" name="kariah_name" class="form-control" style="text-transform: uppercase" value="<?php echo $kariah_name; ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td>
                                    <label>Pilih Yuran</label>
                                    <select name="product_id[]" style="width: 250px" class="form-control productid" multiple required="" oninvalid="this.setCustomValidity('Pilih Yuran')" oninput="setCustomValidity('')">
                                        <?php
                                        echo fill_product($pdo);
                                        ?>
                                    </select>
                                </td>
                                <td><input type="hidden" name="jumlah" class="form-control jumlah" placeholder="" readonly /></td>
                                <td><input type="hidden" name="quantity" class="form-control quantity" placeholder="" /></td>
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
                                                <input type="number" name="paid" class="form-control" id="paid" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan jumlah')" oninput="setCustomValidity('')" />
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
                                            <div class="input-group date" data-target-input="nearest">
                                                <div class="input-group-append" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="tarikh_bayar" id="tarikh_bayar" required="" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>No Resit Pembayaran</label>
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

                                <input type="hidden" name="p_method" class="form-control" placeholder="" value="Tunai" />
                                <input type="hidden" name="stat" class="form-control" />

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
                                    <li>Pastikan anda telah mengemaskini maklumat terlebih dahulu sebelum membuat pembayaran</li><br>
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
                        <table id="" class="table table">
                            <thead>
                                <tr>
                                    <th>Yuran</th>
                                    <th>Status</th>
                                    <th>Bayar</th>
                                    <th>Baki</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $allbayaran = array();
                                $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_ASSOC);

                                $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
                                $select->execute();
                                $row = $select->fetchAll();
                                foreach ($row as $bayaran) {
                                    $pid = explode(',', $bayaran['product_id']);
                                    $allbayaran = array_merge($allbayaran, $pid);
                                }

                                $select33 = $pdo->prepare("SELECT * FROM tbl_product");
                                $select33->execute();
                                $row33 = $select33->fetchAll();

                                foreach ($row33 as $product) {
                                    $selectKK =  $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.product_id = " . $product['product_id'] . " AND khairat_kematian.kariah_id = " . $id);
                                    $selectKK->execute();
                                    $KK = $selectKK->fetch(PDO::FETCH_ASSOC);
                                    if (in_array($product['product_id'], $allbayaran)) {
                                        echo '<tr>
                                        <td style="font-size:88%;">' . $product['product_name'] . '</td>
                                        <td style="font-size:88%;"><span class="badge bg-success">' . 'Sudah Dibayar' . '</td>
                                        <td style="font-size:88%;">RM ' . number_format($product['jumlah'], 2) . '</td>
                                        <td style="font-size:88%;">RM ' . number_format($KK['due'], 2) . '</td>

                                         <tr>';
                                    } else {
                                        echo '<tr>
                                        <td style="font-size:88%;">' . $product['product_name'] . '</td>
                                        <td style="font-size:88%;"><span class="badge bg-danger">' . 'Tertunggak' . '</td>
                                        <td style="font-size:88%;">RM ' . number_format($KK['due'], 2) . '</td>
                                        <td style="font-size:88%;">RM ' . number_format($product['jumlah'], 2) . '</td>

                                     <tr>';
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
    // $(function() {
    //     $("#reservationdate").datetimepicker({
    //         format: "L",
    //     });
    // });

    $(document).ready(function() {
        $("#tarikh_bayar").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
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
            //var productid = this.value;
            var productid = $(".productid").val();

            var tr = $(this).parent().parent();
            $.ajax({
                url: "/khairat/admin/getproduct.php",
                method: "get",
                data: {
                    id: productid
                },
                success: function(data) {
                    tr.find(".pname").val(data["product_name"]);
                    tr.find(".jumlah").val(data["jumlah"]);
                    tr.find(".quantity").val(1);
                    tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah").val());
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
            calculate(paid);
        })
    });
</script>

<?php
include_once 'footer.php';
?>