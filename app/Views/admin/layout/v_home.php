		<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Berita Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-3">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Berita</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= isset($total_berita) ? number_format($total_berita) : '0' ?></div>
                        </div>
                        <div class="icon-circle bg-primary text-white">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <?php if (isset($persen_berita)): ?>
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1" style="height: 6px;">
                                <div class="progress-bar bg-<?= $persen_berita >= 0 ? 'success' : 'danger' ?>" 
                                     role="progressbar" 
                                     style="width: <?= min(100, abs($persen_berita)) ?>%" 
                                     aria-valuenow="<?= abs($persen_berita) ?>" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <span class="text-<?= $persen_berita >= 0 ? 'success' : 'danger' ?> small ml-2">
                                <i class="fas fa-arrow-<?= $persen_berita >= 0 ? 'up' : 'down' ?>"></i> <?= abs($persen_berita) ?>%
                            </span>
                        </div>
                        <div class="text-muted small mt-1">Dari bulan lalu</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <a href="<?= base_url('admin/berita') ?>" class="text-primary small font-weight-bold d-flex align-items-center">
                        Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Galeri Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-3">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Galeri</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= isset($total_galeri) ? number_format($total_galeri) : '0' ?></div>
                        </div>
                        <div class="icon-circle bg-success text-white">
                            <i class="fas fa-images"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <?php if (isset($persen_galeri)): ?>
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1" style="height: 6px;">
                                <div class="progress-bar bg-<?= $persen_galeri >= 0 ? 'success' : 'danger' ?>" 
                                     role="progressbar" 
                                     style="width: <?= min(100, abs($persen_galeri)) ?>%" 
                                     aria-valuenow="<?= abs($persen_galeri) ?>" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <span class="text-<?= $persen_galeri >= 0 ? 'success' : 'danger' ?> small ml-2">
                                <i class="fas fa-arrow-<?= $persen_galeri >= 0 ? 'up' : 'down' ?>"></i> <?= abs($persen_galeri) ?>%
                            </span>
                        </div>
                        <div class="text-muted small mt-1">Dari bulan lalu</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <a href="<?= base_url('admin/galeri') ?>" class="text-success small font-weight-bold d-flex align-items-center">
                        Lihat Galeri <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Pendaftar Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-3">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pendaftar</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= isset($total_pendaftar) ? number_format($total_pendaftar) : '0' ?></div>
                        </div>
                        <div class="icon-circle bg-warning text-white">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <?php if (isset($persen_pendaftar)): ?>
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1" style="height: 6px;">
                                <div class="progress-bar bg-<?= $persen_pendaftar >= 0 ? 'success' : 'danger' ?>" 
                                     role="progressbar" 
                                     style="width: <?= min(100, abs($persen_pendaftar)) ?>%" 
                                     aria-valuenow="<?= abs($persen_pendaftar) ?>" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <span class="text-<?= $persen_pendaftar >= 0 ? 'success' : 'danger' ?> small ml-2">
                                <i class="fas fa-arrow-<?= $persen_pendaftar >= 0 ? 'up' : 'down' ?>"></i> <?= abs($persen_pendaftar) ?>%
                            </span>
                        </div>
                        <div class="text-muted small mt-1">Dari bulan lalu</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <a href="<?= base_url('admin/pelatihan') ?>" class="text-warning small font-weight-bold d-flex align-items-center">
                        Lihat Pendaftar <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Pengunjung Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-3">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengunjung Hari Ini</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= isset($total_pengunjung) ? number_format($total_pengunjung) : '0' ?></div>
                        </div>
                        <div class="icon-circle bg-info text-white">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <?php if (isset($persen_pengunjung)): ?>
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1" style="height: 6px;">
                                <div class="progress-bar bg-<?= $persen_pengunjung >= 0 ? 'success' : 'danger' ?>" 
                                     role="progressbar" 
                                     style="width: <?= min(100, abs($persen_pengunjung)) ?>%" 
                                     aria-valuenow="<?= abs($persen_pengunjung) ?>" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <span class="text-<?= $persen_pengunjung >= 0 ? 'success' : 'danger' ?> small ml-2">
                                <i class="fas fa-arrow-<?= $persen_pengunjung >= 0 ? 'up' : 'down' ?>"></i> <?= abs($persen_pengunjung) ?>%
                            </span>
                        </div>
                        <div class="text-muted small mt-1">Dari kemarin</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <a href="<?= base_url('admin/pengunjung') ?>" class="text-info small font-weight-bold d-flex align-items-center">
                        Lihat Statistik <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Content Row -->
    <div class="row">
        <!-- Activity Feed -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-history text-primary mr-2"></i>Aktivitas Terbaru
                    </h6>
                    <a href="#" class="btn btn-sm btn-link text-primary p-0">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($recent_activities)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach (array_slice($recent_activities, 0, 5) as $activity): ?>
                                <a href="<?= $activity['link'] ?>" class="list-group-item list-group-item-action border-0 py-3 px-4 hover-lift">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-<?= $activity['color'] ?> text-white mr-3 flex-shrink-0">
                                            <i class="fas fa-<?= $activity['icon'] ?>"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="font-weight-bold mb-1"><?= $activity['title'] ?></h6>
                                                <small class="text-muted"><?= $activity['time'] ?></small>
                                            </div>
                                            <p class="mb-0 text-gray-600 small"><?= $activity['description'] ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-inbox fa-3x text-gray-300"></i>
                            </div>
                            <h6 class="text-gray-500 mb-0">Tidak ada aktivitas terbaru</h6>
                            <p class="small text-muted">Aktivitas akan muncul di sini</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Stats -->
        <div class="col-lg-6 mb-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="#" class="btn btn-primary btn-block py-3">
                                <i class="fas fa-plus-circle fa-fw"></i> Buat Berita Baru
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="#" class="btn btn-success btn-block py-3">
                                <i class="fas fa-upload fa-fw"></i> Unggah ke Galeri
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="#" class="btn btn-info btn-block py-3">
                                <i class="fas fa-envelope fa-fw"></i> Kelola Pesan
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="#" class="btn btn-warning btn-block py-3">
                                <i class="fas fa-cog fa-fw"></i> Pengaturan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Statistik</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6 mb-4">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($total_pengunjung) ?></div>
                                <div class="small text-uppercase text-muted">Pengunjung Hari Ini</div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($total_pengunjung * 7) ?></div>
                                <div class="small text-uppercase text-muted">Total Pengunjung Bulan Ini</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($total_berita) ?></div>
                                <div class="small text-uppercase text-muted">Total Berita</div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($total_galeri) ?></div>
                                <div class="small text-uppercase text-muted">Total Galeri</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="#" class="btn btn-sm btn-primary">Lihat Laporan Lengkap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->