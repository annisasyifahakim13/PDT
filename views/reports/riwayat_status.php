<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lacak Riwayat - LostTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .timeline {
            border-left: 3px solid #4da6ff; 
            padding-left: 20px;
            margin-left: 15px;
            margin-top: 20px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 25px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #4da6ff;
            border: 3px solid #ffffff;
            box-shadow: 0 0 0 2px #4da6ff;
        }
        .time-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
<div class="dashboard-wrapper">
    <aside class="sidebar">
        <div class="logo">🔍 LostTrack</div>
        <ul class="menu">
            <li><a href="index.php?page=reports"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a></li>
            <?php if($_SESSION['user']['role'] == 'user'): ?>
                <li><a href="index.php?page=create_report"><i class="bi bi-plus-circle"></i> Tambah Aduan</a></li>
                <li><a href="index.php?page=aduan_saya"><i class="bi bi-file-earmark-text"></i> Aduan Saya</a></li>
            <?php endif; ?>
            <li><a href="index.php?page=logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <div class="topbar">
            <h2>Lacak Riwayat Status</h2>
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0" style="color: #4da6ff;">
                    Item: <?= htmlspecialchars($report['nama_barang']) ?> 
                    <span class="text-muted fs-6">(#LT<?= str_pad($report['id'], 4, '0', STR_PAD_LEFT) ?>)</span>
                </h5>
            </div>
            <div class="card-body">
                
                <?php if(empty($history)): ?>
                    <div class="alert alert-info">Belum ada pembaruan riwayat untuk item ini.</div>
                <?php else: ?>
                    <div class="timeline">
                        <?php foreach($history as $log): ?>
                            <div class="timeline-item">
                                <div class="time-label">
                                    <i class="bi bi-clock"></i> 
                                    <?= date('d M Y - H:i:s', strtotime($log['created_at'])) ?>
                                </div>
                                <div class="p-3 border rounded bg-light">
                                    Status berubah dari 
                                    <strong><span class="text-danger"><?= htmlspecialchars($log['status_lama']) ?></span></strong> 
                                    menjadi 
                                    <strong><span style="color: #4da6ff;"><?= htmlspecialchars($log['status_baru']) ?></span></strong>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </main>
</div>
</body>
</html>