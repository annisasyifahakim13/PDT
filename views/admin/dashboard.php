<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard LostTrack</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
                <a href="index.php?page=status_logs">
                    <i class="bi bi-clock-history"></i>
                    Riwayat Status
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

            <h2>Dashboard Admin</h2>

            <span>
                Halo, <?= $_SESSION['user']['nama'] ?>
            </span>

        </div>

        <!-- STATISTIK -->

        <div class="stats">

            <div class="stat-card">

                <h3><?= $totalAduan ?></h3>

                <p>Total Aduan</p>

            </div>

            <div class="stat-card warning">

                <h3><?= $menunggu ?></h3>

                <p>Menunggu</p>

            </div>

            <div class="stat-card success">

                <h3><?= $ditemukan ?></h3>

                <p>Ditemukan</p>

            </div>

        </div>

        <!-- TABEL -->

        <div class="card dashboard-card">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Aduan Terbaru
                </h5>

            </div>

            <div class="card-body p-0">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>
                            <th>ID Aduan</th>
                            <th>Barang</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach($reports as $report): ?>

                        <tr>

                            <td>
                                #LT<?= str_pad($report['id'],4,'0',STR_PAD_LEFT) ?>
                            </td>

                            <td>
                                <?= $report['nama_barang'] ?>
                            </td>

                            <td>
                                <?= $report['lokasi_hilang'] ?>
                            </td>

                            <td>
                                <?= date('d M Y', strtotime($report['tanggal_hilang'])) ?>
                            </td>

                            <td>

                                <?php if($report['status']=='Menunggu Verifikasi'): ?>

                                    <span class="badge bg-warning text-dark">
                                        Menunggu
                                    </span>

                                <?php elseif($report['status']=='Dalam Pencarian'): ?>

                                    <span class="badge bg-info">
                                        Dalam Proses
                                    </span>

                                <?php elseif($report['status']=='Ditemukan'): ?>

                                    <span class="badge bg-success">
                                        Ditemukan
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger">
                                        Ditutup
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <form method="POST" action="index.php?page=update_status">

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $report['id'] ?>"
                                    >

                                    <div class="d-flex gap-2">

                                        <select
                                            name="status"
                                            class="form-select form-select-sm"
                                        >

                                            <option
                                                value="Menunggu Verifikasi"
                                                <?= $report['status'] == 'Menunggu Verifikasi' ? 'selected' : '' ?>
                                            >
                                                Menunggu Verifikasi
                                            </option>

                                            <option
                                                value="Dalam Pencarian"
                                                <?= $report['status'] == 'Dalam Pencarian' ? 'selected' : '' ?>
                                            >
                                                Dalam Pencarian
                                            </option>

                                            <option
                                                value="Ditemukan"
                                                <?= $report['status'] == 'Ditemukan' ? 'selected' : '' ?>
                                            >
                                                Ditemukan
                                            </option>

                                            <option
                                                value="Ditutup"
                                                <?= $report['status'] == 'Ditutup' ? 'selected' : '' ?>
                                            >
                                                Ditutup
                                            </option>

                                        </select>

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-sm"
                                        >
                                            Simpan
                                        </button>

                                    </div>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>