<div class="main-panel">
    <div class="content" style="margin-top: 60px">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card">
                                <div class="card-header">
                                    <h3 class="card-title">Tuntutan Ahli</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" name="" enctype="multipart/form-data">
                                        <input type="hidden" style="text-transform: uppercase" name="tuntut_name" class="form-control" value="<?php echo strtoupper($kariah_name); ?>" placeholder="" />
                                        <input type="hidden" name="tuntut_ic" class="form-control" value="<?php echo $kariah_ic; ?>" placeholder="" />
                                        <input type="hidden" name="status_tuntut" class="form-control" value="Dalam Proses" />
                                        <input type="hidden" name="kariah_id" class="form-control" value="<?php echo $kariah_id; ?>" placeholder="" />
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Nama Penuntut Bagi Si Mati</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="penuntut" style="text-transform: uppercase" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tarikh</label>
                                            <div class="input-group">
                                                <input type="text" name="tarikh" id="tarikh" style="text-transform: uppercase" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Hubungan Penuntut Dengan Si Mati</span></h5>
                                                    <select name="hubungan" id="hubungan" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')" class="form-control">
                                                        <option value="" disabled selected>Sila Pilih</option>
                                                        <option value="1000">Suami</option>
                                                        <option value="1000">Isteri</option>
                                                        <option value="1000">Anak</option>
                                                        <option value="2000">Ayah Kandung</option>
                                                        <option value="2500">Ibu Kandung</option>
                                                    </select>
                                                    <input type="hidden" name="hubunganpenuntut" id="hubunganpenuntut_hidden">
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
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Tarikh Tuntut</span></h5>
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
                                        <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Tuntut</label>
                                            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control datetimepicker-input" name="tarikh_tuntut" data-date-format="yyyy-mm-dd" data-target="#reservationdate1">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">No Surat Mati</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="no_surat" class="form-control" placeholder="" value="<?php echo $no_surat; ?>" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
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
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Jumlah Dituntut</span></h5>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                RM
                                                            </span>
                                                        </div>
                                                        <input type="text" name="jumlah" class="form-control" id="jumlah" required="" oninvalid="this.setCustomValidity('Isi')" oninput="setCustomValidity('')" readonly />
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
                                        <!-- <label>* Jumlah Dituntut (RM)</label>
                                <td style="display:none;"><input type="hidden" name="paid" class="form-control" placeholder="" readonly /></td>
                                <td>
                                    <select name="kariah_id" style="width: 300px" class="form-control">
                                        <option value="">Jumlah Dituntut</option><?php //echo tunggak($pdo);
                                                                                    ?>
                                    </select>
                                </td> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Cara Pembayaran</label>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="radioPrimary1" name="cara_bayar" value="Perbankan Internet">
                                                            <label for="radioPrimary1">Perbankan Internet</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="radioPrimary2" name="cara_bayar" value="Lain-lain">
                                                            <label for="radioPrimary2">Lain-lain</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="radioPrimary3" name="cara_bayar" value="Cek">
                                                            <label for="radioPrimary3">Cek</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>No Cek/Baucar</label>
                                                    <div class="input-group">
                                                        <input type="text" name="no_cek" class="form-control" placeholder="Jika Ada" value="<?php echo $no_cek; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nota Tambahan</label>
                                                    <div class="input-group">
                                                        <input type="text" name="nota" class="form-control" placeholder="Jika Ada" value="<?php echo $nota; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="pindah_milik" hidden>
                                                <option value="Belum">Belum</option>
                                            </select>
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