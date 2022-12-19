<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

if (isset($_SESSION['user_id'])) {
    if ((time() - $_SESSION['last_login_timestamp']) > 60) {
        header("location:logout.php");
    } else {
        $_SESSION['last_login_timestamp'] = time();
        echo "<h1 align='center'>" . $_SESSION["username"] . "</h1>";
        echo '<h1 align="center">' . $_SESSION['last_login_timestamp'] . '</h1>';
        echo "<p align='center'><a href='logout.php'>Logout</a></p>";
    }
} else {
    header('Location: index.php');
}

$select = $pdo->prepare("SELECT sum(jumlah) as jumlah, count(tid_tanggung) as tid_tanggung FROM tuntut_tanggungan WHERE status = 'Berjaya' ");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);
$tuntut_jumlah_tanggung = $row->jumlah;

$select = $pdo->prepare("SELECT sum(jumlah) as jumlah, count(kariah_id) as kariah_id FROM tuntut WHERE status_tuntut = 'Berjaya' ");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);
$total_jumlah = $row->jumlah; //based on berapa jumlah id
$total_semua = ($total_jumlah + $tuntut_jumlah_tanggung);

$select = $pdo->prepare("SELECT sum(paid) as paid, count(kariah_id) as kariah_id FROM khairat_kematian WHERE status_id = 1");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);
$net_total = $row->paid;
$net_total = $net_total - $total_semua;

$select = $pdo->prepare("SELECT MONTH(tarikh_bayar) as tarikh_bayar, YEAR(tarikh_bayar) as year, count(DISTINCT kariah_id) as kariah_id FROM khairat_kematian WHERE status_id = 1 AND tarikh_bayar >= DATE_FORMAT(NOW() - INTERVAL 12 MONTH, '%Y-%m-%d') GROUP BY YEAR(tarikh_bayar), MONTH(tarikh_bayar) ORDER BY 'Month' ASC"); //limit 12 bulan ja maksudnya
//$select = $pdo->prepare("SELECT MONTH(tarikh_bayar) as tarikh_bayar, YEAR(tarikh_bayar) as year, count(DISTINCT kariah_id) as kariah_id FROM khairat_kematian WHERE status_id = 1 group by MONTH(tarikh_bayar) LIMIT 12");
$select->execute();
$ttl = [];
$date = [];
while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $ttl[] = $kariah_id;
    $date[] = 'Bulan ' . $tarikh_bayar . ' / ' . $year;
}



// $select = $pdo->prepare("SELECT tarikh_daftar, count(khairat_id) as khairat_id FROM khairat_kematian WHERE status_id = 1 group by tarikh_daftar LIMIT 30");
// $select->execute();
// $ttl = [];
// $date = [];
// while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
//     extract($row);
//     $ttl[] = $khairat_id;
//     $date[] = date('d-m-Y', strtotime($tarikh_daftar));
// }

include_once 'header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Paparan Utama</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="tuntutan-kematian.php">
                                <h3><?php echo '<span style="color:White; font-size: 70%;">RM ' . number_format($total_semua, 2); ?></h3>
                                <p style="color:White">Jumlah Tuntutan</p>
                            </a>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <a href="tuntutan-kematian.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <a href="senarai-khairat-kematian.php">
                                <h3><?php echo '<span style="color:White; font-size: 70%;">RM ' . number_format($net_total, 2); ?></h3>
                                <p style="color:White">Jumlah Kutipan Yuran</p>
                            </a>
                        </div>
                        <div class="icon">
                            <i class="far fa-chart-bar"></i>
                        </div>
                        <a href="senarai-khairat-kematian.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <?php
                $select = $pdo->prepare("SELECT count(kariah_id) as kariah_id FROM ahli_kariah");
                $select->execute();
                $row = $select->fetch(PDO::FETCH_OBJ);

                $total_ahli = $row->kariah_id;
                ?>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <a href="ahli-kariah.php">
                                <h3><?php echo '<span style="color:Black; font-size: 70%;">' . $total_ahli; ?></h3>
                                <p style="color:Black">Ahli Kariah</p>
                            </a>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list-ul"></i>
                        </div>
                        <a href="ahli-kariah.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <?php
                $select = $pdo->prepare("SELECT count(tuntut_name) as tuntut_name FROM tuntut WHERE status_tuntut = 'Berjaya' ");
                $select->execute();
                $row = $select->fetch(PDO::FETCH_OBJ);
                $total_tuntut = $row->tuntut_name;
                ?>

                <?php
                $select = $pdo->prepare("SELECT count(nama) as nama FROM tuntut_tanggungan WHERE status = 'Berjaya' ");
                $select->execute();
                $row = $select->fetch(PDO::FETCH_OBJ);
                $total_tuntut_tanggung = $row->nama;

                $total_mati = $total_tuntut + $total_tuntut_tanggung;
                ?>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <a href="tuntutan-kematian.php">
                                <h3><?php echo '<span style="color:White; font-size: 70%;">' . $total_mati; ?></h3>
                                <p style="color:White">Jumlah Kematian</p>
                            </a>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="tuntutan-kematian.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Transaksi Khairat Kematian</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-md-6">
                    <div class="card card-">
                        <div class="card-header">
                            <h3 class="card-title">Best Selling Product</h3>
                        </div>
                        <div class="card-body">
                            <table id="bestsellingproductlist" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //$i = 1;
                                    ?>
                                    <?php
                                    // $select = $pdo->prepare("SELECT product_id, product_name, price, sum(quantity) as quantity, sum(quantity * price) as total FROM tbl_invoice_details group by product_id order by sum(quantity) DESC LIMIT 15");
                                    // $select->execute();
                                    // while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                    //     echo '
                                    //         <tr>
                                    //             <td>' . $i . '</td>
                                    //             <td>' . $row->product_name . '</td>
                                    //             <td>' . $row->quantity . '</td>
                                    //             <td>' . $row->price . '</td>
                                    //             <td>' . $row->total . '</td>
                                    //         </tr>
                                    //         ';
                                    //     $i++;
                                    // }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Terkini</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:87%;">No</th>
                                            <th style="font-size:87%;">Nama</th>
                                            <th style="font-size:87%;">Tarikh Bayar</th>
                                            <th style="font-size:87%;">Jumlah</th>
                                            <!-- <th style="font-size:87%;">Cara Bayar</th> -->
                                            <!-- <th style="font-size:87%;">Jenis Pembayaran</th> -->
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
<!-- /.content-wrapper -->

<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php
                    echo json_encode($date);

                    ?>,

            datasets: [{
                label: 'Jumlah Transaksi',
                backgroundColor: 'rgb(255, 99, 13)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php echo json_encode($ttl); ?>,
                // borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    // $(document).ready(function() {
    //     $('#bestsellingproductlist').DataTable({
    //         "order": [
    //             [0, "asc"]
    //         ] //tutorial tu kata dia akan table dalam desc order
    //     });
    // });

    <?php
    $nilai = 0;
    ?>

    $(document).ready(function() {
        var table = $('#producttable').DataTable({
            "order": [
                [0, ""]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "fetchDataUtama.php?nilai=<?= $nilai; ?>",

            "columnDefs": [{
                "targets": 3,
                "render": $.fn.dataTable.render.number(',', '.', '2', 'RM ')

            }, ]
        });
        table.on('draw.dt', function() {
            var info = table.page.info();
            table.column(0, {
                search: 'applied',
                order: 'applied',
                page: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
    });
</script>

<?php
include_once 'footer.php';
?>