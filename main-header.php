<?php
include_once 'admin/database/connect.php';
if ($_SESSION['kariah_id'] == "" or $_SESSION['role'] == "Admin") {
    header('Location: index.php');
}

$select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);
?>

<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">

        <a href="user.php?p=utama" class="logo">
            <img src="admin/dist/img/logo.png" alt="navbar brand" class="navbar-brand" width="27%">
            <!-- <img src="admin/dist/img/logo.png" class="brand-image img-circle elevation-3" style="opacity: 0.8" /> -->
            <span class="brand-text font-weight-light"></span><span class="h4 text-white">Al-Wustha</span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark2">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="btn btn-sm btn-success" href="tel:04-468 0301" aria-expanded="false">
                        <i class="fas fa-phone"></i><span class="h4"> Hubungi</span>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="img/user.png" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">

                                    <div class="u-text">
                                        <h4 style="text-transform: uppercase"><?php echo $row->kariah_name; ?></h4>
                                        <p class="text-muted"><?php echo $row->user_email; ?></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <!-- <a class="dropdown-item" href="index.php?p=profile">Profil pengguna</a> -->
                                <a class="dropdown-item" href="user.php?p=member">Tukar Kata Laluan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Log Keluar</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>