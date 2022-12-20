<?php
include_once 'admin/database/connect.php';
session_start();
DATE_DEFAULT_TIMEZONE_SET('Asia/Kuala_Lumpur');
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

include_once 'header-test.php';

//error_reporting(0);

//fetch semula product
$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();

$select->bindColumn('kariah_name', $kariah_name);
$select->bindColumn('kariah_ic', $kariah_ic);
$select->bindColumn('user_email', $user_email);
$select->bindColumn('kariah_umur', $kariah_umur);
$select->bindColumn('jantina', $jantina);
$select->bindColumn('pekerjaan', $pekerjaan);
$select->bindColumn('alamat', $alamat);
$select->bindColumn('alamat2', $alamat2);
$select->bindColumn('poskod', $poskod);
$select->bindColumn('bandar', $bandar);
$select->bindColumn('negeri', $negeri);
$select->bindColumn('s_menetap', $s_menetap);
$select->bindColumn('tel_rumah', $tel_rumah);
$select->bindColumn('tel_hp', $tel_hp);
$select->bindColumn('tahun_menetap', $tahun_menetap);
$select->bindColumn('status_perkahwinan', $status_perkahwinan);
$select->bindColumn('penerima_bantuan', $penerima_bantuan);
$select->bindColumn('password', $password);
$select->bindColumn('role', $role);
$select->bindColumn('approvement', $approvement);
$select->bindColumn('mati', $mati);

$row = $select->fetch(PDO::FETCH_ASSOC);

$kariah_name = $row['kariah_name'];
$kariah_ic = $row['kariah_ic'];
$user_email = $row['user_email'];
$kariah_umur = $row['kariah_umur'];
$jantina = $row['jantina'];
$pekerjaan = $row['pekerjaan'];
$alamat = $row['alamat'];
$alamat2 = $row['alamat2'];
$poskod = $row['poskod'];
$bandar = $row['bandar'];
$negeri = $row['negeri'];
$s_menetap = $row['s_menetap'];
$tel_rumah = $row['tel_rumah'];
$tel_hp = $row['tel_hp'];
$kawasan = $row['kawasan'];
$tahun_menetap = $row['tahun_menetap'];
$status_perkahwinan = $row['status_perkahwinan'];
$penerima_bantuan = $row['penerima_bantuan'];
$password = $row['password'];
$tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
$role = $row['role'];
$approvement = $row['approvement'];
$mati = $row['mati'];

$select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id = $id");
$select->execute();
$row_tanggung = $select->fetchAll(PDO::FETCH_ASSOC);

function fill_product($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';

    //$selecPaid = $pdo->prepare("SELECT tbl_product.* FROM tbl_product LEFT JOIN khairat_kematian ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id = 1 AND khairat_kematian.kariah_id = " . $id . " ORDER BY product_name ASC");
    $selecPaid = $pdo->prepare("SELECT * FROM khairat_kematian WHERE kariah_id = $id AND status_id = 1");
    $selecPaid->execute();
    $resultPaid = $selecPaid->fetchAll();
    $allPaid = [];
    foreach ($resultPaid as $rowPaid) {
        $p1 = explode(",", $rowPaid['product_id']);
        $allPaid = array_merge($allPaid, $p1);
    }

    $array = explode("-", $_SESSION['tarikh_daftar']);
    $tahun = $array[0];
    //2022-02-02
    //array 0 adalah tahun iaitu 2022

    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE tahun < $tahun AND stat = 1");
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
        $allPaid[] = $row['product_id'];
    }

    $resultPaid = implode(",", $allPaid);

    if ($resultPaid != null) {
        $select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id NOT IN($resultPaid) ORDER BY product_name ASC");
    } else {
        $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
    }

    $select->execute();
    $result = $select->fetchAll();

    foreach ($result as $row) {
        $output .= '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
    }
    return $output;
}

function fill_product2($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT * FROM tbl_product");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
    }
    return $output;
}

function tunggak($pdo)
{
    $output = '';
    $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["product_id"] . '">' . $row["stat"] . '</option>';
    }
    return $output;
}

