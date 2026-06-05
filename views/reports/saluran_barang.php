<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Saluran Barang Hilang</title>
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
            <h2>📢 Saluran Barang Hilang</h2>
        </div>

        <div class="row">

            <?php foreach($reports as $report): ?>

                <?php if($report['status'] != 'Menunggu Verifikasi'): ?>

                <div class="col-md-6 mb-4">

                    <div class="card shadow-sm h-100">

                        <div class="card-body">

                            <h5 class="card-title">
                                <?= $report['nama_barang'] ?>
                            </h5>

                            <p>
                                <strong>Kategori:</strong>
                                <?= $report['kategori'] ?>
                            </p>

                            <p>
                                <strong>Lokasi Hilang:</strong>
                                <?= $report['lokasi_hilang'] ?>
                            </p>

                            <p>
                                <strong>Tanggal:</strong>
                                <?= date('d M Y', strtotime($report['tanggal_hilang'])) ?>
                            </p>

                            <p>
                                <strong>Status:</strong>

                                <?php if($report['status']=='Dalam Pencarian'): ?>
                                    <span class="badge bg-info">
                                        Dalam Pencarian
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success">
                                        <?= $report['status'] ?>
                                    </span>
                                <?php endif; ?>
                            </p>

                            <hr>

                            <p>
                                <?= $report['deskripsi'] ?>
                            </p>

                            <a href="index.php?page=form_penemuan&id=<?= $report['id'] ?>" class="btn btn-success w-100"> Saya Menemukan Barang Ini</a>

                        </div>

                    </div>

                </div>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

    </main>

</div>

</body>
</html>