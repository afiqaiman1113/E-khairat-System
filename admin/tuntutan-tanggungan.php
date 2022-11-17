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
                            <h3 class="card-title">Tuntutan tanggungan yang meninggal dunia</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;" width="22%">Si Mati</th>
                                            <th style="font-size:90%;">Tarikh Mati</th>
                                            <th style="font-size:90%;">Tarikh Tuntut</th>
                                            <th style="font-size:90%;">Waris</th>
                                            <th style="font-size:90%;">Hubungan</th>
                                            <th style="font-size:90%;">Jumlah Dituntut</th>
                                            <th style="font-size:90%;">Status Tuntutan</th>
                                            <th style="font-size:90%;">Pilihan</th>
                                            <!-- <th style="font-size:90%;">Semak</th>
                                            <th style="font-size:90%;">Pindah Hak Milik Keahlian</th>
                                            <th style="font-size:90%;">Status Pemindahan</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM tuntut_tanggungan INNER JOIN ahli_kariah ON tuntut_tanggungan.kariah_id = ahli_kariah.kariah_id ORDER BY tid_tanggung DESC ");

                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        ?>

                                            <tr>
                                                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->nama ?></td>
                                                <td style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_mati)); ?></td>
                                                <td style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_tuntut)) ?></td>
                                                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->kariah_name ?></td>
                                                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->t_tanggunghubungan ?></td>
                                                <td style="font-size:87%;">RM <?php echo number_format($row->jumlah, 2) ?></td>
                                                <?php
                                                if ($row->status == "Berjaya") {
                                                    echo '<td><span class="badge bg-success">Berjaya</span></td>';
                                                } elseif ($row->status == "Dalam Proses") {
                                                    echo '<td><span class="badge bg-warning">Dalam Proses</span></td>';
                                                } else {
                                                    echo '<td><span class="badge bg-danger">Gagal</span></td>';
                                                }
                                                ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            Lanjut
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a href="#edit_<?php echo $row->tid_tanggung; ?>" class="dropdown-item view_data" data-toggle="modal"><span class="fa fa-eye text-dark"></span> Lihat</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item view_data" href="semak-tuntutan-tanggungan.php?tid_tanggung=<?php echo $row->tid_tanggung; ?>"><span class="fa fa-edit text-primary"></span> Kemaskini Tuntutan</a>
                                                            <div class="dropdown-divider"></div>
                                                            <?php
                                                            if ($row->status == "Berjaya") {
                                                            } else {
                                                            ?>
                                                                <a class="dropdown-item edit_data" href="sms-refund.php?tid_tanggung=<?php echo $row->tid_tanggung; ?>"><span class="fas fa-check text-success"></span> Wang Dikreditkan </a>
                                                                <div class="dropdown-divider"></div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($row->status == "Gagal") {
                                                            } else {
                                                            ?>
                                                                <a class="dropdown-item edit_data" href="sms-failed.php?tid_tanggung=<?php echo $row->tid_tanggung; ?>"><span class="fas fa-window-close text-danger"></span> Tuntutan Gagal </a>
                                                                <div class="dropdown-divider"></div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($row->status == "Dalam Proses" || $row->status == "Gagal") {
                                                            } else {
                                                            ?>
                                                                <a class="dropdown-item edit_data" target="_blank" href="penyata-tuntutan-tanggungan.php?tid_tanggung=<?php echo $row->tid_tanggung; ?>"><span class="fas fa-print text-warning"></span> Cetak</a>
                                                                <div class="dropdown-divider"></div>
                                                            <?php
                                                            }

                                                            ?>

                                                            <button type="button" id=<?php echo $row->tid_tanggung; ?> class="dropdown-item edit_data btndelete"><span class="fas fa-trash text-danger"></span> Padam</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php include('view_tuntutan_tanggungan.php'); ?>

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

    $(document).ready(function() {
        $('.btndelete').on('click', function() {
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
    });
</script>

<?php
include_once 'footer.php';
?>