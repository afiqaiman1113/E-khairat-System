<?php
include_once 'admin/database/connect.php';
session_start();
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

include_once 'header-test.php';

//error_reporting(0);

$status_id = $_GET['status_id'];
// $transaction_id = $_GET['transaction_id'];
// $billcode = $_GET['billcode'];
$order_id = $_GET['order_id'];

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id  = $order_id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$khairat_id = $row['khairat_id'];
$kariah_id = $row['kariah_id'];
$product_id = $row['product_id'];
$product_name = $row['product_name'];
$jumlah = $row['jumlah'];
$quantity = $row['quantity'];
// $status_id = $row['status_id'];
$tarikh_bayar = date('d-m-Y', strtotime($row['tarikh_bayar']));
$total = $row['total'];
$paid = $row['paid'];
$due = $row['due'];

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.khairat_id  = $order_id");
$select->execute();
$row_invoice_details = $select->fetchAll(PDO::FETCH_ASSOC);


// $update_kariah = $pdo->prepare("UPDATE khairat_kematian SET status_id=:status_id WHERE khairat_id = $order_id");

// $update_kariah->bindParam(':status_id', $status_id);

// $update_kariah->execute();

// if ($status_id == 1) {
//     $sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar' WHERE kariah_id = $kariah_id ";
//     $update = $pdo->prepare($sql);
//     $update->execute();
//     echo '<script type="text/javascript">
//     jQuery(function validation() {
//     swal({
//         title: "Terima Kasih!",
//         icon: "success",
//         button: "Ok",
//       }).then(function() {

//       });
// });
// </script>';
// } else {
//     $sql = "UPDATE ahli_kariah SET approvement = 'Belum Daftar' WHERE kariah_id = $kariah_id ";
//     $update = $pdo->prepare($sql);
//     $update->execute();
//     echo '<script type="text/javascript">
//     jQuery(function validation() {
//         swal({
//             title: "Transaksi Gagal!",
//             icon: "error",
//             button: "Ok",
//           }).then(function() {

//         });
//     });
//     </script>';
// }


// if (isset($_POST['btn_simpan_gagal'])) {

//     $approvement = $_POST['approvement'];
//     $status_id = $_POST['status_id'];

//     $update_kariah1 = $pdo->prepare("UPDATE khairat_kematian SET approvement=:approvement, status_id=:status_id WHERE khairat_id = $order_id");

//     $update_kariah1->bindParam(':approvement', $approvement);
//     $update_kariah1->bindParam(':status_id', $status_id);

//     $update_kariah1->execute();
//         header('location:user.php?p=message');


//     $sql1 = "UPDATE ahli_kariah SET approvement = 'Belum Daftar' WHERE kariah_id = $kariah_id ";
//     $update1 = $pdo->prepare($sql1);
//     $update1->execute();
// }

if ($_SESSION['role'] == "User") {
    include_once 'header-test.php';
} else {
    include_once 'headerphp';
}

?>

