<?php
include_once 'database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$id = $_GET['khairat_id'];
//$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id = $id");
//latest komen bwh ni
//$select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.* FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE khairat_id = $id ");
$select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.* FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE khairat_id = $id");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

$khairat_id = $row['khairat_id'];
$kariah_id = $row['kariah_id'];
$kariah_name = $row['kariah_name'];
$product_id = $row['product_id'];
$product_name = $row['product_name'];
$jumlah = $row['jumlah'];
$quantity = $row['quantity'];
$tarikh_bayar = $row['tarikh_bayar'];
$total = $row['total'];
$paid = $row['paid'];
$due = $row['due'];
$invoice_no = $row['invoice_no'];

//latest komen bwh
//$select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.* FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE khairat_id = $id ");
$select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.* FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE khairat_id = $id");
$select->execute();
$row_invoice_details = $select->fetchAll(PDO::FETCH_ASSOC);

function fill_product($pdo, $product_id)
{
    $output = '';
    $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["product_id"] . '"';
        if ($product_id == $row['product_id']) {
            $output .= 'selected';
        }
        $output .= '>' . $row["product_name"] . '</option>';
    }
    return $output;
}

function displayYuranName($products, $pdo)
{
    include_once 'database/connect.php';
    $string = [];
    $array = explode(",", $products);

    $clause = implode(',', array_fill(0, count($array), '?'));
    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id IN ($clause)");
    $stmt->execute($array);
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        $string[] = $row['product_name'];
    }

    return implode(", ", $string);
}

function fill($pdo)
{
    $output = '';
    $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
    }
    return $output;
}

//setting
function test($pdo)
{
    $id = $_GET['khairat_id'];
    $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id = $id");

    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    $kariah_id = $row['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT product_id, product_name FROM khairat_kematian WHERE khairat_kematian.kariah_id = $kariah_id ");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        if ($row) {
            $output .= '<option value="' . $row["product_id"] . '">' . " Berjaya" .  '</option>';
        } else {
            $output .= '<option value="' . $row["product_id"] . '">' . "Tunggak " .  '</option>';
        }
    }
    return $output;
}

function jumlah($pdo)
{

    $id = $_GET['khairat_id'];
    $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id = $id");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    $kariah_id = $row['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT kariah_id, paid FROM khairat_kematian WHERE khairat_kematian.kariah_id = $kariah_id");
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

    $id = $_GET['khairat_id'];
    $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id = $id");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    $kariah_id = $row['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT kariah_id, due FROM khairat_kematian WHERE khairat_kematian.kariah_id = $kariah_id ");
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


if (isset($_POST['btn_update_kariah'])) {

    $product_name = $_POST['product_name'];
    //$jumlah = $_POST['jumlah'];
    $quantity = $_POST['quantity'];
    $arr_total = $_POST['total'];
    $tarikh_bayar = date('Y-m-d', strtotime($_POST['tarikh_bayar']));
    $expired = date("Y-m-d", strtotime(date("Y-m-d", strtotime($tarikh_bayar)) . " + 365 day"));
    $total = $_POST['total'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $invoice_no = $_POST['invoice_no'];

    $update_kariah = $pdo->prepare("UPDATE khairat_kematian SET quantity=:quantity, tarikh_bayar=:tarikh_bayar, expired=:expired, total=:total, paid=:paid, due=:due, invoice_no=:invoice_no WHERE khairat_id = $id ");

    //$update_kariah->bindParam(':jumlah', $jumlah);
    $update_kariah->bindParam(':quantity', $quantity);
    $update_kariah->bindParam(':tarikh_bayar', $tarikh_bayar);
    $update_kariah->bindParam(':expired', $expired);
    $update_kariah->bindParam(':total', $total);
    $update_kariah->bindParam(':paid', $paid);
    $update_kariah->bindParam(':due', $due);
    $update_kariah->bindParam(':invoice_no', $invoice_no);

    if ($update_kariah->execute()) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kemaskini Berjaya",
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
                        title: "Kemaskini Gagal",
                        icon: "error",
                        button: "Ok",
                      });
                });
                </script>';
    }
    $activity = "Bayaran {$product_name} dari {$kariah_name} berjaya dikemaskini";
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
                <div class="col-md-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Semakan Bayaran Khairat Kematian</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jenis Bayaran</label>
                                            <div class="input-group">
                                                <input type="text" name="product_name" class="form-control pname" value="<?php echo displayYuranName($row['product_id'], $pdo) ?>" placeholder="" readonly />

                                                <input type="hidden" name="quantity" class="form-control quantity" value="<?php echo $row['quantity']; ?>" placeholder="" readonly />
                                                <input type="hidden" name="total" class="form-control total" value="<?php echo $row['total']; ?>" placeholder="" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <input type="text" name="total" class="form-control" id="total" value="<?php echo number_format($total , 2); ?>" placeholder="" readonly />
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
                                                <input type="number" name="paid" class="form-control" id="paid" value="<?php echo number_format($paid, 2); ?>" placeholder="" required />
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
                                                <input type="text" name="due" class="form-control" id="due" value="<?php echo number_format($due, 2); ?>" placeholder="" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Pembayaran</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="tarikh_bayar" id="tarikh_bayar" value="<?php echo date('d-m-Y', strtotime($tarikh_bayar)); ?>" required="" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>No Invois</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="invoice_no" class="form-control" value="<?php echo $invoice_no; ?>" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div align="center">
                                    <input type="submit" name="btn_update_kariah" value="Kemaskini Bayaran" class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
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
                </div>
            </div>
    </section>
</div>

<script>
    $(function() {
        $("#reservationdate").datetimepicker({
            format: "L",
        });
    });

    $(document).ready(function() {
        $("#tarikh_bayar").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    });

    $(document).ready(function() {

        $('.productidedit').select2()
        $('.productidedit').select2({
            theme: 'bootstrap4'
        })
        $('.productidedit').on('change', function(e) {
            var productid = this.value;
            var tr = $(this).parent().parent();
            $.ajax({
                url: "getproduct.php",
                method: "get",
                data: {
                    id: productid
                },
                success: function(data) {
                    tr.find(".pname").val(data["product_name"]);
                    tr.find(".jumlah").val(data["total"]);
                    tr.find(".quantity").val(1);
                    tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah").val());
                    calculate(0, 0);
                    $("#paid").val("");
                }
            })
        })

        $(document).on('click', '.btnremove', function() {
            $(this).closest('tr').remove();
            calculate(0, 0);
            $("#paid").val("");
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