<?php
include_once 'database/connect.php';
error_reporting(0);
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
include_once 'header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekod Transaksi Yuran</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">From : <?php echo date('d-m-Y', strtotime($_POST['date1'])) ?> -- To : <?php echo date('d-m-Y', strtotime($_POST['date2'])) ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="penyata.php" method="POST" name="">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="date" name="date1" id="date1" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="date" name="date2" id="date2" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div align="left">
                                                <input type="submit" name="btn_date_filter" value="Carian" class="btn btn-success">
                                            </div>
                                        </div>
                                        <a href="penyata.php?from=date1&to=date2" class="btn btn-sm btn-warning" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>

                                    </div>
                                </div><br>

                                <?php
                                $select = $pdo->prepare("SELECT sum(paid) as paid, sum(due) as due, count(kariah_id) as kariah_id FROM khairat_kematian WHERE tarikh_bayar between :fromdate AND :todate");
                                $select->bindParam(':fromdate', $_POST['date1']);
                                $select->bindParam(':todate', $_POST['date2']);
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_OBJ);
                                $paid = $row->paid; //total, stotal, invoice tu ambik dari line 63. AS AS tu
                                $due = $row->due;
                                $kariah_id = $row->kariah_id;
                                ?>

                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Jumlah Transaksi</span>
                                                <span class="info-box-number"><?php echo $kariah_id; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix hidden-md-up"></div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Jumlah Bayaran</span>
                                                <span class="info-box-number"><?php echo "RM " . number_format($paid, 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Jumlah Baki</span>
                                                <span class="info-box-number"><?php echo "RM " . number_format($due, 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="overflow-x: auto;">
                                    <table id="salesreporttable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="font-size:90%;">No</th>
                                                <th style="font-size:90%;">No Ahli</th>
                                                <th style="font-size:90%;">Nama</th>
                                                <th style="font-size:90%;">No K/P</th>
                                                <th style="font-size:90%;">Kariah</th>
                                                <th style="font-size:90%;">Tarikh Bayar</th>
                                                <th style="font-size:90%;">Jumlah</th>
                                                <th style="font-size:90%;">Telah Bayar</th>
                                                <th style="font-size:90%;">Baki</th>
                                                <th style="font-size:90%;">Jenis Bayaran</th>
                                                <th style="font-size:90%;">Cara Bayar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php
                                            $select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE tarikh_bayar between :fromdate AND :todate");
                                            $select->bindParam(':fromdate', $_POST['date1']);
                                            $select->bindParam(':todate', $_POST['date2']);
                                            $select->execute();
                                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                                echo '
                                        <tr>
                                        <td>' . $i . '</td>
                                        <td style="font-size:87%;">' . $row->no_ahli . '</td>
                                        <td style="font-size:87%;">' . $row->khairat_name . '</td>
                                        <td style="font-size:87%;">' . $row->khairat_ic . '</td>
                                        <td style="font-size:87%;">' . $row->kawasan . '</td>
                                        <td style="font-size:87%;">' . date('d-m-Y', strtotime($row->tarikh_bayar)) . '</td>

                                        ';

                                                echo '
                                        <td style="font-size:87%;">' . number_format($row->total, 2) . '</td>
                                        <td style="font-size:87%;">' . number_format($row->paid, 2) . '</td>
                                        <td style="font-size:87%;">' . number_format($row->due, 2) . '</td>
                                        <td style="font-size:87%;">' . $row->product_name . '</td>
                                        ';

                                                if ($row->p_method == "CASH") {
                                                    echo '<td><span class="badge bg-success">' . $row->p_method . '</span></td>';
                                                } else {
                                                    echo '<td><span class="badge bg-info">' . $row->p_method . '</span></td>';
                                                }

                                                $i++;
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    $(document).ready(function() {
        $('#salesreporttable').DataTable({
            "order": [
                [0, "asc"]
            ] //tutorial tu kata dia akan table dalam desc order
        });
    });

    // $(function() {
    //     $("#datepicker1").datetimepicker({
    //         format: "L",
    //     });
    // });

    // $(function() {
    //     $("#datepicker2").datetimepicker({
    //         format: "L",
    //     });
    // });
</script>

<?php
include_once 'footer.php';
?>