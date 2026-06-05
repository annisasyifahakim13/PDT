<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Keseluruhan - LostTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="dashboard-wrapper">
    <aside class="sidebar">

        <div class="logo">
            🔍 LostTrack
        </div>

        <ul class="menu">

            <li>
                <a href="index.php?page=reports">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Dashboard Admin
                </a>
            </li>

            <li>
                <a href="index.php?page=reports">
                    <i class="bi bi-folder2-open"></i>
                    Kelola Aduan
                </a>
            </li>
            
            <li>
                <a href="index.php?page=history" class="active">
                    <i class="bi bi-collection"></i>
                    Riwayat
                </a>
            </li>

            <li>
                <a href="index.php?page=laporan_penemuan">
                    <i class="bi bi-search"></i>
                    Laporan Penemuan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=backup">
                    <i class="bi bi-database"></i>
                    Backup Database
                </a>
            </li>

            <li>
                <a href="index.php?page=logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>
            </li>

        </ul>

    </aside>

    <main class="content">
        <div class="topbar">
            <h2>Riwayat Keseluruhan</h2>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Semua Laporan</h5>
            </div>
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID Aduan</th>
                        <th>Item</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($reports)): ?>
                        <tr><td colspan="6" class="text-center">Belum ada aduan.</td></tr>
                    <?php else: ?>
                        <?php foreach($reports as $report): ?>
                        <tr>
                            <td>#LT<?= str_pad($report['id'], 4, '0', STR_PAD_LEFT) ?></td>
                            <td><?= $report['nama_barang'] ?></td>
                            <td><?= $report['lokasi_hilang'] ?></td>
                            <td><?= date('d M Y', strtotime($report['tanggal_hilang'])) ?></td>
                            <td>
                                <?php 
                                    $warnaBadge = 'bg-secondary'; 
                                    if ($report['status'] == 'Menunggu Verifikasi') {
                                        $warnaBadge = 'bg-warning text-dark'; 
                                    } elseif ($report['status'] == 'Dalam Pencarian') {
                                        $warnaBadge = 'bg-info text-dark'; 
                                    } elseif ($report['status'] == 'Ditemukan') {
                                        $warnaBadge = 'bg-success'; 
                                    } elseif ($report['status'] == 'Ditutup') {
                                        $warnaBadge = 'bg-dark'; 
                                    }
                                ?>
                                <span class="badge <?= $warnaBadge ?>"><?= $report['status'] ?></span>
                            </td>
                            <td>
                                <a href="index.php?page=riwayat_status&id=<?= $report['id'] ?>" class="btn btn-sm" style="background-color: #4da6ff; color: white;">
                                    <i class="bi bi-search"></i> Lacak
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>