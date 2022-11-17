<?php
// include_once 'admin/database/connect.php';

// $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE ahli_kariah.kariah_ic = '" . $_SESSION['kariah_ic'] . "' ");
// $select->execute();
?>


<div class="main-panel">
    <div class="content" style="margin-top: 60px">
        <?php
        if (isset($_GET['p'])) {
            switch ($_GET['p']) {
                case 'utama1':
                    include_once 'utama1.php';
                    break;
                case 'fee':
                    include_once 'fee.php';
                    break;
                case 'statistic':
                    include_once 'statistic.php';
                    break;
                case 'senarai-penama':
                    include_once 'senarai-penama.php';
                    break;
                case 'message':
                    include_once 'message.php';
                    break;
                case 'penyata-tuntutan':
                    include_once 'penyata-tuntutan.php';
                    break;
                case 'penyata-tuntutan-tanggungan':
                    include_once 'penyata-tuntutan-tanggungan.php';
                    break;
                case 'tnc':
                    include_once 'tnc.php';
                    break;
                case 'financial-statement':
                    include_once 'financial-statement.php';
                    break;
                case 'member':
                    include_once 'member.php';
                    break;
                default:
                    include_once '404.php';
                    break;
            }
        } else {
            // include_once 'dashboard.php';
        }
        ?>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul class="nav">
                    <li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:bendaharimawgc@gmail.com">
                            Cadangan / Laporan
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                Hak Cipta Terpelihara &copy; 2022 Masjid Al-Wustha Guar Chempedak
            </div>
        </div>
    </footer>
</div>