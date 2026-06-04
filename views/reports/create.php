<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Aduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            <h4>Tambah Aduan Kehilangan</h4>
        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input
                        type="text"
                        name="nama_barang"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label>Kategori</label>

                    <select
                        name="kategori"
                        class="form-select"
                    >
                        <option>Elektronik</option>
                        <option>Dokumen</option>
                        <option>Aksesoris</option>
                        <option>Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Lokasi Hilang</label>

                    <input
                        type="text"
                        name="lokasi_hilang"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label>Tanggal Hilang</label>

                    <input
                        type="date"
                        name="tanggal_hilang"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4"
                    ></textarea>
                </div>

                <div class="mb-3">
                    <label>Foto Barang</label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                    >
                </div>

                <button class="btn btn-primary">
                    Simpan Aduan
                </button>

                <a
                    href="index.php?page=reports"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>