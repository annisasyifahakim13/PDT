<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lapor Penemuan Barang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            <h4>Lapor Penemuan Barang</h4>
        </div>

        <div class="card-body">

            <h5><?= $report['nama_barang'] ?></h5>

            <p>
                Lokasi Hilang:
                <?= $report['lokasi_hilang'] ?>
            </p>

            <hr>

            <form>

                <div class="mb-3">
                    <label class="form-label">
                        Nama Penemu
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Masukkan nama">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Kontak
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Masukkan nomor HP">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea
                        class="form-control"
                        rows="4"></textarea>
                </div>

                <button
                    type="button"
                    class="btn btn-success">
                    Kirim Laporan
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>