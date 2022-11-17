<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
if ($_SESSION['role'] == "Admin") {
    error_log('Connected Successfully');
} else {
    '';
}
?>


<table id="producttable" class="table table-striped">
    <thead>

        <tr>
            <th style="font-size:90%;">No Ahli</th>
            <th style="font-size:90%;">Nama</th>
            <!-- <th style="font-size:90%;">No K/P</th> -->
            <th style="font-size:90%;">Kariah</th>
            <th style="font-size:90%;">Tarikh Daftar</th>
            <th style="font-size:90%;">Status Khairat Kematian</th>
            <th style="font-size:90%;">Status Ahli</th>
            <th style="font-size:90%;">Status Bayaran</th>
            <th style="font-size:90%;">Status SMS</th>
            <!-- <th style="font-size:90%;">Padam</th>
            <th style="font-size:90%;">Bayar (CASH)</th>
            <th style="font-size:90%;">Tuntut Ahli</th>
            <th style="font-size:90%;">Tuntut Tanggungan</th> -->
            <th style="font-size:90%;">Pilihan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $select = $pdo->prepare("SELECT * FROM ahli_kariah ORDER BY kariah_id DESC");
        $select->execute();
        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
        ?>
            <tr>
                <td style="font-size:87%;"><?php echo $row->no_ahli; ?></td>
                <td style="font-size:87%;"><span style="text-transform:uppercase"><?php echo $row->kariah_name; ?></td>
                <!-- <td style="font-size:87%;"><?php //echo $row->kariah_ic;
                                                ?></td> -->
                <td style="font-size:87%;"><?php echo $row->kawasan; ?></td>
                <td style="font-size:87%;"><?php echo date('d-m-Y', strtotime($row->tarikh_daftar)); ?></td>

                <?php

                if ($row->approvement == "Telah Daftar") {
                    echo '<td><span class="badge bg-success">' . $row->approvement . '</span></td>';
                } elseif ($row->approvement == "Digantung") {
                    echo '<td><span class="badge bg-warning">' . $row->approvement . '</span></td>';
                } else {
                    echo '<td><span class="badge bg-info">' . $row->approvement . '</span></td>';
                }

                if ($row->mati == "Mati") {
                    echo '<td><a href="semak-tuntutan.php?kariah_id=' . $row->kariah_id . '"><span class="badge bg-danger">Meninggal</span></td>';
                } else {
                    echo '<td><span class="badge bg-success">Hidup</span></td>';
                }

                if (strtotime(date("d-m-Y")) <= strtotime($row->tarikh_expired)) {
                    echo '<td><span class="badge bg-success">' . "Aktif" . '</span></td>';
                } elseif ($row->tarikh_expired == NULL) {
                    echo '<td><span class="badge bg-warning">Belum Bayar</span></td>';
                } else {
                    echo '<td><span class="badge bg-danger">' . "Tamat Tempoh" . '</span></td>';
                }

                if ($row->status_sms == 0) {
                    echo '<td><span class="badge bg-danger">Belum Hantar</span></td>';
                } elseif ($row->status_sms == 2) {
                    echo '<td><span class="badge bg-warning">Tiada</span></td>';
                } else {
                    echo '<td><span class="badge bg-success">Selesai Hantar</span></td>';
                }

                ?>


                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            Lanjut
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item view_data" href="semak-ahli/<?php echo $row->kariah_id; ?>"><span class="fa fa-eye text-dark"></span> Semak</a>
                            <div class="dropdown-divider"></div>
                            <?php
                            if ($row->mati == "Mati") {
                            } else {
                            ?>
                                <a class="dropdown-item edit_data" href="bayar/<?php echo $row->kariah_id; ?>"><span class="fa fa-money-bill-wave-alt"></span> Bayar Tunai</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item edit_data" href="send-sms.php?kariah_id=<?php echo $row->kariah_id; ?>"><span class="fa fa-sms"></span> Hantar Peringatan</a>
                                <div class="dropdown-divider"></div>

                            <?php
                            }
                            ?>
                            <!-- <div class="dropdown-divider"></div>
                            <a href="#add_<?php //echo $row->kariah_id;
                                            ?>" class="dropdown-item view_data" data-toggle="modal"><span class="fa fa-eye text-dark"></span> Tambah Penama</a> -->

                            <!-- <a class="dropdown-item edit_data" href="tambah-penama.php?kariah_id=<?php //echo $row->kariah_id;
                                                                                                        ?>"><span class="fa fa-edit text-primary"></span> Penama</a>
                            <div class="dropdown-divider"></div> -->
                            <?php
                            if ($row->mati == "Mati") {
                            } else {
                            ?>
                                <a class="dropdown-item edit_data" href="tuntut.php?kariah_id=<?php echo $row->kariah_id; ?>"><span class="fas fa-user"></span> Tuntut Ahli</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item edit_data" href="tuntut-tanggungan.php?kariah_id=<?php echo $row->kariah_id; ?>"><span class="fas fa-users"></span> Tuntut Tanggungan</a>
                                <div class="dropdown-divider"></div>
                            <?php
                            }
                            ?>
                            <button type="button" id=<?php echo $row->kariah_id; ?> class="dropdown-item edit_data btndelete"><span class="fas fa-trash text-danger"></span> Padam</button>
                        </div>
                    </div>
                </td>
                <?php include('tambah_penama.php'); ?>
            <?php
        }
            ?>
    </tbody>
</table>


<!-- <td>
    <a href="semak-ahli-kariah.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
        <i class="fas fa-edit"></i>
    </a>
</td>
<td>
    <button type="button" id=' . $row->kariah_id . ' class="btn btn-sm btn-danger btndelete"><span class="fas fa-trash"></span></button>
</td>
<td>
    <a href="bayar-tunai-najmi.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
        <i class="fas fa-wallet"></i>
    </a>
</td>
<td>
    <a href="tuntut.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
        <i class="fas fa-edit"></i>
    </a>
</td>
<td>
    <a href="tuntut-tanggungan.php?kariah_id=' . $row->kariah_id . '" class="btn btn-sm btn-info">
        <i class="fas fa-edit"></i>
    </a>
</td> -->