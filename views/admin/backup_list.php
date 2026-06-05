<?php

$backupDir = __DIR__ . '/../../storage/backups/';

$files = [];

if (is_dir($backupDir)) {
    $files = array_diff(scandir($backupDir, SCANDIR_SORT_DESCENDING), ['.', '..']);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Backup Database</title>

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
                <a href="index.php?page=history">
                    <i class="bi bi-collection"></i>
                    Riwayat
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
            <h2>Backup Database</h2>

            <span>
                Halo, <?= $_SESSION['user']['nama'] ?>
            </span>
        </div>

        <div class="card dashboard-card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Daftar Backup
                </h5>

                <a href="backup.php" class="btn btn-primary">
                    <i class="bi bi-download"></i>
                    Backup Sekarang
                </a>

            </div>

            <div class="card-body">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php $no = 1; ?>

                    <?php foreach($files as $file): ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $file ?></td>
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