function test($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    // $select = $pdo->prepare("SELECT product_id, product_name FROM khairat_kematian WHERE kariah_id = $id");
    $select = $pdo->prepare("SELECT khairat_kematian.* FROM tbl_product LEFT JOIN khairat_kematian ON tbl_product.product_id = khairat_kematian.product_id WHERE kariah_id = $id");
    $select->execute();
    $result = $select->fetchAll();

    foreach ($result as $row) {
        if ($row) {
            $output .= '<option value="' . $row["product_id"] . '">'   . " Berjaya" .  '</option>';
        } elseif ($output .= '<option value="' . $row["product_id"] . '">'   . " Berjaya" .  '</option>' != true) {
            $output .= '<option hidden>' . "Tunggak " .  '</option>';
        }
    }
    $output .= '<option>' . "Tunggak " .  '</option>';

    return $output;
}

function jumlah($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT kariah_id, paid FROM khairat_kematian WHERE kariah_id = $id");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        if ($row) {

            $output .= '<option value="' . $row["kariah_id"] . '">' . number_format($row["paid"], 2)  .  '</option>';
        } else {
            $output .= '<option value="' . $row["product_id"] . '">' . "Tunggak " .  '</option>';
        }
    }
    $output .= '<option >' . "Tunggak " .  '</option>';
    return $output;
}

function baki($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';
    $select = $pdo->prepare("SELECT kariah_id, due FROM khairat_kematian WHERE kariah_id = $id");
    $select->execute();
    $result = $select->fetchAll();
    foreach ($result as $row) {
        if ($row) {

            $output .= '<option value="' . $row["kariah_id"] . '">' . number_format($row["due"], 2)  .  '</option>';
        } else {
            $output .= '<option value="' . $row["product_id"] . '">' . "Tunggak " .  '</option>';
        }
    }
    $output .= '<option >' . "Tunggak " .  '</option>';
    return $output;
}

