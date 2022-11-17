<div class="main-panel">
    <div class="content" style="margin-top: 60px">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card">
                                <div class="card-header">
                                    <h3 class="card-title">Tuntutan Tanggungan</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" name="" enctype="multipart/form-data">
                                        <input type="hidden" name="status" class="form-control" value="Dalam Proses" placeholder="" />
                                        <input type="hidden" class="form-control nama" name="namatanggungan" readonly>
                                        <div class="form-group">
                                            <td><select class="form-control id_tanggungan" name="id_tanggungan" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')" style="width: 250px" ;>
                                                    <option value="" disabled selected>Pilih Tanggungan</option>
                                                    <?php
                                                    if (tunggak($pdo) == true) {
                                                        echo tunggak($pdo);
                                                    } else {
                                                        echo tunggak1($pdo);
                                                    }

                                                    ?>
                                                </select></td>
                                        </div>
                                        <input type="hidden" class="form-control id" name="id" readonly>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Hubungan Dengan Tanggungan</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="t_tanggunghubungan" class="form-control" placeholder="" value="<?php echo $t_tanggunghubungan; ?>" required="" oninvalid="this.setCustomValidity('Isi Maklumat')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Tarikh Kematian</span></h5>
                                                    <div class="input-group date" data-target-input="nearest">
                                                        <div class="input-group-append" data-toggle="datetimepicker">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" class="form-control" name="tarikh_mati" id="tarikh_mati" required="" value="<?php echo $tarikh_mati; ?>" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Tarikh Tuntutan</span></h5>
                                                    <div class="input-group date" data-target-input="nearest">
                                                        <div class="input-group-append" data-toggle="datetimepicker">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" name="tarikh_tuntut" id="tarikh_tuntut" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Pilih tarikh')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">No Surat Mati</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="no_surat" class="form-control" placeholder="" required="" value="<?php echo $no_surat; ?>" oninvalid="this.setCustomValidity('Isi Maklumat')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5 style="color:red; font-weight: bold">* <span style="color: black;">Surat Mati</span></h5>
                                            <input type="file" class="input-group" name="myfile" required="" oninvalid="this.setCustomValidity('Pilih Gambar')" oninput="setCustomValidity('')" />
                                            <p style="color:red;">Format: jpg, png atau jpeg</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Jumlah Tuntutan</span></h5>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                RM
                                                            </span>
                                                        </div>
                                                        <input type="text" name="jumlah" class="form-control" value="500" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Pilih Bank</span></h5>
                                                    <select name="bank" id="bank" class="form-control">
                                                        <option value="" disabled selected>Sila Pilih</option>
                                                        <option value="Maybank">Maybank</option>
                                                        <option value="CIMB">CIMB</option>
                                                        <option value="Bank Islam">Bank Islam</option>
                                                        <option value="Bank Rakyat">Bank Rakyat</option>
                                                        <option value="AmBank">AmBank</option>
                                                        <option value="RHB Bank">RHB Bank</option>
                                                        <option value="Affin Bank">Affin Bank</option>
                                                        <option value="Agrobank">Agrobank</option>
                                                        <option value="Alliance Bank">Alliance Bank</option>
                                                        <option value="Bank Muamalat">Bank Muamalat</option>
                                                        <option value="Bank Simpanan Nasional">Bank Simpanan Nasional</option>
                                                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                                                        <option value="HSBC Bank">HSBC Bank</option>
                                                        <option value="Public Bank">Public Bank</option>
                                                        <option value="OCBC Bank">OCBC Bank</option>
                                                        <option value="Standard Chartered">Standard Chartered</option>
                                                        <option value="UOB Bank">UOB Bank</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">No Akaun Bank</span></h5>
                                                    <div class="input-group">
                                                        <input type="number" name="no_akaun" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="cara_bayar" class="form-control" value="Perbankan Internet" />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No Cek/Baucar</label>
                                                    <div class="input-group">
                                                        <input type="text" name="no_cek" class="form-control" value="<?php echo $no_cek; ?>" placeholder="Jika Ada" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nota Tambahan</label>
                                                    <div class="input-group">
                                                        <input type="text" name="nota" class="form-control" value="<?php echo $nota; ?>" placeholder="Jika Ada" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input name="invoice" type="hidden" class="form-control" value="<?php $b = rand(10000, 100000);
                                                                                                        $c = $b;
                                                                                                        echo $c; ?>" autofocus="on" readonly="readonly" />
                                        <div align="center">
                                            <input type="submit" name="btn_tuntut" value="Tuntut" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card">
                                <div class="card-header" style="background-color: #FF0000;">
                                    <h3 class="card-title" style="color:White">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Penting
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert alert-dismissible">
                                        <h5><i class="icon fas fa-ban"></i> Nota!</h5>
                                        <ul>
                                            <li>Pastikan anda telah mengemaskini maklumat terlebih dahulu sebelum melakukan tuntutan</li><br>
                                            <li>Maklumat pada resit tuntutan tidak boleh dikemaskini setelah melakukan pembayaran</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include_once 'footer2.php'; ?>
</div>