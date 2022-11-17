<?php
include_once 'database/db.php';
session_start();

if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM tbl_user WHERE user_id = '{$user_id}' ";
    $select_profile = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($select_profile)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $password = $row['password'];
        $role = $row['role'];
    }
}

if (isset($_POST['btn_update_profile'])) {

    // $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];

    $user_id = $_SESSION['user_id'];
    $query = "UPDATE tbl_user SET username = '$username' , user_email = '$user_email' WHERE user_id = '$user_id' ";

    $edit_query = mysqli_query($conn, $query);

    if ($edit_query) {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kemaskini Berjaya",
                icon: "success",
                button: "Ok",
              });
        });
        </script>';
    } else {
        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kemaskini Gagal",
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
            <form role="form" action="" method="post">

                <div class="col-md-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Username</label>
                            <!-- <input type="hidden" name="user_id" class="form-control" placeholder="Enter Category" /> -->
                            <input type="text" class="form-control" value="<?php echo $username; ?>" name="username" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Emel</label>
                            <input type="text" class="form-control" value="<?php echo $user_email; ?>" name="user_email" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="btn_update_profile">Kemaskini</button>
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