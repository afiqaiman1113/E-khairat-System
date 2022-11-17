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

include_once 'header-test.php';

if (isset($_SESSION['penama_id'])) {
    $penama_id = $_SESSION['penama_id'];
    $query = "SELECT * FROM penama WHERE penama_id = '{$penama_id}' ";
    $select_profile = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($select_profile)) {
        $penama_id = $row['penama_id'];
        $penama_name = $row['penama_name'];
        // $penama_ic = $row['penama_ic'];
        $penama_email = $row['penama_email'];
        // $penama_pass = $row['penama_pass'];
        // $role = $row['role'];
    }
}

if (isset($_POST['btn_update_profile'])) {

    // $user_id = $_POST['user_id'];
    $penama_name = $_POST['penama_name'];
    // $penama_ic = $_POST['penama_ic'];
    $penama_no = $_POST['penama_no'];
    $penama_email = $_POST['penama_email'];
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
    $query = "UPDATE penama SET penama_name = '$penama_name' , penama_no = '$penama_no', penama_email = '$penama_email' WHERE penama_id = '$penama_id' ";

    $edit_query = mysqli_query($conn, $query);

    if (!filter_var($penama_email, FILTER_VALIDATE_EMAIL)) {
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
                window.location = "penama.php?p=utama1";
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
                                    <input type="text" class="form-control" style="text-transform: uppercase" value="<?php echo $penama_name; ?>" name="penama_name" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">No Kad Pengenalan</label>
                                    <input type="text" class="form-control" value="<?php echo $penama_ic; ?>" name="penama_ic" id="penama_ic" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">No Tel</label>
                                    <input type="text" name="penama_no" id="penama_no" class="form-control" value="<?php echo $penama_no; ?>" placeholder="Tiada Dash (-)" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhone(this);" oninput="InvalidPhone(this);" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Emel</label>
                                    <input type="email" name="penama_email" id="penama_email" class="form-control" value="<?php echo $penama_email; ?>" placeholder="" required="required" oninvalid="InvalidMsg(this);" />
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

<script>
    $(document).ready(function() {
        var masks = ["A00000000000", '000000-00-0000'];
        var options = {
            onKeyPress: function(cep, e, field, options) {
                var mask = (cep.length == 12) ? masks[1] : masks[0];
                $('#penama_ic').mask(mask, options);
            }
        };

        $('#penama_ic').mask(masks[1], options);
    });
</script>

<?php
// include_once 'admin/footer.php';
?>