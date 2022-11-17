<?php
include_once 'database/connect.php';
session_start();

if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}

include_once 'header.php';

error_reporting(0);

$user_id = $_GET['user_id'];

$delete = $pdo->prepare("DELETE FROM tbl_user WHERE user_id=" . $user_id);

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
}

if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    //hashing pass
    $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    $user_id = $_SESSION['user_id'];

    if (isset($_POST['user_email'])) {
        $select = $pdo->prepare("SELECT user_email FROM tbl_user WHERE user_id='$user_id' ");
        $select->execute();

        if ($select->rowCount() > 0) {
            echo '<script type="text/javascript">
            jQuery(function validation() {
                swal({
                    title: "Emel sudah terdaftar",
                    icon: "warning",
                    button: "Ok",
                  });
            });
            </script>';
        } else {
            $insert = $pdo->prepare("INSERT INTO tbl_user(username, user_email, password, role) VALUES(:username,:user_email,:password,:role)");

            $insert->bindParam(':username', $username);
            $insert->bindParam(':user_email', $user_email);
            $insert->bindParam(':password', $password);
            $insert->bindParam(':role', $role);

            if ($insert->execute()) {
                echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Berjaya Daftar",
                        icon: "success",
                        button: "Ok",
                      });
                });
                </script>';
            } else {
                echo '<script type="text/javascript">
                jQuery(function validation() {
                    swal({
                        title: "Gagal Daftar",
                        icon: "error",
                        button: "Ok",
                      });
                });
                </script>';
            }
        }
    }
}
?>

<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Admin</h3>
                        </div>
                        <form action="" method="POST">
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputUsername">Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Emel</label>
                                        <input type="email" name="user_email" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Kata Laluan</label>
                                        <input type="password" name="password" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                    </div>
                                    <div class="form-group">
                                        <!-- <label>Role</label> -->
                                        <select class="form-control" name="role" id="" hidden>
                                            <!-- <option value="" disabled selected>Select Role</option> -->
                                            <!-- <option value="User">User</option> -->
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                    <input class="btn btn-primary" type="submit" name="create_user" value="Daftar">
                                </div>

                            </div>
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <!-- <thead> -->
                                    <!-- <tr>
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>PASSWORD</th>
                                            <th>ROLE</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <?php
                                        // $select = $pdo->prepare("SELECT * FROM tbl_user ORDER BY user_id DESC");
                                        // $select->execute();
                                        // while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        // echo '
                                        // <tr>
                                        // <td>' . $row->user_id . '</td>
                                        // <td>' . $row->username . '</td>
                                        // <td>' . $row->user_email . '</td>
                                        // <td>' . $row->password . '</td>
                                        // <td>' . $row->role . '</td>
                                        // <td>
                                        //     <a href="registration.php?user_id=' . $row->user_id . '" class="btn btn-danger">
                                        //         <span class="glyphicon glyphicon-print"></span> Padam
                                        //     </a>
                                        // </td>

                                        // </tr>
                                        // ';
                                        // }

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


<?php
include_once 'footer.php';
?>