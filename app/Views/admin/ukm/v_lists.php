<?php 
helper('form'); // Load the form helper
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <div>
            <a href="<?= base_url('admin/' . $menu . '/data_tambah') ?>" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Tambah UKM
            </a>
            <a href="<?= base_url('admin/ukm/export') ?>" class="btn btn-success">
                <i class="fas fa-file-export mr-2"></i>Export Excel
            </a>
        </div>
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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama UKM</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>ID UMKM</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama UKM</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>ID UMKM</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dataukm as $key => $value) { ?>
                            <tr>

                                <td><?= $no++; ?></td>
                                <td><?= $value['name_umkm'] ?? '-'; ?></td>
                                <td><?= $value['address_umkm'] ?? '-'; ?></td>
                                <td><?= $value['districts_city_name'] ?? '-'; ?></td>
                                <td><?= $value['id_number'] ?? '-'; ?></td>
                                <td>
                                    <div class="form-button-action text-center">
                                        <a class="btn btn-primary btn-sm" href="<?= base_url('admin/' . $menu . '/data_edit/' . $value['id_number']); ?>" title="Edit"> <i class="fa fa-edit"> </i></a>
                                        <button type="button" title="Hapus" data-toggle="modal" data-target="#delete<?= $value['id_number']; ?>" class="btn btn-danger btn-sm" data-original-title="Remove">
                                            <i class="fa fa-times"> </i>
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
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable with export buttons
        var table = $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            },
            "order": [[0, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": [5] } // Disable sorting on action column
            ],
            "dom": '<"row"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"l><"col-md-6"p>>',
            "buttons": [
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-success',
                    text: '<i class="fas fa-file-excel mr-1"></i> Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Adjust columns as needed
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-sm btn-info',
                    text: '<i class="fas fa-print mr-1"></i> Print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Adjust columns as needed
                    }
                }
            ]
        });

        // SweetAlert for delete confirmation
        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            
            Swal.fire({
                title: 'Hapus Data UKM',
                html: `Apakah Anda yakin ingin menghapus UKM <strong>${name}</strong>?`,
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
                    form.attr('action', `<?= base_url('admin/ukm/delete/') ?>${id}`);
                    form.submit();
                }
            });
        });
    });
</script>

<!-- Modal Hapus -->
<?php foreach ($dataukm as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_number'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Hapus Data</span>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <!-- form start-->
                    <h3 style="font-size: 20px; font-weight: 600;">Udah yakin mau ko hapus data ini?</h3>
                    <br>
                    <div class="swal-footer no-bd">
                        <a href="<?= base_url('admin/' . $menu . '/data_delete/' . $value['id_number']) ?>" type="button" class="btn btn-success">Gasss!!!</a>
                        <a href="<?= base_url('admin/' . $menu . '/data') ?>" type="button" class="btn btn-danger">Gak Jadi</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->