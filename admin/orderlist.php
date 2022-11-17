<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}
if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Order List</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer Name</th>
                                            <th>Order Date</th>
                                            <th>Jumlah</th>
                                            <th>Telah Bayar</th>
                                            <th>Baki</th>
                                            <th>Cara Bayar</th>
                                            <th>Invoice</th>
                                            <th>Edit</th>
                                            <th>Padam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM tbl_invoice ORDER BY invoice_id DESC");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                            <tr>
                                            <td>' . $i . '</td>
                                            <td>' . $row->customer_name . '</td>
                                            <td>' . date('d-m-Y', strtotime($row->order_date)) . '</td>
                                            <td>' . $row->total . '</td>
                                            <td>' . $row->paid . '</td>
                                            <td>' . $row->due . '</td>
                                            <td>' . $row->payment_method . '</td>
                                            <td>
                                                <a href="invoice_db.php?invoice_id=' . $row->invoice_id . '" class="btn btn-sm btn-warning" target="_blank">
                                                <i class="fas fa-print"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="editorder.php?invoice_id=' . $row->invoice_id . '" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" id=' . $row->invoice_id . ' class="btn btn-sm btn-danger btndelete"><span class="fas fa-trash"></button>
                                            </td>
                                            </tr>
                                            ';
                                            $i++;
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    $(document).ready(function() {
        $('#producttable').DataTable({
            "order": [
                [0, "asc"]
            ] //tutorial tu kata dia akan table dalam desc order
        });
    });

    $(document).ready(function() {
        $('.btndelete').on('click', function() {
            var tdh = $(this);
            var id = $(this).attr("id");

            swal({
                    title: "Are you sure?",
                    // text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'orderdelete.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr').hide();
                            }
                        })
                        swal("Delete Successful", {
                            icon: "success",
                        });
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                });
        });
    });
</script>

<?php
include_once 'footer.php';
?>