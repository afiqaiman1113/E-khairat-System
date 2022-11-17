<?php
include_once 'admin/database/connect.php';
// session_start();
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

function test($pdo)
{
    //$id = $_GET['kariah_id'];
    $output = '';
    // $select = $pdo->prepare("SELECT product_id, product_name FROM khairat_kematian WHERE kariah_id = $id");
    $select = $pdo->prepare("SELECT * FROM tuntut_tanggungan INNER JOIN ahli_kariah ON tuntut_tanggungan.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);

    if ($row->status == 1) {
        $output .= 'Berjaya';
    } elseif ($row->status == 2) {
        $output .= 'Dalam Proses';
    } else {
        $output .= 'Belum';
    }


    // if ($row->status == 1) {
    //     echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-success">Berjaya</span></td>';
    // } elseif ($row->status == 2) {
    //     echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-warning">Dalam Proses</span></td>';
    // } else {
    //     echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-info">Belum</span></td>';
    // }

    // $output .= '<option>' . "Tunggak " .  '</option>';

    return $output;
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
                            <h3 class="card-title">Penyata Tuntutan Kematian Tanggungan</h3>
                        </div> <br>

                        <div style="overflow-x: auto;">
                            <table id="producttable" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th class="d-md-none d-sm-table-cell" style="font-size:90%;">Butiran</th>

                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Si Mati</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Tarikh Mati</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Tarikh Tuntut</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Waris</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Hubungan</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Jumlah Dituntut</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Status Tuntutan</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Cetak</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                    //$select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tuntut ON ahli_kariah.kariah_id = tuntut.kariah_id WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                    $select = $pdo->prepare("SELECT * FROM tuntut_tanggungan INNER JOIN ahli_kariah ON tuntut_tanggungan.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                    $select->execute();
                                    while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                    ?>

                                        <tr>
                                            <td class="d-md-none d-sm-table-cell">
                                                <br>
                                                <dl class="row">
                                                    <dt class="col-sm-8">Si Mati</dt>
                                                    <dd class="col-sm-8"><span style="text-transform:uppercase"><?php echo $row->nama ?></dd>
                                                    <dt class="col-sm-4">Tarikh Mati</dt>
                                                    <dd class="col-sm-4"><?php echo date('d-m-Y', strtotime($row->tarikh_mati)) ?></dd>
                                                    <dt class="col-sm-4">Tarikh Tuntut</dt>
                                                    <dd class="col-sm-4"><?php echo date('d-m-Y', strtotime($row->tarikh_tuntut)) ?></dd>
                                                    <dt class="col-sm-8">Waris</dt>
                                                    <dd class="col-sm-8"><span style="text-transform:uppercase"><?php echo $row->kariah_name ?></dd>
                                                    <dt class="col-sm-8">Jumlah Tuntutan</dt>
                                                    <dd class="col-sm-8">RM <?php echo number_format($row->jumlah, 2) ?></dd>
                                                    <dt class="col-sm-8">Status Tuntutan</dt>
                                                    <?php
                                                    if ($row->status == "Berjaya") {
                                                        echo '<dd class="col-sm-8 text-white"><span class="badge bg-success">Berjaya</span></dd>';
                                                    } elseif ($row->status == "Dalam Proses") {
                                                        echo '<dd class="col-sm-8 text-white"><span class="badge bg-warning">Dalam Proses</span></dd>';
                                                    } else {
                                                        echo '<dd class="col-sm-8 text-white"><span class="badge bg-danger">Gagal</span></dd>';
                                                    }
                                                    ?>
                                                    <dt class="col-sm-8">Cetak Resit</dt>
                                                    <?php
                                                    if ($row->status == "Dalam Proses") {
                                                        echo '<dd class="col-sm-8 text-white"><span class="badge bg-warning">Dalam Proses</span></dd>';
                                                    } elseif ($row->status == "Gagal") {
                                                        echo '<dd class="col-sm-8 text-white"><span class="badge bg-danger">Gagal</span></dd>';
                                                    } else {
                                                    ?>
                                                        <dt class="col-sm-4">
                                                            <a href="penyata.php?tid_tanggung=<?php echo $row->tid_tanggung ?>" class="btn btn-xs btn-warning" target="_blank">
                                                                <span class="fas fa-print"></span><br>
                                                            </a>
                                                        </dt>
                                                    <?php
                                                    }
                                                    ?>
                                                </dl>
                                            </td>

                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->nama ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_mati)) ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_tuntut)) ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->kariah_name ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->t_tanggunghubungan ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;">RM <?php echo number_format($row->jumlah, 2) ?></td>


                                            <!-- <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->total, 2) . '</td>
                                        <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->paid, 2) . '</td>
                                        <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->due, 2) . '</td> -->
                                            <?php
                                            if ($row->status == "Berjaya") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-success">Berjaya</span></td>';
                                            } elseif ($row->status == "Dalam Proses") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-warning">Dalam Proses</span></td>';
                                            } else {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-danger">Gagal</span></td>';
                                            }
                                            ?>
                                            <?php
                                            if ($row->status == "Dalam Proses") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-warning">Dalam Proses</span></td>';
                                            } elseif ($row->status == "Gagal") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-danger">Gagal</span></td>';
                                            } else {
                                            ?>
                                                <td class="d-none d-md-table-cell">
                                                    <a href="penyata.php?tid_tanggung=<?php echo $row->tid_tanggung ?>" class="btn btn-xs btn-warning" target="_blank">
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
                [0, "desc"]
            ],

            pageLength: 2,
            lengthMenu: [
                [2],
                [2]
            ],

            "lengthChange": false,
            "bInfo": false
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