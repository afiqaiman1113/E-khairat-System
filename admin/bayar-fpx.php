<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

// error_reporting(0);

$id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $id");
$select->execute();

// $select->bindParam(':kariah_name', $kariah_name);
// $select->bindParam(':kariah_ic', $kariah_ic);
// $select->bindParam(':user_email', $user_email);
// $select->bindParam(':kariah_umur', $kariah_umur);
// $select->bindParam(':jantina', $jantina);
// $select->bindParam(':pekerjaan', $pekerjaan);
// $select->bindParam(':alamat', $alamat);
// $select->bindParam(':alamat2', $alamat2);
// $select->bindParam(':poskod', $poskod);
// $select->bindParam(':bandar', $bandar);
// $select->bindParam(':negeri', $negeri);
// $select->bindParam(':s_menetap', $s_menetap);
// $select->bindParam(':tel_rumah', $tel_rumah);
// $select->bindParam(':tel_hp', $tel_hp);
// $select->bindParam(':kawasan', $kawasan);
// $select->bindParam(':tahun_menetap', $tahun_menetap);
// $select->bindParam(':status_perkahwinan', $status_perkahwinan);
// $select->bindParam(':penerima_bantuan', $penerima_bantuan);
// $select->bindParam(':password', $password);
// $select->bindParam(':tarikh_daftar', $tarikh_daftar);
// $select->bindParam(':role', $role);
// $select->bindParam(':approvement', $approvement);

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

$select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id = $id");
$select->execute();
$row_tanggung = $select->fetchAll(PDO::FETCH_ASSOC);

