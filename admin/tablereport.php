<?php
include_once 'database/connect.php';
error_reporting(0);
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
include_once 'header.php';

function displayYuranName($products, $pdo)
{
    include_once 'database/connect.php';
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

<!-- <input type="date"> -->
<!-- <head> -->
<!-- Required meta tags -->
<!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

<!-- Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

<!-- Datepicker -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

<!-- Datatables -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" /> -->
<!-- </head> -->

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
                            <h3 class="card-title">Rekod</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                                <!-- <input type="text" class="form-control" name="date1" id="date1" placeholder="Start Date" readonly required> -->
                                                <input type="date" name="date1" id="date1" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                                <!-- <input type="text" class="form-control" name="date2" id="date2" placeholder="End Date" readonly required> -->
                                                <input type="date" name="date2" id="date2" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div align="left">
                                                <input type="submit" name="btn_date_filter" value="Cari" id="filter" class="btn btn-success">
                                                <button id="reset" class="btn btn-info">Reset</button>
                                            </div>
                                        </div>

                                    </div>
                                </div><br>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div align="left">
                                            <a class="btn btn-danger" id="generateReportBtn" target="_blank"><i class="fa fa-download"></i> Rekod Yang Ditapis</a>
                                            <a href="penyata.php" class="btn btn-warning" target="_blank"><i class="fa fa-file-pdf"></i> Semua Rekod</a>
                                            <a id="generateExcel" class="btn btn-warning" target="_blank"><i class="fa fa-file-excel"></i> Export Excel</a>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $select = $pdo->prepare("SELECT sum(paid) as paid, sum(due) as due, count(kariah_id) as kariah_id FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE tarikh_bayar.khairat_kematian AND status_id = 1 BETWEEN :fromdate AND :todate ");
                                // $select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE tarikh_bayar.khairat_kematian AND status_id = 1 BETWEEN :fromdate AND :todate");
                                //$select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE tarikh_bayar BETWEEN :fromdate AND :todate ");
                                //$select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE khairat_id = $id ");
                                $select->bindParam(':fromdate', $_POST['date1']);
                                $select->bindParam(':todate', $_POST['date2']);
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_OBJ);
                                $paid = $row->paid; //total, stotal, invoice tu ambik dari line 63. AS AS tu
                                $due = $row->due;
                                $kariah_id = $row->kariah_id;
                                ?>

                                <!-- <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Jumlah Transaksi</span>
                                                <span class="info-box-number"><?php //echo $kariah_id;
                                                                                ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix hidden-md-up"></div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Jumlah Bayaran</span>
                                                <span class="info-box-number"><?php //echo "RM " . number_format($paid, 2);
                                                                                ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Jumlah Baki</span>
                                                <span class="info-box-number"><?php //echo "RM " . number_format($due, 2);
                                                                                ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- Table -->
                                <div class="overflow-x: auto;">
                                    <table class="table table-striped" id="salesreporttable" style="width:100%">
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
                                                <th style="font-size:90%;">Bayaran</th>
                                                <th style="font-size:90%;">Cara Bayar</th>
                                                <!-- <th style="font-size:90%;">Total</th> -->
                                            </tr>
                                        </thead>
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


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<!-- Datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Datatables -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>
<!-- Momentjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script>
    // $(document).ready(function() {
    //     $('#salesreporttable').DataTable({
    //         "order": [
    //             [0, "asc"]
    //         ] //tutorial tu kata dia akan table dalam desc order
    //     });
    // });

    // $(function() {
    //     $("#date1").datepicker({
    //         "dateFormat": "yy-mm-dd",
    //         changeMonth: true,
    //         changeYear: true
    //     });
    //     $("#date2").datepicker({
    //         "dateFormat": "yy-mm-dd",
    //         changeMonth: true,
    //         changeYear: true
    //     });

    // });
</script>

