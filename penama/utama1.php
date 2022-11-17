<?php
include_once '../admin/database/connect.php';
// session_start();
if ($_SESSION['penama_id'] == "") {
    header('Location: index.php');
}
error_reporting(0);

// $id = $_GET['kariah_id'];
$select = $pdo->prepare("SELECT * FROM penama WHERE penama_id = '" . $_SESSION['penama_id'] . "' ");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$penama_name = $row['penama_name'];
$penama_ic = $row['penama_ic'];
$penama_no = $row['penama_no'];

?>

<br>
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
                            $select = $pdo->prepare("SELECT * FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE penama_id= '" . $_SESSION['penama_id'] . "' ");
                            $select->execute();
                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                echo '
                                <dl class="row">
                                <dt class="col-sm-4">Nama Ahli</dt>
                                <dd class="col-sm-8"><span style="text-transform:uppercase">' . $row->penama_name . '</dd>

                                    <dt class="col-sm-4">No Kad Pengenalan</dt>
                                    <dd class="col-sm-8">' . $row->penama_ic . '</dd>
                                    <dt class="col-sm-4">No Tel</dt>
                                    <dd class="col-sm-8">' . $row->penama_no . '</dd>
                                    <dt class="col-sm-4">Waris</dt>
                                    <dd class="col-sm-8"><span style="text-transform:uppercase">' . $row->kariah_name . '</dd>
                                    <br><br>

                                    ';

                                echo '</dl>';
                            }

                            ?>
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
            ]
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
            ]
        });
    });
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