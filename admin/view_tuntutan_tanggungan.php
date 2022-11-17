<div class="modal fade" id="edit_<?php echo $row->tid_tanggung; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <center>
                    <h4 class="modal-title" id="myModalLabel">Butiran Tuntutan</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="container-fluid">
                    <dl>
                        <dt class="text-muted"><b>Si Mati</b></dt>
                        <dd class="text-muted"><span style="text-transform:uppercase"><?php echo $row->nama; ?></dd>
                        <!-- <dt class="text-muted"><b>No Kad Pengenalan</b></dt>
                        <dd class="text-muted"><?php //echo $row->tuntut_ic;
                                                ?></dd> -->

                        <dt class="text-muted"><b>Tarikh Meninggal</b></dt>
                        <dd class="text-muted"><?php echo date('d-m-Y', strtotime($row->tarikh_mati)); ?></dd>
                        <dt class="text-muted"><b>Tarikh Dituntut</b></dt>
                        <dd class="text-muted"><?php echo date('d-m-Y', strtotime($row->tarikh_tuntut)); ?></dd>
                        <dt class="text-muted"><b>Waris</b></dt>
                        <dd class="text-muted"><span style="text-transform:uppercase"><?php echo $row->kariah_name; ?></dd>
                        <dt class="text-muted"><b>Kariah</b></dt>
                        <dd class="text-muted"><?php echo $row->kawasan; ?></dd>
                        <dt class="text-muted"><b>Hubungan dengan si mati</b></dt>
                        <dd class="text-muted"><span style="text-transform:uppercase"><?php echo $row->t_tanggunghubungan; ?></dd>
                        <dt class="text-muted"><b>Jumlah Dituntut</b></dt>
                        <dd class="text-muted">RM <?php echo number_format($row->jumlah, 2); ?></dd>
                        <dt class="text-muted"><b>Kaedah Pembayaran</b></dt>
                        <dd class="text-muted"><?php echo $row->cara_bayar; ?></dd>
                        <dt class="text-muted"><b>Jenis Bank</b></dt>
                        <?php
                        if ($row->bank == NULL) {
                        ?>
                            <dd class="text-muted">Tiada</dd>
                        <?php
                        } else {
                        ?>
                            <dd class="text-muted"><?php echo $row->bank; ?></dd>
                        <?php
                        }
                        ?>
                        <dt class="text-muted"><b>No Akaun Bank</b></dt>
                        <?php
                        if ($row->bank == NULL) {
                        ?>
                            <dd class="text-muted">Tiada</dd>
                        <?php
                        } else {
                        ?>
                            <dd class="text-muted"><?php echo $row->no_akaun; ?></dd>
                        <?php
                        }
                        ?>
                        <dt class="text-muted"><b>No Resit</b></dt>
                        <dd class="text-muted"><?php echo $row->invoice; ?></dd>
                        <dt class="text-muted"><b>No Surat Mati</b></dt>
                        <dd class="text-muted"><?php echo $row->no_surat; ?></dd>
                        <dt class="text-muted"><b>Surat Mati</b></dt>
                        <?php
                        if ($row->tuntutan_image == NULL) {
                        ?>
                            <dd class="text-muted">Tiada Gambar</dd>
                        <?php
                        } else {
                        ?>
                            <ul class="list-group">
                                <img src="productimages/<?php echo $row->tuntutan_image; ?> " class="img-responsive" />
                            </ul>
                        <?php
                        }
                        ?>
                    </dl>
                    <div class="clear-fix mb-3"></div>
                    <div class="text-right">
                        <button class="btn btn-dark bg-gradient-dark btn-flat" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>