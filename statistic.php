<?php
include_once 'admin/database/connect.php';
// session_start();
if ($_SESSION['kariah_ic'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}
// if ($_SESSION['role'] == "Admin") {
//     include_once 'header.php';
// } else {
//     include_once 'header_user.php';
// }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Senarai Ahli</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="" class="table table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No K/P</th>
                                            <th>Kariah</th>
                                            <th>Tarikh Daftar</th>
                                            <th>Semak</th>
                                            <th>Padam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE ahli_kariah.kariah_ic= '" . $_SESSION['kariah_ic'] . "' ");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                            <tr>
                                            <td>' . $i . '</td>
                                            <td>' . $row->kariah_name . '</td>
                                            <td>' . $row->kariah_ic . '</td>
                                            <td>' . $row->kawasan . '</td>
                                            <td>' . date('d-m-Y', strtotime($row->tarikh_daftar)) . '</td>
                                            <td>
                                                <a href="editkariah.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" id=' . $row->kariah_id . ' class="btn btn-sm btn-danger btndelete"><span class="fas fa-trash"></span></button>
                                            </td>
                                            </tr>
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
</script>

<?php
// include_once 'admin/footer.php';
?>