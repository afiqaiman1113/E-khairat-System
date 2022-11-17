<!-- edit yuran -->
<?php
$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
?>
    <div class="modal fade" id="edi_<?php echo $row->penama_id; ?>" data-backdrop="false" tabindex="-1" role="dialog" style="display:none;" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="myModalLabel">Kemaskini Penama</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="POST" action="edit.php?penama_id=<?php echo $row->penama_id; ?>">
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label class="control-label" style="position:relative; top:7px;">Nama:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="penama_name" value="<?php echo $row->penama_name; ?>" onKeyUP="this.value = this.value.toUpperCase();" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label class="control-label" style="position:relative; top:7px;">No K/P:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="penama_ic" id="penama_ic" value="<?php echo $row->penama_ic; ?>" disabled>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label class="control-label" style="position:relative; top:7px;">Tel Bimbit:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="penama_no" id="penama_no" class="form-control" value="<?php echo $row->penama_no ?>" placeholder="Tiada Dash (-)" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhonePenama(this);" oninput="InvalidPhonePenama(this);" />
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
<?php
} else {
?>
    <div class="modal fade" id="edi_<?php echo $row->penama_id; ?>" tabindex="-1" role="dialog" style="display:none;" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="myModalLabel">Kemaskini Penama</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="POST" action="edit.php?penama_id=<?php echo $row->penama_id; ?>">
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label class="control-label" style="position:relative; top:7px;">Nama:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="penama_name" value="<?php echo $row->penama_name; ?>" onKeyUP="this.value = this.value.toUpperCase();" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('') ">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label class="control-label" style="position:relative; top:7px;">No K/P:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="penama_ic" id="penama_ic" value="<?php echo $row->penama_ic; ?>" disabled>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label class="control-label" style="position:relative; top:7px;">Tel Bimbit:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="penama_no" id="penama_no" class="form-control" value="<?php echo $row->penama_no ?>" placeholder="Tiada Dash (-)" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhonePenama(this);" oninput="InvalidPhonePenama(this);" />
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

<?php
}
?>


<!-- view yuran -->
<?php
$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
?>
    <div class="modal fade" id="edit_<?php echo $row->penama_id; ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                            <dt class="text-muted"><b>Nama</b></dt>
                            <dd class="text-muted"><?php echo $row->penama_name; ?></dd>
                            <dt class="text-muted"><b>No K/P</b></dt>
                            <dd class="text-muted"><?php echo $row->penama_ic; ?></dd>
                            <dt class="text-muted"><b>Tel Bimbit</b></dt>
                            <dd class="text-muted"><?php echo $row->penama_no; ?></dd>
                            <dt class="text-muted"><b>Emel</b></dt>
                            <dd class="text-muted"><?php echo $row->penama_email; ?></dd>
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
<?php
} else {
?>
    <div class="modal fade" id="edit_<?php echo $row->penama_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                            <dt class="text-muted"><b>Nama</b></dt>
                            <dd class="text-muted"><?php echo $row->penama_name; ?></dd>
                            <dt class="text-muted"><b>No K/P</b></dt>
                            <dd class="text-muted"><?php echo $row->penama_ic; ?></dd>
                            <dt class="text-muted"><b>Tel Bimbit</b></dt>
                            <dd class="text-muted"><?php echo $row->penama_no; ?></dd>
                            <dt class="text-muted"><b>Emel</b></dt>
                            <dd class="text-muted"><?php echo $row->penama_email; ?></dd>
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

<?php
}
?>