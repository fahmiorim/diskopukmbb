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
                <span class="text">Tambah User</span>
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
                            <th>Username</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($user as $key => $value) { ?>
                            <tr>

                                <td><?= $no++; ?></td>
                                <td><?= $value['username']; ?></td>
                                <td><?= $value['nama']; ?></td>
                                <td><?= $value['hp']; ?></td>
                                <td><?= $value['email']; ?></td>
                                <td><?= $value['level']; ?></td>
                                <td><?= $value['status']; ?></td>
                                <td class=""><img src="<?= base_url('./media/user/' . $value['foto']) ?>" width="80px"><br>
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
                        Tambah User</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <!-- form start-->

                <form role="form" action="<?= base_url('admin/user/tambah'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="form-group col-sm-12">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username" value="<?= old('username'); ?>">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Nama Lengkap</label>
                        <input class="form-control" type="text" name="nama" value="<?= old('nama'); ?>">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>No HP</label>
                        <input class="form-control" type="text" name="hp" value="<?= old('hp'); ?>">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email" value="<?= old('email'); ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Level</label>
                        <select class="form-control" type="text" name="level">
                            <option value="">-Level-</option>
                            <option value="Super Admin">Super Admin</option>
                            <option value="Admin Website">Admin</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Status</label>
                        <select class="form-control" type="text" name="status">
                            <option value="">-Status-</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control tambah" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                    </div>
                    <div class="form-group col-md-6">
                        <img id="blah" src=<?= base_url('./media/no_image.jpg'); ?> class="" width="200" height="150" />
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-paper-plane"></i> Simpan</button>
                        <a href="<?= base_url('admin/user') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Kembali</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Edit -->
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Edit user</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <!-- form start-->
                    <form role="form" action="<?= base_url('admin/user/edit/' . $value['id']); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="form-group col-sm-12">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="nama" value="<?= $value['nama']; ?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>No HP</label>
                            <input class="form-control" type="text" name="hp" value="<?= $value['hp']; ?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" value="<?= $value['email']; ?>">
                        </div>
                        <div class=" form-group col-sm-6">
                            <label>Level</label>
                            <select class="form-control" type="text" name="level">
                                <option value="<?= $value['level']; ?>"><?= $value['level']; ?></option>
                                <option value="Super Admin">Super Admin</option>
                                <option value="Admin Website">Admin</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Status</label>
                            <select class="form-control" type="text" name="status">
                                <option value="<?= $value['status']; ?>"><?= $value['status']; ?></option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                        </div>
                        <div class="form-group col-md-6">
                            <img id="blah" src=<?= base_url('./media/user/' . $value['foto']); ?> class="" width="280" height="150" />
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-paper-plane"></i> Simpan</button>
                            <a href="<?= base_url('admin/user') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Kembali</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Edit -->

<!-- Modal Hapus -->
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title ">
                        <span class="fw-mediumbold">
                            Hapus user</span>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <!-- form start-->
                    <h3 style=" font-size: 20px; font-weight: 600;">apakah anda yakin akan menghapus data ini ? </h3>
                    <br>
                    <div class="swal-footer no-bd">
                        <a href="<?= base_url('admin/user/delete/' . $value['id']) ?>" type="button" class="btn btn-success">Hapus</a></button>
                        <a href="<?= base_url('admin/user') ?>" type="button" class="btn btn-danger">Batal</a></button>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->