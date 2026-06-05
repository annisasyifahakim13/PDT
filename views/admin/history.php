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
                <a href="index.php?page=reports" class="active">
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
                <a href="index.php?page=history">
                    <i class="bi bi-collection"></i>
                    Riwayat Semua
                </a>
            </li>

            <li>
                <a href="index.php?page=status_logs">
                    <i class="bi bi-clock-history"></i>
                    Riwayat Status
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

        <div class="card">
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
                    <?php 
                    require_once __DIR__ . '/../../models/ReportModel.php';
                    $rm = new ReportModel();
                    $allReports = $rm->getHistoryUnion();
                    
                    foreach($allReports as $report): 
                    ?>
                    <tr>
                        <td>#LT<?= str_pad($report['id'], 4, '0', STR_PAD_LEFT) ?></td>
                        <td><?= $report['nama_barang'] ?></td>
                        <td><?= $report['lokasi_hilang'] ?></td>
                        <td><?= date('d M Y', strtotime($report['tanggal_hilang'])) ?></td>
                        <td>
                            <span class="badge bg-secondary"><?= $report['status'] ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>