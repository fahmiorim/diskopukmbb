<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                    <?= $title ?>
                </div>
                <div class="card-body">
                    <!-- form start-->
                    <form role="form" action="<?= base_url('admin/' . $menu . '/data_update/' . $umkm['id_number']); ?>" method="post">
                        <div class="form-group col-sm-10">
                            <label>Nama UMKM</label>
                            <input class="form-control" type="text" name="name_umkm" value="<?= $umkm['name_umkm'] ?? '' ?>" required>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Alamat UMKM</label>
                            <textarea class="form-control" name="address_umkm" required><?= $umkm['address_umkm'] ?? '' ?></textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Kecamatan</label>
                            <input class="form-control" type="text" name="districts_city_name" value="<?= $umkm['districts_city_name'] ?? '' ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Nomor Telepon</label>
                            <input class="form-control" type="text" name="phone_number" value="<?= $umkm['phone_number'] ?? '' ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" value="<?= $umkm['email'] ?? '' ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>NIB</label>
                            <input class="form-control" type="text" name="nib_umkm" value="<?= $umkm['nib_umkm'] ?? '' ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>NPWP</label>
                            <input class="form-control" type="text" name="npwp_umkm" value="<?= $umkm['npwp_umkm'] ?? '' ?>">
                        </div>
                        <br>
                        <div class="card-action col-sm-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-paper-plane"></i> Update
                            </button>
                            <a href="<?= base_url('admin/' . $menu . '/data') ?>" class="btn btn-danger btn-sm">
                                <i class="fa fa-reply"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->