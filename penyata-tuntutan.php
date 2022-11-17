<?php
include_once 'admin/database/connect.php';
// session_start();
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Penyata Tuntutan Kematian</h3>
                        </div> <br>

                        <div style="overflow-x: auto;">
                            <table id="producttable" class="table">
                                <thead>
                                    <tr>
                                        <th class="d-md-none d-sm-table-cell" style="font-size:90%;">Butiran</th>

                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Si Mati</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Tarikh Mati</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Tarikh Tuntut</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Kariah</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Penuntut</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Jumlah Dituntut</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Status Pindah Ahli</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Status Tuntutan</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Cetak</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                    $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tuntut ON ahli_kariah.kariah_id = tuntut.kariah_id INNER JOIN penama ON penama.kariah_id = tuntut.kariah_id  WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                    $select->execute();
                                    while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                    ?>

                                        <tr>
                                            <td class="d-md-none d-sm-table-cell">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <br><b>Si Mati: <?php echo $row->tuntut_name ?> </b><br><br> <b>Tarikh Mati: <?php echo date('d-m-Y', strtotime($row->tarikh_mati)) ?></b><br><br><b>Tarikh Tuntut: <?php echo date('d-m-Y', strtotime($row->tarikh_tuntut)) ?></b><br><br><b>Penuntut: <?php echo $row->penuntut ?><br><br><b>Jumlah Dituntut: RM <?php echo number_format($row->jumlah, 2) ?><br><br> Status Pindah Ahli: <?php echo $row->pindah_milik ?><br><br> Status Tuntutan: <?php echo $row->status_tuntut ?>
                                                    </div>
                                                    <?php
                                                    if ($row->status_tuntut == "Dalam Proses") {
                                                    } elseif ($row->status_tuntut == "Gagal") {
                                                    } else {
                                                    ?>
                                                        <div class="col">
                                                            <div class="text-center"><br>
                                                                <a href="penyata-khairat.php?kariah_id=<?php echo $row->kariah_id ?>" class="btn btn-xs btn-warning" target="_blank">
                                                                    <span class="fas fa-print"></span><br>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div><br>
                                            </td>

                                            <td class="d-none d-md-table-cell" style="font-size:87%;" width="15%"><span style="text-transform:uppercase"><?php echo $row->tuntut_name ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_mati)) ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_tuntut)) ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo $row->kawasan ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><span style="text-transform:uppercase" width="13%"><?php echo $row->penama_name ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;">RM <?php echo number_format($row->jumlah, 2) ?></td>


                                            <!-- <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->total, 2) . '</td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->paid, 2) . '</td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->due, 2) . '</td> -->

                                            <?php
                                            if ($row->pindah_milik == "Selesai") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-success">Selesai</span></td>';
                                            } else {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-danger">Belum</span></td>';
                                            }

                                            if ($row->status_tuntut == "Berjaya") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-success">Berjaya</span></td>';
                                            } elseif ($row->status_tuntut == "Dalam Proses") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-warning">Dalam Proses</span></td>';
                                            } else {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-danger">Gagal</span></td>';
                                            }
                                            ?>

                                            <?php
                                            if ($row->status_tuntut == "Dalam Proses") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-warning">Dalam Proses</span></td>';
                                            } elseif ($row->status_tuntut == "Gagal") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-danger">Gagal</span></td>';
                                            } else {
                                            ?>
                                                <td class="d-none d-md-table-cell">
                                                    <a href="tuntutan.php?kariah_id=<?php echo $row->kariah_id ?>" class="btn btn-xs btn-warning" target="_blank">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </td>

                                            <?php
                                            }
                                            ?>



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
    </section>

</div>

<script>
    $(document).ready(function() {

        $('#producttable').DataTable({
            "order": [
                [0, "asc"]
            ],

            pageLength: 2,
            lengthMenu: [
                [2],
                [2]
            ],
        });

        // $('#producttable').DataTable({
        //     pageLength: 5,
        //     lengthMenu: [
        //         [5, 10, 20, -1],
        //         [5, 10, 20, 'Todos']
        //     ]
        // })

    });
</script>

<?php
// include_once 'footer.php';
?>