<body>
    <div class="wrapper">
        <?php
        include_once 'main-header.php';
        include_once 'sidebar.php';
        ?>
        <br>
        <div class="main-panel">
            <div class="content" style="margin-top: 60px">
                <div class="content-wrapper">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card">
                                        <div class="card-header">
                                            <h3 class="card-title">Pengesahan Bayaran</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="POST" name="">
                                                <input type="hidden" name="status_id" class="form-control" placeholder="" value="<?php echo $status_id; ?>" />
                                                <!-- <input type="hidden" name="approvement" class="form-control" placeholder="" value="Telah Daftar" readonly /> -->

                                                <?php
                                                if ($status_id == 1) {
                                                    echo '
                                                    <div class="text-center">
                                                        <h2 class="text-success">Terima Kasih Atas Bayaran</h2>
                                                        <p class="lead">Status bayaran Berjaya</p>
                                                    </div>
                                                    ';

                                                    echo '<script type="text/javascript">
                                                    jQuery(function validation() {
                                                    swal({
                                                        title: "Terima Kasih!",
                                                        icon: "success",
                                                        button: "Ok",
                                                    }).then(function() {
                                                        window.location = "user.php?p=message";
                                                    });
                                                    });
                                                    </script>';
                                                } elseif ($status_id == 2) {
                                                    echo '
                                                    <div class="text-center">
                                                        <h2 class="text-success">Terima Kasih Atas Bayaran</h2>
                                                        <p class="lead">Status bayaran PENDING</p>
                                                    </div>
                                                    ';
                                                } else {
                                                    echo '
                                                    <div class="text-center">
                                                        <h2 class="text-success">Status bayaran GAGAL. Sila hubungi masjid untuk masalah berkenaan</h2>
                                                        <p>Klik butang Hubungi untuk terus berhubung dengan pihak masjid</p>
                                                    </div>
                                                    ';

                                                    echo '<script type="text/javascript">
                                                    jQuery(function validation() {
                                                    swal({
                                                        title: "Transaksi Gagal!",
                                                        icon: "error",
                                                        button: "Ok",
                                                      }).then(function() {

                                                    });
                                                });
                                                </script>';
                                                }
                                                ?>

                                                <?php //include_once 'edit-fpx.php';
                                                ?>
                                                <hr>
                                                <?php
                                                // if ($status_id == 1) {
                                                //     echo '
                                                //     <div align="center">
                                                //         <input type="submit" name="btn_simpan" value="PENGESAHAN" class="btn btn-success">
                                                //     </div>
                                                //     ';
                                                // } elseif ($status_id == 2) {
                                                //     echo '
                                                //     <div align="center">
                                                //         <input type="submit" name="btn_simpan" value="PENGESAHAN" class="btn btn-success">
                                                //     </div>
                                                //     ';
                                                // } else {
                                                //     echo '
                                                //     <div align="center">
                                                //         <input type="submit" name="btn_simpan_gagal" value="KEMBALI" class="btn btn-info">
                                                //     </div>
                                                //     ';
                                                // }
                                                ?>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <?php include_once 'footer2.php'; ?>
        </div>
    </div>

    <script>
        Circles.create({
            id: 'circles-1',
            radius: 45,
            value: 60,
            maxValue: 100,
            width: 7,
            text: 5,
            colors: ['#f1f1f1', '#FF9E27'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })
        Circles.create({
            id: 'circles-2',
            radius: 45,
            value: 70,
            maxValue: 100,
            width: 7,
            text: 36,
            colors: ['#f1f1f1', '#2BB930'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })
        Circles.create({
            id: 'circles-3',
            radius: 45,
            value: 40,
            maxValue: 100,
            width: 7,
            text: 12,
            colors: ['#f1f1f1', '#F25961'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });

        $(document).ready(function() {

            $('#member-list').DataTable({
                "order": [
                    [0, "asc"]
                ] //tutorial tu kata dia akan table dalam desc order
            });

            $('.productid').on('change', function(e) {
                //var productid = this.value;
                var productid = $(".productid").val();

                var tr = $(this).parent().parent();
                $.ajax({
                    url: "admin/getproduct2.php",
                    method: "get",
                    data: {
                        id: productid
                    },
                    success: function(data) {
                        tr.find(".pname").val(data["product_name"]);
                        tr.find(".jumlah").val(data["jumlah"]);
                        tr.find(".quantity").val(1);
                        tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah").val());
                        calculate(0, 0);
                    }
                })
            })

            function calculate(paid) {
                var net_total = 0;
                var paid_amount = paid;
                var due = 0;

                $(".total").each(function() {
                    net_total = net_total + ($(this).val() * 1);
                })

                $(".paid").each(function() {
                    net_total = net_total + ($(this).val() * 1);
                })

                net_total = net_total;
                paid_amount = net_total;
                due = net_total - paid_amount;
                $("#total").val(net_total.toFixed(2));
                $("#paid").val(net_total.toFixed(2));
                $("#due").val(due.toFixed(2));
            }

            $("#paid").keyup(function() {
                var paid = $(this).val();
                calculate(paid);
            })
        });
    </script>

    <?php
    if (isset($billcode) && !empty($billcode)) :
    ?>
        <script type="text/javascript">
            window.location.href = "https://dev.toyyibpay.com/<?php echo $billcode; ?>";
        </script>
    <?php
    endif;
    ?>
</body>