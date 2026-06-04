<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Dashboard LostTrack</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <span class="navbar-brand">
            🔍 LostTrack
        </span>

        <div>

            <span class="text-white me-3">
                Halo, <?= $_SESSION['user']['nama'] ?>
                (<?= $_SESSION['user']['role'] ?>)
            </span>

            <a
                href="index.php?page=create_report"
                class="btn btn-light btn-sm"
            >
                + Tambah Aduan
            </a>

            <a
                href="index.php?page=logout"
                class="btn btn-danger btn-sm"
            >
                Logout
            </a>

        </div>

    </div>

</nav>

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">
                Data Aduan Kehilangan
            </h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Status</th>

                        <?php if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>

                    </tr>

                </thead>

                <tbody>

                <?php if(empty($reports)): ?>

                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada aduan
                        </td>
                    </tr>

                <?php endif; ?>

                <?php foreach($reports as $i => $report): ?>

                    <tr>

                        <td><?= $i + 1 ?></td>

                        <td><?= $report['nama_barang'] ?></td>

                        <td><?= $report['kategori'] ?></td>

                        <td><?= $report['lokasi_hilang'] ?></td>

                        <td><?= $report['tanggal_hilang'] ?></td>

                        <td>

                            <?php
                            $status = $report['status'] ?? 'Menunggu Verifikasi';

                            if($status == 'Menunggu Verifikasi'){
                                echo '<span class="badge bg-warning text-dark">'.$status.'</span>';
                            }
                            elseif($status == 'Dalam Pencarian'){
                                echo '<span class="badge bg-info">'.$status.'</span>';
                            }
                            elseif($status == 'Ditemukan'){
                                echo '<span class="badge bg-success">'.$status.'</span>';
                            }
                            else{
                                echo '<span class="badge bg-secondary">'.$status.'</span>';
                            }
                            ?>

                        </td>

<?php if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin'): ?>

<td>

    <form
        method="POST"
        action="index.php?page=update_status"
    >

        <input
            type="hidden"
            name="id"
            value="<?= $report['id'] ?>"
        >

        <select
            name="status"
            class="form-select form-select-sm mb-2"
        >

            <option
                value="Menunggu Verifikasi"
                <?= $status == 'Menunggu Verifikasi' ? 'selected' : '' ?>
            >
                Menunggu Verifikasi
            </option>

            <option
                value="Dalam Pencarian"
                <?= $status == 'Dalam Pencarian' ? 'selected' : '' ?>
            >
                Dalam Pencarian
            </option>

            <option
                value="Ditemukan"
                <?= $status == 'Ditemukan' ? 'selected' : '' ?>
            >
                Ditemukan
            </option>

            <option
                value="Ditutup"
                <?= $status == 'Ditutup' ? 'selected' : '' ?>
            >
                Ditutup
            </option>

        </select>

        <button
            type="submit"
            class="btn btn-primary btn-sm w-100"
        >
            Simpan Status
        </button>

    </form>

</td>

<?php endif; ?>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>