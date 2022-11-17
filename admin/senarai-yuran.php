<?php
include_once 'database/connect.php';
session_start();

if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Senarai Yuran</h3>
                        </div> <br>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div align="left">
                                    <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">Nama Yuran</th>
                                            <th style="font-size:90%;">Tahun</th>
                                            <th style="font-size:90%;">Jumlah</th>
                                            <th style="font-size:90%;">Pilihan</th>
                                            <!-- <th>Semak</th>
                                            <th>Padam</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_id DESC");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        ?>
                                            <tr>
                                                <td style="font-size:87%;"><?php echo $row->product_name; ?></td>
                                                <td style="font-size:87%;"><?php echo $row->tahun; ?></td>
                                                <td style="font-size:87%;">RM <?php echo number_format($row->jumlah, 2); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        Lanjut
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a href="#edit_<?php echo $row->product_id; ?>" class="dropdown-item view_data" data-toggle="modal"><span class="fa fa-eye text-dark"></span> Lihat</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#edi_<?php echo $row->product_id; ?>" class="dropdown-item view_data" data-toggle="modal"><span class="fa fa-edit text-primary"></span> Kemaskini</a>
                                                        <div class="dropdown-divider"></div>
                                                        <!-- <a class="dropdown-item edit_data" href="semak-yuran.php?product_id=<?php //echo $row->product_id;
                                                                                                                                    ?>" data-id=""><span class="fa fa-edit text-primary"></span> Semak Yuran</a>
                                                        <div class="dropdown-divider"></div> -->
                                                        <button type="button" id=<?php echo $row->product_id; ?> class="dropdown-item edit_data btndelete"><span class="fas fa-trash text-danger"></span> Padam</button>
                                                    </div>
                                                </td>
                                                <?php include('edit_modal.php'); ?>
                                            </tr>
                                        <?php
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
        $('.view_data').click(function() {
            uni_modal("Lihat Yuran", "view_yuran.php?product_id=" + $(this).attr('data-id'));
        })
    })
</script>

<!-- <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/jquery/jquery.min.js"></script> -->

<script>
    $(document).ready(function() {
        $('.btndelete').on('click', function() {
            var tdh = $(this);
            var id = $(this).attr("id");

            swal({
                    title: "Padam Yuran?",
                    // text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'productdelete.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr').hide();
                            }
                        })
                        swal("Berjaya Padam", {
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