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
                            <h3 class="card-title">Ahli Kariah Yang Belum Mendaftar Khairat Kematian</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">No Ahli</th>
                                            <th style="font-size:90%;">Nama</th>
                                            <th style="font-size:90%;">No K/P</th>
                                            <th style="font-size:90%;">Kariah</th>
                                            <th style="font-size:90%;">Status Khairat Kematian</th>
                                            <th style="font-size:90%;">Pilihan</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE approvement = 'Belum Daftar' ");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        ?>

                                            <tr>
                                                <td style="font-size:90%;"><?php echo $row->no_ahli; ?></td>
                                                <td style="font-size:90%;"><span style="text-transform:uppercase"><?php echo $row->kariah_name; ?></td>
                                                <td style="font-size:90%;"><?php echo $row->kariah_ic; ?></td>
                                                <td style="font-size:90%;"><?php echo $row->kawasan; ?></td>

                                                <?php

                                                if ($row->approvement == "Telah Daftar") {
                                                    echo '<td><span class="badge bg-success">' . $row->approvement . '</span></td>';
                                                } elseif ($row->approvement == "Digantung") {
                                                    echo '<td><span class="badge bg-warning">' . $row->approvement . '</span></td>';
                                                } else {
                                                    echo '<td><span class="badge bg-info">' . $row->approvement . '</span></td>';
                                                }
                                                ?>


                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            Lanjut
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a class="dropdown-item view_data" href="semak-ahli-kariah.php?kariah_id=<?php echo $row->kariah_id; ?>"><span class="fa fa-eye text-dark"></span> Semak</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item edit_data" href="bayar-tunai-najmi.php?kariah_id=<?php echo $row->kariah_id; ?>"><span class="fa fa-money-bill"></span> Bayar Tunai</a>
                                                            <div class="dropdown-divider"></div>
                                                            <button type="button" id=<?php echo $row->kariah_id; ?> class="dropdown-item edit_data btndelete"><span class="fas fa-trash text-danger"></span> Padam</button>
                                                        </div>
                                                    </div>
                                                </td>
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
                [0, "dsc"]
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
                            url: 'kariahdelete.php',
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
        $('.btnstatus').on('click', function() {
            var tdh = $(this);
            var id = $(this).attr("id");

            swal({
                    title: "Lulus ahli?",
                    // text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'kariahapprove.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr').hide();
                            }
                        })
                        swal("Berjaya", {
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