<?php
include_once 'admin/database/db.php';
// session_start();

if ($_SESSION['kariah_ic'] == "") {
    header('Location: index.php');
}

// if ($_SESSION['role'] == "Admin") {
//     include_once 'header.php';
// } else {
//     include_once 'header_user.php';
// }

if (isset($_SESSION['kariah_ic'])) {
    $kariah_ic = $_SESSION['kariah_ic'];
    $query = "SELECT * FROM ahli_kariah WHERE kariah_ic = '{$kariah_ic}' ";
    $select_profile = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($select_profile)) {
        $kariah_id = $row['kariah_id'];
        $kariah_name = $row['kariah_name'];
        $kariah_ic = $row['kariah_ic'];
        $user_email = $row['user_email'];
        $password = $row['password'];
        $role = $row['role'];
    }
}

if (isset($_POST['btn_update_profile'])) {

    // $user_id = $_POST['user_id'];
    $kariah_name = $_POST['kariah_name'];
    // $user_email = $_POST['user_email'];

    // $query = "SELECT user_email FROM ahli_kariah WHERE user_email = '$user_email' ";
    // $mysqli_query = mysqli_query($conn, $query);

    // if (mysqli_num_rows($mysqli_query) > 0) {
    //     echo '<script type="text/javascript">
    //     jQuery(function validation() {
    //         swal({
    //             title: "Email dah terdaftar",
    //             icon: "warning",
    //             button: "Ok",
    //           });
    //     });
    //     </script>';
    //} //else {

    // $user_email = $_SESSION['user_email'];
    $query = "UPDATE ahli_kariah SET kariah_name = '$kariah_name' , user_email = '$user_email' WHERE kariah_ic = '$kariah_ic' ";

    $edit_query = mysqli_query($conn, $query);

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo '<script type="text/javascript">
        jQuery(function validation(){
            swal({
                title: "Format Emel Salah!",
                icon: "error",
                button: "Ok",
            });
        });
        </script>';
    } else {
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
    }
    //}
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
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama</label>
                                    <!-- <input type="hidden" name="user_id" class="form-control" placeholder="Enter Category" /> -->
                                    <input type="text" class="form-control" style="text-transform: uppercase" value="<?php echo $kariah_name; ?>" name="kariah_name" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Emel</label>
                                    <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="btn_update_profile">Kemaskini</button>
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