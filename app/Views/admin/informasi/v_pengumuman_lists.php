<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/informasi/pengumuman_tambah') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pengumuman
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengumuman</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Aksi:</div>
                    <a class="dropdown-item" href="<?= base_url('admin/informasi/pengumuman_tambah') ?>">
                        <i class="fas fa-plus fa-sm text-primary mr-2"></i> Tambah Baru
                    </a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exportModal">
                        <i class="fas fa-file-export fa-sm text-success mr-2"></i> Ekspor Data
                    </a>
                </div>
            </div>
        </div>

        <?php if (session()->has('errors')) : ?>
            <div class="alert alert-danger mx-3 mt-3">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success mx-3 mt-3">
                <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul Pengumuman</th>
                            <th width="15%">Tanggal</th>
                            <th width="10%">Jam</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pengumuman)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p class="mb-0">Belum ada data pengumuman</p>
                                        <a href="<?= base_url('admin/informasi/pengumuman_tambah') ?>" class="btn btn-primary btn-sm mt-3">
                                            <i class="fas fa-plus mr-1"></i> Tambah Pengumuman
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($pengumuman as $key => $value): 
                                $badgeClass = '';
                                $badgeText = '';
                                $currentDate = date('Y-m-d');
                                $pengumumanDate = $value['tanggal'];
                                
                                if ($pengumumanDate > $currentDate) {
                                    $badgeClass = 'bg-info';
                                    $badgeText = 'Akan Datang';
                                } elseif ($pengumumanDate == $currentDate) {
                                    $badgeClass = 'bg-success';
                                    $badgeText = 'Hari Ini';
                                } else {
                                    $badgeClass = 'bg-secondary';
                                    $badgeText = 'Telah Berlalu';
                                }
                            ?>
                                <tr>
                                    <td class="align-middle"><?= $no++; ?></td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <i class="fas fa-bullhorn fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">
                                                    <a href="<?= base_url('admin/informasi/pengumuman_detail/' . $value['id']); ?>" class="text-dark font-weight-bold">
                                                        <?= esc($value['judul']) ?>
                                                    </a>
                                                </h6>
                                                <small class="text-muted">
                                                    <i class="far fa-calendar-alt mr-1"></i> 
                                                    <?= date('d M Y', strtotime($value['tanggal'])) ?> 
                                                    <span class="mx-1">•</span> 
                                                    <i class="far fa-clock mr-1"></i> <?= $value['jam'] ?>
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge <?= $badgeClass ?> text-white">
                                            <?= date('d M Y', strtotime($value['tanggal'])) ?>
                                        </span>
                                        <small class="d-block text-muted"><?= $badgeText ?></small>
                                    </td>
                                    <td class="align-middle"><?= $value['jam'] ?></td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <?php if ($value['form'] == "yes"): ?>
                                                <a href="<?= base_url('admin/pendaftar/pengumuman/' . $value['id']); ?>" 
                                                   class="btn btn-info" 
                                                   data-toggle="tooltip" 
                                                   title="Lihat Pendaftar">
                                                    <i class="fas fa-users"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <a href="<?= base_url('admin/informasi/pengumuman_edit/' . $value['id']); ?>" 
                                               class="btn btn-warning text-white" 
                                               data-toggle="tooltip" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-danger" 
                                                    data-toggle="tooltip" 
                                                    title="Hapus"
                                                    onclick="confirmDelete(<?= $value['id'] ?>, '<?= addslashes($value['judul']) ?>')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Ekspor Data -->
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exportModalLabel">
                    <i class="fas fa-file-export mr-2"></i> Ekspor Data Pengumuman
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/informasi/export_pengumuman') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="format">Pilih Format Ekspor</label>
                        <select class="form-control" id="format" name="format" required>
                            <option value="excel">Excel (.xlsx)</option>
                            <option value="pdf">PDF (.pdf)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_range">Rentang Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" id="date_range" name="date_range">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-download mr-1"></i> Unduh
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Fungsi konfirmasi hapus dengan SweetAlert2
function confirmDelete(id, judul) {
    Swal.fire({
        title: 'Hapus Pengumuman',
        html: `Apakah Anda yakin ingin menghapus pengumuman <b>${judul}</b>?<br><small class="text-danger">Data yang dihapus tidak dapat dikembalikan!</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`<?= base_url('admin/informasi/pengumuman_delete/') ?>${id}`, {
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
                    `Gagal menghapus: ${error}`
                )
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Terhapus!',
                text: 'Data pengumuman berhasil dihapus.',
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
    // Inisialisasi date range picker
    $('#date_range').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY',
            separator: ' - ',
            applyLabel: 'Pilih',
            cancelLabel: 'Batal',
            fromLabel: 'Dari',
            toLabel: 'Sampai',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            firstDay: 1
        },
        opens: 'right',
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Hapus'
        }
    });

    $('#date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    // Inisialisasi DataTable
    $('#dataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "order": [[2, 'desc'], [3, 'desc']], // Urutkan berdasarkan tanggal dan jam terbaru
        "columnDefs": [
            { "orderable": false, "targets": [4] } // Non-aktifkan sorting untuk kolom aksi
        ],
        "drawCallback": function() {
            // Inisialisasi tooltip setelah tabel di-render
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
});
</script>

<!-- Date Range Picker CSS & JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>