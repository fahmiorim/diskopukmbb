<?php 
helper('form'); // Load the form helper
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/profile/tambah') ?>" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Tambah Profile
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul</th>
                            <th width="15%">Tanggal Posting</th>
                            <th width="10%">Urutan</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($profile)): ?>
                            <?php $no = 1; foreach ($profile as $item): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= esc($item['judul']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($item['tanggal'])) ?></td>
                                    <td class="text-center"><?= $item['urutan'] ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('admin/profile/edit/' . $item['id']) ?>" 
                                               class="btn btn-sm btn-primary" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger btn-delete" 
                                                    data-id="<?= $item['id'] ?>"
                                                    data-title="<?= esc($item['judul']) ?>"
                                                    title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data profile</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Delete Form -->
<?= form_open('', ['id' => 'form-delete', 'class' => 'd-none']) ?>
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="DELETE">
</form>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
    // Initialize DataTable only if not already initialized
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            },
            "order": [[3, 'asc']], // Sort by urutan by default
            "columnDefs": [
                { "orderable": false, "targets": [4] } // Disable sorting on action column
            ],
            "retrieve": true, // Prevent reinitialization warning
            "destroy": true   // Allow reinitialization if needed
        });

        // SweetAlert for delete confirmation
        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            
            Swal.fire({
                title: 'Hapus Data',
                html: `Apakah Anda yakin ingin menghapus <strong>${title}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('#form-delete');
                    form.attr('action', `<?= base_url('admin/profile/delete/') ?>${id}`);
                    form.submit();
                }
            });
        });

        // Show success message from session
        <?php if (session()->getFlashdata('success')): ?>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('success') ?>'
            });
        <?php endif; ?>
    });
</script>
<!-- End Modal Hapus -->