<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
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
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Senarai Penama</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">No</th>
                                            <th style="font-size:90%;">Penama</th>
                                            <!-- <th style="font-size:90%;">No K/P</th> -->
                                            <th style="font-size:90%;">Ahli Kariah</th>
                                            <th style="font-size:90%;">Kawasan Ahli Kariah</th>
                                            <th style="font-size:90%;">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id ORDER BY penama_id DESC ");
                                        $select->execute();

                                        // function status_bayaran($pdo)
                                        // {
                                        //     $output = '';
                                        //     $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 ORDER BY khairat_id DESC ");
                                        //     $select->execute();
                                        //     $row = $select->fetch(PDO::FETCH_OBJ);
                                        //         if (strtotime(date("d-m-Y")) < strtotime($row->expired)) {
                                        //             echo '<td><span class="badge bg-success">' . "Active" . '</span></td>';
                                        //         } else {
                                        //             echo '<td><span class="badge bg-danger">' . "Expired" . '</span></td>';
                                        //         }

                                        // }

                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->penama_name; ?></td>
                                                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->kariah_name; ?></td>
                                                <td style="font-size:87%;"><?php echo $row->kawasan; ?></td>


                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            Lanjut
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a href="#view<?php echo $row->penama_id; ?>" class="dropdown-item view_data" data-toggle="modal"><span class="fa fa-eye text-dark"></span> Lihat Butiran</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="#edi_<?php echo $row->penama_id; ?>" class="dropdown-item view_data" data-toggle="modal"><span class="fa fa-edit text-primary"></span> Kemaskini</a>
                                                            <div class="dropdown-divider"></div>
                                                            <button type="button" id=<?php echo $row->penama_id; ?> class="dropdown-item edit_data btndelete"><span class="fas fa-trash text-danger"></span> Padam</button>
                                                        </div>
                                                    </div>
                                                </td>

                                                <?php include('view_details_penama.php'); ?>

                                            <?php
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
        $('#producttable').on('click', '.btndelete', function() {
            var tdh = $(this);
            var id = $(this).attr("id");

            swal({
                    title: "Anda Pasti?",
                    // text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'penamadelete.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr').hide();
                            }
                        })
                        swal("Berjaya padam", {
                            icon: "success",
                        });
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                });
        });
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
</script>

<?php
include_once 'footer.php';
?>