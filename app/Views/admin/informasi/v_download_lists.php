
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus-circle mr-2"></i>Tambah Data
        </button>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar File Download</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel mr-2"></i>Export to Excel</a>
                    <a class="dropdown-item" href="#" id="exportPdf"><i class="fas fa-file-pdf mr-2"></i>Export to PDF</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fas fa-sync-alt mr-2"></i>Refresh</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Diperbarui</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($download as $key => $value) { 
                                $file_ext = pathinfo($value['file'], PATHINFO_EXTENSION);
                                $icon = getFileIcon($file_ext);
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= esc($value['judul']) ?></td>
                                    <td>
                                        <?php if($value['file']): ?>
                                            <a href="<?= base_url('assets/upload/download/' . $value['file']) ?>" class="text-primary" target="_blank">
                                                <i class="<?= $icon ?> mr-2"></i> <?= $value['file'] ?>
                                            </a>
                                            <small class="d-block text-muted"><?= formatFileSize(filesize(FCPATH . 'assets/upload/download/' . $value['file'])) ?></small>
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada file</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d M Y H:i', strtotime($value['updated_at'] ?? $value['created_at'])) ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" title="Edit" data-toggle="modal" data-target="#edit<?= $value['id'] ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" title="Hapus" onclick="confirmDelete(<?= $value['id'] ?>, '<?= esc($value['judul']) ?>')" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <?php if($value['file']): ?>
                                            <a href="<?= base_url('assets/upload/download/' . $value['file']) ?>" title="Download" class="btn btn-sm btn-info" download>
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <?php endif; ?>
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
</div>
<!-- /.container-fluid -->

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahModalLabel">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah File Download
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTambah" action="<?= base_url('admin/informasi/download_tambah') ?>" method="post" enctype="multipart/form-data" onsubmit="return validateFile('file')">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <?php if(session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach(session('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="judul">Judul File <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= session('errors.judul') ? 'is-invalid' : '' ?>" 
                               id="judul" name="judul" value="<?= old('judul') ?>" required>
                        <?php if(session('errors.judul')): ?>
                            <div class="invalid-feedback">
                                <?= session('errors.judul') ?>
                            </div>
                        <?php endif; ?>
                        <small class="form-text text-muted">Masukkan judul file yang akan didownload</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="file">File <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= session('errors.file') ? 'is-invalid' : '' ?>" 
                                   id="file" name="file" onchange="previewFile(this, 'previewFileTambah')" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar" required>
                            <label class="custom-file-label" for="file">Pilih file (maks. 10MB)...</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                            <?php if(session('errors.file')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.file') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <small class="form-text text-muted">Ukuran maksimal 10MB. Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, RAR</small>
                        
                        <!-- File Preview -->
                        <div id="previewFileTambah" class="mt-3 text-center" style="display: none;">
                            <div class="card border-left-primary">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <i class="fas fa-file-pdf fa-3x text-danger" id="fileIconTambah"></i>
                                    </div>
                                    <div class="mt-2">
                                        <span id="fileNameTambah" class="d-block font-weight-bold"></span>
                                        <span id="fileSizeTambah" class="text-muted small"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSimpan">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($download as $key => $value) { 
    $file_ext = pathinfo($value['file'], PATHINFO_EXTENSION);
    $icon = getFileIcon($file_ext);
?>
    <div class="modal fade" id="edit<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $value['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="editModalLabel<?= $value['id'] ?>">
                        <i class="fas fa-edit mr-2"></i>Edit File Download
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/informasi/download_edit/' . $value['id']) ?>" method="post" enctype="multipart/form-data" onsubmit="return validateFile('file_edit_'.$value['id'])">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="old_file" value="<?= $value['file'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul_<?= $value['id'] ?>">Judul File <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.judul') ? 'is-invalid' : '' ?>" 
                                   id="judul_<?= $value['id'] ?>" name="judul" value="<?= old('judul', $value['judul']) ?>" required>
                            <?php if(session('errors.judul')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.judul') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label>File Saat Ini</label>
                            <?php if($value['file'] && file_exists(FCPATH . 'assets/upload/download/' . $value['file'])): ?>
                                <div class="alert alert-light d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="<?= $icon ?> mr-2"></i> 
                                        <a href="<?= base_url('assets/upload/download/' . $value['file']) ?>" target="_blank">
                                            <?= $value['file'] ?>
                                        </a>
                                        <small class="d-block text-muted"><?= formatFileSize(filesize(FCPATH . 'assets/upload/download/' . $value['file'])) ?></small>
                                    </div>
                                    <a href="<?= base_url('assets/upload/download/' . $value['file']) ?>" class="btn btn-sm btn-info" download>
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> File tidak ditemukan
                                </div>
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="ganti_file_<?= $value['id'] ?>" 
                                           onchange="toggleFileInput('ganti_file_<?= $value['id'] ?>', 'file_<?= $value['id'] ?>')">
                                    <label class="custom-control-label" for="ganti_file_<?= $value['id'] ?>">Ganti file</label>
                                </div>
                                
                                <div id="file_edit_<?= $value['id'] ?>_container" style="display: none;">
                                    <label for="file_edit_<?= $value['id'] ?>" class="mt-2">File Baru</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_edit_<?= $value['id'] ?>" name="file" onchange="previewFile(this, 'previewFileEdit<?= $value['id'] ?>')" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">
                                        <label class="custom-file-label" for="file_edit_<?= $value['id'] ?>">Pilih file baru (opsional, maks. 10MB)</label>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah file</small>
                                    </div>
                                    
                                    <!-- File Preview -->
                                    <div id="previewFileEdit<?= $value['id'] ?>" class="mt-3 text-center" style="display: none;">
                                        <div class="card">
                                            <div class="card-body p-2">
                                                <i class="fas fa-file-pdf fa-3x text-danger" id="fileIconEdit<?= $value['id'] ?>"></i>
                                                <div class="mt-2">
                                                    <span id="fileNameEdit<?= $value['id'] ?>" class="d-block font-weight-bold"></span>
                                                    <span id="fileSizeEdit<?= $value['id'] ?>" class="text-muted small"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-warning" id="btnUpdate">
                            <i class="fas fa-save mr-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Edit -->

<?= $this->include('admin/layout/v_footer') ?>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script>
// Inisialisasi DataTable
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi DataTable
    var table = $('#dataTable').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
        },
        columnDefs: [
            { orderable: false, targets: [0, 4] },
            { searchable: false, targets: [0, 3, 4] }
        ],
        order: [[1, 'asc']],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend: 'excel',
                className: 'btn btn-success btn-sm',
                text: '<i class="fas fa-file-excel mr-1"></i> Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger btn-sm ml-1',
                text: '<i class="fas fa-file-pdf mr-1"></i> PDF',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                },
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 10;
                    doc.pageMargins = [20, 40, 20, 30];
                }
            },
            {
                extend: 'print',
                className: 'btn btn-info btn-sm ml-1',
                text: '<i class="fas fa-print mr-1"></i> Print',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ]
    });
    
    // Tambah tombol export di atas tabel
    $('.dataTables_wrapper .row:first-child').prepend(
        '<div class="col-md-12 mb-3">' +
        '   <div class="btn-group" role="group">' +
        '       <button type="button" class="btn btn-success btn-sm" id="exportExcel"><i class="fas fa-file-excel mr-1"></i> Excel</button>' +
        '       <button type="button" class="btn btn-danger btn-sm" id="exportPdf"><i class="fas fa-file-pdf mr-1"></i> PDF</button>' +
        '       <button type="button" class="btn btn-info btn-sm" id="printTable"><i class="fas fa-print mr-1"></i> Print</button>' +
        '   </div>' +
        '</div>'
    );
    
    // Event handler untuk tombol export
    $('#exportExcel').on('click', function() {
        table.button('.buttons-excel').trigger();
    });
    
    $('#exportPdf').on('click', function() {
        table.button('.buttons-pdf').trigger();
    });
    
    $('#printTable').on('click', function() {
        table.button('.buttons-print').trigger();
    });
    
    // Inisialisasi tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    // Inisialisasi select2 jika ada
    if ($.fn.select2) {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih...',
            allowClear: true
        });
    }
});

