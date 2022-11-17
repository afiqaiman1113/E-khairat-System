<input name="invoice_no" type="hidden" class="form-control" value="<?php $b = rand(10,10000);$c = $b;echo $c; ?>" autofocus="on" readonly="readonly" />
<input type="hidden" name="p_method" class="form-control" placeholder="" value="FPX" />
<input type="hidden" name="khairat_name" class="form-control" placeholder="" value="<?php echo $kariah_name; ?>" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" readonly />
<input type="hidden" name="approvement" class="form-control" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan nama')" oninput="setCustomValidity('')" readonly />
<input type="hidden" name="khairat_ic" class="form-control" placeholder="" value="<?php echo $kariah_ic; ?>" required="" oninvalid="this.setCustomValidity('Wajib isi')" oninput="setCustomValidity('')" readonly />
<input type="hidden" name="khairat_umur" class="form-control" placeholder="" value="<?php echo $kariah_umur; ?>" readonly />
<input type="hidden" name="khairat_email" class="form-control" placeholder="" value="<?php echo $user_email; ?>" readonly />
<select name="jantina" class="form-control" id="" readonly hidden>
    <option value='<?php echo $jantina; ?>'><?php echo $jantina; ?></option>
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
<input type="hidden" name="pekerjaan" class="form-control" placeholder="" value="<?php echo $pekerjaan; ?>" readonly />
<input type="hidden" name="alamat" class="form-control" placeholder="" value="<?php echo $alamat; ?>" readonly />
<input type="hidden" name="alamat2" class="form-control" placeholder="" value="<?php echo $alamat2; ?>" readonly />
<input type="hidden" name="poskod" class="form-control" placeholder="" value="<?php echo $poskod; ?>" readonly />
<input type="hidden" name="bandar" class="form-control" placeholder="" value="<?php echo $bandar; ?>" readonly />
<select name="negeri" class="form-control" id="" readonly hidden>
    <option value='<?php echo $negeri; ?>'><?php echo $negeri; ?></option>
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
<select name="s_menetap" class="form-control" id="" readonly hidden>
    <option value='<?php echo $s_menetap; ?>'><?php echo $s_menetap; ?></option>
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
<input type="hidden" name="tel_rumah" class="form-control" value="<?php echo $tel_rumah; ?>" placeholder="" readonly />
<input type="hidden" name="tel_hp" class="form-control" value="<?php echo $tel_hp; ?>" placeholder="" readonly />
<select name="kawasan" class="form-control" id="" readonly hidden>
    <option value='<?php echo $kawasan; ?>'><?php echo $kawasan; ?></option>
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
    } elseif ($kawasan == 'Surau Hj Husin') {
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Kg Tok Kau'>Surau Kg Tok Kau</option>";
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
        echo "<option value='Surau Hj Husin'>Surau Hj Husin</option>";
        echo "<option value='Surau Haji Abdul Bt 18'>Surau Haji Abdul Bt 18</option>";
    }
    ?>
</select>
<input type="hidden" name="tahun_menetap" class="form-control" value='<?php echo $tahun_menetap; ?>' placeholder="" readonly />

<select name="status_perkahwinan" class="form-control" id="" readonly hidden>
    <option value='<?php echo $status_perkahwinan; ?>'><?php echo $status_perkahwinan; ?></option>
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
<input type="hidden" name="penerima_bantuan" class="form-control" value="<?php echo $penerima_bantuan; ?>" placeholder="Kosongkan jika tiada" readonly />
<?php
foreach ($row_tanggung as $item_tanggung) {
    $select = $pdo->prepare("SELECT * FROM tbl_tanggung WHERE kariah_id =  '{$item_tanggung['kariah_id']}' ");
    $select->execute();

    $row_komitment = $select->fetchAll(PDO::FETCH_ASSOC);
?>

    <tr>
        <?php
        echo '<td><input type="hidden" name="nama[]" class="form-control nama" value="' . $item_tanggung['nama'] . '" placeholder="" readonly /></td>';
        echo '<td><input type="hidden" name="ic[]" class="form-control ic" value="' . $item_tanggung['ic'] . '"  placeholder="" readonly /></td>';
        echo '<td><input type="hidden" name="umur[]" class="form-control umur" value="' . $item_tanggung['umur'] . '"  placeholder="" readonly /></td>';
        echo '<td><input type="hidden" name="tel[]" class="form-control tel" value="' . $item_tanggung['tel'] . '"  placeholder="" readonly /></td>';
        echo '<td><input type="hidden" name="pertalian[]" class="form-control pertalian" value="' . $item_tanggung['kariah_pertalian'] . '"  placeholder="" readonly /></td>';
        echo '<td><input type="hidden" name="khairat_pekerjaan[]" class="form-control khairat_pekerjaan" value="' . $item_tanggung['kariah_pekerjaan'] . '"  placeholder="" readonly /></td>';
        // echo '<td><center><button type="button" name="btn_remove" class="btn btn-danger btn-sm btnremove">Remove</button></center></td>';
        ?>
    </tr>

<?php } ?>