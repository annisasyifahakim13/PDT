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

<form method="POST" action="index.php?page=simpan_penemuan">

    <input
        type="hidden"
        name="report_id"
        value="<?= $report['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Nama Penemu</label>

        <input
            type="text"
            name="nama_penemu"
            class="form-control"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kontak</label>

        <input
            type="text"
            name="kontak"
            class="form-control"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Keterangan</label>

        <textarea
            name="keterangan"
            class="form-control"
            rows="4"
            required></textarea>
    </div>
<button
    type="submit"
    class="btn btn-success"
    onclick="this.disabled=true; this.form.submit();">
    Kirim Laporan
</button>

</form>

        </div>

    </div>

</div>

</body>
</html>