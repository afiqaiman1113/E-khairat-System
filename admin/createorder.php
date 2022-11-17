<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}
//create function untuk direcall pada jquery script di bawah sekali. Fungsi function ini utk echo semua product name dari database
function fill_product($pdo)
{
    $output = '';
    $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
    $select->execute();
    $result = $select->fetchAll();
    //foreach mmg penting tau. Untuk loop semua nama product
    foreach ($result as $row) {
        //dia akan fetch product id dan product name
        $output .= '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
    }
    return $output; //then return balik value tadi kat sini
}

if (isset($_POST['btn_save_order'])) {

    $customer_name = $_POST['customer_name'];
    $order_date = date('Y-m-d', strtotime($_POST['order_date']));
    // $sub_total = $_POST['sub_total'];
    // $tax = $_POST['tax'];
    // $discount = $_POST['discount'];
    $total = $_POST['total'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $payment_method = $_POST['payment_method'];

    //bwh ni pulak utk masuk dekat tbl_invoice_details
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    // $stock = $_POST['stock'];
    $jumlah = $_POST['jumlah'];
    $quantity = $_POST['quantity'];
    $arr_total = $_POST['total'];

    $insert = $pdo->prepare("INSERT INTO tbl_invoice(customer_name, order_date, total, paid, due, payment_method)
    VALUES(:customer_name, :order_date, :total, :paid, :due, :payment_method)");

    $insert->bindParam(':customer_name', $customer_name);
    $insert->bindParam(':order_date', $order_date);
    // $insert->bindParam(':sub_total', $sub_total);
    // $insert->bindParam(':tax', $tax);
    // $insert->bindParam(':discount', $discount);
    $insert->bindParam(':total', $total);
    $insert->bindParam(':paid', $paid);
    $insert->bindParam(':due', $due);
    $insert->bindParam(':payment_method', $payment_method);

    $insert->execute();

    //second query utk save di tbl_invoice_details
    $invoice_id = $pdo->lastInsertId();
    if ($invoice_id != null) {
        // for ($i = 0; $i < count($product_id); $i++) {

        $insert = $pdo->prepare("INSERT INTO tbl_invoice_details(invoice_id, product_id, product_name, jumlah, quantity, order_date)
            VALUES(:invoice_id, :product_id, :product_name, :jumlah, :quantity, :order_date)");

        $insert->bindParam(':invoice_id', $invoice_id);
        $insert->bindParam(':product_id', $product_id);
        $insert->bindParam(':product_name', $product_name);
        $insert->bindParam(':jumlah', $jumlah);
        $insert->bindParam(':quantity', $quantity);
        $insert->bindParam(':order_date', $order_date);

        $insert->execute();
        // }
        // echo "Successful";
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
                    <h1>Create Order</h1>
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
                    <h3 class="card-title">New Order</h3>
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
                                        <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control datetimepicker-input" name="order_date" value="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd" data-target="#reservationdate">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="overflow-x: auto;">
                                    <table id="" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">#</th>
                                                <th>Search Product</th>
                                                <!-- <th>Stock</th> -->
                                                <th>Jumlah</th>
                                                <th>Enter Quantity</th>
                                                <th>Total</th>
                                                <th>
                                                    <center><button type="button" name="btn_add" class="btn btn-success btn-sm btnadd">Add</button></center>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label>Sub Total</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="sub_total" class="form-control" id="sub_total" placeholder="" readonly />
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
                                        <input type="text" name="tax" class="form-control" id="tax" placeholder="" readonly />
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
                                        <input type="text" name="discount" class="form-control" id="discount" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="total" class="form-control" id="total" placeholder="" readonly />
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
                                        <input type="number" name="paid" class="form-control" id="paid" placeholder="" required />
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
                                        <input type="text" name="due" class="form-control" id="due" placeholder="" readonly />
                                    </div>
                                </div>
                                <td style="display:none;"><input type="hidden" name="product_name" class="form-control pname" placeholder="" readonly /></td>
                                <td><select name="product_id" style="width: 250px" class="form-control productid">
                                        <option value="">Pilih Yuran</option><?php echo fill_product($pdo); ?>
                                    </select></td>
                                <td><input type="hidden" name="jumlah" class="form-control jumlah" placeholder="" readonly /></td>
                                <td><input type="hidden" name="quantity" class="form-control quantity" placeholder="" /></td>
                                <td><input type="hidden" name="total" class="form-control total" placeholder="" readonly /></td>
                                <label>Payment Method</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="payment_method" value="CASH" checked>
                                        <label for="radioPrimary1">CASH</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="payment_method" value="CARD">
                                        <label for="radioPrimary2">CARD</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" name="payment_method" value="CHECK">
                                        <label for="radioPrimary3">CHECK</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div align="center">
                            <input type="submit" name="btn_save_order" value="Save Order" class="btn btn-info">
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
        $(document).on('click', '.btnadd', function() { //btnadd tu, rujuk dekat button Add and akan nampak class dia
        var html = '';
        html += '<tr>';

        html += '<td style="display:none;"><input type="hidden" name="product_name[]" class="form-control pname" placeholder="" readonly/></td>';
        html += '<td><select name="product_id[]" style="width: 250px" class="form-control productid"><option value="" disabled selected>Sila Pilih</option><option value="Sendiri">Sendiri</option><option value="Sewa">Sewa</option></select></td>';

        //code di atas dimana kita dah recall semula function yg dicreate kat line atas sekali. So, ia akan display list of product name
        html += '<td><input type="text" name="stock[]" class="form-control stock" placeholder="" readonly/></td>';
        html += '<td><input type="text" name="jumlah[]" class="form-control jumlah" placeholder="" readonly/></td>';
        html += '<td><input type="text" name="quantity[]" class="form-control quantity" placeholder="" /></td>';
        html += '<td><input type="text" name="total[]" class="form-control total" placeholder="" readonly/></td>';
        html += '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove">Remove</button></center></td>';
        $('#producttable').append(html);
        //ni maksudnya jquery tu berlaku dlm table. So, producttable tu adalah id table. html dekat append tu, dia ambik html yg atas ni. Sbb tu bila click Add, akan display form dekat table

        //Initialize Select2 Elements. Err, means kegunaan dia bila hg nak select product, hg boleh search dlm tu, haha lebih kurg camtu la
        $('.productid').select2()
        $('.productid').select2({
            theme: 'bootstrap4'
        })
        //ajax implementation based on video 98
        $('.productid').on('change', function(e) {
            var productid = this.value;
            var tr = $(this).parent().parent();
            $.ajax({
                url: "getproduct.php",
                method: "get",
                data: {
                    id: productid
                }, //id itu akan dipass ke getproduct.php using GET method
                success: function(data) {
                    tr.find(".pname").val(data["product_name"]);
                    //find method di bwh ini dan stock,price apa semua ni based on name di line 213
                    // tr.find(".stock").val(data["product_stock"]); //product_stock ni dari column di table database
                    tr.find(".jumlah").val(data["jumlah"]);
                    tr.find(".quantity").val(1);
                    tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah").val());
                    calculate(0, 0); //pass parameter yg related dgn line 266 and 306, refer vid 103
                }
            })
        })
        // })

        // $(document).on('click', '.btnremove', function() {
        //     $(this).closest('tr').remove();
        //     calculate(0, 0);
        //     $("#paid").val(0);
        // })

        //recall id  <table> dan guna delegate method. Aku x fhm, so nanti tgk video 100 dia explain. Aku fedup part ni


        //function utk calculate, refer explaination di video 101
        function calculate(paid) { //utk reference mengenai 2 parameter dis and paid ni, tgk video 103, minit ke 3:02
            // var subtotal = 0;
            // var tax = 0;
            // var discount = dis;
            var net_total = 0;
            var paid_amount = paid;
            var due = 0;

            //total ni dari line 213
            $(".total").each(function() {
                //subtotal ini dtgnya dari var di line 267
                net_total = net_total + ($(this).val() * 1);
            })

            //formula for tax. tax ini direcall dari variable di line 268
            // tax = 0.05 * subtotal;

            //net_total direcall dari variable di line 270
            net_total = net_total;

            // net_total = net_total - discount;

            due = net_total - paid_amount;

            //recall id sub_total
            // $("#sub_total").val(subtotal.toFixed(2)); //2 ni adalah 0.00 (2 digit value kt blkng) . Cth: sub total : 12.00

            //calculation for tax and id tax yg direcall (#tax) dekat form atas line 113
            // $("#tax").val(tax.toFixed(2));

            //recall id total di area line 113. net_total tu direcall balik sbb net_call adalah formula
            $("#total").val(net_total.toFixed(2));

            // $("#discount").val(discount);

            $("#due").val(due.toFixed(2));
        }

        // $("#discount").keyup(function() {
        //     var discount = $(this).val();
        //     calculate(discount, 0); //sini dia letak 2 parameter dan parameter tu dipanggil di line 266, refer video 103
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