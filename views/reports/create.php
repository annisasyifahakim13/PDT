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

<style>
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        transform: scale(1.5);
        cursor: pointer;
        margin-right: 5px;
    }

    input[type="file"].form-control, 
    input[type="file"] {
        background-color: #0b1c36 !important; 
        color: #b0b0b0 !important; 
        border: none !important;
        padding: 5px;
        border-radius: 5px;
        width: 100%;
    }
    
    input[type="file"]::-webkit-file-upload-button {
        background-color: #798693; 
        color: white;
        border: none;
        padding: 14px 16px;
        margin-right: 15px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: 0.3s ease;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
        background-color: #3388ff; 
    }

    select[name="kategori"] {
        appearance: none; 
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right 15px center !important;
        background-size: 16px !important;
        padding-right: 40px !important;
    }
</style>
<div class="dashboard-wrapper">

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
                <a href="index.php?page=saluran_barang">
                    <i class="bi bi-broadcast"></i>
                    Saluran Barang Hilang
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

                        <select name="kategori" class="form-control" style="background-color: #0b1c36; color: white; border: none;" required>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Dokumen">Dokumen</option>
                            <option value="Aksesoris">Aksesoris</option>
                            <option value="Tas/Dompet">Tas/Dompet</option>
                            <option value="Kunci">Kunci</option>
                            <option value="Peralatan Tulis">Peralatan Tulis</option>
                            <option value="Kendaraan">Kendaraan</option>
                            <option value="Lainnya">Lainnya</option>
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