function fill_product($pdo)
{
    $id = $_GET['kariah_id'];
    $output = '';

    $selecPaid = $pdo->prepare("SELECT tbl_product.* FROM tbl_product LEFT JOIN khairat_kematian ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id = 1 AND khairat_kematian.kariah_id = " . $id . " ORDER BY product_name ASC");
    $selecPaid->execute();
    $resultPaid = $selecPaid->fetchAll();
    $allPaid = [];
    foreach ($resultPaid as $rowPaid) {
        $allPaid[] = $rowPaid['product_id'];
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

if (isset($_POST['btn_simpan'])) {

    foreach ($_POST['product_id'] as $pid) {
        $productDetails = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = $pid");
        $productDetails->execute();
        $result = $productDetails->fetchAll();

        // $kariah_id = $_POST['kariah_id'];
        $product_id = $result[0]['product_id'];
        $product_name = $result[0]['product_name'];
        $jumlah = $result[0]['jumlah'];
        $quantity = $_POST['quantity'];
        $arr_total = $_POST['total'];
        $khairat_name = $_POST['khairat_name'];
        $khairat_ic = $_POST['khairat_ic'];
        $khairat_email = $_POST['khairat_email'];
        $khairat_umur = $_POST['khairat_umur'];
        $jantina = $_POST['jantina'];
        $pekerjaan = $_POST['pekerjaan'];
        $alamat = $_POST['alamat'];
        $alamat2 = $_POST['alamat2'];
        $poskod = $_POST['poskod'];
        $bandar = $_POST['bandar'];
        $negeri = $_POST['negeri'];
        $s_menetap = $_POST['s_menetap'];
        $tel_rumah = $_POST['tel_rumah'];
        $tel_hp = $_POST['tel_hp'];
        $kawasan = $_POST['kawasan'];
        $tahun_menetap = $_POST['tahun_menetap'];
        $status_perkahwinan = $_POST['status_perkahwinan'];
        $penerima_bantuan = $_POST['penerima_bantuan'];
        $tarikh_bayar = date("Y-m-d");
        $expired = date('Y-m-d', strtotime('+1 years'));
        $approvement = $_POST['approvement'];
        $total = $_POST['total'];
        $paid = $_POST['paid'];
        $due = $_POST['due'];
        $invoice_no = $_POST['invoice_no'];
        $p_method = $_POST['p_method'];
        $status_id = $_POST['status_id'];

        if ($khairat_umur == null) {
            echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Sila kemaskini maklumat",
                        icon: "warning",
                        button: "Ok",
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
                });
            });
            </script>';
        } else {

            $nama = $_POST['nama'];
            $ic = $_POST['ic'];
            $umur = $_POST['umur'];
            $tel = $_POST['tel'];
            $pertalian = $_POST['pertalian'];
            $khairat_pekerjaan = $_POST['khairat_pekerjaan'];

            $kariah_id = $pdo->lastInsertId();
            if ($kariah_id != null) {

                $insert = $pdo->prepare("INSERT INTO khairat_kematian(kariah_id, product_id, product_name, jumlah, quantity, khairat_name, khairat_ic, khairat_email, khairat_umur, jantina, pekerjaan, alamat, alamat2, poskod, bandar, negeri, s_menetap, tel_rumah, tel_hp, kawasan, tahun_menetap, status_perkahwinan, penerima_bantuan, tarikh_bayar, expired, approvement, total, paid, due, invoice_no, p_method, status_id)
                    VALUES(:kariah_id, :product_id, :product_name, :jumlah, :quantity, :khairat_name, :khairat_ic, :khairat_email, :khairat_umur, :jantina, :pekerjaan, :alamat, :alamat2, :poskod, :bandar, :negeri, :s_menetap, :tel_rumah, :tel_hp, :kawasan, :tahun_menetap, :status_perkahwinan, :penerima_bantuan, :tarikh_bayar, :expired, :approvement, :total, :paid, :due, :invoice_no, :p_method, :status_id)");

                $insert->bindParam(':kariah_id', $id);
                $insert->bindParam(':product_id', $product_id);
                $insert->bindParam(':product_name', $product_name);
                $insert->bindParam(':jumlah', $jumlah);
                $insert->bindParam(':quantity', $quantity);
                $insert->bindParam(':khairat_name', $khairat_name);
                $insert->bindParam(':khairat_ic', $khairat_ic);
                $insert->bindParam(':khairat_email', $khairat_email);
                $insert->bindParam(':khairat_umur', $khairat_umur);
                $insert->bindParam(':jantina', $jantina);
                $insert->bindParam(':pekerjaan', $pekerjaan);
                $insert->bindParam(':alamat', $alamat);
                $insert->bindParam(':alamat2', $alamat2);
                $insert->bindParam(':poskod', $poskod);
                $insert->bindParam(':bandar', $bandar);
                $insert->bindParam(':negeri', $negeri);
                $insert->bindParam(':s_menetap', $s_menetap);
                $insert->bindParam(':tel_rumah', $tel_rumah);
                $insert->bindParam(':tel_hp', $tel_hp);
                $insert->bindParam(':kawasan', $kawasan);
                $insert->bindParam(':tahun_menetap', $tahun_menetap);
                $insert->bindParam(':status_perkahwinan', $status_perkahwinan);
                $insert->bindParam(':penerima_bantuan', $penerima_bantuan);
                $insert->bindParam(':tarikh_bayar', $tarikh_bayar);
                $insert->bindParam(':expired', $expired);
                $insert->bindParam(':approvement', $approvement);
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
                            window.location = "senarai-khairat-kematian.php";
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
                if ($khairat_id != null) {
                    for ($i = 0; $i < count($nama); $i++) {
                        $insert = $pdo->prepare("INSERT INTO cubaan(khairat_id, kariah_id, nama, ic, umur, tel, pertalian, khairat_pekerjaan)
                            VALUES(:khairat_id, :kariah_id, :nama, :ic, :umur, :tel, :pertalian, :khairat_pekerjaan)");

                        $insert->bindParam(':khairat_id', $khairat_id);
                        $insert->bindParam(':kariah_id', $id);
                        $insert->bindParam(':nama', $nama[$i]);
                        $insert->bindParam(':ic', $ic[$i]);
                        $insert->bindParam(':umur', $umur[$i]);
                        $insert->bindParam(':tel', $tel[$i]);
                        $insert->bindParam(':pertalian', $pertalian[$i]);
                        $insert->bindParam(':khairat_pekerjaan', $khairat_pekerjaan[$i]);

                        $insert->execute();
                    }
                }
            }
            $rm = ($paid * 100);

            $some_data = array(
                'userSecretKey' => 'lc7j9r3c-o0wc-ak0g-5iek-kqlx9sm4khlm',
                'categoryCode' => 'wrc842tp',
                'billName' => $product_name,
                'billDescription' => 'BAYARAN SEBANYAK RM ' . $paid . ' MENGGUNAKAN FPX',
                'billPriceSetting' => 1,
                'billPayorInfo' => 1,
                'billAmount' => $rm,
                'billReturnUrl' => 'https://alwusto.ml/admin/toyyibcallbackurl.php',
                'billCallbackUrl' => 'https://alwusto.ml/admin/toyyibcallbackurl.php',
                'billExternalReferenceNo' => $khairat_id,
                'billTo' => $kariah_name,
                'billEmail' => $user_email,
                'billPhone' => $tel_hp,
                'billSplitPayment' => 0,
                'billSplitPaymentArgs' => '',
                'billPaymentChannel' => 0,
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
    }
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bayaran Online (FPX)</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="">
                                <input type="hidden" name="status_id" class="form-control" placeholder="" value="0" />
                                <td style="display:none;">
                                    <!--<input type="hidden" name="product_name[]" class="form-control pname" placeholder="" readonly />-->
                                </td>
                                <td>
                                    <select name="product_id[]" style="width: 250px" class="form-control productid">
                                        <option value="">Pilih Yuran</option>
                                        <?php
                                        echo fill_product($pdo);
                                        ?>
                                    </select>
                                </td>
                                <td><input type="hidden" name="jumlah" class="form-control jumlah" placeholder="" readonly /></td>
                                <td><input type="hidden" name="quantity" class="form-control quantity" placeholder="" /></td>
                                <td><input type="hidden" name="total" class="form-control total" placeholder="" readonly /></td>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        RM
                                                    </span>
                                                </div>
                                                <input type="text" name="total" class="form-control" id="total" placeholder="" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bayar</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        RM
                                                    </span>
                                                </div>
                                                <input type="text" name="paid" class="form-control" id="paid" placeholder="" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="due" class="form-control" id="due" placeholder="" readonly />
                                <!-- input form -->
                                <?php include_once 'input-fpx.php'; ?>
                                <hr>
                                <div align="center">
                                    <input type="submit" name="btn_simpan" value="BAYAR GUNA FPX" class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-exclamation-triangle"></i>
                                Penting
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Nota!</h5>
                                <ul>
                                    <li>Ruangan bertanda * wajib diisi</li>
                                    <li>Pastikan anda mendaftar di kariah surau yang betul</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">
                            Transaksi Akaun
                        </h3>
                    </div><br>
                    <div style="overflow-x: auto;">
                        <table id="member-list" class="table table">
                            <thead>
                                <tr>
                                    <th style="font-size:90%;">Yuran</th>
                                    <th style="font-size:90%;">Status</th>
                                    <th style="font-size:90%;">Telah Bayar</th>
                                    <th style="font-size:90%;">Baki Tunggakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $id");
                                $select->execute();
                                $row = $select->fetch(PDO::FETCH_ASSOC);

                                $select33 = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
                                $select33->execute();
                                $row33 = $select33->fetchAll();

                                foreach ($row33 as $product) {
                                    $selectKK =  $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.product_id = " . $product['product_id'] . " AND khairat_kematian.kariah_id = " . $id);
                                    $selectKK->execute();
                                    $KK = $selectKK->fetch(PDO::FETCH_ASSOC);
                                    if ($KK) {
                                        echo '<tr>
                                        <td style="font-size:88%;">' . $product['product_name'] . '</td>
                                        <td style="font-size:90%;"><span class="badge bg-success">' . 'Sudah Dibayar' . '</span></td>
                                        <td style="font-size:88%;">RM ' . number_format($KK['paid'], 2) . '</td>
                                        <td style="font-size:88%;">RM ' . number_format($KK['due'], 2) . '</td>
                                         ';
                                    } else {
                                        echo '<tr>
                                        <td style="font-size:88%;">' . $product['product_name'] . '</td>
                                        <td style="font-size:90%;"><span class="badge bg-danger">' . 'Tertunggak' . '</span></td>
                                        <td style="font-size:88%;">RM 0.00</td>
                                        <td style="font-size:88%;">RM ' . number_format($product['jumlah'], 2) . '</td>
                                    ';
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {

        $('#member-list').DataTable({
            "order": [
                [0, "asc"]
            ],

            pageLength: 2,
            lengthMenu: [
                [2],
                [2]
            ]
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
                url: "getproduct2.php",
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

<!-- maksudnya kena check dulu billcode tu ada ke tak -->
<?php
if (isset($billcode) && !empty($billcode)) :
?>
    <script type="text/javascript">
        window.location.href = "https://dev.toyyibpay.com/<?php echo $billcode; ?>";
    </script>
<?php
endif;
?>

<?php
include_once 'footer.php';
?>