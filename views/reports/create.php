<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Aduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="dashboard-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            🔍 LostTrack
        </div>

        <ul class="menu">

            <li>
                <a href="index.php?page=reports">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="index.php?page=create_report">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Aduan
                </a>
            </li>

            <li>
                <a href="index.php?page=aduan_saya">
                    <i class="bi bi-file-earmark-text"></i>
                    Aduan Saya
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

    <!-- CONTENT -->
    <main class="content">

        <div class="page-header">
            <h2>Tambah Aduan Kehilangan</h2>
            <p>Isi data barang yang hilang dengan lengkap.</p>
        </div>

        <div class="report-card">

            <form method="POST" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Nama Barang</label>
                        <input
                            type="text"
                            name="nama_barang"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Kategori</label>

                        <select
                            name="kategori"
                            class="form-select">

                            <option>Elektronik</option>
                            <option>Dokumen</option>
                            <option>Aksesoris</option>
                            <option>Lainnya</option>

                        </select>
                    </div>

                </div>

                <div class="mb-3">
                    <label>Lokasi Hilang</label>

                    <input
                        type="text"
                        name="lokasi_hilang"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Hilang</label>

                    <input
                        type="date"
                        name="tanggal_hilang"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"></textarea>
                </div>

                <div class="mb-4">
                    <label>Upload Foto Barang</label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control">
                </div>

                <button
                    type="submit"
                    class="btn btn-save">

                    Simpan Aduan

                </button>

                <a
                    href="index.php?page=reports"
                    class="btn btn-back">

                    Kembali

                </a>

            </form>

        </div>

    </main>

</div>

</body>
</html>