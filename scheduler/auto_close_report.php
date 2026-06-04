<?php

require_once __DIR__ . '/../config/db.php';
$db = getDB();

echo "<h2>Task Scheduler: Fragmentasi Database</h2>";

try {
    $db->beginTransaction();

    $pindahData = $db->exec("
        INSERT INTO reports_archive (id, user_id, nama_barang, kategori, lokasi_hilang, tanggal_hilang, deskripsi, foto, status, created_at)
        SELECT id, user_id, nama_barang, kategori, lokasi_hilang, tanggal_hilang, deskripsi, foto, status, created_at 
        FROM reports 
        WHERE status = 'Ditutup'
    ");

    if ($pindahData > 0) {
        $db->exec("DELETE FROM reports WHERE status = 'Ditutup'");
        echo "<p style='color: green;'>Sukses: $pindahData aduan berhasil dipindahkan ke tabel arsip (Fragmentasi Horizontal).</p>";
    } else {
        echo "<p>Tidak ada data aduan dengan status 'Ditutup' yang perlu diarsip saat ini.</p>";
    }

    $db->commit();

} catch (Exception $e) {
    $db->rollBack();
    echo "<p style='color: red;'>Gagal melakukan fragmentasi: " . $e->getMessage() . "</p>";
}
?>