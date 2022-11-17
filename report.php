<?php

// error_reporting();
include 'vendor/autoload.php';

include_once 'admin/database/connect.php';
session_start();

if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: admin/index.php');
}

include_once 'admin/header.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;

$select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_id DESC");
$select->execute();
$result = $select->fetchAll();

if(isset($_POST["export"]))
{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'Product Name');
  $active_sheet->setCellValue('B1', 'Product Caetgory');
  $active_sheet->setCellValue('C1', 'Purchase Price');
  $active_sheet->setCellValue('D1', 'Sale Price');
  $active_sheet->setCellValue('E1', 'Product Stock');
  $active_sheet->setCellValue('F1', 'Product Description');

  $count = 2;

  foreach($result as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["product_name"]);
    $active_sheet->setCellValue('B' . $count, $row["product_category"]);
    $active_sheet->setCellValue('C' . $count, $row["purchase_price"]);
    $active_sheet->setCellValue('D' . $count, $row["sale_price"]);
    $active_sheet->setCellValue('E' . $count, $row["product_stock"]);
    $active_sheet->setCellValue('F' . $count, $row["product_description"]);

    $count = $count + 1;
  }

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

  $file_name = time() . '.' . strtolower($_POST["file_type"]);

  $writer->save($file_name);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"".$file_name."\"");

  readfile($file_name);

  unlink($file_name);

  exit;

}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Muat Turun Semua Ahli</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <form method="post">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">User Data</div>
                                <div class="col-md-2">
                                    <select name="file_type" class="form-control input-sm">
                                        <option value="Xlsx">Xlsx</option>
                                        <option value="Xls">Xls</option>
                                        <option value="Csv">Csv</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" name="export" class="btn btn-success btn-sm" value="Export" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Purchase Price</th>
                                            <th>Sale Price</th>
                                            <th>Stock</th>
                                            <th>Description</th>
                                            <th>Image</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_id DESC");
                                        $select->execute();
                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                            <tr>
                                                <td>' . $i . '</td>
                                                <td>' . $row->product_name . '</td>
                                                <td>' . $row->product_category . '</td>
                                                <td>' . $row->purchase_price . '</td>
                                                <td>' . $row->sale_price . '</td>
                                                <td>' . $row->product_stock . '</td>
                                                <td>' . $row->product_description . '</td>
                                                <td><img src = "productimages/' . $row->product_image . '" class="img-rounded" width="40px" height="40px"/></td>
                                                
                                               
                                             

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


<script>
    $(document).ready(function() {
        $('.btndelete').on('click', function() {
            var tdh = $(this);
            var id = $(this).attr("id");

            swal({
                    title: "Are you sure?",
                    // text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'admin/productdelete.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr').hide();
                            }
                        })
                        swal("Delete Successful", {
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
include_once 'admin/footer.php';
?>