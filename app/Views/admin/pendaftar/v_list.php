<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $pengumuman['form_judul'] ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/pendaftar/export/' . $pengumuman['id']) ?>" class="btn btn-primary btn-round ml-auto">
                <span class="text">Export to Excel</span>
            </a>
            <a class="btn btn-danger btn-round ml-auto float-right" href="<?= base_url('admin/informasi/pengumuman') ?>">
                <span><i class="fa fa-reply"></i></span>
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
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>Pendidikan</th>
                            <th>Kecamatan</th>
                            <th>Desa / Kelurahan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>Pendidikan</th>
                            <th>Kecamatan</th>
                            <th>Desa / Kelurahan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pendaftaran as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['name']; ?></td>
                                <td>
                                    <?php
                                    $birthDate = $value['date_birth'];
                                    $currentDate = date("d-m-Y");
                                    $age = date_diff(date_create($birthDate), date_create($currentDate));
                                    echo $age->format("%y") . " Tahun";
                                    ?>
                                </td>
                                <td><?= $value['jenis_kelamin']; ?></td>
                                <td><?= $value['pendidikan']; ?></td>
                                <td><?= $value['kecamatan_name']; ?></td>
                                <td><?= $value['desa_name']; ?></td>
                                <td>
                                    <div class="form-button-action text-center">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('admin/pendaftar/lihat/' . $value['id']); ?>" title="Lihat Pendaftar"><i class="fa fa-eye"></i></a>
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