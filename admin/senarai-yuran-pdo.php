<?php
include_once 'database/connect.php';
session_start();

if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';
?>

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
                                    <!-- <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Tambah</a> -->
                                    <button class="btn btn-primary" data-target="#addnew" data-toggle="modal">Tambah Yuran</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="tableCategories" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">No</th>
                                            <th style="font-size:90%;">Nama Yuran</th>
                                            <th style="font-size:90%;">Jumlah</th>
                                            <th style="font-size:90%;">Tahun</th>
                                            <!-- <th style="font-size:90%;">Status</th> -->
                                            <th style="font-size:90%;">Action</th>
                                            <!-- <th style="font-size:90%;">Delete</th> -->
                                            <!-- <th>Semak</th>
                                            <th>Padam</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>


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

<?php include('edit_modal.php'); ?>
<?php include('update_modal.php'); ?>

<script>
    $(document).ready(function() {
        $('.view_data').click(function() {
            uni_modal("Lihat Yuran", "view_yuran.php?product_id=" + $(this).attr('data-id'));
        })
    })
</script>

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