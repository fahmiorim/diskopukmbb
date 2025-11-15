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
                                <div class="card-header">
                                    Foto Pendaftar
                                </div>
                                <div class="card-body">
                                    <div class="form-group text-center">
                                        <img src=<?= base_url('./media/daftar/' . $value['foto']); ?> class="img-fluid" style="height: 200px;" />
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    KTP Pendaftar
                                </div>
                                <div class="card-body">
                                    <div class="form-group text-center">
                                        <img src=<?= base_url('./media/daftar/' . $value['ktp']); ?> class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Nama Lengkap</label>
                                <label class="col-form-label col-sm-6">: <?= $value['name'] ?></label>
                            </div>
                            <div class="form-group row">
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
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Status Perkawinan</label>
                                <label class="col-form-label col-sm-6">: <?= $value['status'] ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Ijazah Tertinggi</label>
                                <label class="col-form-label col-sm-6">: <?= $value['pendidikan'] ?></label>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                        </div> -->
                        <div class="col-md-12">
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
                            </div>
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