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
            <li><a href="index.php?page=saluran_barang"><i class="bi bi-broadcast"></i>Saluran Barang Hilang</a></li>
            <li><a href="index.php?page=logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <div class="topbar">
            <h2>Riwayat Aduan Saya</h2>
            <span>Halo, <?= $_SESSION['user']['nama'] ?></span>
        </div>

        <?php if (isset($_SESSION['flash_msg'])): ?>
            <?= $_SESSION['flash_msg']; unset($_SESSION['flash_msg']); ?>
        <?php endif; ?>

        <div class="card mt-4">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID Aduan</th>
                        <th>Item</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                            <td><?= date('d M Y', strtotime($report['tanggal_hilang'])) ?></td>
                            <td><span class="badge bg-secondary"><?= $report['status'] ?></span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="index.php?page=riwayat_status&id=<?= $report['id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-search"></i> Lacak</a>
                                    <?php if($report['status'] == 'Menunggu Verifikasi'): ?>
                                        <a href="index.php?page=delete&id=<?= $report['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus aduan ini?')"><i class="bi bi-trash"></i> Hapus</a>
                                    <?php endif; ?>
                                </div>
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