<?php
include_once 'admin/database/connect.php';
// session_start();
if ($_SESSION['kariah_ic'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

function displayYuranName($products, $pdo)
{
    include_once 'admin/database/connect.php';
    $string = [];
    $array = explode(",", $products);

    $clause = implode(',', array_fill(0, count($array), '?'));
    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id IN ($clause)");
    $stmt->execute($array);
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        $string[] = $row['product_name'];
    }

    return implode(", ", $string);
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
                            <h3 class="card-title">Penyata Bayaran</h3>
                        </div> <br>

                        <div style="overflow-x: auto;">
                            <table id="producttable" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th class="d-md-none d-sm-table-cell" style="font-size:90%;">Butiran</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Jenis Yuran</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Tarikh Bayar</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Jumlah</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Telah Bayar</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Baki</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Kaedah Bayaran</th>
                                        <th class="d-none d-md-table-cell" style="font-size:90%;">Cetak</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.*
                                     FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id = 1 AND khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                    $select->execute();
                                    while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                    ?>

                                        <tr>
                                            <td class="d-md-none d-sm-table-cell">
                                                <br>
                                                <dl class="row">
                                                    <dt class="col-sm-8">Jenis Yuran</dt>
                                                    <dd class="col-sm-8"><?php echo displayYuranName($row->product_id, $pdo) ?></dd>
                                                    <dt class="col-sm-4">Tarikh Bayar</dt>
                                                    <dd class="col-sm-4"><?php echo date('d-m-Y', strtotime($row->tarikh_bayar)) ?></dd>
                                                    <dt class="col-sm-8">Kaedah Bayaran</dt>
                                                    <?php
                                                    if ($row->p_method == "Tunai") {
                                                        echo '<dd class="col-sm-8"><span class="badge bg-success" style="color:White">' . $row->p_method . '</span></dd>';
                                                    } else {
                                                        echo '<dd class="col-sm-8"><span class="badge bg-info" style="color:White">' . $row->p_method . '</span></dd>';
                                                    }
                                                    ?>

                                                    <dt class="col-sm-8">Jumlah</dt>
                                                    <dd class="col-sm-8">RM <?php echo number_format($row->total, 2) ?></dd>
                                                    <dt class="col-sm-8">Telah Bayar</dt>
                                                    <dd class="col-sm-8">RM <?php echo number_format($row->paid, 2) ?></dd>
                                                    <dt class="col-sm-8">Baki</dt>
                                                    <dd class="col-sm-8">RM <?php echo number_format($row->due, 2) ?></dd>
                                                    <dt class="col-sm-8">Cetak</dt>
                                                    <dt class="col-sm-4">
                                                        <a href="penyata-khairat.php?khairat_id=<?php echo $row->khairat_id ?>" class="btn btn-xs btn-warning" target="_blank">
                                                            <span class="fas fa-print"></span><br>
                                                        </a>
                                                    </dt>
                                                </dl>
                                            </td>

                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo displayYuranName($row->product_id, $pdo) ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_bayar)) ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;">RM <?php echo number_format($row->total, 2) ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;">RM <?php echo number_format($row->paid, 2) ?></td>
                                            <td class="d-none d-md-table-cell" style="font-size:87%;">RM <?php echo number_format($row->due, 2) ?></td>


                                            <?php

                                            if ($row->p_method == "Tunai") {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-success">' . $row->p_method . '</span></td>';
                                            } else {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-info">' . $row->p_method . '</span></td>';
                                            }
                                            ?>

                                            <td class="d-none d-md-table-cell">
                                                <a href="penyata-khairat.php?khairat_id=<?php echo $row->khairat_id ?>" class="btn btn-sm btn-warning" target="_blank">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            </td>

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