<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/berita/kegiatan_tambah') ?>" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Kegiatan</span>
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
                            <th>Tanggal Posting</th>
                            <th>Jam</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Posting</th>
                            <th>Jam</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($berita as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['judul']; ?></td>
                                <td data-order="<?= $value['tanggal'] ?>">
                                    <?= date('d/m/Y', strtotime($value['tanggal'])) ?>
                                </td>
                                <td><?= date('H:i', strtotime($value['jam'])) ?></td>
                                <td>
                                    <div class="form-button-action">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('admin/berita/kegiatan_edit/' . $value['id']); ?>" title="Edit"> <i class="fa fa-edit"></i></a>
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
<!-- /.container-fluid -->

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfirmasi hapus
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Hapus Kegiatan',
            html: `Apakah Anda yakin ingin menghapus kegiatan:<br><b>${title}</b>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(`<?= base_url('admin/berita/kegiatan_delete/') ?>${id}`, {
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
                    text: 'Data kegiatan berhasil dihapus.',
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
            "order": [[2, "desc"]], // Urutkan berdasarkan kolom tanggal (index 2) secara descending
            "columnDefs": [
                { "orderable": false, "targets": [4] } // Non-aktifkan sorting untuk kolom aksi
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
</script>

<!-- Modal Hapus (tidak digunakan lagi, diganti dengan SweetAlert) -->
<?php foreach ($berita as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title ">
                        <span class="fw-mediumbold">
                            Hapus Kegiatan</span>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <!-- form start-->
                    <h3 style=" font-size: 20px; font-weight: 600;">Udah yakin mau ko hapus data ini?</h3>
                    <br>
                    <div class="swal-footer no-bd">
                        <a href="<?= base_url('admin/berita/kegiatan_delete/' . $value['id']) ?>" type="button" class="btn btn-success">Gasss!!!</a></button>
                        <a href="<?= base_url('admin/berita/kegiatan') ?>" type="button" class="btn btn-danger">Gak Jadi</a></button>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->