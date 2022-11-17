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
                            <h3 class="card-title">Transaksi Gagal</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">No</th>
                                            <th style="font-size:90%;">Nama</th>
                                            <th style="font-size:90%;">No K/P</th>
                                            <th style="font-size:90%;">Kariah</th>
                                            <th style="font-size:90%;">Tarikh Bayar</th>
                                            <th style="font-size:90%;">Jumlah</th>
                                            <th style="font-size:90%;">Bayar</th>
                                            <th style="font-size:90%;">Status Transaksi</th>
                                            <th style="font-size:90%;">Cara Bayar</th>
                                            <th style="font-size:90%;">Padam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id IN (0,2,3) ORDER BY khairat_id DESC"); //IN digunakan untuk display dua atau lebih value id
                                        $select->execute();

                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                            <tr>
                                            <td>' . $i . '</td>
                                            <td style="font-size:87%;">' . $row->kariah_name . '</td>
                                            <td style="font-size:87%;">' . $row->kariah_ic . '</td>
                                            <td style="font-size:87%;">' . $row->kawasan . '</td>
                                            <td style="font-size:87%;">' . date('d-m-Y', strtotime($row->tarikh_bayar)) . '</td>
                                            ';

                                            echo '
                                            <td style="font-size:87%;">RM ' . number_format($row->total, 2) . '</td>
                                            <td style="font-size:87%;">RM ' . number_format($row->paid, 2) . '</td>
                                            ';

                                            if ($row->status_id == 0) {
                                                echo '<td><span class="badge bg-danger">Transaksi Gagal</span></td>';
                                            } elseif ($row->status_id == 2) {
                                                echo '<td><span class="badge bg-warning">Transaksi Pending</span></td>';
                                            } else {
                                                echo '<td><span class="badge bg-danger">Transaksi Gagal</span></td>';
                                            }

                                            if ($row->p_method == "CASH") {
                                                echo '<td><span class="badge bg-success">' . $row->p_method . '</span></td>';
                                            } else {
                                                echo '<td><span class="badge bg-info">' . $row->p_method . '</span></td>';
                                            }

                                            echo '
                                            <td>
                                                <button type="button" id=' . $row->khairat_id . ' class="btn btn-sm btn-danger btndelete"><span class="fas fa-trash"></span></button>
                                            </td>
                                            ';
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