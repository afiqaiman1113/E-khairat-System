<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

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

$id = $_GET['invoice_id'];
$select = $pdo->prepare("SELECT * FROM tbl_invoice WHERE invoice_id = $id");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

$customer_name = $row['customer_name'];
$order_date = date('Y-m-d', strtotime($row['order_date']));
// $sub_total = $row['sub_total'];
// $tax = $row['tax'];
// $discount = $row['discount'];
$total = $row['total'];
$paid = $row['paid'];
$due = $row['due'];
$payment_method = $row['payment_method'];

$select = $pdo->prepare("SELECT * FROM tbl_invoice_details WHERE invoice_id = $id");
$select->execute();

$row_invoice_details = $select->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['btn_update_order'])) {

    $customer_name = $_POST['customer_name'];
    $order_date = date('Y-m-d', strtotime($_POST['order_date']));
    // $sub_total = $_POST['sub_total'];
    // $tax = $_POST['tax'];
    // $discount = $_POST['discount'];
    $total = $_POST['total'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $payment_method = $_POST['payment_method'];

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    // $stock = $_POST['stock'];
    $jumlah = $_POST['jumlah'];
    $quantity = $_POST['quantity'];
    $arr_total = $_POST['total'];

    // foreach ($row_invoice_details as $item_invoice_details) {
    //     $updateproduct = $pdo->prepare("UPDATE tbl_product SET product_stock = product_stock+" . $item_invoice_details['quantity'] . " WHERE product_id='" . $item_invoice_details['product_id'] . "' ");
    //     $updateproduct->execute();
    // }

    $delete_invoice_details = $pdo->prepare("DELETE FROM tbl_invoice_details WHERE invoice_id = $id");
    $delete_invoice_details->execute();

    $update_invoice = $pdo->prepare("UPDATE tbl_invoice SET customer_name=:customer_name, order_date=:order_date, total=:total, paid=:paid, due=:due, payment_method=:payment_method WHERE invoice_id = $id ");

    $update_invoice->bindParam(':customer_name', $customer_name);
    $update_invoice->bindParam(':order_date', $order_date);
    // $update_invoice->bindParam(':sub_total', $sub_total);
    // $update_invoice->bindParam(':tax', $tax);
    // $update_invoice->bindParam(':discount', $discount);
    $update_invoice->bindParam(':total', $total);
    $update_invoice->bindParam(':paid', $paid);
    $update_invoice->bindParam(':due', $due);
    $update_invoice->bindParam(':payment_method', $payment_method);

    $update_invoice->execute();

    $invoice_id = $pdo->lastInsertId();
    if ($invoice_id != null) {
        for ($i = 0; $i < count($product_id); $i++) {

            $insert = $pdo->prepare("INSERT INTO tbl_invoice_details(invoice_id, product_id, product_name, jumlah, quantity, order_date)
            VALUES(:invoice_id, :product_id, :product_name, :jumlah, :quantity, :order_date)");

            $insert->bindParam(':invoice_id', $id);
            $insert->bindParam(':product_id', $product_id[$i]);
            $insert->bindParam(':product_name', $product_name[$i]);
            $insert->bindParam(':jumlah', $jumlah[$i]);
            $insert->bindParam(':quantity', $quantity[$i]);
            $insert->bindParam(':order_date', $order_date);

            $insert->execute();
        }
        header('location:orderlist.php');
    }
}

if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Advanced Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Edit Order</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" name="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div class="input-group">
                                        <input type="date" name="order_date" value="<?php echo $order_date; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div style="overflow-x: auto;">
                                    <table id="producttable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">#</th>
                                                <th>Search Product</th> -->
                        <!-- <th>Stock</th> -->
                        <!-- <th>Jumlah</th>
                                                <th>Enter Quantity</th>
                                                <th>Total</th>
                                                <th> -->
                        <!-- <center><button type="button" name="btn_add" class="btn btn-info btn-sm btnadd">Add</button></center>
                                                </th>
                                            </tr>
                                        </thead>


                                    </table>
                                </div>
                            </div>
                        </div> -->

                        <div class="row">
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sub Total</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="sub_total" class="form-control" id="sub_total" value="<?php //echo $sub_total;
                                                                                                                        ?>" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tax (5%)</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="tax" class="form-control" id="tax" value="<?php //echo $tax;
                                                                                                            ?>" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Discount</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="discount" class="form-control" id="discount" value="<?php //echo $discount;
                                                                                                                        ?>" required />
                                    </div>
                                </div>
                            </div> -->


                            <div class="col-md-6">
                                <?php
                                foreach ($row_invoice_details as $item_invoice_details) {
                                    $select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = '{$item_invoice_details['product_id']}' ");
                                    $select->execute();

                                    $row_product = $select->fetch(PDO::FETCH_ASSOC);

                                    // $select2 = $pdo->prepare("SELECT * FROM tbl_invoice");
                                    // $select2->execute();
                                    // $row_invoice = $select2->fetch(PDO::FETCH_ASSOC);
                                ?>

                                    <tr>
                                        <?php
                                        echo '<td style="display: none;"><input type="hidden" name="product_name[]" class="form-control pname" placeholder="" value="' . $row_product['product_name'] . '" readonly/></td>';
                                        echo '<td><select name="product_id[]" style="width: 250px" class="form-control productidedit"><option value="">Select Option</option>' . fill_product($pdo, $item_invoice_details['product_id']) . '</select></td>';

                                        // echo '<td><input type="text" name="stock[]" class="form-control stock" placeholder="" value="' . $row_product['product_stock'] . '" readonly/></td>';
                                        echo '<td><input type="hidden" name="jumlah[]" class="form-control jumlah" placeholder="" value="' . $row_product['jumlah'] . '" readonly/></td>';
                                        echo '<td><input type="hidden" name="quantity[]" class="form-control quantity" placeholder="" value="' . $item_invoice_details['quantity'] . '" /></td>';
                                        echo '<td><input type="hidden" name="total[]" class="form-control total" placeholder="" value="' . $row_product['jumlah'] . '" readonly/></td>';
                                        // echo '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove">Remove</button></center></td>';

                                        ?>
                                    </tr>

                                <?php } ?>
                                <div class="form-group">
                                    <label>Total</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="total" class="form-control" id="total" value="<?php echo $total; ?>" readonly required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Paid</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="paid" class="form-control" id="paid" value="<?php echo $paid; ?>" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Due</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="due" class="form-control" id="due" value="<?php echo $due; ?>" readonly />
                                    </div>
                                </div>
                                <label>Payment Method</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="payment_method" value="CASH" <?php echo ($payment_method == 'CASH') ? 'checked' : '' ?>>
                                        <label for="radioPrimary1">CASH</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="payment_method" value="CARD" <?php echo ($payment_method == 'CARD') ? 'checked' : '' ?>>
                                        <label for="radioPrimary2">CARD</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" name="payment_method" value="CHECK" <?php echo ($payment_method == 'CHECK') ? 'checked' : '' ?>>
                                        <label for="radioPrimary3">CHECK</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div align="center">
                            <input type="submit" name="btn_update_order" value="Update Order" class="btn btn-warning">
                        </div>
                    </form>
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
                    tr.find(".jumlah").val(data["jumlah"]);
                    tr.find(".quantity").val(1);
                    tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah").val());
                    calculate(0, 0);
                    $("#paid").val("");
                }
            })
        })

        // $(document).on('click', '.btnadd', function() {
        //     var html = '';
        //     html += '<tr>';

        //     html += '<td style="display: none;"><input type="hidden" name="product_name[]" class="form-control pname" placeholder="" readonly/></td>';
        //     html += '<td><select name="product_id[]" style="width: 250px" class="form-control productid"><option value="">Select Option</option><?php echo fill_product($pdo, ''); ?></select></td>';
        //     html += '<td><input type="text" name="jumlah[]" class="form-control jumlah" placeholder="" readonly/></td>';
        //     html += '<td><input type="text" name="quantity[]" class="form-control quantity" placeholder="" /></td>';
        //     html += '<td><input type="text" name="total[]" class="form-control total" placeholder="" readonly/></td>';
        //     html += '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove">Remove</button></center></td>';

        //     $('#producttable').append(html);
        //     $('.productid').select2()
        //     $('.productid').select2({
        //         theme: 'bootstrap4'
        //     })
        //     $('.productid').on('change', function(e) {
        //         var productid = this.value;
        //         var tr = $(this).parent().parent();
        //         $.ajax({
        //             url: "getproduct.php",
        //             method: "get",
        //             data: {
        //                 id: productid
        //             },
        //             success: function(data) {
        //                 tr.find(".pname").val(data["product_name"]);
        //                 // tr.find(".stock").val(data["product_stock"]); //product_stock ni dari column di table database
        //                 tr.find(".jumlah").val(data["jumlah"]);
        //                 tr.find(".quantity").val(1);
        //                 tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah").val());
        //                 calculate(0, 0);
        //                 $("#paid").val("");
        //             }
        //         })
        //     })
        // })

        $(document).on('click', '.btnremove', function() {
            $(this).closest('tr').remove();
            calculate(0, 0);
            // $("#paid").val(0);
            $("#paid").val("");
        })

        // $("#producttable").delegate(".quantity", "keyup", function() {
        //     var quantity = $(this);
        //     var tr = $(this).parent().parent();
        //     $("#paid").val("");
        //     if ((quantity.val() - 0) > (tr.find(".stock").val() - 0)) {
        //         swal("WARNING!", "Sorry! This much of quantity is not available", "warning");
        //         quantity.val(1);
        //         tr.find(".total").val(quantity.val() * tr.find(".price").val());
        //         calculate(0, 0);
        //     } else {
        //         tr.find(".total").val(quantity.val() * tr.find(".price").val());
        //         calculate(0, 0);
        //     }
        // })

        function calculate(paid) {
            var net_total = 0;
            var paid_amount = paid;
            var due = 0;

            $(".total").each(function() {
                net_total = net_total + ($(this).val() * 1);
            })

            // tax = 0.05 * subtotal;

            net_total = net_total;

            // net_total = net_total - discount;

            due = net_total - paid_amount;

            // $("#sub_total").val(subtotal.toFixed(2)); //2 ni adalah 0.00 (2 digit value kt blkng) . Cth: sub total : 12.00

            // $("#tax").val(tax.toFixed(2));

            $("#total").val(net_total.toFixed(2));

            // $("#discount").val(discount);

            $("#due").val(due.toFixed(2));
        }

        // $("#discount").keyup(function() {
        //     var discount = $(this).val();
        //     calculate(discount, 0);
        // })

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