<script>
    // Fetch records
    function fetch(date1, date2) {
        $.ajax({
            url: "records.php",
            type: "POST",
            data: {
                date1: date1,
                date2: date2
            },
            dataType: "json",
            success: function(data) {
                // Datatables
                var i = "1";

                $('#salesreporttable').DataTable({
                    "data": data,
                    // buttons
                    // "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    //     "<'row'<'col-sm-12'tr>>" +
                    //     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    // "buttons": [
                    //     'excel', 'pdf', 'print'
                    // ],
                    // responsive
                    "responsive": true,
                    "columns": [{
                            "data": 1,
                            "render": function(data, type, row, meta) {
                                return i++;
                            }
                        },
                        {
                            "data": "no_ahli",
                            "render": function(data, type, row, meta) {
                                return data;
                            }
                        },
                        {
                            "data": "kariah_name",
                            "render": function(data, type, row, meta) {
                                return data.toUpperCase();
                            }
                        },
                        {
                            "data": "kariah_ic",
                            "render": function(data, type, row, meta) {
                                return data;
                            }
                        },
                        {
                            "data": "kawasan"
                        },
                        {
                            "data": "tarikh_bayar",
                            "render": function(data, type, row, meta) {
                                return moment.utc(data).local().format('DD-MM-YYYY');
                            }
                        },
                        {
                            "data": "total",
                            "render": function(data, type, row, meta) {
                                // return `RM ${data}`;
                                return `RM ${parseFloat(data).toFixed(2)}`;
                            }
                        },
                        {
                            "data": "paid",
                            "render": function(data, type, row, meta) {
                                return `RM ${parseFloat(data).toFixed(2)}`;
                            }
                        },
                        {
                            "data": "due",
                            "render": function(data, type, row, meta) {
                                return `RM ${parseFloat(data).toFixed(2)}`;
                            }
                        },
                        {
                            "data": "product_name"
                            // "render": function(data, type, row, meta) {
                            //     return `${row.product_name}`;
                            // }
                        },
                        {
                            "data": "p_method"
                        },
                        // {
                        //     "data": "paid",

                        // },
                    ]
                });
            }
        });
    }
    fetch();

    // Filter
    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var date1 = $("#date1").val();
        var date2 = $("#date2").val();

        if (date1 == "" || date2 == "") {
            alert("Sila pilih tarikh dahulu");
        } else {
            $('#salesreporttable').DataTable().destroy();
            fetch(date1, date2);
        }
    });

    $(document).on("click", "#generateReportBtn", function(e) {
        e.preventDefault();

        var date1 = $("#date1").val();
        var date2 = $("#date2").val();

        if (date1 == "" || date2 == "") {
            jQuery(function validation() {
                swal({
                    title: "Pilih tarikh dahulu",
                    icon: "warning",
                    button: "Ok",
                });
            });
        } else {

            $.ajax({
                url: 'penyata.php',
                type: 'POST',
                data: {
                    date1: date1,
                    date2: date2
                },
                success: function(data) {
                    //window.open("penyata.php");
                    window.open('penyata.php?date1=' + $('#date1').val() + '&date2=' + $('#date2').val(), '_blank');
                    //onclick="location.href='penyata.php?date1='+$('#date1').val()+'&date2='+$('#date2').val() "
                }
            });


        }
    });

    $(document).on("click", "#generateExcel", function(e) {
        e.preventDefault();

        var date1 = $("#date1").val();
        var date2 = $("#date2").val();

        if (date1 == "" || date2 == "") {
            //alert("Sila pilih tarikh dahulu");
            jQuery(function validation() {
                swal({
                    title: "Pilih tarikh dahulu",
                    icon: "warning",
                    button: "Ok",
                });
            });
        } else {

            $.ajax({
                url: 'penyata_excel.php',
                type: 'POST',
                data: {
                    date1: date1,
                    date2: date2
                },
                success: function(data) {
                    //window.open("penyata.php");
                    window.location.href = 'penyata_excel.php?date1=' + $('#date1').val() + '&date2=' + $('#date2').val();
                    //onclick="location.href='penyata.php?date1='+$('#date1').val()+'&date2='+$('#date2').val() "
                }
            });


        }
    });

    // Reset
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#date1").val(''); // empty value
        $("#date2").val('');

        $('#salesreporttable').DataTable().destroy();
        fetch();
    });
</script>

<script src="report.js"></script>

<?php
include_once 'footer.php';
?>