<?php

include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

$status_id = $_GET['status_id'];
$transaction_id = $_GET['transaction_id'];
$billcode = $_GET['billcode'];
$order_id = $_GET['order_id'];

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id  = $order_id");
// $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = $order_id");
$select->execute();

// $select->bindColumn('khairat_id', $khairat_id);
// $select->bindColumn('kariah_id', $kariah_id);
// $select->bindColumn('product_id', $product_id);
// $select->bindColumn('product_name', $product_name);
// $select->bindColumn('jumlah', $jumlah);
// $select->bindColumn('quantity', $quantity);
// $select->bindColumn('khairat_name', $khairat_name);
// $select->bindColumn('khairat_ic', $khairat_ic);
// $select->bindColumn('khairat_email', $khairat_email);
// $select->bindColumn('khairat_umur', $khairat_umur);
// $select->bindColumn('jantina', $jantina);
// $select->bindColumn('pekerjaan', $pekerjaan);
// $select->bindColumn('alamat', $alamat);
// $select->bindColumn('alamat2', $alamat2);
// $select->bindColumn('poskod', $poskod);
// $select->bindColumn('bandar', $bandar);
// $select->bindColumn('negeri', $negeri);
// $select->bindColumn('s_menetap', $s_menetap);
// $select->bindColumn('tel_rumah', $tel_rumah);
// $select->bindColumn('tel_hp', $tel_hp);
// $select->bindColumn('tahun_menetap', $tahun_menetap);
// $select->bindColumn('status_perkahwinan', $status_perkahwinan);
// $select->bindColumn('penerima_bantuan', $penerima_bantuan);
// $select->bindColumn('total', $total);
// $select->bindColumn('paid', $paid);
// $select->bindColumn('due', $due);

$row = $select->fetch(PDO::FETCH_ASSOC);

$khairat_id = $row['khairat_id'];
$kariah_id = $row['kariah_id'];
$product_id = $row['product_id'];
$product_name = $row['product_name'];
$jumlah = $row['jumlah'];
$quantity = $row['quantity'];
$khairat_name = $row['khairat_name'];
$khairat_ic = $row['khairat_ic'];
$khairat_email = $row['khairat_email'];
$khairat_umur = $row['khairat_umur'];
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
$tarikh_bayar = date('d-m-Y', strtotime($row['tarikh_bayar']));
$total = $row['total'];
$paid = $row['paid'];
$due = $row['due'];
// $status_id = $row['status_id'];

$select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.khairat_id  = $order_id");
$select->execute();
$row_invoice_details = $select->fetchAll(PDO::FETCH_ASSOC);

// function fill_product($pdo, $product_id)
// {
//     $output = '';
//     $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_name ASC");
//     $select->execute();
//     $result = $select->fetchAll();
//     foreach ($result as $row) {
//         $output .= '<option value="' . $row["product_id"] . '"';
//         if ($product_id == $row['product_id']) {
//             $output .= 'selected';
//         }
//         $output .= '>' . $row["product_name"] . '</option>';
//     }
//     return $output;
// }

// $select = $pdo->prepare("SELECT * FROM khairat_kematian");
// $select->execute();
// $row = $select->fetch(PDO::FETCH_OBJ);
// $row->khairat_id;
// $test = $_GET['khairat_id'];

if (isset($_POST['btn_simpan'])) {

    // $product_id = $_POST['product_id'];
    // $product_name = $_POST['product_name'];
    // $jumlah = $_POST['jumlah'];
    // $quantity = $_POST['quantity'];
    // $arr_total = $_POST['total'];
    // $khairat_name = $_POST['khairat_name'];
    // $khairat_ic = $_POST['khairat_ic'];
    // $khairat_email = $_POST['khairat_email'];
    // $khairat_umur = $_POST['khairat_umur'];
    // $jantina = $_POST['jantina'];
    // $pekerjaan = $_POST['pekerjaan'];
    // $alamat = $_POST['alamat'];
    // $alamat2 = $_POST['alamat2'];
    // $poskod = $_POST['poskod'];
    // $bandar = $_POST['bandar'];
    // $negeri = $_POST['negeri'];
    // $s_menetap = $_POST['s_menetap'];
    // $tel_rumah = $_POST['tel_rumah'];
    // $tel_hp = $_POST['tel_hp'];
    // $kawasan = $_POST['kawasan'];
    // $tahun_menetap = $_POST['tahun_menetap'];
    // $status_perkahwinan = $_POST['status_perkahwinan'];
    // $penerima_bantuan = $_POST['penerima_bantuan'];
    // $total = $_POST['total'];
    // $paid = $_POST['paid'];
    // $due = $_POST['due'];
    $approvement = $_POST['approvement'];
    $status_id = $_POST['status_id'];


    $update_kariah = $pdo->prepare("UPDATE khairat_kematian SET approvement=:approvement, status_id=:status_id WHERE khairat_id = $order_id");

    // $update_kariah->bindParam(':product_id', $product_id);
    // $update_kariah->bindParam(':jumlah', $jumlah);
    // $update_kariah->bindParam(':quantity', $quantity);
    // $update_kariah->bindParam(':khairat_name', $khairat_name);
    // $update_kariah->bindParam(':khairat_ic', $khairat_ic);
    // $update_kariah->bindParam(':khairat_email', $khairat_email);
    // $update_kariah->bindParam(':khairat_umur', $khairat_umur);
    // $update_kariah->bindParam(':jantina', $jantina);
    // $update_kariah->bindParam(':pekerjaan', $pekerjaan);
    // $update_kariah->bindParam(':alamat', $alamat);
    // $update_kariah->bindParam(':alamat2', $alamat2);
    // $update_kariah->bindParam(':poskod', $poskod);
    // $update_kariah->bindParam(':bandar', $bandar);
    // $update_kariah->bindParam(':negeri', $negeri);
    // $update_kariah->bindParam(':s_menetap', $s_menetap);
    // $update_kariah->bindParam(':tel_rumah', $tel_rumah);
    // $update_kariah->bindParam(':tel_hp', $tel_hp);
    // $update_kariah->bindParam(':kawasan', $kawasan);
    // $update_kariah->bindParam(':tahun_menetap', $tahun_menetap);
    // $update_kariah->bindParam(':status_perkahwinan', $status_perkahwinan);
    // $update_kariah->bindParam(':penerima_bantuan', $penerima_bantuan);
    // $update_kariah->bindParam(':total', $total);
    // $update_kariah->bindParam(':paid', $paid);
    // $update_kariah->bindParam(':due', $due);
    $update_kariah->bindParam(':approvement', $approvement);
    $update_kariah->bindParam(':status_id', $status_id);

    if ($update_kariah->execute()) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
        swal({
            title: "Terima Kasih!",
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
                    title: "Transaksi Gagal!",
                    icon: "error",
                    button: "Ok",
                  }).then(function() {
                    window.location = "senarai-khairat-kematian.php";
                });
            });
            </script>';
    }

    $sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar' WHERE kariah_id = $kariah_id ";
    $update = $pdo->prepare($sql);
    $update->execute();
}

