<?php
include_once 'admin/database/db.php';
// session_start();
if ($_SESSION['kariah_id'] == "") {
    header('Location: index.php');
}

// if ($_SESSION['role'] == "Admin") {
//     include_once 'header.php';
// } else {
//     include_once 'header_user.php';
// }


if (isset($_POST['btn_update_pass'])) {

    $kariah_id = $_SESSION['kariah_id'];

    // $user_id = $_POST['user_id'];

    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];

    $query_password = "SELECT password FROM ahli_kariah WHERE kariah_id = '$kariah_id' ";
    $get_user_query = mysqli_query($conn, $query_password);

    $row = mysqli_fetch_array($get_user_query);

    $db_user_password = $row['password'];

    if ($password == $confirm_pass) {

        if ($db_user_password != $password) {
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        }

        $query = "UPDATE ahli_kariah SET password = '$password' WHERE kariah_id = '$kariah_id' ";
        $edit_user_query = mysqli_query($conn, $query);

        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kemaskini Berjaya",
                icon: "success",
                button: "Ok",
              }).then(function() {
                window.location = "user.php?p=utama";
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
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card">
                        <form role="form" action="" method="POST">
                            <div class="card-body">
                                <!-- <div class="form-group">
                                    <label for="exampleInputPassword1">Kata laluan sedia ada</label>
                                    <input type="password" class="form-control" name="old_pass" placeholder="Password" required>
                                </div> -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kata laluan baru</label>
                                    <input type="password" class="form-control" name="password" placeholder="Kata Laluan" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Sahkan kata laluan baru</label>
                                    <input type="password" class="form-control" name="confirm_pass" placeholder="Kata Laluan" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="btn_update_pass">Kemaskini</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
// include_once 'admin/footer.php';
?>