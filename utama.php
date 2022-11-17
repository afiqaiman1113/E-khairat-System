<?php
include_once 'admin/database/connect.php';
// session_start();
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "Admin") {
    header('Location: index.php');
}
error_reporting(0);

// $id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
$select->execute();

$select->bindParam(':kariah_name', $kariah_name);
$select->bindParam(':kariah_ic', $kariah_ic);
$select->bindParam(':user_email', $user_email);
$select->bindParam(':kariah_umur', $kariah_umur);
$select->bindParam(':jantina', $jantina);
$select->bindParam(':pekerjaan', $pekerjaan);
$select->bindParam(':alamat', $alamat);
$select->bindParam(':alamat2', $alamat2);
$select->bindParam(':poskod', $poskod);
$select->bindParam(':bandar', $bandar);
$select->bindParam(':negeri', $negeri);
$select->bindParam(':s_menetap', $s_menetap);
$select->bindParam(':tel_rumah', $tel_rumah);
$select->bindParam(':tel_hp', $tel_hp);
$select->bindParam(':kawasan', $kawasan);
$select->bindParam(':tahun_menetap', $tahun_menetap);
$select->bindParam(':status_perkahwinan', $status_perkahwinan);
$select->bindParam(':penerima_bantuan', $penerima_bantuan);
$select->bindParam(':password', $password);
$select->bindParam(':tarikh_daftar', $tarikh_daftar);
$select->bindParam(':role', $role);
$select->bindParam(':approvement', $approvement);

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
//front end display in format yg kita nak. Cuba bca balik chat dgn abg haezal
$tarikh_daftar = date('d-m-Y', strtotime($row['tarikh_daftar']));
$role = $row['role'];
$approvement = $row['approvement'];

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
<?php
$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
?>
    <div class="modal" id="popup" data-modal-color="green" data-backdrop="false" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                <h5 class="modal-title">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
                <div class="modal-header" style="background-color: #4caf50;">
                    <h3 class="card-title" style="color:White">
                        <i class="fas fa-exclamation-triangle"></i>
                        Penting
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Sekiranya anda belum mengemaskini maklumat, sila kemaskini maklumat anda dengan segera</p>
                </div>
                <div class="modal-footer" style="background-color: #4caf50;">
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="modal" id="popup" data-modal-color="green" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
                <h5 class="modal-title">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
                <div class="modal-header" style="background-color: #4caf50;">
                    <h3 class="card-title" style="color:White">
                        <i class="fas fa-exclamation-triangle"></i>
                        Penting
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Sekiranya anda belum mengemaskini maklumat, sila kemaskini maklumat anda dengan segera</p>
                </div>
                <div class="modal-footer" style="background-color: #4caf50;">
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php
}
?>


