<div class="modal fade" id="edit<?php echo $row->khairat_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <center>
                    <h4 class="modal-title" id="myModalLabel">Butiran Pembayaran</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="container-fluid">
                    <dl>
                        <!-- <dt class="text-muted"><b>No Ahli</b></dt>
                        <dd class="text-muted"><?php //echo $row->no_ahli;
                                                ?></dd> -->
                        <dt class="text-muted"><b>Nama</b></dt>
                        <dd class="text-muted"><span style="text-transform:uppercase"><?php echo $row->kariah_name; ?></dd>
                        <dt class="text-muted"><b>No Kad Pengenalan</b></dt>
                        <dd class="text-muted"><?php echo $row->kariah_ic; ?></dd>
                        <dt class="text-muted"><b>Kariah</b></dt>
                        <dd class="text-muted"><?php echo $row->kawasan; ?></dd>
                        <dt class="text-muted"><b>Jenis Bayaran</b></dt>
                        <dd class="text-muted"><?php echo displayYuranName($row->product_id, $pdo) ?></dd>
                        <dt class="text-muted"><b>Tarikh </b></dt>
                        <dd class="text-muted"><?php echo date('d-m-Y', strtotime($row->tarikh_bayar)); ?></dd>
                        <dt class="text-muted"><b>Tarikh Pembaharuan Yuran</b></dt>
                        <dd class="text-muted"><?php echo date('d-m-Y', strtotime($row->expired)); ?></dd>
                        <dt class="text-muted"><b>Jumlah Bayaran</b></dt>
                        <dd class="text-muted">RM <?php echo number_format($row->total, 2); ?></dd>
                        <dt class="text-muted"><b>Telah Bayar</b></dt>
                        <dd class="text-muted">RM <?php echo number_format($row->paid, 2); ?></dd>
                        <dt class="text-muted"><b>Baki Bayaran</b></dt>
                        <dd class="text-muted">RM <?php echo number_format($row->due, 2); ?></dd>
                        <dt class="text-muted"><b>Kaedah Bayaran</b></dt>
                        <dd class="text-muted"><?php echo $row->p_method; ?></dd>
                        <dt class="text-muted"><b>No Invois</b></dt>
                        <dd class="text-muted"><?php echo $row->invoice_no; ?></dd>
                        <dt class="text-muted"><b>Status Khairat Kematian</b></dt>
                        <dd class="text-muted"><?php echo $row->approvement; ?></dd>
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