<?php
include_once 'database/db.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once '../header_user.php';
}

if (isset($_POST['btn_update_pass'])) {

    $user_id = $_SESSION['user_id'];

    // $user_id = $_POST['user_id'];

    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];

    $query_password = "SELECT password FROM tbl_user WHERE user_id = '$user_id' ";
    $get_user_query = mysqli_query($conn, $query_password);

    $row = mysqli_fetch_array($get_user_query);

    $db_user_password = $row['password'];

    if ($password == $confirm_pass) {

        if ($db_user_password != $password) {
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        }

        $query = "UPDATE tbl_user SET password = '$password' WHERE user_id = '$user_id' ";
        $edit_user_query = mysqli_query($conn, $query);

        echo '<script type="text/javascript">
        jQuery(function validation(){
        swal({
          title: "Kemaskini Berjaya",
          icon: "success",
          button: "Ok",
        });
        });
        </script>';
    } else {
        echo '<script type="text/javascript">
    jQuery(function validation(){
    swal({
      title: "Kata Laluan Tak Sama",
      icon: "error",
      button: "Ok",
    });
    });
    </script>';
    }
}


?>
<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="card card-primary">
            <form role="form" action="" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="card-body">
                        <!-- <div class="form-group">
                            <label for="exampleInputPassword1">Kata laluan sedia ada</label>
                            <input type="password" class="form-control" name="old_pass" placeholder="Password" required>
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kata Laluan Baru</label>
                            <input type="password" class="form-control" name="password" placeholder="Kata Laluan" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Sahkan Kata Laluan Baru</label>
                            <input type="password" class="form-control" name="confirm_pass" placeholder="Sahkan Kata Laluan" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="btn_update_pass">Kemaskini</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?php
include_once 'footer.php';
?>