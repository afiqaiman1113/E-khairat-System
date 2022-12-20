<?php
include_once 'admin/database/connect.php';

?>

<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">

            <!-- Start menu -->
            <ul class="nav nav-primary">
                <li id="link-utama" class="nav-item">
                    <a href="user.php?p=utama">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Papan Utama</p>
                    </a>
                </li>
                <li id="" class="nav-item">
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout/Keluar</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Ahli</h4>
                </li>
                <!-- <li id="link-fee" class="nav-item">
                    <a href="user.php?p=fee">
                        <i class="fas fa-donate"></i>
                        <p>Create Order</p>
                    </a>
                </li> -->
                <!-- <li id="link-statistic" class="nav-item">
                    <a href="user.php?p=statistic">
                        <i class="fas fa-chart-area"></i>
                        <p>Senarai Ahli Kariah</p>
                    </a>
                </li> -->
                <li id="link-senarai-penama" class="nav-item">
                    <a href="user.php?p=senarai-penama">
                        <i class="fas fa-user"></i>
                        <p>Kemaskini Penama</p>
                    </a>
                </li>
                <li id="link-message" class="nav-item">
                    <a href="user.php?p=message">
                        <i class="fas fa-file-alt"></i>
                        <p>Penyata Bayaran</p>
                    </a>
                </li>
                <?php
                $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                $select->execute();
                while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                    //failed to pass id using this ui
                    // echo '
                    // <li id="link-tnc" class="nav-item">
                    // <a href="tuntut-kematian.php?kariah_id=' . $row->kariah_id . '">
                    //     <i class="fas fa-file-signature"></i>
                    //     <p>Tuntut</p>
                    //     </a>
                    // </li>
                    //     ';

                    echo '
                        <li id="link-tnc" class="nav-item">
                        <a href="tuntut-tanggungan.php?kariah_id=' . $row->kariah_id . '">
                        <i class="fas fa-users"></i>
                            <p>Tuntut Tanggungan</p>
                            </a>
                        </li>
                            ';
                }

                ?>
                <!-- <li id="link-penyata-tuntutan" class="nav-item">
                    <a href="user.php?p=penyata-tuntutan">
                        <i class="fas fa-file-alt"></i>
                        <p>Tuntutan Kematian</p>
                    </a>
                </li> -->
                <li id="link-penyata-tuntutan-tanggungan" class="nav-item">
                    <a href="user.php?p=penyata-tuntutan-tanggungan">
                        <i class="fas fa-file-alt"></i>
                        <p>Penyata Tuntutan</p>
                    </a>
                </li>
                <?php
                $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE ahli_kariah.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                $select->execute();
                while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                    //failed to pass id using this ui
                    echo '
                    <li id="link-tnc" class="nav-item">
                    <a href="tnc.php?kariah_id=' . $row->kariah_id . '">
                        <i class="fas fa-file-signature"></i>
                        <p>Kemaskini Maklumat</p>
                        </a>
                    </li>

                    <li id="" class="nav-item">
                    <a href="bayar.php?kariah_id=' . $row->kariah_id . '" >
                    <i class="fas fa-money-check"></i>
                        <p>Bayar Yuran</p>
                        </a>
                    </li>
                        ';
                }

                ?>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Butiran Peribadi</h4>
                </li>
                <!-- <li id="link-financial-statement" class="nav-item">
                    <a href="user.php?p=financial-statement">
                        <i class="fas fa-user-cog"></i>
                        <p>Sunting Profile</p>
                    </a>
                </li> -->
                <li id="link-member" class="nav-item">
                    <a href="user.php?p=member">
                        <i class="fas fa-key"></i>
                        <p>Tukar Kata Laluan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

<script>
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    p = getUrlParameter('p')

    if (typeof p == 'undefined') {
        p = 'dashboard'
    }

    $('#link-' + p).addClass('active')
</script>