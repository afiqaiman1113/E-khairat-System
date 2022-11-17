<?php

include '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include_once 'database/connect.php';
session_start();

if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

//$query = "SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id";
//$query = "SELECT DISTINCT khairat_kematian.khairat_name, ahli_kariah.no_ahli, khairat_kematian.khairat_ic, khairat_kematian.tarikh_bayar, khairat_kematian.kawasan FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE status_id = 1 ";
$query = "SELECT DISTINCT ahli_kariah.kariah_name, ahli_kariah.no_ahli, ahli_kariah.kariah_ic, ahli_kariah.kawasan, tarikh_bayar FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.approvement = 'Telah Daftar' GROUP BY khairat_kematian.kariah_id";

$statement = $pdo->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

if (isset($_POST["export"])) {
    $file = new Spreadsheet();

    $active_sheet = $file->getActiveSheet();

    $active_sheet->setCellValue('A1', 'No Ahli');
    $active_sheet->setCellValue('B1', 'Nama');
    $active_sheet->setCellValue('C1', 'No Kad Pengenalan');
    $active_sheet->setCellValue('D1', 'Kariah');
    $active_sheet->setCellValue('E1', 'Tarikh Daftar');

    $count = 2;

    foreach ($result as $row) {
        $active_sheet->setCellValue('A' . $count, $row["no_ahli"]);
        $active_sheet->setCellValue('B' . $count, strtoupper($row["kariah_name"]));
        $active_sheet->setCellValue('C' . $count, $row["kariah_ic"]);
        $active_sheet->setCellValue('D' . $count, $row["kawasan"]);
        $active_sheet->setCellValue('E' . $count, date('d-m-Y', strtotime($row["tarikh_bayar"])));

        $count = $count + 1;
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

    $file_name = time() . '.' . strtolower($_POST["file_type"]);

    $writer->save($file_name);

    header('Content-Type: application/x-www-form-urlencoded');

    header('Content-Transfer-Encoding: Binary');

    header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

    readfile($file_name);

    unlink($file_name);

    exit;
}

include_once 'header.php';

?>
<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9">Laporan Ahli Khairat Kematian</div>
                                    <div class="col-md-2">
                                        <select name="file_type" class="form-control input-sm" hidden>
                                            <option value="Xlsx">Xlsx</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="submit" name="export" class="btn btn-success btn-sm" value="Muat Turun" />
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div style="overflow-x: auto;">
                                    <table id="producttable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="font-size:90%;" width="5%">No</th>
                                                <th style="font-size:90%;">No Ahli</th>
                                                <th style="font-size:90%;">Nama</th>
                                                <th style="font-size:90%;">No K/P</th>
                                                <th style="font-size:90%;">Kariah</th>
                                                <th style="font-size:90%;">Tarikh Daftar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php

                                            //$select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE status_id = 1 AND product_name = 'Yuran Pendaftaran' ORDER BY khairat_id ASC ");
                                            //$select = $pdo->prepare("SELECT DISTINCT khairat_kematian.khairat_name, ahli_kariah.no_ahli, khairat_kematian.khairat_ic, tarikh_bayar, khairat_kematian.kawasan FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id GROUP BY khairat_kematian.kariah_id");
                                            $select = $pdo->prepare("SELECT DISTINCT ahli_kariah.kariah_name, ahli_kariah.no_ahli, ahli_kariah.kariah_ic, ahli_kariah.kawasan, tarikh_bayar FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id WHERE ahli_kariah.approvement = 'Telah Daftar' GROUP BY khairat_kematian.kariah_id");
                                            //$select = $pdo->prepare("SELECT DISTINCT ahli_kariah.kariah_name, ahli_kariah.no_ahli, ahli_kariah.kariah_ic, ahli_kariah.kawasan, khairat_kematian.tarikh_bayar FROM ahli_kariah INNER JOIN khairat_kematian ON ahli_kariah.kariah_id = khairat_kematian.kariah_id WHERE ahli_kariah.approvement = 'Telah Daftar' ");
                                            //$select = $pdo->prepare("SELECT DISTINCT ahli_kariah.* FROM ahli_kariah LEFT JOIN khairat_kematian ON ahli_kariah.kariah_id = khairat_kematian.kariah_id WHERE ahli_kariah.approvement = 'Telah Daftar'  ");
                                            //konsep distinct digunakan untuk taknak bg duplicate id dipaparkan
                                            //$select = $pdo->prepare("SELECT tbl_tanggung.nama, ahli_kariah.kawasan, tuntut_tanggungan.tarikh_mati, tuntut_tanggungan.tarikh_tuntut, ahli_kariah.kariah_name, tuntut_tanggungan.t_tanggunghubungan, tuntut_tanggungan.jumlah FROM tuntut_tanggungan INNER JOIN tbl_tanggung ON tuntut_tanggungan.kariah_id = tbl_tanggung.kariah_id  INNER JOIN ahli_kariah ON tuntut_tanggungan.kariah_id = ahli_kariah.kariah_id WHERE tbl_tanggung.mati_tanggung = 'ya' ");
                                            $select->execute();

                                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                                echo '
                                             <tr>
                                            <td>' . $i . '</td>
                                            <td style="font-size:87%;">' . $row->no_ahli . '</td>
                                            <td style="font-size:87%;"><span style="text-transform:uppercase">' . $row->kariah_name . '</td>
                                            <td style="font-size:87%;">' . $row->kariah_ic . '</td>
                                            <td style="font-size:87%;">' . $row->kawasan . '</td>
                                            <td style="font-size:87%;">' . date('d-m-Y', strtotime($row->tarikh_bayar)) . '</td>
                                            ';
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </form>
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
</script>

<?php
include_once 'footer.php';
?>