if (isset($_POST['btn_simpan'])) {

    $product_id = array();
    $product_name = array();
    $jumlah = array();

    foreach ($_POST['product_id'] as $pid) {
        $productDetails = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = $pid");
        $productDetails->execute();
        $result = $productDetails->fetchAll();

        // $kariah_id = $_POST['kariah_id'];
        $product_id[] = $result[0]['product_id'];
        $product_name[] = $result[0]['product_name'];
        $jumlah[] = $result[0]['jumlah'];
    }

    $product_id = implode(",", $product_id);
    $product_name = implode(",", $product_name);
    $jumlah = implode(",", $jumlah);

    // $quantity = $_POST['quantity'];
    // $arr_total = $_POST['total'];
    // $tarikh_bayar = date("Y-m-d");
    // //$tarikh_bayar = date('Y-m-d', strtotime($_POST['tarikh_bayar']));
    // // $expired = date('Y-m-d', strtotime('+1 years'));
    // $expired = date("Y-m-d", strtotime(date("Y-m-d", strtotime($tarikh_bayar)) . " + 365 day"));
    // $approvement = $_POST['approvement'];
    // $total = $_POST['total'];
    // $paid = $_POST['paid'];
    // $due = $_POST['due'];
    // $invoice_no = $_POST['invoice_no'];
    // $p_method = $_POST['p_method'];
    // $status_id = $_POST['status_id'];
    // $stat = $_POST['stat'];

    $quantity = $_POST['quantity'];
    $arr_total = $_POST['total'];
    $tarikh_bayar = date("Y-m-d");
    $expired = date("Y-m-d", strtotime(date("Y-m-d", strtotime($tarikh_bayar)) . " + 365 day"));
    $total = $_POST['total'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $invoice_no = $_POST['invoice_no'];
    $p_method = $_POST['p_method'];
    $status_id = $_POST['status_id'];
    $stat = $_POST['stat'];

    if ($kariah_umur == null) {
        echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Sila kemaskini maklumat",
                        icon: "warning",
                        button: "Ok",
                    }).then(function() {
                        window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                    });
                });
                </script>';
    } elseif ($jantina == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini jantina",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($pekerjaan == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini pekerjaan",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($alamat == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini alamat",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($poskod == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini poskod",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($bandar == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini bandar",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($negeri == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini negeri",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($s_menetap == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini status menetap",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($tel_hp == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini no telefon bimbit",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($kawasan == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini kawasan kariah",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($tahun_menetap == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini tahun menetap",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } elseif ($status_perkahwinan == null) {
        echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Sila kemaskini status perkahwinan",
                    icon: "warning",
                    button: "Ok",
                }).then(function() {
                    window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                });
            });
            </script>';
    } else {

        $kariah_id = $pdo->lastInsertId();
        if ($kariah_id != null) {

            $insert = $pdo->prepare("INSERT INTO khairat_kematian(kariah_id, product_id, product_name, jumlah, quantity, tarikh_bayar, expired, total, paid, due, invoice_no, p_method, status_id, stat)
                VALUES(:kariah_id, :product_id, :product_name, :jumlah, :quantity, :tarikh_bayar, :expired, :total, :paid, :due, :invoice_no, :p_method, :status_id, 0)");

            // $insert->bindParam(':kariah_id', $id);
            // $insert->bindParam(':product_id', $product_id);
            // $insert->bindParam(':product_name', $product_name);
            // $insert->bindParam(':jumlah', $jumlah);
            // $insert->bindParam(':quantity', $quantity);
            // $insert->bindParam(':tarikh_bayar', $tarikh_bayar);
            // $insert->bindParam(':expired', $expired);
            // $insert->bindParam(':approvement', $approvement);
            // $insert->bindParam(':total', $total);
            // $insert->bindParam(':paid', $paid);
            // $insert->bindParam(':due', $due);
            // $insert->bindParam(':invoice_no', $invoice_no);
            // $insert->bindParam(':p_method', $p_method);
            // $insert->bindParam(':status_id', $status_id);

            $insert->bindParam(':kariah_id', $id);
            $insert->bindParam(':product_id', $product_id);
            $insert->bindParam(':product_name', $product_name);
            $insert->bindParam(':jumlah', $jumlah);
            $insert->bindParam(':quantity', $quantity);
            $insert->bindParam(':tarikh_bayar', $tarikh_bayar);
            $insert->bindParam(':expired', $expired);
            $insert->bindParam(':total', $total);
            $insert->bindParam(':paid', $paid);
            $insert->bindParam(':due', $due);
            $insert->bindParam(':invoice_no', $invoice_no);
            $insert->bindParam(':p_method', $p_method);
            $insert->bindParam(':status_id', $status_id);

            if ($insert->execute()) {
                echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Berjaya Bayar",
                            icon: "success",
                            button: "Ok",
                        }).then(function() {
                            window.location = "bayar.php";
                        });
                    });
                    </script>';
            } else {
                echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Gagal Bayar",
                            icon: "error",
                            button: "Ok",
                        });
                    });
                    </script>';
            }
            $khairat_id = $pdo->lastInsertId();
        }
        $rm = ($paid * 100);

        $some_data = array(
            'userSecretKey' => 'lc7j9r3c-o0wc-ak0g-5iek-kqlx9sm4khlm',
            'categoryCode' => 'wrc842tp',
            'billName' => 'Bayaran Khairat Kematian',
            'billDescription' => 'BAYARAN SEBANYAK RM ' . $paid . ' MENGGUNAKAN FPX',
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => $rm,
            'billReturnUrl' => 'https://localhost/callback.php', //so lepas bayar akan gi ke page callback.php ni
            'billCallbackUrl' => 'https://khairat.tk/callback-backend.php', //server to server communication yg akan handle
            'billExternalReferenceNo' => $khairat_id,
            'billTo' => $kariah_name,
            'billEmail' => $user_email,
            'billPhone' => $tel_hp,
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => 0,
            'billContentEmail'=>'Terima kasih atas pembayaran, sila log masuk https://khairatwustha.tk untuk muat turun resit bayaran anda',
            'billChargeToCustomer' => 2
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        $obj = json_decode($result, true);
        $billcode = $obj[0]['BillCode'];
    }

    // $sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar' WHERE kariah_id = $id ";
    // $update = $pdo->prepare($sql);
    // $update->execute();
}

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
        <?php include_once 'form-fpx.php'; ?>
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

            $('.productid').select2()
            $('.productid').select2({
                theme: 'bootstrap4'
            })

            $('.productid').on('change', function(e) {
                //var productid = this.value;
                var productid = $(".productid").val();

                var tr = $(this).parent().parent();
                $.ajax({
                    url: "admin/getproduct.php",
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

    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- <script>

    </script> -->

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