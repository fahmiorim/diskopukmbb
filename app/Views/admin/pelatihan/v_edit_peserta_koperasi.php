<div class="container">
    <form class="row" role="form" action="<?= base_url('admin/pelatihan/peserta_save/'); ?>" method="post" enctype="multipart/form-data">
        <div class="col-lg-4">
            <div class="card mb-4">
                <?php foreach ($data_peserta as $key => $value) { ?>
                    <div class="card-header">
                        Foto Peserta
                    </div>
                    <div class="card-body">
                        <div class="form-group text-center">
                            <img id="blah" src=<?= base_url('./media/datakopukm/' . $value['profile_photo']) ?> class="mx-auto rounded-circle" width="200" height="200" />
                        </div>
                        <div class="form-group text-center">
                            <div class="upload-btn-wrapper">
                                <button class="btn-upload">Upload a file</button>
                                <input type="file" name="profile_photo" class="form-control tambah" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    Profile Peserta
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name" value="<?= $value['name'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Nomor Induk Kependudukan (NIK)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="id_number" value="<?= $value['id_number']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <select class="form-control" role="button" name="gender">
                                <option value="<?= $value['gender']; ?>" selected><?= $value['gender']; ?></option>
                                <option value="Laki-Laki" <?php if ("Laki-Laki" == old('gender')) echo "selected" ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if ("Perempuan" == old('gender')) echo "selected" ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Tempat Lahir</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="place_birth" value="<?= $value['place_birth']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Tanggal Lahir</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="date_birth" value="<?= $value['date_birth']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Agama</label>
                        <div class="col-sm-8">
                            <select class="form-control" role="button" name="religion_id">
                                <option value="<?= $value['religion_name']; ?>" selected><?= $value['religion_name']; ?></option>
                                <?php foreach ($religion as $key => $value) { ?>
                                    <option value="<?= $value['religion_id'] ?>" <?php if ($value['religion_id'] == old('religion_id')) echo "selected" ?>><?= $value['religion_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Education</label>
                        <div class="col-sm-8">
                            <select class="form-control" role="button" name="education_id">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($education as $key => $value) { ?>
                                    <option value="<?= $value['education_id'] ?>" <?php if ($value['education_id'] == old('education_id')) echo "selected" ?>><?= $value['education_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Alamat Rumah</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="address_participant"><?= old('address_participant'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Kecamatan</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="kecamatan" role="button" name="kecamatan_kode">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($kecamatan as $key => $value) { ?>
                                    <option value="<?= $value['kecamatan_kode'] ?>" <?php if ($value['kecamatan_kode'] == old('kecamatan_kode')) echo "selected" ?>><?= $value['kecamatan_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Desa</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="desa" role="button" name="desa_kode">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Nomor HP</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="phone_number" value="<?= old('phone_number'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Email</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="email" value="<?= old('email'); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    Data Koperasi atau UMKM Peserta
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Status Usaha</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="business_status" role="button" name="business_status_id">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($business_status as $key => $value) { ?>
                                    <option value="<?= $value['business_status_id'] ?>" <?php if ($value['business_status_id'] == old('business_status_id')) echo "selected" ?>><?= $value['business_status_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4" id="umkm">
                <div class="card-header">
                    Data UMKM
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Nama Usaha</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name_umkm" value="<?= old('name_umkm'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Alamat Usaha</label>
                        <div class="col-md-8">
                            <textarea type="text" class="form-control" name="address_umkm"><?= old('address_umkm'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Sektor Usaha</label>
                        <div class="col-sm-8">
                            <select class="form-control" role="button" name="business_sector_id">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($business_sector as $key => $value) { ?>
                                    <option value="<?= $value['business_sector_id'] ?>" <?php if ($value['business_sector_id'] == old('business_sector_id')) echo "selected" ?>><?= $value['business_sector_id'] ?>. <?= $value['business_sector_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4">Bidang Usaha</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="business_field_umkm" role="button" name="business_field_umkm_id">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($business_field_umkm as $key => $value) { ?>
                                    <option value="<?= $value['business_field_umkm_id'] ?>" <?php if ($value['business_field_umkm_id'] == old('business_field_umkm_id')) echo "selected" ?>><?= $value['business_field_umkm_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Tanggal Pendirian Usaha</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="date_establishment_umkm" value="<?= old('date_establishment_umkm'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">NPWP Usaha</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="npwp_umkm" value="<?= old('npwp_umkm'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Nomor Induk Berusaha (NIB)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nib_umkm" value="<?= old('nib_umkm'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Kekayaan Usaha (Asset) per Tahun</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="tel" name="asset_umkm" class="form-control rupiah" value="<?= old('asset_umkm'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Volume Usaha (Omset) per Tahun</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="tel" name="omset_umkm" class="form-control rupiah" value="<?= old('omset_umkm'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jumlah Karyawan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input name="number_employees" type="number" class="form-control" value="<?= old('number_employees'); ?>">
                                <div class=" input-group-append">
                                    <div class="input-group-text">Orang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Kapasitas Produksi per Tahun</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="production_capacity" value="<?= old('production_capacity'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Anggota Koperasi</label>
                        <div class="col-md-8">
                            <select class="form-control" name="member_koperasi" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="1" <?php if ("1" == old('member_koperasi')) echo "selected" ?>>Ya</option>
                                <option value="0" <?php if ("0" == old('member_koperasi')) echo "selected" ?>>Tidak</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom none mb-4" id="koperasi">
                <div class="card-header">
                    <h6 class="mb-0">Data Koperasi</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Nomor Induk Koperasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="registrasion_number_koperasi" value="<?= old('registrasion_number_koperasi'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Nama Koperasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="name_koperasi" value="<?= old('name_koperasi'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Nomor Badan Hukum</label>
                        <div class="col-md-8">
                            <input class="form-control" name="legal_entity_number" value="<?= old('legal_entity_number'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Tanggal Pendirian Koperasi</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="date_establishment_koperasi" value="<?= old('date_establishment_koperasi'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Alamat Koperasi</label>
                        <div class="col-md-8">
                            <textarea class="form-control form-control-sm" name="address_koperasi" rows="3"><?= old('address_koperasi'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jenis Koperasi</label>
                        <div class="col-md-8">
                            <select class="form-control" name="type_koperasi_id" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($type_koperasi as $key => $value) { ?>
                                    <option value="<?= $value['type_koperasi_id'] ?>" <?php if ($value['type_koperasi_id'] == old('type_koperasi_id')) echo "selected" ?>><?= $value['type_koperasi_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Kelompok Koperasi</label>
                        <div class="col-md-8">
                            <select class="form-control" name="group_koperasi_id" value="<?= old('group_koperasi_id'); ?>" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($group_koperasi as $key => $value) { ?>
                                    <option value="<?= $value['group_koperasi_id'] ?>" <?php if ($value['group_koperasi_id'] == old('group_koperasi_id')) echo "selected" ?>><?= $value['group_koperasi_id'] ?>. <?= $value['group_koperasi_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Sektor Usaha</label>
                        <div class="col-md-8">
                            <select class="form-control" name="business_sector_id" value="<?= old('business_sector_id'); ?>" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($business_sector as $key => $value) { ?>
                                    <option value="<?= $value['business_sector_id'] ?>" <?php if ($value['business_sector_id'] == old('koperasi_sector_id')) echo "selected" ?>><?= $value['business_sector_id'] ?>. <?= $value['business_sector_name'] ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Koperasi Binaan</label>
                        <div class="col-md-8">
                            <select class="form-control" name="fostered_koperasi_id" value="<?= old('fostered_koperasi_id'); ?>" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($fostered_koperasi as $key => $value) { ?>
                                    <option value="<?= $value['fostered_koperasi_id'] ?>" <?php if ($value['fostered_koperasi_id'] == old('fostered_koperasi_id')) echo "selected" ?>><?= $value['fostered_koperasi_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jabatan di Koperasi</label>
                        <div class="col-md-8">
                            <select class="form-control" name="position_koperasi_id" value="<?= old('position_koperasi_id'); ?>" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($position_koperasi as $key => $value) { ?>
                                    <option value="<?= $value['position_koperasi_id'] ?>" <?php if ($value['position_koperasi_id'] == old('position_koperasi_id')) echo "selected" ?>><?= $value['position_koperasi_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">NPWP Koperasi</label>
                        <div class="col-md-8">
                            <input class="form-control npwp" name="npwp_koperasi" value="<?= old('npwp_koperasi'); ?>" minlength="20" maxlength="20">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">RAT Terakhir</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Tahun</div>
                                </div>
                                <input type="tel" class="form-control" name="last_rat" value="<?= old('last_rat'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Status NIK</label>
                        <div class="col-md-8">
                            <select class="form-control" name="nik_status" value="<?= old('nik_status'); ?>" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="sudah bersertifikat" <?php if ("sudah bersertifikat" == old('nik_status')) echo "selected" ?>>Sudah Bersertifikat</option>
                                <option value="belum bersertifikat" <?php if ("belum bersertifikat" == old('nik_status')) echo "selected" ?>>Belum Bersertifikat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Bentuk Koperasi</label>
                        <div class="col-md-8">
                            <select class="form-control" name="form_koperasi_id" value="<?= old('form_koperasi_id'); ?>" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($form_koperasi as $key => $value) { ?>
                                    <option value="<?= $value['form_koperasi_id'] ?>" <?php if ($value['form_koperasi_id'] == old('form_koperasi_id')) echo "selected" ?>><?= $value['form_koperasi_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Asset Koperasi</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="tel" class="form-control rupiah" name="asset_koperasi" value="<?= old('asset_koperasi'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Omzet Koperasi</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="tel" class="form-control rupiah" name="omset_koperasi" value="<?= old('omset_koperasi'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">SHU Koperasi</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="tel" class="form-control rupiah" name="shu_koperasi" value="<?= old('shu_koperasi'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jumlah Anggota Laki-Laki</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="number" class="form-control" name="total_member_koperasi_men" value="<?= old('total_member_koperasi_men'); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">Orang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jumlah Anggota Perempuan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="number" class="form-control" name="total_member_koperasi_women" value="<?= old('total_member_koperasi_women'); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">Orang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jumlah Karyawan Laki-Laki</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="number" class="form-control" name="total_employee_koperasi_men" value="<?= old('total_employee_koperasi_men'); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">Orang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jumlah Karyawan Perempuan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="number" class="form-control" name="total_employee_koperasi_women" value="<?= old('total_employee_koperasi_women'); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">Orang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jangkauan Pemasaran Produk/Layanan Koperasi</label>
                        <div class="col-md-8">
                            <?php foreach ($marketing_reach_koperasi as $key => $value) { ?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="marketing_reach_koperasi_id" value="<?= $value['marketing_reach_koperasi_id'] ?>" <?php if ($value['marketing_reach_koperasi_id'] == old('marketing_reach_koperasi_id')) echo 'checked="checked"' ?> id="koperasi_marketing">
                                        <?= $value['marketing_reach_koperasi_name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                            <input class="form-control mt-2 none" name="marketing_reach_koperasi_non_local" id="koperasi_local" value="<?= old('marketing_reach_koperasi_non_local'); ?>" placeholder="Lokasi">
                        </div>
                    </div>


                </div>
            </div>
            <div class="card card-custom none mb-4" id="digitalisasi_usaha">
                <div class="card-header">
                    <h6 class="mb-0">Digitalisasi Usaha</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Email Usaha</label>
                        <div class="col-md-8">
                            <select class="form-control" id="business_email" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="Ada" <?php if ("Ada" == old('business_email')) echo "selected" ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ("Tidak Ada" == old('business_email')) echo "selected" ?>>Tidak Ada</option>
                            </select>
                            <input type="email" name="business_email" class="form-control mt-2 none" id="business_email_yes" value="<?= old('business_email'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Website Usaha</label>
                        <div class="col-md-8">
                            <select class="form-control" id="business_website" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="Ada" <?php if ("yes" == old('business_website')) echo "selected" ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ("no" == old('business_website')) echo "selected" ?>>Tidak Ada</option>
                            </select>
                            <input class="form-control mt-2 none" name="business_website" id="business_website_yes" value="<?= old('business_website'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Media Sosial Usaha</label>
                        <div class="col-md-8">
                            <?php foreach ($social_media as $key => $value) { ?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="sosmed_kode[]" value="<?= $value['sosmed_kode']; ?>" <?php if ($value['sosmed_kode'] == old($value['sosmed_kode'])) echo "checked" ?>>
                                        <?= $value['social_media_name']; ?>
                                    </label>
                                </div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Marketplace</label>
                        <div class="col-md-8">
                            <?php foreach ($marketplace as $key => $value) { ?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="<?= $value['marketplace_kode'] ?>" <?php if ($value['marketplace_kode'] == old($value['marketplace_kode'])) echo "checked" ?> name="marketplace_kode[]">
                                        <?= $value['marketplace_name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom none mb-4" id="pembiayaan_usaha">
                <div class="card-header">
                    <h6 class="mb-0">Pembiayaan Usaha</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Apakah pernah mengakses kredit perbankan/non-perbankan?</label>
                        <div class="col-md-8">
                            <select class="form-control" name="banking_credit" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="1" <?php if ("1" == old('banking_credit')) echo "selected" ?>>Ya</option>
                                <option value="0" <?php if ("0" == old('banking_credit')) echo "selected" ?>>Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Apakah memiliki tabungan?</label>
                        <div class="col-md-8">
                            <select class="form-control" name="savings" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="1" <?php if ("1" == old('banking_credit')) echo "selected" ?>>Ya</option>
                                <option value="0" <?php if ("0" == old('banking_credit')) echo "selected" ?>>Tidak</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom mb-4 none" id="transformasi_usaha">
                <div class="card-header">
                    <h6 class="mb-0">Transformasi Usaha</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Perizinan Usaha</label>
                        <div class="col-md-8">
                            <?php foreach ($business_licensing as $key => $value) { ?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="<?= $value['business_licensing_kode'] ?>" name="business_licensing_kode[]" <?php if ($value['business_licensing_kode'] == old($value['business_licensing_kode'])) echo "checked" ?>>
                                        <?= $value['business_licensing_name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Sertifikasi Produk/Usaha</label>
                        <div class="col-md-8">
                            <?php foreach ($business_certificate as $key => $value) { ?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="<?= $value['business_certificate_kode'] ?>" name="business_certificate_kode[]" <?php if ($value['business_certificate_kode']  == old($value['business_certificate_kode'])) echo "checked" ?>>
                                        <?= $value['business_certificate_name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom mb-4 none" id="rantai_pasok_ekspor">
                <div class="card-header">
                    <h6 class="mb-0">Rantai Pasok dan Ekspor</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Jangkauan Pemasaran Produk/Layanan Usaha</label>
                        <div class="col-md-8">
                            <?php foreach ($marketing_reach_koperasi as $key => $value) { ?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="marketing_reach_umkm_id" id="marketing_reach_umkm_id" value="<?= $value['marketing_reach_koperasi_id'] ?>" <?php if ($value['marketing_reach_koperasi_id'] == old('marketing_reach_umkm_id')) echo "checked" ?>>
                                        <?= $value['marketing_reach_koperasi_name'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                            <input class=" form-control mt-2 none" id="marketing_reach_umkm_optional" name="marketing_reach_umkm_optional" placeholder="Lokasi" value="<?= old('marketing_reach_umkm_optional') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Apakah Pernah Melakukan Ekspor?</label>
                        <div class="col-md-8">
                            <select class="form-control" id="export" name="export" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="1" <?php if ("1" == old('1')) echo "selected" ?>>Ya</option>
                                <option value="0" <?php if ("0" == old('0')) echo "selected" ?>>Tidak</option>
                            </select>
                            <select class="form-control mt-2 none" id="export_yes" name="export_delivery" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="pengiriman forwarder" <?php if ("pengiriman forwarder" == old('export_delivery')) echo "selected" ?>>Pengiriman Forwarder</option>
                                <option value="pengiriman langsung" <?php if ("pengiriman langsung" == old('export_delivery')) echo "selected" ?>>Pengiriman Langsung</option>
                            </select>
                        </div>
                    </div>
                    <div class="none" id="export_form">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Negara Tujuan</label>
                            <div class="col-md-8">
                                <input class="form-control" name="export_destination" id="export_destination" value="<?= old('export_destination') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Volume Ekspor per Tahun</label>
                            <div class="col-md-8">
                                <input class="form-control" name="export_volume" id="export_volume" value="<?= old('export_volume') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Nilai Ekspor</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="tel" class="form-control rupiah" name="export_value" id="export_value" value="<?= old('export_value') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Apakah bapak/ibu mensuplai produk sebagai bahan baku pada usaha lain?</label>
                        <div class="col-md-8">
                            <select class="form-control" name="product_supply" id="product_supply" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="1" <?php if ("1" == old('product_supply')) echo "selected" ?>>Ya</option>
                                <option value="0" <?php if ("0" == old('product_supply')) echo "selected" ?>>Tidak</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom mb-4 none" id="kemitraan_usaha">
                <div class="card-header">
                    <h6 class="mb-0">Kemitraan Usaha</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Apakah melakukan kemitraan dengan lembaga lain?</label>
                        <div class="col-md-8">
                            <select class="form-control" name="partnership" role="button">
                                <option disabled selected>Pilih</option>
                                <option value="1" <?php if ("1" == old('partnership')) echo "selected" ?>>Ya</option>
                                <option value="0" <?php if ("0" == old('partnership')) echo "selected" ?>>Tidak</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom mb-4 none" id="calon">
                <div class="card-header">
                    <h6 class="mb-0">Calon Wirausaha</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Ide Bisnis</label>
                        <div class="col-md-8">
                            <input class="form-control" name="business_idea" value="<?= old('business_idea') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Alamat Calon Usaha</label>
                        <div class="col-md-8">
                            <textarea class="form-control form-control-sm" name="entrepreneur_address" rows="3"><?= old('entrepreneur_address'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Sektor Calon Usaha</label>
                        <div class="col-md-8">
                            <select class="form-control" name="entrepreneur_sector_id" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($business_sector as $key => $value) { ?>
                                    <option value="<?= $value['business_sector_id'] ?>" <?php if ($value['business_sector_id'] == old('business_sector_id')) echo "selected" ?>><?= $value['business_sector_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Bidang Calon Usaha</label>
                        <div class="col-md-8">
                            <select class="form-control" name="business_field_entrepreneur_id" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($business_field_umkm as $key => $value) { ?>
                                    <option value="<?= $value['business_field_umkm_id'] ?>" <?php if ($value['business_field_umkm_id'] == old('business_field_umkm_id')) echo "selected" ?>><?= $value['business_field_umkm_id'] ?> <?= $value['business_field_umkm_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Pendamping yang didapatkan</label>
                        <div class="col-md-8">
                            <select class="form-control" id="accompaniment_entrepreneur_id" role="button" name="accompaniment_entrepreneur_id">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($accompaniment_entrepreneur as $key => $value) { ?>
                                    <option value="<?= $value['accompaniment_entrepreneur_id'] ?>" <?php if ($value['accompaniment_entrepreneur_id'] == old('accompaniment_entrepreneur_id')) echo "selected" ?>><?= $value['accompaniment_entrepreneur_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom mb-4 none" id="lainnya">
                <div class="card-header">
                    <h6 class="mb-0">Lain-Lainnya</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Permasalahan yang dihadapi dalam pengembangan usaha</label>
                        <div class="col-md-8">
                            <select class="custom-select" name="m1" id="m1" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($m1 as $key => $value) { ?>
                                    <option value="<?= $value['m1_id'] ?>" <?php if ($value['m1_id'] == old('m1')) echo "selected" ?>><?= $value['m1_name'] ?></option>
                                <?php } ?>
                            </select>
                            <input class="form-control none mt-2" name="other_m1" id="other_m1" value="<?= old('other_m1') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Kebutuhan Diklat</label>
                        <div class="col-md-8">
                            <select class="custom-select" name="m2_id" role="button">
                                <option disabled selected>Pilih</option>
                                <?php foreach ($m2 as $key => $value) { ?>
                                    <option value="<?= $value['m2_id'] ?>" <?php if ($value['m2_id'] == old('m2_id')) echo "selected" ?>><?= $value['m2_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Masukan/Saran</label>
                        <div class="col-md-8">
                            <textarea class="form-control form-control-sm" name="m3" rows="3"><?= old('m3'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row pt-4">
                        <div class="offset-md-4 col-md-8">
                            <button class="btn btn-block btn-primary" id="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function() {
        $("#umkm").hide();
        $("#koperasi").hide();
        $("#digitalisasi_usaha").hide();
        $("#pembiayaan_usaha").hide();
        $("#transformasi_usaha").hide();
        $("#rantai_pasok_ekspor").hide();
        $("#kemitraan_usaha").hide();
        $("#calon").hide();
        $('#business_status').on('change', function() {
            var value = $(this).val();
            if (value == "") {
                $("#umkm").hide();
                $("#koperasi").hide();
                $("#digitalisasi_usaha").hide();
                $("#pembiayaan_usaha").hide();
                $("#transformasi_usaha").hide();
                $("#rantai_pasok_ekspor").hide();
                $("#kemitraan_usaha").hide();
                $("#calon").hide();
            } else if (value == "1") {
                $("#umkm").show();
                $("#digitalisasi_usaha").show();
                $("#pembiayaan_usaha").show();
                $("#transformasi_usaha").show();
                $("#rantai_pasok_ekspor").show();
                $("#kemitraan_usaha").show();
                $("#koperasi").hide();
                $("#calon").hide();
            } else if (value == "2") {
                $("#koperasi").show();
                $("#digitalisasi_usaha").show();
                $("#transformasi_usaha").show();
                $("#kemitraan_usaha").show();
                $("#umkm").hide();
                $("#pembiayaan_usaha").hide();
                $("#rantai_pasok_ekspor").hide();
                $("#calon").hide();
            } else if (value == "3") {
                $("#koperasi").hide();
                $("#digitalisasi_usaha").hide();
                $("#transformasi_usaha").hide();
                $("#kemitraan_usaha").hide();
                $("#umkm").hide();
                $("#pembiayaan_usaha").hide();
                $("#rantai_pasok_ekspor").hide();
                $("#calon").show();
            }
        });

        // Koperasi
        $("#koperasi_local").hide();
        $('input[id="koperasi_marketing"]').click(function() {
            var inputValue = $(this).attr("value");
            if (inputValue == "1") {
                $("#koperasi_local").hide();
            } else if (inputValue == "2") {
                $("#koperasi_local").show();
            } else if (inputValue == "3") {
                $("#koperasi_local").show();
            } else if (inputValue == "4") {
                $("#koperasi_local").show();
            }
        });
        // End Koperasi
        // Digitalisasi Usaha
        $("#business_email_yes").hide();
        $('#business_email').on('change', function() {
            var value = $(this).val();
            if (value == "Tidak Ada") {
                $("#business_email_yes").hide();
            } else if (value == "Ada") {
                $("#business_email_yes").show();
            }
        });
        // End Digitalisasi Usaha
        // Website Usaha
        $("#business_website_yes").hide();
        $('#business_website').on('change', function() {
            var value = $(this).val();
            if (value == "Tidak Ada") {
                $("#business_website_yes").hide();
            } else if (value == "Ada") {
                $("#business_website_yes").show();
            }
        });
        // End Website Usaha

        // Rantai Pasok dan Ekspor 
        $("#marketing_reach_umkm_optional").hide();
        $('input[id="marketing_reach_umkm_id"]').click(function() {
            var inputValue = $(this).attr("value");
            if (inputValue == "1") {
                $("#marketing_reach_umkm_optional").hide();
            } else if (inputValue == "2") {
                $("#marketing_reach_umkm_optional").show();
            } else if (inputValue == "3") {
                $("#marketing_reach_umkm_optional").show();
            } else if (inputValue == "4") {
                $("#marketing_reach_umkm_optional").hide();
            }
        });

        $("#export_yes").hide();
        $("#export_form").hide();
        $('#export').on('change', function() {
            var value = $(this).val();
            if (value == "0") {
                $("#export_yes").hide();
                $("#export_form").hide();
            } else if (value == "1") {
                $("#export_yes").show();
                $("#export_form").show();
            }
        });
        // End Rantai Pasok dan Ekspor

        // Lain-Lainnya
        $("#other_m1").hide();
        $('#m1').on('change', function() {
            var value = $(this).val();
            if (value == "1" || value == "2" || value == "3" || value == "4" || value == "5" || value == "6") {
                $("#other_m1").hide();
            } else if (value == "7") {
                $("#other_m1").show();
            }
        });
        // End Lain-Lainnya
    });
</script>

<script>
    $(document).ready(function() {
        $("#kecamatan").change(function() {
            var url = "<?php echo site_url('admin/pelatihan/add_ajax_des'); ?>/" + $(this).val();
            $('#desa').load(url);
            return false;
        })
    });
</script>