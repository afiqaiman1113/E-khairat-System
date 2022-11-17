<?php
include_once 'admin/database/connect.php';
// session_start();
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "") {
    header('Location: index.php');
}
?>

<?php
$select = $pdo->prepare("SELECT * FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE penama.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$penama_id = $row['penama_id'];


if ($penama_id == false) {
    echo '<script type="text/javascript">
                    jQuery(function validation() {
                        swal({
                            title: "Sila Isi Maklumat Penama",
                            icon: "error",
                            button: "Ok",
                        }).then(function() {
                            window.location = "tnc.php?kariah_id=' . $_SESSION['kariah_id'] . '";
                        });
                    });
                </script>';
} else {
?>
    <br>
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
                                <table id="tableCategories" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="d-md-none d-sm-table-cell" style="font-size:90%;">Butiran</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">Penama</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">No K/P</th>
                                            <th class="d-none d-md-table-cell" style="font-size:90%;">No Tel</th>
                                            <th class="d-none d-md-table-cell" width="25%" style="font-size:90%;">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE status_id = 1 AND khairat_kematian.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        //$select = $pdo->prepare("SELECT * FROM ahli_kariah INNER JOIN tuntut ON ahli_kariah.kariah_id = tuntut.kariah_id WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        $select = $pdo->prepare("SELECT *, UPPER(penama_name) AS penama_name FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        ?>
                                            <tr>
                                                <td class="d-md-none d-sm-table-cell">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <br><b>Penama: <?php echo $row->penama_name; ?></b><br><br><b>No K/P: <?php echo $row->penama_ic; ?><br><br><b>No Tel: <?php echo $row->penama_no; ?><br><br><a href="#edit_<?php echo $row->penama_id; ?>" class="btn btn-xs btn-info view_data" data-toggle="modal">Lihat Butiran</a>&nbsp;<a href="#edi_<?php echo $row->penama_id; ?>" class="btn btn-xs btn-warning view_data" data-toggle="modal">Kemaskini</a>
                                                        </div>
                                                    </div><br>
                                                </td>
                                                <td class="d-none d-md-table-cell" width="30%" style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->penama_name; ?></td>
                                                <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo $row->penama_ic; ?></td>
                                                <td class="d-none d-md-table-cell" style="font-size:87%;"><?php echo $row->penama_no; ?></td>
                                                <td class="d-none d-md-table-cell">
                                                    <a href="#edit_<?php echo $row->penama_id; ?>" class="btn btn-sm btn-info view_data" data-toggle="modal">Lihat Butiran</a>
                                                    <a href="#edi_<?php echo $row->penama_id; ?>" class="btn btn-sm btn-warning view_data" data-toggle="modal">Kemaskini</a>
                                                </td>
                                                <?php include('edit_modal.php'); ?>
                                            </tr>
                                        <?php
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

<!-- Content Wrapper. Contains page content -->


<script>
    $(document).ready(function() {

        $('#tableCategories').DataTable({
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
            var masks = ["A00000000000", '000000-00-0000'];
            var options = {
                onKeyPress: function(cep, e, field, options) {
                    var mask = (cep.length == 12) ? masks[1] : masks[0];
                    $('#penama_ic').mask(mask, options);
                }
            };

            $('#penama_ic').mask(masks[0], options);
        });

    });

    $(document).off('focusin.modal');

    function InvalidPhonePenama(textbox) {

        if (textbox.value == '') {
            textbox.setCustomValidity('Wajib isi');
        } else if (textbox.validity.patternMismatch) {
            textbox.setCustomValidity('Isi format yang betul');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
</script>

<?php
// include_once 'footer.php';
?>