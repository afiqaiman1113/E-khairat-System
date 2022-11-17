<?php
include_once '../admin/database/db.php';
// session_start();
if ($_SESSION['penama_id'] == "") {
    header('Location: index.php');
}

// if ($_SESSION['role'] == "Admin") {
//     include_once 'header.php';
// } else {
//     include_once 'header_user.php';
// }


if (isset($_POST['btn_update_pass'])) {

    $penama_id = $_SESSION['penama_id'];

    // $user_id = $_POST['user_id'];

    $penama_pass = $_POST['penama_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    $query_password = "SELECT penama_pass FROM penama WHERE penama_id = '$penama_id' ";
    $get_user_query = mysqli_query($conn, $query_password);

    $row = mysqli_fetch_array($get_user_query);

    $db_user_password = $row['penama_pass'];

    if ($penama_pass == $confirm_pass) {

        if ($db_user_password != $penama_pass) {
            $penama_pass = password_hash($penama_pass, PASSWORD_BCRYPT, array('cost' => 12));
        }

        $query = "UPDATE penama SET penama_pass = '$penama_pass' WHERE penama_id = '$penama_id' ";
        $edit_user_query = mysqli_query($conn, $query);

        echo '<script type="text/javascript">
        jQuery(function validation() {
            swal({
                title: "Kemaskini Berjaya",
                icon: "success",
                button: "Ok",
              }).then(function() {
                window.location = "penama.php?p=utama1";
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
                                    <input type="password" class="form-control" name="penama_pass" placeholder="Kata Laluan" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Sahkan kata laluan</label>
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