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
                            <h3 class="card-title">Tuntutan ahli kariah yang meninggal dunia</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th style="font-size:90%;">No Ahli</th> -->
                                            <th style="font-size:90%;" width="15%">Si Mati</th>
                                            <!-- <th style="font-size:90%;">No K/P</th> -->
                                            <th style="font-size:90%;">Kariah</th>
                                            <th style="font-size:90%;">Tarikh Meninggal</th>
                                            <th style="font-size:90%;">Tarikh Tuntut</th>
                                            <th style="font-size:90%;" width="13%">Si Penuntut</th>
                                            <th style="font-size:90%;">Jumlah Dituntut</th>
                                            <th style="font-size:90%;">Status Tuntutan</th>
                                            <th style="font-size:90%;">Status Pindah Milik</th>
                                            <!-- <th style="font-size:90%;">Pindah Hak Milik Ahli</th> -->
                                            <th style="font-size:90%;">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tuntut ON ahli_kariah.kariah_id = tuntut.kariah_id INNER JOIN penama ON penama.kariah_id = tuntut.kariah_id ORDER BY tuntut_id DESC");

                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        ?>
                                            <tr>
                                                <!-- <td style="font-size:87%;"><?php //echo $row->no_ahli;
                                                                                ?></td> -->
                                                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->tuntut_name; ?></td>

                                                <td style="font-size:87%;"><?php echo $row->kawasan; ?></td>
                                                <td style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_mati)); ?></td>
                                                <td style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_tuntut)); ?></td>
                                                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->penama_name; ?></td>
                                                <td style="font-size:87%;">RM <?php echo number_format($row->jumlah, 2); ?></td>
                                                <?php
                                                if ($row->status_tuntut == "Gagal") {
                                                    echo '<td><span class="badge bg-danger">Gagal</span></td>';
                                                } elseif ($row->status_tuntut == "Dalam Proses") {
                                                    echo '<td><span class="badge bg-warning">Dalam Proses</span></td>';
                                                } else {
                                                    echo '<td><span class="badge bg-success">Berjaya</span></td>';
                                                }

                                                if ($row->pindah_milik == "Selesai") {
                                                    echo '<td><span class="badge bg-success">Selesai Dipindahkan</span></td>';
                                                } else {
                                                    echo '<td><span class="badge bg-danger">Belum Dipindahkan</span></td>';
                                                }
                                                ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            Lanjut
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a href="#edit_<?php echo $row->tuntut_id; ?>" class="dropdown-item view_data" data-toggle="modal"><span class="fa fa-eye text-dark"></span> Lihat</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item view_data" href="semak-tuntutan.php?tuntut_id=<?php echo $row->tuntut_id; ?>"><span class="fa fa-edit text-primary"></span> Kemaskini Tuntutan</a>
                                                            <div class="dropdown-divider"></div>
                                                            <?php
                                                            if ($row->status_tuntut == "Berjaya") {
                                                            } else {
                                                            ?>
                                                                <a class="dropdown-item edit_data" href="refund.php?tuntut_id=<?php echo $row->tuntut_id; ?>"><span class="fas fa-check text-success"></span> Wang Dikreditkan </a>
                                                                <div class="dropdown-divider"></div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($row->status_tuntut == "Gagal") {
                                                            } else {
                                                            ?>
                                                                <a class="dropdown-item edit_data" href="failed.php?tuntut_id=<?php echo $row->tuntut_id; ?>"><span class="fas fa-window-close text-danger"></span> Tuntutan Gagal </a>
                                                                <div class="dropdown-divider"></div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($row->status_tuntut == "Dalam Proses" || $row->status_tuntut == "Gagal") {
                                                            } else {
                                                            ?>
                                                                <a class="dropdown-item edit_data" target="_blank" href="penyata-tuntutan.php?kariah_id=<?php echo $row->kariah_id; ?>"><span class="fas fa-print text-warning"></span> Cetak</a>
                                                                <div class="dropdown-divider"></div>

                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($row->pindah_milik == "Selesai" || $row->status_tuntut == "Dalam Proses" || $row->status_tuntut == "Gagal") {
                                                            } else {
                                                            ?>
                                                                <a class="dropdown-item edit_data" href="pindah-ahli.php?kariah_id=<?php echo $row->kariah_id; ?>"><span class="fas fa-exchange-alt text-primary"></span> Pindah Hak Milik Ahli</a>
                                                                <div class="dropdown-divider"></div>

                                                            <?php
                                                            }
                                                            ?>

                                                            <button type="button" id=<?php echo $row->tuntut_id; ?> class="dropdown-item edit_data btndelete"><span class="fas fa-trash text-danger"></span> Padam</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php include('view_tuntutan_kematian.php'); ?>
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
                [0, "desc"]
            ] //tutorial tu kata dia akan table dalam desc order
        });
    });



    $(document).on('click', '.btndelete', function() {
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
                        url: 'tuntutan-delete.php',
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
</script>

<?php
include_once 'footer.php';
?>