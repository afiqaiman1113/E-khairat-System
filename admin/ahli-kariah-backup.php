<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    '';
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
                            <h3 class="card-title">Senarai Ahli Anak Kariah</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">No Ahli</th>
                                            <th style="font-size:90%;">Nama</th>
                                            <th style="font-size:90%;">No K/P</th>
                                            <th style="font-size:90%;">Kariah</th>
                                            <th style="font-size:90%;">Tarikh Daftar</th>
                                            <th style="font-size:90%;">Status K.Kematian</th>
                                            <th style="font-size:90%;">Semak</th>
                                            <th style="font-size:90%;">Padam</th>
                                            <th style="font-size:90%;">Bayar (CASH)</th>
                                            <th style="font-size:90%;">Tuntut Ahli</th>
                                            <th style="font-size:90%;">Tuntut Tanggungan</th>
                                            <th style="font-size:90%;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM ahli_kariah ORDER BY kariah_id DESC");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                            <tr>
                                            <td style="font-size:87%;">' . $row->no_ahli . '</td>
                                            <td style="font-size:87%;"><span style="text-transform:uppercase">' . $row->kariah_name . '</td>
                                            <td style="font-size:87%;">' . $row->kariah_ic . '</td>
                                            <td style="font-size:87%;">' . $row->kawasan . '</td>
                                            <td style="font-size:87%;">' . date('d-m-Y', strtotime($row->tarikh_daftar)) . '</td>
                                            ';

                                            if ($row->approvement == "Telah Daftar") {
                                                echo '<td><span class="badge bg-success">' . $row->approvement . '</span></td>';
                                            } elseif ($row->approvement == "Digantung") {
                                                echo '<td><span class="badge bg-warning">' . $row->approvement . '</span></td>';
                                            } else {
                                                echo '<td><span class="badge bg-info">' . $row->approvement . '</span></td>';
                                            }

                                            echo '
                                            <td>
                                                <a href="semak-ahli-kariah.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" id=' . $row->kariah_id . ' class="btn btn-sm btn-danger btndelete"><span class="fas fa-trash"></span></button>
                                            </td>
                                            <td>
                                                <a href="bayar-tunai-najmi.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
                                                    <i class="fas fa-wallet"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tuntut.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tuntut-tanggungan.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            ';

                                            if ($row->mati == "Mati") {
                                                echo '<td><a href="semak-tuntutan.php?kariah_id=' . $row->kariah_id . '"><span class="badge bg-danger">Meninggal</span></td>';
                                            } else {
                                                echo '<td><span class="badge bg-success">Hidup</span></td>';
                                            }
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
                [0, "dsc"]
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
                            url: 'kariahdelete.php',
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