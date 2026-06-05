<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penemuan - LostTrack</title>

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
                <a href="index.php?page=history">
                    <i class="bi bi-collection"></i>
                    Riwayat Semua
                </a>
            </li>

            <li>
                <a href="index.php?page=laporan_penemuan" class="active">
                    <i class="bi bi-search"></i>
                    Laporan Penemuan
                </a>
            </li>

            <li>
                <a href="index.php?page=backup">
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
            <h2>Laporan Penemuan Barang</h2>

            <span>
                Halo, <?= $_SESSION['user']['nama'] ?>
            </span>
        </div>

        <div class="card dashboard-card">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Data Penemuan Barang
                </h5>
            </div>

            <div class="card-body">

                <?php if(empty($laporan)): ?>

                    <div class="alert alert-info">
                        Belum ada laporan penemuan barang.
                    </div>

                <?php else: ?>

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barang</th>
                                <th>Nama Penemu</th>
                                <th>Kontak</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php foreach($laporan as $item): ?>

                            <tr>

                                <td>
                                    #<?= $item['id'] ?>
                                </td>

                                <td>
                                    <?= $item['nama_barang'] ?>
                                </td>

                                <td>
                                    <?= $item['nama_penemu'] ?>
                                </td>

                                <td>
                                    <?= $item['kontak'] ?>
                                </td>

                                <td>
                                    <?= $item['keterangan'] ?>
                                </td>

                                <td>
                                    <?= date('d M Y H:i', strtotime($item['created_at'])) ?>
                                </td>

                                <td>

                                    <form method="POST"
                                          action="index.php?page=update_status">

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= $item['report_id'] ?>">

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="Ditemukan">

                                        <button
                                            type="submit"
                                            class="btn btn-success btn-sm">

                                            Tandai Ditemukan

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                <?php endif; ?>

            </div>

        </div>

    </main>

</div>

<div id="loadingOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.8); z-index:9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-center">
            <div class="spinner-border text-primary"></div>
            <h5 class="mt-3">Wait For Minute...</h5>
        </div>
    </div>
</div>

<script>
document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", function(){
        document.getElementById("loadingOverlay").style.display = "block";
    });
});
</script>

</body>
</html>