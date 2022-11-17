<div class="modal fade" id="add_<?php echo $row->kariah_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <center>
                    <h4 class="modal-title" id="myModalLabel">Butiran Penama</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?php

              //$select1 = $pdo->prepare("SELECT * FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE penama.penama_id = penama.penama_id");
              //$select = $pdo->prepare("SELECT * FROM ahli_kariah ORDER BY kariah_id DESC");

              //$select1->execute();
           //$row1 = $select1->fetch(PDO::FETCH_OBJ)
            ?>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="tambah.php">
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Firstname:</label>
                            </div>
                            <input type="text" class="form-control" name="kariah_id" value="<?php echo $row->kariah_id; ?>">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Firstname:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="firstname" value="<?php echo $row1->firstname; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Lastname:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lastname" value="<?php echo $row1->lastname; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Address:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address"  value="<?php echo $row1->address; ?>">
                            </div>
                        </div>
                </div>
            </div>
            <?php
              //}
              ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                <button type="submit" name="add" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Tambah</a>
                    </form>
            </div>
        </div>
    </div>
</div>