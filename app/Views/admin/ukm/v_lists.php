<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/' . $menu . '/data_tambah') ?>" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
        </div>

        <div class="swal" data-swal="<?= session()->getFlashdata('success') ?>"></div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama UKM</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>ID UMKM</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama UKM</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>ID UMKM</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dataukm as $key => $value) { ?>
                            <tr>

                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_usaha']; ?></td>
                                <td><?= $value['alamat']; ?></td>
                                <td><?= $value['kecamatan']; ?></td>
                                <td><?= $value['id_umkm']; ?></td>
                                <td>
                                    <div class="form-button-action text-center">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('admin/' . $menu . '/data_edit/' . $value['id']); ?>" title="Edit"> <i class="fa fa-edit"> </i></a>
                                        <button type="button" title="Hapus" data-toggle="modal" data-target="#delete<?= $value['id']; ?>" class="btn btn-danger btn-sm" data-original-title="Remove">
                                            <i class="fa fa-times"> </i>
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
<?php foreach ($dataukm as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <a href="<?= base_url('admin/' . $menu . '/data_delete/' . $value['id']) ?>" type="button" class="btn btn-success">Gasss!!!</a></button>
                        <a href="<?= base_url('admin/' . $menu . '/data') ?>" type="button" class="btn btn-danger">Gak Jadi</a></button>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->