<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php foreach ($daftar as $key => $value) { ?>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary py-3">
                    <div class="text-center">
                        <h6 class="m-0 font-weight-bold text-white"><i class="fa fa-user"></i>&nbsp; Data Diri Pendaftar</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header bg-primary">
                                    <div class="text-white text-center">
                                        Foto Pendaftar
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group text-center">
                                        <img src=<?= base_url('./media/daftar/' . $value['foto']); ?> class="img-fluid" style="height: 200px;" />
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header bg-primary">
                                    <div class="text-white text-center">
                                        KTP Pendaftar
                                    </div>
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
                                        <label for="disabledTextInput" class="form-label">Nama Lengkap</label>
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
                                        <?php if ($value['pekerjaan_lainnya'] == "") { ?>
                                            <input type="text" id="disabledTextInput" class="form-control" value=" <?= $value['pekerjaan'] ?>">
                                        <?php } else { ?>
                                            <input type="text" id="disabledTextInput" class="form-control" value=" <?= $value['pekerjaan_lainnya'] ?> (<?= $value['pekerjaan'] ?>)">
                                        <?php } ?>
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Apakah punya pengalaman menjadi petugas sensus / survei ?</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value="<?= $value['pengalaman'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Lokasi Penempatan Yang Anda Inginkan</label>
                                        <input type="text" id="disabledTextInput" class="form-control" value=" <?= $value['penempatan'] ?>, <?= $value['penempatan2'] ?>">
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Ijazah Terakhir</label>
                                        <br>
                                        <a href="<?= base_url('./media/daftar/' . $value['ijazah']); ?>" target="_blank"><i class="btn btn-primary btn-sm"> Lihat</i></a>
                                        <div class="mb-3"></div>
                                        <label for="disabledTextInput" class="form-label">Deskripsi Singkat</label>
                                        <textarea class="form-control" rows="3" id="alamat_wp" disabled="disabled" style="height: 160px;"><?= $value['perkenalan'] ?></textarea>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <hr>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="card-action py-3 text-center">
                                <a href="<?= base_url('admin/pendaftar/pengumuman/' . $value['id_pengumuman']) ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<!-- /.container-fluid -->