// Fungsi untuk konfirmasi hapus
function confirmDelete(id, judul) {
    Swal.fire({
        title: 'Hapus File Download',
        html: `Apakah Anda yakin ingin menghapus file <b>${judul}</b>?<br><small class="text-danger">Data yang dihapus tidak dapat dikembalikan!</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`<?= base_url('admin/informasi/download_delete/') ?>${id}`, {
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
                Swal.showValidationMessage(`Gagal menghapus: ${error}`);
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Terhapus!',
                text: 'Data berhasil dihapus.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.reload();
            });
        }
    });
}

// Fungsi untuk preview file
function previewFile(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];
    
    if (file) {
        // Tampilkan preview
        preview.style.display = 'block';
        
        // Set nama file
        document.getElementById(previewId.replace('previewFile', 'fileName') + input.id.split('_').pop()).textContent = file.name;
        
        // Set ukuran file
        const fileSize = (file.size / (1024 * 1024)).toFixed(2);
        document.getElementById(previewId.replace('previewFile', 'fileSize') + input.id.split('_').pop()).textContent = `${fileSize} MB`;
        
        // Set ikon berdasarkan tipe file
        const fileIcon = document.getElementById(previewId.replace('previewFile', 'fileIcon') + input.id.split('_').pop());
        const fileExt = file.name.split('.').pop().toLowerCase();
        
        // Hapus semua kelas ikon
        fileIcon.className = 'fas fa-3x mr-2';
        
        // Tambahkan kelas ikon berdasarkan tipe file
        if (fileExt === 'pdf') {
            fileIcon.classList.add('fa-file-pdf', 'text-danger');
        } else if (['doc', 'docx'].includes(fileExt)) {
            fileIcon.classList.add('fa-file-word', 'text-primary');
        } else if (['xls', 'xlsx'].includes(fileExt)) {
            fileIcon.classList.add('fa-file-excel', 'text-success');
        } else if (['ppt', 'pptx'].includes(fileExt)) {
            fileIcon.classList.add('fa-file-powerpoint', 'text-warning');
        } else if (['zip', 'rar', '7z'].includes(fileExt)) {
            fileIcon.classList.add('fa-file-archive', 'text-secondary');
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
            fileIcon.classList.add('fa-file-image', 'text-info');
        } else {
            fileIcon.classList.add('fa-file-alt', 'text-secondary');
        }
        
        // Update label file input
        const fileName = input.files[0].name;
        const nextElement = input.nextElementSibling;
        if (nextElement && nextElement.tagName === 'LABEL') {
            nextElement.textContent = fileName;
        }
    } else {
        preview.style.display = 'none';
    }
}

// Fungsi untuk toggle input file
function toggleFileInput(checkboxId, fileInputId) {
    const checkbox = document.getElementById(checkboxId);
    const fileInput = document.getElementById(fileInputId);
    const container = document.getElementById(fileInputId + '_container');
    
    if (checkbox.checked) {
        container.style.display = 'block';
        fileInput.required = true;
    } else {
        container.style.display = 'none';
        fileInput.required = false;
        fileInput.value = '';
    }
}

// Fungsi untuk memformat ukuran file
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Fungsi untuk mendapatkan ikon berdasarkan ekstensi file
function getFileIcon(ext) {
    switch(ext.toLowerCase()) {
        case 'pdf':
            return 'fas fa-file-pdf text-danger';
        case 'doc':
        case 'docx':
            return 'fas fa-file-word text-primary';
        case 'xls':
        case 'xlsx':
            return 'fas fa-file-excel text-success';
        case 'ppt':
        case 'pptx':
            return 'fas fa-file-powerpoint text-warning';
        case 'zip':
        case 'rar':
        case '7z':
            return 'fas fa-file-archive text-secondary';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            return 'fas fa-file-image text-info';
        default:
            return 'fas fa-file-alt text-secondary';
    }
}

// Fungsi untuk menampilkan notifikasi
function showNotification(type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
    
    Toast.fire({
        icon: type,
        title: message
    });
}

// Event listener untuk form submit
$('form').on('submit', function() {
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');
});

// Inisialisasi tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// Tampilkan notifikasi jika ada pesan flash
const flashData = $('.swal').data('swal');
if (flashData) {
    showNotification('success', flashData);
}
</script>