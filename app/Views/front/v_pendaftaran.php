    <!--=== Content Part ===-->
    <div class="container content">
        <div class="row">
            <!-- Begin Content -->
            <div class="col-md-12 d-flex justify-content-center">
                <!-- Checkout-Form -->
                <form action="<?= base_url('pendaftaran/pendaftaran_save/' . $pendaftaran['id']); ?>" id="sky-form" class="sky-form" method="post" enctype="multipart/form-data">
                    <header class="text-center" style="color:white; background: linear-gradient( 90deg, rgba(0,77,149,255) 0%, rgba(2,103,185,255) 100%, rgba(0,77,149,255) 100% );"><?= $pendaftaran['form_judul']; ?></header>
                    <div class="d-flex justify-content-center">
                        <fieldset>
                            <?php $validation = \Config\Services::validation(); ?>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Nama Lengkap (Sesuai KTP)</label>
                                    <label class="col-sm-8">
                                        <input class="form-control" type="text" name="name" value="<?= old('name'); ?>">
                                        <?php if ($validation->getError('name')) { ?>
                                            <div class='note note-error alert-danger'>
                                                <?= $error = $validation->getError('name'); ?>
                                            </div>
                                        <?php } ?>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Nomor Induk KTP (NIK)</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="nik" value="<?= old('nik'); ?>">
                                        <?php if ($validation->getError('nik')) { ?>
                                            <div class='note note-error alert-danger'>
                                                <?= $error = $validation->getError('nik'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Email Aktif</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="email" value="<?= old('email'); ?>">
                                        <?php if ($validation->getError('email')) { ?>
                                            <div class='note note-error alert-danger'>
                                                <?= $error = $validation->getError('email'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">No HP / WA</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="nohp" value="<?= old('nohp'); ?>">
                                        <?php if ($validation->getError('nohp')) { ?>
                                            <div class='note note-error alert-danger'>
                                                <?= $error = $validation->getError('nohp'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Alamat Domisili saat ini</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="alamat" value="<?= old('alamat'); ?>">
                                        <?php if ($validation->getError('alamat')) { ?>
                                            <div class='note note-error alert-danger'>
                                                <?= $error = $validation->getError('alamat'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4"></label>
                                    <div class="col col-4">
                                        <label class="select">
                                            <select name="kecamatan_kode" id="kecamatan" role="button" name="kecamatan_kode">
                                                <option value="none" selected disabled>Pilih Kecamatan</option>
                                                <?php foreach ($kecamatan as $key => $value) { ?>
                                                    <option value="<?= $value['kecamatan_kode'] ?>" <?php if ($value['kecamatan_kode'] == old('kecamatan_kode')) echo "selected" ?>><?= $value['kecamatan_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <i></i>
                                            <?php if ($validation->getError('kecamatan_kode')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('kecamatan_kode'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                    <div class="col col-4">
                                        <label class="select">
                                            <select class="form-control" id="desa" role="button" name="desa_kode">
                                            </select>
                                            <i></i>
                                            <?php if ($validation->getError('desa_kode')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('desa_kode'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Alamat Domisili Sama dengan Alamat pada KTP?</label>
                                    <div class="col-sm-8 inline-group">
                                        <label class="radio"><input type="radio" value="ya" name="alamat_sesuai"><i class="rounded-x"></i>Ya</label>
                                        <label class="radio"><input type="radio" value="tidak" name="alamat_sesuai"><i class="rounded-x"></i>Tidak</label>
                                        <label for="">
                                            <?php if ($validation->getError('alamat_sesuai')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('alamat_sesuai'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Tanggal Lahir</label>
                                    <div class="col-sm-6">
                                        <label class="input">
                                            <input type="date" class="form-control" name="date_birth" value="<?= old('date_birth'); ?>">
                                            <?php if ($validation->getError('date_birth')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('date_birth'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Jenis Kelamin</label>
                                    <div class="col-sm-8 inline-group">
                                        <label class="radio"><input type="radio" value="Laki-Laki" name="jenis_kelamin"><i class="rounded-x"></i>Laki-Laki</label>
                                        <label class="radio"><input type="radio" value="Perempuan" name="jenis_kelamin"><i class="rounded-x"></i>Perempuan</label>
                                        <label for="">
                                            <?php if ($validation->getError('jenis_kelamin')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('jenis_kelamin'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Agama</label>
                                    <div class="col col-6">
                                        <label class="select">
                                            <select name="agama">
                                                <option value="none" selected disabled>Pilih Agama</option>
                                                <?php foreach ($religion as $key => $value) { ?>
                                                    <option value="<?= $value['religion_name'] ?>" <?php if ($value['religion_name'] == old('religion_name')) echo "selected" ?>><?= $value['religion_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <i></i>
                                            <?php if ($validation->getError('agama')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('agama'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Status Perkawinan</label>
                                    <div class="col col-6">
                                        <label class="select">
                                            <select name="status">
                                                <option value="none" selected disabled>Pilih Status Perkawinan</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                                <option value="Kawin">Kawin</option>
                                                <option value="Cerai Hidup">Cerai Hidup</option>
                                                <option value="Cerai Mati">Cerai Mati</option>
                                            </select>
                                            <i></i>
                                            <?php if ($validation->getError('status')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('status'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Ijazah Tertinggi</label>
                                    <div class="col col-6">
                                        <label class="select">
                                            <select name="pendidikan">
                                                <option value="none" selected disabled>Pilih Ijazah Tertinggi</option>
                                                <?php foreach ($education as $key => $value) { ?>
                                                    <option value="<?= $value['education_name'] ?>" <?php if ($value['education_name'] == old('education_name')) echo "selected" ?>><?= $value['education_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <i></i>
                                            <?php if ($validation->getError('pendidikan')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('pendidikan'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Pekerjaan/Kegiatan Sehari-hari</label>
                                    <div class="col col-6">
                                        <label class="select">
                                            <select name="pekerjaan" id="pekerjaan">
                                                <option value="none" selected disabled>Pilih Pekerjaan/Kegiatan Sehari-hari</option>
                                                <option value="Aparat Desa / Kelurahan">Aparat Desa / Kelurahan</option>
                                                <option value="Kader PKK / Karang Taruna / Kader Lainnya">Kader PKK / Karang Taruna / Kader Lainnya</option>
                                                <option value="Pegawai / Guru Honorer">Pegawai / Guru Honorer</option>
                                                <option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
                                                <option value="Wiraswasta">Wiraswasta</option>
                                                <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            <i></i>
                                            <?php if ($validation->getError('pekerjaan')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('pekerjaan'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                        <input class="form-control" type="text" id="pekerjaan_lainnya" name="pekerjaan_lainnya" value="<?= old('pekerjaan_lainnya'); ?>">
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Apakah punya pengalaman menjadi petugas sensus/survei ?</label>
                                    <div class="col-sm-8 inline-group">
                                        <label class="radio"><input type="radio" value="ya" name="pengalaman"><i class="rounded-x"></i>Ya</label>
                                        <label class="radio"><input type="radio" value="tidak" name="pengalaman"><i class="rounded-x"></i>Tidak</label>
                                        <label for="">
                                            <?php if ($validation->getError('pengalaman')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('pengalaman'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Lokasi Penempatan Yang Anda Inginkan</label>
                                    <div class="col col-4">
                                        <label>Pilihan 1</label>
                                        <label class="select">
                                            <select name="penempatan" id="kecamatan" role="button">
                                                <option value="none" selected disabled>Pilih Kecamatan</option>
                                                <?php foreach ($kecamatan as $key => $value) { ?>
                                                    <option value="<?= $value['kecamatan_name'] ?>" <?php if ($value['kecamatan_name'] == old('kecamatan_name')) echo "selected" ?>><?= $value['kecamatan_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <i></i>
                                            <?php if ($validation->getError('penempatan')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('penempatan'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                    <div class="col col-4">
                                        <label>Pilihan 2</label>
                                        <label class="select">
                                            <select name="penempatan2" id="kecamatan" role="button">
                                                <option value="none" selected disabled>Pilih Kecamatan</option>
                                                <?php foreach ($kecamatan as $key => $value) { ?>
                                                    <option value="<?= $value['kecamatan_name'] ?>" <?php if ($value['kecamatan_name'] == old('kecamatan_name')) echo "selected" ?>><?= $value['kecamatan_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <i></i>
                                            <?php if ($validation->getError('penempatan')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('penempatan2'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>

                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Pas Foto Terbaru</label>
                                    <div class="col-sm-6">
                                        <label for="file" class="input input-file">
                                            <div class="button"><input type="file" name="foto" multiple onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" readonly>
                                            <?php if ($validation->getError('foto')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('foto'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Foto KTP</label>
                                    <div class="col-sm-6">
                                        <label for="file" class="input input-file">
                                            <div class="button"><input type="file" name="ktp" multiple onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" readonly>
                                            <?php if ($validation->getError('ktp')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('ktp'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Foto Ijazah Terakhir</label>
                                    <div class="col-sm-6">
                                        <label for="file" class="input input-file">
                                            <div class="button"><input type="file" name="ijazah" multiple onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" readonly>
                                            <?php if ($validation->getError('ijazah')) { ?>
                                                <div class='note note-error alert-danger'>
                                                    <?= $error = $validation->getError('ijazah'); ?>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </section>
                            </div>

                            <div class="row">
                                <section class="col-md-12">
                                    <label class="col-form-label col-sm-4">Deskripsikan diri anda secara singkat</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="4" type="text" name="perkenalan"><?= old('perkenalan'); ?></textarea>
                                        <?php if ($validation->getError('perkenalan')) { ?>
                                            <div class='note note-error alert-danger'>
                                                <?= $error = $validation->getError('perkenalan'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col-md-12">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4 text-center"> <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-paper-plane"></i> Kirim</button>
                                        <a href="<?= base_url(); ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Batal</a>
                                    </div>
                                    <div class="col-sm-4"></div>
                                </section>
                            </div>
                        </fieldset>
                        <footer>
                        </footer>
                    </div>
                </form>
                <!-- End Checkout-Form -->
            </div>
            <!-- End Content -->
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#kecamatan").change(function() {
                var url = "<?php echo site_url('pendaftaran/add_ajax_des'); ?>/" + $(this).val();
                $('#desa').load(url);
                return false;
            })
            // Website Usaha
            $("#pekerjaan_lainnya").hide();
            $('#pekerjaan').on('change', function() {
                var value = $(this).val();
                if (value !== "Lainnya") {
                    $("#pekerjaan_lainnya").hide();
                } else if (value == "Lainnya") {
                    $("#pekerjaan_lainnya").show();
                }
            });
            // End Website Usaha
        });
    </script>