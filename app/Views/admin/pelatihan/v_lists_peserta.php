<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card card-custom mb-4">
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Jenis Pelatihan</label>
                            <label class="col-form-label col-sm-10">: <?= $pelatihan['training_name']; ?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Judul Pelatihan</label>
                            <label class="col-form-label col-sm-10">: <?= $pelatihan['training_title']; ?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Tanggal Pelaksanaan</label>
                            <label class="col-form-label col-sm-10">: <?= format_indo($pelatihan['start_date']); ?> s/d <?= format_indo($pelatihan['finish_date']); ?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tempat Pelaksanaan</label>
                            <label class="col-form-label col-md-10">: <?= $pelatihan['place']; ?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Status</label>
                            <label class="col-form-label col-md-10">: <?php
                                                                        $tgl_now = date("Y-m-d");
                                                                        if ($tgl_now > $pelatihan['finish_date']) {
                                                                            echo '<button class="btn btn-danger btn-sm">Expired</button>';
                                                                        } else {
                                                                            echo "Aktif";
                                                                        } ?>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <a href="<?= base_url('admin/pelatihan/peserta_tambah/' . $pelatihan['training_id']) ?>" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Peserta</span>
            </a>

            <a href="<?= base_url('admin/pelatihan/') ?>" class="btn btn-danger float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-reply"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div>
        <div class="swal" data-swal="<?= session()->getFlashdata('success') ?>"></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Usia</th>
                            <th>Telp/HP</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Usia</th>
                            <th>Telp/HP</th>
                            <th width="150px">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($peserta as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['name']; ?></td>
                                <td><?= $value['gender']; ?></td>
                                <td class="text-center" width="100px"> <?php
                                                                        $birthDate = $value['date_birth'];
                                                                        $currentDate = date("d-m-Y");
                                                                        $age = date_diff(date_create($birthDate), date_create($currentDate));
                                                                        echo $age->format("%y") . " Tahun";
                                                                        ?>
                                </td>
                                <td><?= $value['phone_number']; ?></td>
                                <td class="text-center" width="100px">
                                    <div class="form-button-action">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('admin/pelatihan/peserta_detail/' .  $value['training_id'] . '/' . $value['data_id']); ?>" title="Pendaftar"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('admin/pelatihan/peserta_edit/' . $value['data_id']); ?>" title="Edit"> <i class="fa fa-edit"></i></a>
                                        <button type="button" title="Hapus" data-toggle="modal" data-target="#delete<?= $value['data_id']; ?>" class="btn btn-danger btn-sm" data-original-title="Remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Hapus -->
<?php foreach ($peserta as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['data_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title ">
                        <span class="fw-mediumbold">
                            Hapus Data</span>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <!-- form start-->
                    <h3 style=" font-size: 20px; font-weight: 600;">Udah yakin mau ko hapus data ini?</h3>
                    <br>
                    <div class="swal-footer no-bd">
                        <a href="<?= base_url('admin/pelatihan/peserta_delete/' . $value['data_id'] . '/' . $value['training_id']) ?>" type="button" class="btn btn-success">Gasss!!!</a></button>
                        <a href="<?= base_url('admin/pelatihan/peserta/' . $value['training_id']) ?>" type="button" class="btn btn-danger">Gak Jadi</a></button>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>