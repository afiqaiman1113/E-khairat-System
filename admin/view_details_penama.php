<div class="modal fade" id="view<?php echo $row->penama_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <center>
                    <h4 class="modal-title" id="myModalLabel">Butiran Penama</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="container-fluid">
                    <dl>
                        <!-- <dt class="text-muted"><b>No Ahli</b></dt>
                        <dd class="text-muted"><?php //echo $row->no_ahli;
                                                ?></dd> -->
                        <dt class="text-muted"><b>Penama</b></dt>
                        <dd class="text-muted"><span style="text-transform:uppercase"><?php echo $row->penama_name; ?></dd>
                        <dt class="text-muted"><b>No Kad Pengenalan</b></dt>
                        <dd class="text-muted"><?php echo $row->penama_ic; ?></dd>
                        <dt class="text-muted"><b>No Tel</b></dt>
                        <dd class="text-muted"><?php echo $row->penama_no; ?></dd>
                        <dt class="text-muted"><b>Emel</b></dt>
                        <dd class="text-muted"><?php echo $row->penama_email; ?></dd>
                        <dt class="text-muted"><b>Ahli Kariah</b></dt>
                        <dd class="text-muted"><span style="text-transform:uppercase"><?php echo $row->kariah_name; ?></dd>
                        <dt class="text-muted"><b>Kawasan Ahli Kariah</b></dt>
                        <dd class="text-muted"><?php echo $row->kawasan; ?></dd>

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

<div class="modal fade" id="edi_<?php echo $row->penama_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <center>
                    <h4 class="modal-title" id="myModalLabel">Kemaskini Penama</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="edit-penama.php?penama_id=<?php echo $row->penama_id; ?>">
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">Penama:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="penama_name" style="text-transform: uppercase" value="<?php echo $row->penama_name; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">No K/P:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="penama_ic" id="penama_ic"  value="<?php echo $row->penama_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">No Tel:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="penama_no" value="<?php echo $row->penama_no; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="control-label" style="position:relative; top:7px;">Emel:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="penama_email" value="<?php echo $row->penama_email; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
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