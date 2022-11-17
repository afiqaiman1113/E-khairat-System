<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}

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

<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Senarai Bayaran Khairat Kematian</h3>
                            <div align="right">
                                <button class="btn btn-sm btn-info rounded-0" type="button" onclick="location.reload()"><i class="fa fa-retweet"></i> Refresh Senarai</button>
                            </div>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">No</th>
                                            <th style="font-size:90%;">Nama</th>
                                            <th style="font-size:90%;">Jenis Bayaran</th>
                                            <th style="font-size:90%;">Tarikh Bayar</th>
                                            <!-- <th style="font-size:90%;">Tarikh</th> -->
                                            <th style="font-size:90%;">Jumlah</th>
                                            <th style="font-size:90%;">Bayar</th>
                                            <th style="font-size:90%;">Baki</th>
                                            <th style="font-size:90%;">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        $select = $pdo->prepare("SELECT khairat_kematian.*, ahli_kariah.*
                                        FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id INNER JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id = 1 ORDER BY khairat_id DESC ");
                                        $select->execute();



                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            $kiraan = date('Y-m-d', strtotime($row->tarikh_bayar));
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->kariah_name; ?></td>
                                                <td style="font-size:87%;"><?php echo displayYuranName($row->product_id, $pdo) ?></td>
                                                <td style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_bayar)); ?></td>

                                                <?php
                                                // if (strtotime(date("d-m-Y")) <= strtotime($row->expired)) {
                                                //     echo '<td><span class="badge bg-success">' . "Active" . '</span></td>';
                                                // } else {
                                                //     echo '<td><span class="badge bg-danger">' . "Expired" . '</span></td>';
                                                // }
                                                ?>

                                                <td style="font-size:87%;">RM <?php echo number_format($row->total, 2); ?></td>
                                                <td style="font-size:87%;">RM <?php echo number_format($row->paid, 2); ?></td>
                                                <td style="font-size:87%;">RM <?php echo number_format($row->due, 2); ?></td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            Lanjut
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a href="#edit<?php echo $row->khairat_id; ?>"  class="dropdown-item" data-toggle="modal"><span class="fa fa-eye text-dark"></span> Lihat Butiran</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item edit_data" href="semakan-bayaran.php?khairat_id=<?php echo $row->khairat_id; ?>"><span class="fa fa-edit text-primary"></span> Kemaskini Bayaran</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item edit_data" target="_blank" href="penyata-khairat.php?khairat_id=<?php echo $row->khairat_id; ?>"><span class="fas fa-print text-warning"></span> Cetak</a>
                                                            <div class="dropdown-divider"></div>
                                                            <button type="button" id=<?php echo $row->khairat_id; ?> class="dropdown-item edit_data btndelete"><span class="fas fa-trash text-danger"></span> Padam</button>
                                                        </div>
                                                    </div>
                                                </td>

                                                <?php include('view_pembayaran_khairat.php'); ?>

                                            <?php
                                            $i++;
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
        $('#producttable').DataTable({
            "order": [
                [0, "asc"]
            ] //tutorial tu kata dia akan table dalam desc order
        });
    });
    $(document).ready(function() {
        $('#producttable').on('click', '.btndelete', function() {
            var tdh = $(this);
            var id = $(this).attr("id");

            swal({
                    title: "Anda Pasti?",
                    // text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'kkematiandelete.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr').hide();
                            }
                        })
                        swal("Berjaya padam", {
                            icon: "success",
                        });
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                });
        });
    });
</script>

<?php
include_once 'footer.php';
?>