if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}
?>
<br>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pengesahan Bayaran</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" name="">
                                <input type="hidden" name="status_id" class="form-control" placeholder="" value="<?php echo $status_id; ?>" />
                                <input type="hidden" name="approvement" class="form-control" placeholder="" value="Telah Daftar" readonly />

                                <?php
                                if ($status_id == 1) {
                                    echo '
                                    <div class="text-center">
                                        <h2 class="text-success">Terima Kasih Atas Pembayaran</h2>
                                        <p class="lead">Sila klik butang <b>PENGESAHAN</b> untuk mengesahkan pembayaran anda</p>
                                        <p>Pastikan jaringan internet anda tidak terputus ketika mengesahkan pembayaran ini</p>
                                    </div>
                                    ';
                                } elseif ($status_id == 2) {
                                    echo '
                                    <div class="text-center">
                                        <h2 class="text-success">Terima Kasih Atas Pembayaran</h2>
                                        <p class="lead">Status pembayaran anda adalah PENDING. Sila klik butang <b>PENGESAHAN</b> untuk mengesahkan pembayaran anda</p>
                                        <p>Pastikan jaringan internet anda tidak terputus ketika mengesahkan pembayaran ini</p>
                                    </div>
                                    ';
                                } else {
                                    echo '
                                    <div class="text-center">
                                        <h2 class="text-success">Terima Kasih Atas Pembayaran</h2>
                                        <p class="lead">Status pembayaran anda adalah PENDING. Sila klik butang <b>PENGESAHAN</b> untuk mengesahkan pembayaran anda</p>
                                        <p>Pastikan jaringan internet anda tidak terputus ketika mengesahkan pembayaran ini</p>
                                    </div>
                                    ';
                                }


                                ?>

                                <?php //include_once 'edit-fpx.php'; 
                                ?>
                                <hr>
                                <?php 
                                if ($status_id == 1) {
                                    echo '
                                    <div align="center">
                                        <input type="submit" name="btn_simpan" value="PENGESAHAN" class="btn btn-info">
                                    </div>
                                    ';
                                }  elseif ($status_id == 2) {
                                    echo '
                                    <div align="center">
                                        <input type="submit" name="btn_simpan" value="PENGESAHAN" class="btn btn-info">
                                    </div>
                                    ';
                                } else {
                                    echo '
                                    <div align="center">
                                    <a href="senarai-khairat-kematian.php"><button class="btn btn-info">Kembali</button></a> 
                                    </div>
                                    ';
                                }
                                ?>
                               
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
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {

                //     $('.productidedit').select2()
                //     $('.productidedit').select2({
                //         theme: 'bootstrap4'
                //     })
                //     $('.productidedit').on('change', function(e) {
                //         var productid = this.value;
                //         var tr = $(this).parent().parent();
                //         $.ajax({
                //             url: "getproduct.php",
                //             method: "get",
                //             data: {
                //                 id: productid
                //             },
                //             success: function(data) {
                //                 tr.find(".pname").val(data["product_name"]);
                //                 tr.find(".jumlah").val(data["jumlah"]);
                //                 tr.find(".quantity").val(1);
                //                 tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah").val());
                //                 calculate(0, 0);
                //                 $("#paid").val("");
                //             }
                //         })
                //     })

                //     $(document).on('click', '.btnremove', function() {
                //         $(this).closest('tr').remove();
                //         calculate(0, 0);
                //         $("#paid").val("");
                //     })

                //     function calculate(paid) {
                //         var net_total = 0;
                //         var paid_amount = paid;
                //         var due = 0;

                //         $(".total").each(function() {
                //             net_total = net_total + ($(this).val() * 1);
                //         })

                //         net_total = net_total;

                //         due = net_total - paid_amount;

                //         $("#total").val(net_total.toFixed(2));

                //         $("#due").val(due.toFixed(2));
                //     }

                //     $("#paid").keyup(function() {
                //         var paid = $(this).val();
                //         calculate(paid);
                //     })

                // });
</script>

<?php
include_once 'footer.php';
?>