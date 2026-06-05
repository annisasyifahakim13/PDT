<?php

require_once __DIR__.'/../config/db.php';

class PenemuanModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDB();
    }
public function getAll()
{
    $stmt = getDB()->query("
        SELECT lp.*, r.nama_barang
        FROM laporan_penemuan lp
        JOIN reports r ON lp.report_id = r.id
        ORDER BY lp.id DESC
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function create($reportId, $userId)
    {
        $stmt = $this->db->prepare("
            INSERT INTO laporan_penemuan
            (
                report_id,
                user_id,
                tanggal_lapor
            )
            VALUES (?, ?, NOW())
        ");

        return $stmt->execute([
            $reportId,
            $userId
        ]);
    }
}