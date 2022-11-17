<div class="main-panel">
    <div class="content" style="margin-top: 60px">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card">
                                <div class="card-header card-success">
                                    <h3 class="card-title">Maklumat Ahli</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" name="" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Nama Ahli</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="kariah_name" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $kariah_name; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">No Kad Pengenalan / No Pasport</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="kariah_ic" class="form-control" placeholder="" value="<?php echo $kariah_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Tarikh Lahir</span></h5>
                                                    <input type="date" name="kariah_umur" value="<?php echo $kariah_umur; ?>" class="form-control" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Emel</span></h5>
                                                    <div class="input-group">
                                                        <input type="email" id="user_email" name="user_email" class="form-control" placeholder="" value="<?php echo $user_email; ?>" required="required" oninvalid="InvalidEmail(this);" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="font-weight: bold"><span style="color: black;">Tarikh Daftar</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="tarikh_daftar" class="form-control" placeholder="" value="<?php echo $tarikh_daftar; ?>" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Jantina</span></h5>
                                                    <select name="jantina" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                        <?php
                                                        if ($jantina == NULL) {
                                                        ?>
                                                            <option value='' disabled selected>Sila Pilih</option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value='<?php echo $jantina; ?>'><?php echo $jantina; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($jantina == '') {
                                                            echo "<option value='Perempuan'>Perempuan</option>";
                                                            echo "<option value='Lelaki'>Lelaki</option>";
                                                        } elseif ($jantina == 'Lelaki') {
                                                            echo "<option value='Perempuan'>Perempuan</option>";
                                                        } else {
                                                            echo "<option value='Lelaki'>Lelaki</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Pekerjaan</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="pekerjaan" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $pekerjaan; ?>" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Alamat</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="alamat" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $alamat; ?>" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                                    </div><br>
                                                    <div class="input-group">
                                                        <input type="text" name="alamat2" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $alamat2; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Poskod</span></h5>
                                                    <div class="input-group">
                                                        <input type="number" name="poskod" class="form-control" placeholder="" value="<?php echo $poskod; ?>" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Bandar</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="bandar" class="form-control" style="text-transform: uppercase" placeholder="" value="<?php echo $bandar; ?>" required="" oninvalid="this.setCustomValidity('Wajib Isi')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Negeri</span></h5>
                                                    <select name="negeri" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                        <?php
                                                        if ($negeri == NULL) {
                                                        ?>
                                                            <option value='' disabled selected>Sila Pilih</option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value='<?php echo $negeri; ?>'><?php echo $negeri; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($negeri == '') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Johor') {
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Kedah') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Kelantan') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Melaka') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Negeri Sembilan') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Pahang') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Pulau Pinang') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Perak') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Perlis') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Selangor') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Sabah') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Sarawak') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Terengganu') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Wilayah Persekutuan Labuan') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } elseif ($negeri == 'Wilayah Persekutuan Kuala Lumpur') {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Putrajaya'>Wilayah Persekutuan Putrajaya</option>";
                                                        } else {
                                                            echo "<option value='Johor'>Johor</option>";
                                                            echo "<option value='Kedah'>Kedah</option>";
                                                            echo "<option value='Kelantan'>Kelantan</option>";
                                                            echo "<option value='Melaka'>Melaka</option>";
                                                            echo "<option value='Negeri Sembilan'>Negeri Sembilan</option>";
                                                            echo "<option value='Pahang'>Pahang</option>";
                                                            echo "<option value='Pulau Pinang'>Pulau Pinang</option>";
                                                            echo "<option value='Perak'>Perak</option>";
                                                            echo "<option value='Perlis'>Perlis</option>";
                                                            echo "<option value='Selangor'>Selangor</option>";
                                                            echo "<option value='Sabah'>Sabah</option>";
                                                            echo "<option value='Sarawak'>Sarawak</option>";
                                                            echo "<option value='Terengganu'>Terengganu</option>";
                                                            echo "<option value='Wilayah Persekutuan Labuan'>Wilayah Persekutuan Labuan</option>";
                                                            echo "<option value='Wilayah Persekutuan Kuala Lumpur'>Wilayah Persekutuan Kuala Lumpur</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Status Menetap</span></h5>
                                                    <select name="s_menetap" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                        <?php
                                                        if ($s_menetap == NULL) {
                                                        ?>
                                                            <option value='' disabled selected>Sila Pilih</option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value='<?php echo $s_menetap; ?>'><?php echo $s_menetap; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($s_menetap == '') {
                                                            echo "<option value='Sewa'>Sewa</option>";
                                                            echo "<option value='Sendiri'>Sendiri</option>";
                                                        } elseif ($s_menetap == 'Sendiri') {
                                                            echo "<option value='Sewa'>Sewa</option>";
                                                        } else {
                                                            echo "<option value='Sendiri'>Sendiri</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Tel Bimbit</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="tel_hp" id="tel_hp" class="form-control" value="<?php echo $tel_hp; ?>" placeholder="Tiada Dash (-)" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhone(this);" oninput="InvalidPhone(this);" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="font-weight: bold"><span style="color: black;">Tel Rumah (Jika Ada)</span></h5>
                                                    <div class="input-group">
                                                        <input type="number" name="tel_rumah" class="form-control" value="<?php echo $tel_rumah; ?>" placeholder="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Kawasan Kariah</span></h5>
                                                    <select name="kawasan" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                        <?php
                                                        if ($kawasan == NULL) {
                                                        ?>
                                                            <option value='' disabled selected>Sila Pilih</option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value='<?php echo $kawasan; ?>'><?php echo $kawasan; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($kawasan == '') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Pondok Haji Majid') {
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Kg Jalan Baru') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Taman Markisa') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Pondok Hj Husin') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Lorong Panglima') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Ustaz Khir') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Kg Baru') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Lorong Datuk Madon') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Kg Pasir') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Kg Titi Lahar') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Haji Abdul Bt 18') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Surau Kg Tok Kau') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Taman Keranji') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Taman Delima') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Taman Halaman Damai') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Taman Desa Indah') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } elseif ($kawasan == 'Perumahan Awam (Rumah Murah)') {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Luar Kawasan Kariah'>Luar Kawasan Kariah</option>";
                                                        } else {
                                                            echo "<option value='Surau Pondok Haji Majid'>Surau Pondok Haji Majid</option>";
                                                            echo "<option value='Surau Kg Jalan Baru'>Surau Kg Jalan Baru</option>";
                                                            echo "<option value='Surau Nurul Huda Bt 18 1/2'>Surau Nurul Huda Bt 18 1/2</option>";
                                                            echo "<option value='Surau Taman Markisa'>Surau Taman Markisa</option>";
                                                            echo "<option value='Surau Pondok Hj Husin'>Surau Pondok Hj Husin</option>";
                                                            echo "<option value='Surau Lorong Panglima'>Surau Lorong Panglima</option>";
                                                            echo "<option value='Surau Ustaz Khir'>Surau Ustaz Khir</option>";
                                                            echo "<option value='Surau Kg Baru'>Surau Kg Baru</option>";
                                                            echo "<option value='Surau Lorong Datuk Madon'>Surau Lorong Datuk Madon</option>";
                                                            echo "<option value='Surau Kg Pasir'>Surau Kg Pasir</option>";
                                                            echo "<option value='Surau Kg Titi Lahar'>Surau Kg Titi Lahar</option>";
                                                            echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
                                                            echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
                                                            echo "<option value='Taman Keranji'>Taman Keranji</option>";
                                                            echo "<option value='Taman Delima'>Taman Delima</option>";
                                                            echo "<option value='Taman Halaman Damai'>Taman Halaman Damai</option>";
                                                            echo "<option value='Taman Desa Indah'>Taman Desa Indah</option>";
                                                            echo "<option value='Perumahan Awam(Rumah Murah)'>Perumahan Awam (Rumah Murah)</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Tahun Mula Menetap Dalam Kariah</span></h5>
                                                    <div class="input-group">
                                                        <input type="number" name="tahun_menetap" class="form-control" placeholder="" value="<?php echo $tahun_menetap; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="color:red; font-weight: bold">* <span style="color: black;">Status Perkahwinan</span></h5>
                                                    <select name="status_perkahwinan" class="form-control" id="" required="" oninvalid="this.setCustomValidity('Sila Pilih')" oninput="setCustomValidity('')">
                                                        <?php
                                                        if ($status_perkahwinan == NULL) {
                                                        ?>
                                                            <option value='' disabled selected>Sila Pilih</option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value='<?php echo $status_perkahwinan; ?>'><?php echo $status_perkahwinan; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($status_perkahwinan == '') {
                                                            echo "<option value='Bujang'>Bujang</option>";
                                                            echo "<option value='Kahwin'>Kahwin</option>";
                                                            echo "<option value='Duda'>Duda</option>";
                                                            echo "<option value='Janda'>Janda</option>";
                                                            echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                        } elseif ($status_perkahwinan == 'Bujang') {
                                                            echo "<option value='Kahwin'>Kahwin</option>";
                                                            echo "<option value='Duda'>Duda</option>";
                                                            echo "<option value='Janda'>Janda</option>";
                                                            echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                        } elseif ($status_perkahwinan == 'Kahwin') {
                                                            echo "<option value='Bujang'>Bujang</option>";
                                                            echo "<option value='Duda'>Duda</option>";
                                                            echo "<option value='Janda'>Janda</option>";
                                                            echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                        } elseif ($status_perkahwinan == 'Duda') {
                                                            echo "<option value='Bujang'>Bujang</option>";
                                                            echo "<option value='Kahwin'>Kahwin</option>";
                                                            echo "<option value='Janda'>Janda</option>";
                                                            echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                        } elseif ($status_perkahwinan == 'Janda') {
                                                            echo "<option value='Bujang'>Bujang</option>";
                                                            echo "<option value='Kahwin'>Kahwin</option>";
                                                            echo "<option value='Duda'>Duda</option>";
                                                            echo "<option value='Ibu Tunggal'>Ibu Tunggal</option>";
                                                        } else {
                                                            echo "<option value='Bujang'>Bujang</option>";
                                                            echo "<option value='Kahwin'>Kahwin</option>";
                                                            echo "<option value='Duda'>Duda</option>";
                                                            echo "<option value='Janda'>Janda</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 style="font-weight: bold"><span style="color: black;">Penerima Bantuan (Jika Ya, isi jenis bantuan)</span></h5>
                                                    <div class="input-group">
                                                        <input type="text" name="penerima_bantuan" id="penerima_bantuan" class="form-control" value="<?php echo $penerima_bantuan; ?>" placeholder="Kosongkan jika tiada" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <?php
                                        $select = $pdo->prepare("SELECT * FROM penama INNER JOIN ahli_kariah ON penama.kariah_id = ahli_kariah.kariah_id WHERE penama.kariah_id = '" . $_SESSION['kariah_id'] . "' ");
                                        $select->execute();
                                        $row = $select->fetch(PDO::FETCH_ASSOC);
                                        $penama_id = $row['penama_id'];

                                        if ($penama_id != NULL) {
                                        } else {
                                        ?>

                                            <div class="card card">
                                                <div class="card-header card-success">
                                                    <h3 class="card-title">Wajib: Butiran penama untuk tuntutan khairat kematian</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <h5 style="color:red; font-weight: bold">* <span style="color: black;">Nama</span></h5>
                                                                <div class="input-group">
                                                                    <input type="text" name="penama_name" class="form-control" onKeyUP="this.value = this.value.toUpperCase();" placeholder="" value="<?php echo $penama_name; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <h5 style="color:red; font-weight: bold">* <span style="color: black;">No Kad Pengenalan / No Pasport</span></h5>
                                                                <div class="input-group">
                                                                    <input type="text" name="penama_ic" id="penama_ic" class="form-control" placeholder="" value="<?php echo $penama_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <h5 style="color:red; font-weight: bold"><span style="color: black;">Emel</span></h5>
                                                                <div class="input-group">
                                                                    <input type="email" id="penama_email" name="penama_email" class="form-control" placeholder="" value="<?php echo $penama_email; ?>" oninvalid="InvalidMsg(this);" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <h5 style="color:red; font-weight: bold">* <span style="color: black;">Tel Bimbit</span></h5>
                                                                <div class="input-group">
                                                                    <input type="text" name="penama_no" id="penama_no" class="form-control" value="<?php echo $penama_no; ?>" placeholder="Tiada Dash (-)" required="required" pattern="^(\+?6?01)[0-46-9]*[0-9]{7,8}$" oninvalid="InvalidPhonePenama(this);" oninput="InvalidPhonePenama(this);" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="card card">
                                            <div class="card-header card-success">
                                                <h3 class="card-title">Maklumat Tanggungan</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="overflow-x: auto;">
                                                            <table id="producttable" class="table table">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Nama</th>
                                                                        <th>No K/P</th>
                                                                        <th>Umur</th>
                                                                        <th>No Tel</th>
                                                                        <th>Pertalian</th>
                                                                        <th>Pekerjaan</th>
                                                                        <th> -->
                                                                        <input type="button" name="btn_add" class="d-none btn-success d-md-table-cell btnadd" value="Tambah" style="margin-left: auto; display: block; cursor: pointer;">
                                                                        <input type="button" name="btn_add" class="d-md-none d-sm btn-success btnadd1" value="Tambah" style="margin-left: auto; display: block; cursor: pointer;">
                                                                    </tr>
                                                                </thead>
                                                                <?php
                                                                $useragent = $_SERVER['HTTP_USER_AGENT'];
                                                                if ($row_tanggung == NULL) {
                                                                    foreach ($_POST['nama'] as $key => $item) {
                                                                        // $nama = $_POST['nama'];
                                                                        $ic = $_POST['ic'][$key];
                                                                        $umur = $_POST['umur'][$key];
                                                                        $tel = $_POST['tel'][$key];
                                                                        $kariah_pertalian = $_POST['kariah_pertalian'][$key];
                                                                        $kariah_pekerjaan = $_POST['kariah_pekerjaan'][$key];
                                                                        $mati_tanggung = $_POST['mati_tanggung'][$key];
                                                                ?>
                                                                        <tr>
                                                                            <?php
                                                                            if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
                                                                                echo '<td class="d-md-none d-sm-table-cell"><hr><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" value="' . $item . '" placeholder="Nama" /><br><input type="text" name="ic[]" id="ic" class="form-control ic" value="' . $ic . '"  placeholder="No K/P" /><br><input type="number" name="tel[]" class="form-control tel" value="' . $tel . '" placeholder="No Tel (Jika Ada)" /><br><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" value="' . $kariah_pertalian . '"  placeholder="Pertalian" /><br><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" value="' . $kariah_pekerjaan . '"  placeholder="Pekerjaan" /><input type="hidden" name="mati_tanggung[]" id="mati_tanggung" class="form-control mati_tanggung" value="' . $mati_tanggung . '"  placeholder=""  /><br><button type="button" name="btn_remove" class="btn btn-danger btn-xs btnremove"><span class="fas fa-trash"></span></button><br><br></td>';
                                                                            } else {
                                                                                echo '<td class="d-none d-md-table-cell"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control1 nama" value="' . $item . '" placeholder="Nama" /></td>';
                                                                                echo '<td class="d-none d-md-table-cell"><input type="text" name="ic[]" id="ic" class="form-control2 ic" value="' . $ic . '"  placeholder="No K/P" /></td>';
                                                                                echo '<input type="hidden" name="umur[]" class="form-control3 umur" value="' . $umur . '"  placeholder="Umur" /></td>';
                                                                                echo '<td class="d-none d-md-table-cell"><input type="number" name="tel[]" class="form-control2 tel" value="' . $tel . '"  placeholder="No Tel (Jika Ada)" /></td>';
                                                                                echo '<td class="d-none d-md-table-cell"><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control2 kariah_pertalian" value="' . $kariah_pertalian . '"  placeholder="Pertalian" /></td>';
                                                                                echo '<td class="d-none d-md-table-cell"><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control2 kariah_pekerjaan" value="' . $kariah_pekerjaan . '"  placeholder="Pekerjaan" /></td>';
                                                                                echo '<input type="hidden" name="mati_tanggung[]" id="mati_tanggung" class="form-control mati_tanggung" value="' . $mati_tanggung . '"  placeholder=""  />';
                                                                                echo '<td class="d-none d-md-table-cell"><center><button type="button" name="btn_remove" class="btn btn-danger btn-xs btnremove"><span class="fas fa-trash"></span></button></center></td>';
                                                                            }

                                                                            ?>
                                                                        </tr>
                                                                    <?php } ?>

                                                                    <?php
                                                                } else {
                                                                    foreach ($row_tanggung as $item_tanggung) {
                                                                        $select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id =  '{$item_tanggung['kariah_id']}' ");
                                                                        $select->execute();
                                                                        $row_komitment = $select->fetchAll(PDO::FETCH_ASSOC);
                                                                    ?>
                                                                        <tr>
                                                                            <?php
                                                                            if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
                                                                                echo '<td class="d-md-none d-sm-table-cell"><hr><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control nama" value="' . $item_tanggung['nama'] . '" placeholder="Nama" /><br><input type="text" name="ic[]" id="ic" class="form-control ic" value="' . $item_tanggung['ic'] . '"  placeholder="No K/P" /><br><input type="number" name="tel[]" class="form-control tel" value="' . $item_tanggung['tel'] . '" placeholder="No Tel (Jika Ada)" /><br><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pertalian" value="' . $item_tanggung['kariah_pertalian'] . '"  placeholder="Pertalian" /><br><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control kariah_pekerjaan" value="' . $item_tanggung['kariah_pekerjaan'] . '"  placeholder="Pekerjaan" /><input type="hidden" name="mati_tanggung[]" id="mati_tanggung" class="form-control mati_tanggung" value="' . $item_tanggung['mati_tanggung'] . '"  placeholder=""  /><br><button type="button" name="btn_remove" class="btn btn-danger btn-xs btnremove"><span class="fas fa-trash"></span></button><br><br></td>';
                                                                            } else {
                                                                                echo '<td class="d-none d-md-table-cell"><input type="text" name="nama[]" id="nama" onKeyUP="this.value = this.value.toUpperCase();" class="form-control1 nama" value="' . $item_tanggung['nama'] . '" placeholder="Nama" /></td>';
                                                                                echo '<td class="d-none d-md-table-cell"><input type="text" name="ic[]" id="ic" class="form-control2 ic" value="' . $item_tanggung['ic'] . '"  placeholder="No K/P" /></td>';
                                                                                echo '<input type="hidden" name="umur[]" class="form-control3 umur" value="' . $item_tanggung['umur'] . '"  placeholder="Umur" /></td>';
                                                                                echo '<td class="d-none d-md-table-cell"><input type="number" name="tel[]" class="form-control2 tel" value="' . $item_tanggung['tel'] . '"  placeholder="No Tel (Jika Ada)" /></td>';
                                                                                echo '<td class="d-none d-md-table-cell"><input type="text" name="kariah_pertalian[]" id="kariah_pertalian" onKeyUP="this.value = this.value.toUpperCase();" class="form-control2 kariah_pertalian" value="' . $item_tanggung['kariah_pertalian'] . '"  placeholder="Pertalian" /></td>';
                                                                                echo '<td class="d-none d-md-table-cell"><input type="text" name="kariah_pekerjaan[]" id="kariah_pekerjaan" onKeyUP="this.value = this.value.toUpperCase();" class="form-control2 kariah_pekerjaan" value="' . $item_tanggung['kariah_pekerjaan'] . '"  placeholder="Pekerjaan" /></td>';
                                                                                echo '<input type="hidden" name="mati_tanggung[]" id="mati_tanggung" class="form-control mati_tanggung" value="' . $item_tanggung['mati_tanggung'] . '"  placeholder=""  />';
                                                                                echo '<td class="d-none d-md-table-cell"><center><button type="button" name="btn_remove" class="btn btn-danger btn-xs btnremove"><span class="fas fa-trash"></span></button></center></td>';
                                                                            }
                                                                            ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div align="center">
                                            <input type="submit" name="btn_update_kariah" value="Kemaskini" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="card card">
                                <div class="card-header" style="background-color: #FF0000;">
                                    <h3 class="card-title" style="color:White">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Penting
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-ban"></i> Nota!</h5>
                                        <ul>
                                            <li>Ruangan bertanda * wajib diisi</li><br>
                                            <li>Pastikan anda mendaftar pada kariah surau yang betul</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top" style="float: right;  position:relative; bottom: 10px; right: 20px;  ">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <?php include_once 'footer2.php'; ?>
</div>