<?php 
helper('form'); // Load the form helper
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/profile/kepegawaian_tambah') ?>" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Tambah Pegawai
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
            <i class="fas fa-exclamation-circle mr-2"></i>
            <?php 
                $errors = session()->getFlashdata('error');
                if (is_array($errors)) {
                    echo '<ul class="mb-0">';
                    foreach ($errors as $error) {
                        echo '<li>' . esc($error) . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo esc($errors);
                }
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nip</th>
                            <th>Nama</th>
                            <th>Golongan</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Urutan</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nip</th>
                            <th>Nama</th>
                            <th>Golongan</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Urutan</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pegawai as $key => $value) { ?>
                            <tr>

                                <td><?= $no++; ?></td>
                                <td><?= $value['nip']; ?></td>
                                <td><?= $value['nama']; ?></td>
                                <td><?= $value['golongan']; ?></td>
                                <td><?= $value['jabatan']; ?></td>
                                <td><?= $value['status']; ?></td>
                                <td><?= $value['urutan']; ?></td>
                                <td><img class="img-responsive" height="100" style="border-radius: 50px;" src="<?= base_url() ?>/media/kepegawaian/<?= $value['foto']; ?>"></td>
                                <td>
                                    <div class="form-button-action text-center">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('admin/profile/kepegawaian_edit/' . $value['id']); ?>" title="Edit"> <i class="fa fa-edit"></i></a>
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
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            },
            "order": [[0, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": -1 } // Disable sorting on action column
            ]
        });

        // SweetAlert for delete confirmation
        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            
            Swal.fire({
                title: 'Hapus Data',
                html: `Apakah Anda yakin ingin menghapus <strong>${name}</strong>?`,
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
                    form.attr('action', `<?= base_url('admin/profile/kepegawaian_delete/') ?>${id}`);
                    form.submit();
                }
            });
        });
    });
</script>

<!-- Modal Hapus -->
<?php foreach ($pegawai as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title ">
                        <span class="fw-mediumbold">
                            Hapus Pegawai</span>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <!-- form start-->
                    <h3 style=" font-size: 20px; font-weight: 600;">Udah yakin mau ko hapus data ini?</h3>
                    <br>
                    <div class="swal-footer no-bd">
                        <a href="<?= base_url('admin/profile/kepegawaian_delete/' . $value['id']) ?>" type="button" class="btn btn-success">Gasss!!!</a></button>
                        <a href="<?= base_url('admin/profile/kepegawaian') ?>" type="button" class="btn btn-danger">Gak Jadi</a></button>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->