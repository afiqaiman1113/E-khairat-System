<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
error_reporting(0);
include_once 'header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Graph Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
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
                            <h3 class="card-title">From : <?php echo $_POST['date1'] ?> -- To : <?php echo $_POST['date2'] ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="date" name="date1" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="date" name="date2" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div align="left">
                                                <input type="submit" name="btn_date_filter" value="Filter by date" class="btn btn-success">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $select = $pdo->prepare("SELECT order_date, sum(total) as price FROM tbl_invoice WHERE order_date between :fromdate AND :todate group by order_date");
                                    $select->bindParam(':fromdate', $_POST['date1']);
                                    $select->bindParam(':todate', $_POST['date2']);
                                    $select->execute();
                                    $total = [];
                                    $date = [];
                                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                            extract($row);
                                            $total[] = $price;
                                            $date[] = $order_date;
                                        }
                                // echo json_encode($total);
                                ?>
                                <div class="chart">
                                    <canvas id="myChart" style="position: relative; height:23vh; width:30vw"></canvas>
                                </div>

                                <?php
                                //$select = $pdo->prepare("SELECT product_name, sum(quantity) as quantity FROM tbl_invoice_details WHERE order_date between :fromdate AND :todate group by product_id");
                                //$select->bindParam(':fromdate', $_POST['date1']);
                                // $select->bindParam(':todate', $_POST['date2']);
                                // $select->execute();
                                // $product_name = [];
                                // $quantity = [];
                                // while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                //     extract($row);
                                //     $product_name[] = $product_name;
                                //     $quantity[] = $quantity;
                                // }
                                // echo json_encode($total);
                                ?>
                                <!-- <div class="chart">
                                    <canvas id="bestsellingproduct" style="position: relative; height:23vh; width:30vw"></canvas>
                                </div> -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($date); ?>,
            datasets: [{
                label: 'Total Earnings',
                backgroundColor: 'rgb(255, 99, 13)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php echo json_encode($total); ?>,
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
</script>

<?php
include_once 'footer.php';
?>