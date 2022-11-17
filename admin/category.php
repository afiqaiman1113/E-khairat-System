<?php
include_once 'database/connect.php';
session_start();

if ($_SESSION['user_email'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

if (isset($_POST['create_category'])) {
    $category = $_POST['category'];

    if (empty($category)) {
        $error = '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Sila isi kategori",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
        echo $error;
    }

    if (!isset($error)) {
        $insert = $pdo->prepare("INSERT INTO tbl_category(category) VALUES(:category)");

        $insert->bindParam(':category', $category);

        if ($insert->execute()) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Berjaya simpan",
                    icon: "success",
                    button: "Ok",
                  });
            });
            </script>';
        }
    }
} //btn_add end here

if (isset($_POST['btn_update'])) {
    $category = $_POST['category'];
    $cat_id = $_POST['cat_id'];

    if (empty($category)) {
        $errorupdate = '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Gagal! Sila isi",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';

        echo $errorupdate;
    }

    if (!isset($errorupdate)) {
        $update = $pdo->prepare("UPDATE tbl_category SET category=:category WHERE cat_id=" . $cat_id); //pass bind param secure lagi. --> :category
        $update->bindParam(':category', $category);

        if ($update->execute()) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Berjaya kemaskini",
                    icon: "success",
                    button: "Ok",
                  });
            });
            </script>';
        } else {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Gagal dikemaskini",
                    icon: "error",
                    button: "Ok",
                  });
            });
            </script>';
        }
    }
} //btn_update end here

if (isset($_POST['btn_delete'])) {
    $delete = $pdo->prepare("DELETE FROM tbl_category WHERE cat_id=" . $_POST['btn_delete']);

    if ($delete->execute()) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Berjaya padam",
                icon: "success",
                button: "Ok",
              });
        });
        </script>';
    } else {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Gagal padam",
                icon: "error",
                button: "Ok",
              });
        });
        </script>';
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Kategori</h3>
                        </div>
                        <form action="" method="POST">
                            <?php

                            if (isset($_POST['btn_edit'])) {
                                $select = $pdo->prepare("SELECT * FROM tbl_category WHERE cat_id=" . $_POST['btn_edit']);
                                $select->execute();

                                if ($select) {
                                    $row = $select->fetch(PDO::FETCH_OBJ);
                                    echo '<div class="col-md-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputUsername">Category</label>

                                                <input type="hidden" name="cat_id" class="form-control" value="' . $row->cat_id . '" placeholder="Enter Category"/>

                                                <input type="text" name="category" class="form-control" value="' . $row->category . '" placeholder="Enter Category"/>
                                            </div>
                                            <input class="btn btn-primary" type="submit" name="btn_update" value="Update">
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<div class="col-md-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputUsername">Category</label>
                                            <input type="text" name="category" class="form-control" placeholder="Enter Category"/>
                                        </div>
                                        <input class="btn btn-primary" type="submit" name="create_category" value="Simpan">
                                    </div>
                                </div>';
                            }

                            ?>

                            <div class="col-md-8">
                                <table id="tablecategory" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>CATEGORY</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM tbl_category ORDER BY cat_id DESC");
                                        $select->execute();

                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '<tr>
                                                <td>' . $row->cat_id . '</td>
                                                <td>' . $row->category . '</td>
                                                <td>
                                                <button type="submit" value="' . $row->cat_id . '" class="btn btn-success" name="btn_edit">Edit</button>
                                                </td>
                                                <td>
                                                <button type="submit" value="' . $row->cat_id . '" class="btn btn-danger" name="btn_delete">Delete</button>
                                                </td>

                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<script>
    $(document).ready(function() {
        $('#tablecategory').DataTable();
    });
</script>

<?php
include_once 'footer.php';
?>