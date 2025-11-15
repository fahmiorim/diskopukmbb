<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button class="btn btn-primary btn-round ml-auto float-right" data-toggle="modal" data-target="#tambah">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Foto</span>
                        </a>
                    </button>
                </div>
                <div class="swal" data-swal="<?= session()->getFlashdata('success') ?>"></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $no = 1;
                                foreach ($foto as $key => $value) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class=""><img src="<?= base_url('./media/galeri/' . $value['gambar']) ?>" width="150px"><br>
                                        <td>
                                            <div class="form-button-action text-center">
                                                <button type="button" title="Hapus" data-toggle="modal" data-target="#delete<?= $value['id']; ?>" class="btn btn-danger btn-sm" data-original-title="Remove">
                                                    <span class="icon">
                                                        <i class="fa fa-times"></i>
                                                    </span>
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

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="m-0 font-weight-bold text-primary">Cover Album</h6>
                        </div>
                        <div class="col-lg-6">
                            <a href="<?= base_url('admin/galeri') ?>" class="btn btn-primary btn-icon-split float-right">
                                <span class="icon text-white-50">
                                    <i class="fas fa-reply"></i>
                                </span>
                                <span class="text">Kembali ke Album</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    foreach ($galeri as $key => $value) { ?>
                        <p>Judul Album Galeri : <?= $value['judul'] ?></p>
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body text-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <p>Cover Album</p>
                                        <img class="img-responsive img-fluid" src="<?= base_url('./media/galeri/' . $value['gambar']) ?>" width="400px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Tambah Galeri</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <!-- form start-->
                <?php
                $request = \Config\Services::request(); { ?>
                    <form role="form" action="<?= base_url('admin/galeri/add_foto/' . $request->uri->getSegment(4)); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="form-group col-sm-12">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control tambah" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                        </div>
                        <div class="form-group col-md-6">
                            <img id="blah" src=<?= base_url('./media/no_image.jpg'); ?> class="" width="200" height="150" />
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-paper-plane"></i> Simpan</button>
                            <a href="<?= base_url('admin/galeri/foto/' . $request->uri->getSegment(4)) ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Kembali</a>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Hapus -->
<?php foreach ($foto as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title ">
                        <span class="fw-mediumbold">
                            Hapus Galeri</span>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <!-- form start-->
                    <h3 style=" font-size: 20px; font-weight: 600;">Udah yakin mau ko hapus data ini?</h3>
                    <br>
                    <div class="swal-footer no-bd">
                        <a href="<?= base_url('admin/galeri/delete_foto/' . $value['id_galeri'] . '/' . $value['id']) ?>" type="button" class="btn btn-success">Gasss!!!</a></button>
                        <a href="<?= base_url('admin/galeri') ?>" type="button" class="btn btn-danger">Gak Jadi</a></button>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->