<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Maklumat Akaun
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                            $select->execute();
                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                echo '
                        <dl class="row">
                        <dt class="col-sm-4">No Ahli</dt>
                                <dd class="col-sm-8">' . $row->no_ahli . '</dd>
                                <dt class="col-sm-4">Nama Ahli</dt>
                                <dd class="col-sm-8"><span style="text-transform:uppercase">' . $row->kariah_name . '</dd>
                            <dt class="col-sm-4">Tarikh Daftar Ahli Kariah</dt>
                                <dd class="col-sm-8">' . date('d-m-Y', strtotime($row->tarikh_daftar)) . '</dd>

                            <dt class="col-sm-4">Status Khairat Kematian</dt>
                            ';
                                if ($row->approvement == "Telah Daftar") {
                                    echo '<dd class="col-sm-8 text-white"><span class="badge bg-success">' . $row->approvement . '</span></dd>';
                                } elseif ($row->approvement == "Digantung") {
                                    echo '<dd class="col-sm-8 text-white"><span class="badge bg-warning">' . $row->approvement . '</span></dd>';
                                } else {
                                    echo '<dd class="col-sm-8 text-white"><span class="badge bg-danger">' . $row->approvement . '</span></dd>';
                                }

                                echo '
                                    <dt class="col-sm-4">Status Ahli</dt>
                                ';
                                if ($row->mati == "Mati") {
                                    echo '<dd class="col-sm-8 text-white"><span class="badge bg-danger">Meninggal</span></dd>';
                                } else {
                                    echo '<dd class="col-sm-8 text-white"><span class="badge bg-success">Hidup</span></dd>';
                                }

                                echo '
                                <dt class="col-sm-4">Status Bayaran</dt>
                            ';
                                if (strtotime(date("d-m-Y")) <= strtotime($row->tarikh_expired)) {
                                    echo '<dd class="col-sm-8 text-white"><span class="badge bg-success">Aktif/Belum Tamat Tempoh</span></dd>';
                                } elseif ($row->tarikh_expired == NULL) {
                                    echo '<dd class="col-sm-8 text-white"><span class="badge bg-danger">Belum Bayar</span></dd>';
                                } else {
                                    echo '<dd class="col-sm-8 text-white"><span class="badge bg-danger">Tamat Tempoh</span></dd>';
                                }

                                echo '
                                    <dt class="col-sm-4">Kariah</dt>
                                    <dd class="col-sm-8">' . $row->kawasan . '</dd>
                                    <br><br>

                                    <dt class="col-sm-4">
                                    <a href="bayar.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
                                        Bayar
                                    </a>
                                    </dt>


                                    ';

                                echo '</dl>';
                            }

                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Terkini Yang Dilakukan</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="member-list" class="table table" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">Yuran</th>
                                            <th style="font-size:90%;">Status Yuran</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $allbayaran = array();
                                        $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        $select->execute();
                                        $row = $select->fetch(PDO::FETCH_ASSOC);

                                        $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        $select->execute();
                                        $row = $select->fetchAll();
                                        foreach ($row as $bayaran) {
                                            $pid = explode(',', $bayaran['product_id']);
                                            $allbayaran = array_merge($allbayaran, $pid);
                                        }

                                        $array = explode("-", $_SESSION['tarikh_daftar']);
                                        $tahun = $array[0];

                                        $select33 = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_id DESC");
                                        $select33->execute();
                                        $row33 = $select33->fetchAll();


                                        foreach ($row33 as $product) {
                                            $selectKK =  $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.product_id = " . $product['product_id'] . " AND khairat_kematian.kariah_id = " . $_SESSION['kariah_id']);
                                            $selectKK->execute();
                                            $KK = $selectKK->fetch(PDO::FETCH_ASSOC);
                                            if (in_array($product['product_id'], $allbayaran)) {
                                                echo '<tr>
                                                <td style="font-size:88%;">' . $product['product_name'] . '</td>
                                                <td style="color:White; font-size:90%;"><span class="badge bg-success">' . 'Sudah Dibayar' . '</span></td>

                                                 ';
                                            } else {
                                                echo '<tr>
                                                <td style="font-size:88%;">' . $product['product_name'] . '</td>
                                                <td style="color:White; font-size:90%;"><span class="badge bg-danger">' . 'Tertunggak' . '</span></td>

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

                <div class="col-md-12">
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Yuran Yang Telah Dibayar</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="product" class="table table" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="d-md-none d-sm-table-cell" style="font-size:90%;">Butiran</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">Yuran</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">Tarikh Bayar</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">Sah Sehingga</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">Status Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.*
                                          FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE (status_id = 1) AND khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                                <tr>
                                                <td class="d-md-none d-sm-table-cell">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <br><b>Yuran: ' . displayYuranName($row->product_id, $pdo) . '</b><br><br> <b>Tarikh Bayar: ' . date('d-m-Y', strtotime($row->tarikh_bayar)) . '</b> <br><br><b>Sah Sehingga: ' . date('d-m-Y', strtotime($row->expired)) . '<br><br><b>Status Pembayaran: <span class="badge bg-success" style="color:White">Selesai</span>
                                                    </div>
                                                </div><br>
                                                </td>
                                                    <td class="d-none d-md-table-cell" style="font-size:87%;">' . displayYuranName($row->product_id, $pdo) . '</td>
                                                    <td class="d-none d-md-table-cell" style="font-size:87%;">' . date('d-m-Y', strtotime($row->tarikh_bayar)) . '</td>
                                                    <td class="d-none d-md-table-cell" style="font-size:87%;">' . date('d-m-Y', strtotime($row->expired)) . '</td>
                                                ';


                                            // if ($row->status_id == 1) {
                                            //     echo
                                            //     '<td class="d-md-none d-sm-table-cell text-white">
                                            //         <div class="row">
                                            //             <div class="col-10">
                                            //                 <span class="badge bg-success">Selesai</span>
                                            //             </div>
                                            //         </div><br>
                                            //     </td>';
                                            // } else {
                                            //     echo '<td class="d-md-none d-sm-table-cell text-white"><span class="badge bg-info">Belum</span></td>';
                                            // }


                                            if ($row->status_id == 1) {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-success">Selesai</span></td>';
                                            } else {
                                                echo '<td class="d-none d-md-table-cell text-white"><span class="badge bg-info">Belum</span></td>';
                                            }

                                            echo '
                                            </tr>

                                    ';
                                        }
                                        ?>
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
            ],

            "lengthChange": false,
            "bInfo": false
        });
    });

    $(document).ready(function() {
        $('#product').DataTable({
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
    });

    $(document).ready(function() {
        if (sessionStorage.getItem('#popup') !== 'true') {
            $('#popup').modal('show');
            sessionStorage.setItem('#popup', true);
        }
    });

    // window.addEventListener("load", function() {
    //     setTimeout(
    //         function open(event) {
    //             document.querySelector("#popup").style.display = "block";
    //         },
    //         1000
    //     )
    // });

    // document.querySelector('.close').addEventListener("click", function() {
    //     document.querySelector("#popup").style.display = "none";
    // });
</script>

<!-- code di bwh ini asalnya duduk dlm tbody-->
<?php
// $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
// $select->execute();
// $row = $select->fetch(PDO::FETCH_ASSOC);

// $select33 = $pdo->prepare("SELECT * FROM tbl_product WHERE stat= 1 ORDER BY product_name ASC");
// $select33->execute();
// $row33 = $select33->fetchAll();

// foreach ($row33 as $product) {
//     $selectKK =  $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.product_id = " . $product['product_id'] . " AND khairat_kematian.kariah_id = " . $_SESSION['kariah_id']);
//     $selectKK->execute();
//     $KK = $selectKK->fetch(PDO::FETCH_ASSOC);
//     if ($KK) {
//         echo '<tr>
//                                                 <td style="font-size:88%;">' . $product['product_name'] . '</td>
//                                                 ';

//         if (['tarikh_bayar']) {
//             echo  '<td style="font-size:87%;">' . date('d-m-Y', strtotime($KK['tarikh_bayar'])) . '</td>';
//         } else {
//             echo  '<td style="font-size:87%;">Belum Bayar</td>';
//         }

//         if (['expired']) {
//             echo  '<td style="font-size:87%;">' . date('d-m-Y', strtotime($KK['expired'])) . '</td>';
//         } else {
//             echo  '<td style="font-size:87%;">Belum Bayar</td>';
//         }

//         if (strtotime(date("d-m-Y")) < strtotime($KK['expired'])) {
//             echo '<td style="color:White; font-size:90%;"><span class="badge bg-success">' . 'Aktif' . '</span></td>';
//         } else {
//             echo '<td style="font-size:87%;"><span class="badge bg-danger">' . "Expired" . '</span></td>';
//         }
//     } else {
//         echo '<tr>
//                                                 <td style="font-size:88%;">' . $product['product_name'] . '</td>
//                                                 ';

//         if (['tarikh_bayar'] == false) {
//             echo  '<td style="font-size:87%;">Belum Bayar</td>';
//         } else {
//             echo  '<td style="font-size:87%;">Belum Bayar</td>';
//         }

//         if (['expired'] == false) {
//             echo  '<td style="font-size:87%;">Belum Bayar</td>';
//         } else {
//             echo  '<td style="font-size:87%;">Belum Bayar</td>';
//         }

//         if (strtotime(date("d-m-Y")) < strtotime($KK['expired'])) {
//             echo '<td><span class="badge bg-success">' . "Active" . '</span></td>';
//         } else {
//             echo  '<td style="font-size:87%;">Belum Bayar</td>';
//         }
//     }

// if ($KK['tarikh_daftar']) {
//     echo  '<td style="font-size:87%;">' . date('d-m-Y', strtotime($KK['tarikh_bayar'])) . '</td>';
// } else {
//     echo  '<td style="font-size:87%;">Belum Bayar</td>';
// }
//}


// if (strtotime(date("d-m-Y")) < strtotime($row->expired)) {
//     echo '<td><span class="badge bg-success">' . "Active" . '</span></td>';
// } else {
//     echo '<td><span class="badge bg-danger">' . "Expired" . '</span></td>';
// }

?>