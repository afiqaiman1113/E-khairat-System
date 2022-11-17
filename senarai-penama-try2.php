<?php
include_once 'admin/database/connect.php';
// session_start();
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}

include_once 'header-test.php';

$select = $pdo->prepare("SELECT * FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE penama.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$penama_id = $row['penama_id'];
$kariah_id = $_SESSION['kariah_id'];

if (isset($_POST['btn_simpan_penama'])) {

    $penama_name = $_POST['penama_name'];
    $penama_ic = $_POST['penama_ic'];
    $penama_no = $_POST['penama_no'];
    $penama_pass = substr($_POST['penama_ic'], 0, 6);
    $penama_pass = password_hash($penama_pass, PASSWORD_BCRYPT, array("cost" => 12));

    if (isset($_POST['penama_ic'])) {

        $ic = $pdo->prepare("SELECT kariah_ic FROM penama WHERE penama_ic='$penama_ic'");
        $ic->execute();

        if ($ic->rowCount() > 0) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "No K/P Penama telah berdaftar",
                    icon: "warning",
                    button: "Ok",
                  });
            });
            </script>';
        } else {

            // $kariah_id = $pdo->lastInsertId();
            // if ($kariah_id != null) {

            //table penama
            $insert = $pdo->prepare("INSERT INTO penama(kariah_id, penama_name, penama_ic, penama_no, penama_pass)
                VALUES(:kariah_id, :penama_name, :penama_ic, :penama_no, :penama_pass)");

            $insert->bindParam(':kariah_id', $kariah_id);
            $insert->bindParam(':penama_name', $penama_name);
            $insert->bindParam(':penama_ic', $penama_ic);
            $insert->bindParam(':penama_no', $penama_no);
            $insert->bindParam(':penama_pass', $penama_pass);
            $insert->execute();

            if ($insert->execute()) {
                echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Pendaftaran Berjaya",
                            icon: "success",
                            button: "Ok",
                          }).then(function() {
                              window.location = "user.php?p=utama";
                          });
                    });
                    </script>';
                // header('refresh:2;kariahlist.php');
            } else {
                echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Pendaftaran Gagal",
                            icon: "error",
                            button: "Ok",
                          });
                    });
                    </script>';
            }

            // $activity = "ahli {$kariah_name} berjaya didaftarkan";
            // $time_loged = date("Y-m-d H:i:s", strtotime("now"));
            // $stmt = $pdo->prepare("INSERT INTO logs(user_id, activity, time_loged)VALUES(?, ?, ?)");
            // $stmt->bindParam(1, $_SESSION['user_id']);
            // $stmt->bindParam(2, $activity);
            // $stmt->bindParam(3, $time_loged);
            // $stmt->execute();
            //}
        }
    }
}
if ($_SESSION['role'] == "User") {
    include_once 'header-test.php';
} else {
    include_once 'headerphp';
}
?>

<?php
if ($penama_id == false) {
?>

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Butiran Penama Khairat Kematian</h3>
                                <input type="text" name="penama_id" class="form-control" value="<?php echo $kariah_id;
                                                                                                ?>" />
                            </div>

                            <form role="form" action="" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nama</label>
                                        <!-- <input type="hidden" name="user_id" class="form-control" placeholder="Enter Category" /> -->
                                        <input type="text" class="form-control" onKeyUP="this.value = this.value.toUpperCase();" name="penama_name" placeholder="Nama Penama" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">No Kad Pengenalan</label>
                                        <input type="text" class="form-control" name="penama_ic" id="penama_ic" placeholder="xxxxxx-xx-xxxx" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">No Tel</label>
                                        <input type="number" class="form-control" name="penama_no" placeholder="xxx-xxxxxxx" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="btn_simpan_penama">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
<?php
} else {
?>

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Penama Khairat Kematian</h3>
                                <input type="hidden" name="penama_id" class="form-control" value="<?php echo $penama_id; ?>" />
                            </div> <br>

                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table">
                                    <thead>
                                        <tr>
                                            <th class="d-md-none d-sm-table-cell" style="font-size:90%;">Butiran</th>

                                            <th class="d-none d-md-table-cell" style="font-size:90%;">Penama</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">No K/P</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">No Tel</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        //$select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tuntut ON ahli_kariah.kariah_id = tuntut.kariah_id WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        $select = $pdo->prepare("SELECT *, UPPER(penama_name) AS penama_name FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                <tr>
                                    <td class="d-md-none d-sm-table-cell">
                                        <div class="row">
                                            <div class="col-12">
                                                <br><b>Penama: ' . $row->penama_name . '</b><br><br><b>No K/P: ' . $row->penama_ic . '<br><br><b>No Tel: ' . $row->penama_no . '
                                            </div>


                                        </div><br>
                                    </td>

                                    <td class="d-none d-md-table-cell" style="font-size:87%;"><span style="text-transform:uppercase">' . $row->penama_name . '</td>
                                    <td class="d-none d-md-table-cell" style="font-size:87%;">' . $row->penama_ic . '</td>
                                    <td class="d-none d-md-table-cell" style="font-size:87%;">' . $row->penama_no . '</td>

                                ';

                                            // <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->total, 2) . '</td>
                                            //     <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->paid, 2) . '</td>
                                            //     <td class="d-none d-md-table-cell" style="font-size:87%;">RM ' . number_format($row->due, 2) . '</td>




                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
<?php
}

?>


<script>
    $(document).ready(function() {

        $('#producttable').DataTable({
            "order": [
                [0, "asc"]
            ],
            pageLength: 2,
            lengthMenu: [
                [2],
                [2]
            ],
            "lengthChange": false,
            "bFilter": false,
            "bInfo": false
        });

        // $('#producttable').DataTable({
        //     pageLength: 5,
        //     lengthMenu: [
        //         [5, 10, 20, -1],
        //         [5, 10, 20, 'Todos']
        //     ]
        // })

        $(document).ready(function() {
            $('#penama_ic').mask('000000-00-0000');
        });

    });
</script>

<?php
// include_once 'footer.php';
?>