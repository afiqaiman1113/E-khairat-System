<!-- edit yuran -->
<div class="modal fade" id="edi_<?php echo $row->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Kemaskini Yuran</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="edit.php?product_id=<?php echo $row->product_id; ?>">
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">Nama Yuran:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="product_name" value="<?php echo $row->product_name; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">Jumlah:</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            RM
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="jumlah" value="<?php echo number_format($row->jumlah, 2); ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">Tahun:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tahun" value="<?php echo $row->tahun; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Kemaskini</a>
                    </form>
            </div>
        </div>
    </div>
</div>

<!-- view yuran -->
<div class="modal fade" id="edit_<?php echo $row->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Lihat Yuran</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <dl>
                        <dt class="text-muted"><b>Nama Yuran</b></dt>
                        <dd class="text-muted"><?php echo $row->product_name; ?></dd>
                        <dt class="text-muted"><b>Jumlah</b></dt>
                        <dd class="text-muted">RM <?php echo number_format($row->jumlah, 2); ?></dd>
                        <dt class="text-muted"><b>Tahun</b></dt>
                        <dd class="text-muted"><?php echo $row->tahun; ?></dd>
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

<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Yuran Baru</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="add_yuran.php">
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">Nama Yuran:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="product_name" placeholder="Contoh: Yuran Tahunan 2022" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">Tahun:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tahun" required="" placeholder="Contoh: 2022" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">Jumlah:</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            RM
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="jumlah" placeholder="Contoh: 100" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="stat" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Tambah</a>
                    </form>
            </div>
        </div>
    </div>
</div>