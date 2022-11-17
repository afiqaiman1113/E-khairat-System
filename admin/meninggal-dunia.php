<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
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
                            <h3 class="card-title">Senarai Ahli Meninggal Dunia</h3>
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
                                            <th style="font-size:90%;">Tarikh Meninggal</th>
                                            <!-- <th style="font-size:90%;">Status</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        // $select = $pdo->prepare("SELECT * FROM tuntut INNER JOIN ahli_kariah ON tuntut.kariah_id = ahli_kariah.kariah_id WHERE mati = 'Mati' ");
                                        // $select = $pdo->prepare("SELECT * FROM tuntut INNER JOIN khairat_kematian ON tuntut.kariah_id = khairat_kematian.kariah_id ORDER BY tuntut_id DESC");
                                        $select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tuntut ON ahli_kariah.kariah_id = tuntut.kariah_id ORDER BY tuntut_id DESC");
                                        // $select = $pdo->prepare("SELECT * FROM tuntut INNER JOIN ahli_kariah ON tuntut.kariah_id = ahli_kariah.kariah_id INNER JOIN khairat_kematian ON tuntut.kariah_id = khairat_kematian.kariah_id WHERE tuntut.kariah_id = $id");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                            <tr>
                                            <td style="font-size:90%;">' . $row->no_ahli . '</td>
                                            <td style="font-size:90%;"><span style="text-transform:uppercase">' . $row->tuntut_name . '</td>
                                            <td style="font-size:90%;">' . $row->tuntut_ic . '</td>
                                            <td style="font-size:90%;">' . $row->kawasan . '</td>
                                            <td style="font-size:87%;">' . date('d-m-Y', strtotime($row->tarikh_mati)) . '</td>
                                            ';

                                            // if ($row->mati == "Mati") {
                                            //     echo '<td><span class="badge bg-danger">Meninggal</span></td>';
                                            // } else {
                                            //     echo '<td><span class="badge bg-success">Aktif</span></td>';
                                            // }
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
        $('.btndelete').on('click', function() {
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

    $(document).ready(function() {
        $('.btnstatus').on('click', function() {
            var tdh = $(this);
            var id = $(this).attr("id");

            swal({
                    title: "Lulus ahli?",
                    // text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'kariahapprove.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr').hide();
                            }
                        })
                        swal("Berjaya", {
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