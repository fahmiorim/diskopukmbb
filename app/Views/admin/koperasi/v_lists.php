<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    
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
                            <th>Nama Koperasi</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>ID Number</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Koperasi</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>ID Number</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($datakoperasi as $key => $value) { 
                            // Only show koperasi data
                            if (isset($value['business_status_name']) && $value['business_status_name'] === 'Koperasi') { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $value['name_koperasi'] ?? '-' ?></td>
                                    <td><?= $value['address_koperasi'] ?? '-' ?></td>
                                    <td><?= $value['districts_city_name'] ?? '-' ?></td>
                                    <td><?= $value['id_number'] ?? '-' ?></td>
                                    <td>
                                        <div class="form-button-action">
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/' . $menu . '/data_edit/' . $value['id_number']); ?>" title="Edit"> 
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" title="Hapus" class="btn btn-danger btn-sm" 
                                                    onclick="confirmDelete('<?= $value['id_number'] ?>', '<?= addslashes($value['name_koperasi'] ?? 'Data ini') ?>')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<?php foreach ($datakoperasi as $key => $value) { 
    if (isset($value['business_status_name']) && $value['business_status_name'] === 'KOPERASI') { ?>
        <div class="modal fade" id="delete<?= $value['id_number'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data koperasi <strong><?= $value['name_koperasi'] ?? '' ?></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a href="<?= base_url('admin/' . $menu . '/data_delete/' . $value['id_number']) ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfirmasi hapus
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus data "${name}"!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `<?= base_url('admin/koperasi/data_delete/') ?>${id}`;
            }
        });
    }

    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "columnDefs": [
                { "orderable": false, "targets": [5] } // Non-aktifkan sorting untuk kolom aksi
            ]
        });
    });

    // SweetAlert for success message
    const swal = $('.swal').data('swal');
    if (swal) {
        Swal.fire({
            title: 'Sukses',
            text: swal,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    // Confirmation for delete
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        });
    });
</script>
<!-- /.container-fluid -->
