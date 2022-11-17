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
                            <h3 class="card-title">Senarai Log Aktiviti</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Pengguna</th>
                                            <th>Aktiviti</th>
                                            <th>Masa</th>
                                            <!-- <th>Lihat</th> -->
                                            <!-- <th>Semak</th>
                                            <th>Padam</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $select = $pdo->prepare("SELECT * FROM logs INNER JOIN tbl_user ON logs.user_id = tbl_user.user_id ORDER BY log_id DESC");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            $date = new DateTime($row->time_loged);
                                        ?>
                                            <tr>
                                                <td><?php echo $row->username; ?></td>
                                                <td><?php echo $row->activity; ?></td>
                                                <td><?php echo $date->format('h:i A / d-m-Y') ?></td>
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
            ]
        });
    });
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