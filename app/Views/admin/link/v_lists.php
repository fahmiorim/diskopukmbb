<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tambah">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Link</span>
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
                            <th>Nama</th>
                            <th>Link URL</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Link URL</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($link as $key => $value) { ?>
                            <tr>

                                <td><?= $no++; ?></td>
                                <td><?= $value['nama']; ?></td>
                                <td><?= $value['link_url']; ?></td>
                                <td class=""><img src="<?= base_url('./media/link/' . $value['gambar']) ?>" width="80px"><br>

                                <td>
                                    <div class="form-button-action">
                                        <button type="button" title="Edit Data" data-toggle="modal" data-target="#edit<?= $value['id']; ?>" class="btn btn-primary btn-sm" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" title="Hapus" data-toggle="modal" data-target="#delete<?= $value['id']; ?>" class="btn btn-danger btn-sm" data-original-title="Remove">
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Tambah Link</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <!-- form start-->

                <form role="form" action="<?= base_url('admin/link/tambah'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="form-group col-sm-12">
                        <label>Nama</label>
                        <input class="form-control" type="text" name="nama" value="<?= old('nama'); ?>">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Link URL</label>
                        <input class="form-control" type="text" name="link_url" value="<?= old('link_url'); ?>">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control tambah" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                    </div>
                    <div class="form-group col-md-6">
                        <img id="blah" src=<?= base_url('./media/no_image.jpg'); ?> class="" width="200" height="150" />
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-paper-plane"></i> Simpan</button>
                        <a href="<?= base_url('admin/link') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Kembali</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Edit -->
<?php foreach ($link as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Edit Link</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <!-- form start-->
                    <form role="form" action="<?= base_url('admin/link/edit/' . $value['id']); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="form-group col-sm-12">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="nama" value="<?= $value['nama']; ?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Link URL</label>
                            <input class="form-control" type="text" name="link_url" value="<?= $value['link_url']; ?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="gambar" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                        </div>
                        <div class="form-group col-md-6">
                            <img id="blah" src=<?= base_url('./media/link/' . $value['gambar']); ?> class="" width="280" height="150" />
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-paper-plane"></i> Simpan</button>
                            <a href="<?= base_url('admin/link') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Kembali</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Edit -->

<!-- Modal Hapus -->
<?php foreach ($link as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title ">
                        <span class="fw-mediumbold">
                            Hapus link</span>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <!-- form start-->
                    <h3 style=" font-size: 20px; font-weight: 600;">Udah yakin mau ko hapus data ini?</h3>
                    <br>
                    <div class="swal-footer no-bd">
                        <a href="<?= base_url('admin/link/delete/' . $value['id']) ?>" type="button" class="btn btn-success">Gasss!!!</a></button>
                        <a href="<?= base_url('admin/link') ?>" type="button" class="btn btn-danger">Gak Jadi</a></button>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->