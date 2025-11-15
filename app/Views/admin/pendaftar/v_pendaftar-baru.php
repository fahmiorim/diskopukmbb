<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php foreach ($daftar as $key => $value) { ?>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendaftar</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header bg-primary">
                                    <div class="text-white">Foto Pendaftar</div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group text-center">
                                        <img src=<?= base_url('./media/daftar/' . $value['foto']); ?> class="img-fluid" style="height: 200px;" />
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header bg-primary">
                                    <div class="text-white">KTP Pendaftar</div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group text-center">
                                        <img src=<?= base_url('./media/daftar/' . $value['ktp']); ?> class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <form>
                                <fieldset disabled>
                                    <div class="col-sm-12 mb-3">
                                        <label for="disabledTextInput" class="form-label">Nama</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['name'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">NIK</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['nik'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Email Aktif</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['email'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">No HP / WA</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['nohp'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Alamat Domisili saat ini</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['kecamatan_name'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Alamat Domisili Sama dengan Alamat KTP ?</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['alamat_sesuai'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Tanggal Lahir</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['date_birth'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Jenis Kelamin</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['jenis_kelamin'] ?>">

                                    </div>
                                </fieldset>
                            </form>
                        </div>

                        <div class="col-lg-4">
                            <form>
                                <fieldset disabled>
                                    <div class="col-sm-12 mb-3">
                                        <label for="disabledTextInput" class="form-label">Agama</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['agama'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Status Perkawinan</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['status'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Ijazah Tertinggi</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['pendidikan'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Pekerjaan/Kegiatan Sehari-hari</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Apakah punya pengalaman menjadi petugas sensus / survei ?</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['pengalaman'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Lokasi Penempatan Yang Anda Inginkan</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value=" <?= $value['penempatan'] ?>, <?= $value['penempatan2'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Ijazah Terakhir</label>
                                        <input type="text" id="disabledTextInput" class="form-control">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Deskripsi Singkat</label>
                                        <textarea class="form-control" rows="3" id="alamat_wp" disabled="disabled" style="height: 150px;"><?= $value['perkenalan'] ?></textarea>
                                    </div>
                                </fieldset>
                            </form>
                        </div>




                        <!-- <div class=" form-group row">
                                <label class="col-form-label col-sm-6">NIK</label>
                                <label class="col-form-label col-sm-6">: <?= $value['nik'] ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Email Aktif</label>
                                <label class="col-form-label col-sm-6">: <?= $value['email'] ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">No HP / WA</label>
                                <label class="col-form-label col-sm-6">: <?= $value['nohp'] ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Alamat Domisili saat ini</label>
                                <label class="col-form-label col-sm-6">: <?= $value['alamat'] ?>, Kecamatan <?= $value['kecamatan_name'] ?>, Desa <?= $value['desa_name'] ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Alamat Domisili Sama dengan Alamat pada KTP?</label>
                                <label class="col-form-label col-sm-6">: <?= $value['alamat_sesuai'] ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Tanggal Lahir</label>
                                <label class="col-form-label col-sm-6">: <?= $value['date_birth'] ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Jenis Kelamin</label>
                                <label class="col-form-label col-sm-6">: <?= $value['jenis_kelamin'] ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Agama</label>
                                <label class="col-form-label col-sm-6">: <?= $value['agama'] ?></label>
                            </div> -->
                        <!-- <div class="form-group row">
                            <label class="col-form-label col-sm-6">Status Perkawinan</label>
                            <label class="col-form-label col-sm-6">: <?= $value['status'] ?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-6">Ijazah Tertinggi</label>
                            <label class="col-form-label col-sm-6">: <?= $value['pendidikan'] ?></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-6">Pekerjaan/Kegiatan Sehari-hari</label>
                            <?php if ($value['pekerjaan_lainnya'] == "") { ?>
                                <label class="col-form-label col-sm-6">: <?= $value['pekerjaan'] ?></label>
                            <?php } else { ?>
                                <label class="col-form-label col-sm-6">: <?= $value['pekerjaan_lainnya'] ?> (<?= $value['pekerjaan'] ?>)</label>
                            <?php } ?>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-6">Apakah punya pengalaman menjadi petugas sensus/survei ?</label>
                            <label class="col-form-label col-sm-6">: <?= $value['pengalaman'] ?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-6">Lokasi Penempatan Yang Anda Inginkan</label>
                            <label class="col-form-label col-sm-6">: <?= $value['penempatan'] ?>, <?= $value['penempatan2'] ?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-6">Ijazah Terakhir</label>
                            <label class="col-form-label col-sm-6">: <a href="<?= base_url('./media/daftar/' . $value['ijazah']); ?>" target="_blank">Lihat</a></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-6">Deskripsi Singkat</label>
                            <label class="col-form-label col-sm-6">: <?= $value['perkenalan'] ?></label>
                        </div> -->
                        <div class="card-action py-3 text-center">
                            <a href="<?= base_url('admin/pendaftar/pengumuman/' . $value['id_pengumuman']) ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Kembali</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>
</div>
</div>
<?php } ?>
</div>


<!-- /.container-fluid -->