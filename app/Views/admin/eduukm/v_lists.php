<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/' . $menu . '/tambah_edu') ?>" class="btn btn-primary">
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
                            <th>Judul</th>
                            <th>Jenis</th>
                            <th>Link</th>
                            <th>Tangal Posting</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Jenis</th>
                            <th>Link</th>
                            <th>Tangal Posting</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($eduukm as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['judul']; ?></td>
                                <td><?= $value['jenis']; ?></td>
                                <td>
                                    <?php if (!empty($value['link'])): ?>
                                        <a href="<?= (strpos($value['link'], 'http') === 0 ? '' : 'https://') . $value['link'] ?>" 
                                           target="_blank" class="text-primary">
                                            <i class="fas fa-external-link-alt"></i> Buka Link
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada link</span>
                                    <?php endif; ?>
                                </td>
                                <td data-order="<?= $value['tanggal'] ?>">
                                    <?= date('d/m/Y', strtotime($value['tanggal'])) ?>
                                </td>
                                <td>
                                    <div class="form-button-action">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('admin/eduukm/edit/' . $value['id']); ?>" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" title="Hapus" class="btn btn-danger btn-sm" 
                                                onclick="confirmDelete(<?= $value['id'] ?>, '<?= addslashes($value['judul']) ?>')">
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

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfirmasi hapus
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Hapus Data Edukasi',
            html: `Apakah Anda yakin ingin menghapus data:<br><b>${title}</b>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(`<?= base_url('admin/eduukm/delete/') ?>${id}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Terhapus!',
                    text: 'Data edukasi berhasil dihapus.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    }

    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[4, "desc"]], // Urutkan berdasarkan kolom tanggal (index 4) secara descending
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