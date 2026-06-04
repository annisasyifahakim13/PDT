<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aduan Saya - LostTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="dashboard-wrapper">
    <aside class="sidebar">
        <div class="logo">🔍 LostTrack</div>
        <ul class="menu">
            <li><a href="index.php?page=reports"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a></li>
            <li><a href="index.php?page=create_report"><i class="bi bi-plus-circle"></i> Tambah Aduan</a></li>
            <li><a href="index.php?page=aduan_saya" class="active"><i class="bi bi-file-earmark-text"></i> Aduan Saya</a></li>
            <li><a href="index.php?page=logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <div class="topbar">
            <h2>Riwayat Aduan Saya</h2>
            <span>Halo, <?= $_SESSION['user']['nama'] ?></span>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Semua Laporan (Termasuk Arsip/Selesai)</h5>
            </div>
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID Aduan</th>
                        <th>Item</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($reports)): ?>
                        <tr><td colspan="5" class="text-center">Belum ada aduan.</td></tr>
                    <?php else: ?>
                        <?php foreach($reports as $report): ?>
                        <tr>
                            <td>#LT<?= str_pad($report['id'], 4, '0', STR_PAD_LEFT) ?></td>
                            <td><?= $report['nama_barang'] ?></td>
                            <td><?= $report['lokasi_hilang'] ?></td>
                            <td><?= date('d M Y', strtotime($report['tanggal_hilang'])) ?></td>
                            <td><span class="badge bg-secondary"><?= $report['status'] ?></span></td>
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