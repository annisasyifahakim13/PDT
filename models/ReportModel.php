<?php

require_once __DIR__ . '/../config/db.php';

class ReportModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = getDB();
    }

    public function getAll()
    {
        return $this->db
            ->query("
                SELECT *
                FROM reports
                ORDER BY id DESC
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO reports
            (
                user_id,
                nama_barang,
                kategori,
                lokasi_hilang,
                tanggal_hilang,
                deskripsi,
                foto
            )
            VALUES (?,?,?,?,?,?,?)
        ");

        return $stmt->execute([
            $data['user_id'],
            $data['nama_barang'],
            $data['kategori'],
            $data['lokasi_hilang'],
            $data['tanggal_hilang'],
            $data['deskripsi'],
            $data['foto']
        ]);
    }
    public function verify($id)
{
    $stmt = $this->db->prepare("
        UPDATE reports
        SET status = 'Dalam Pencarian'
        WHERE id = ?
    ");

    return $stmt->execute([$id]);
}
public function updateStatus($id, $status)
{
    $stmt = $this->db->prepare("
        UPDATE reports
        SET status = ?
        WHERE id = ?
    ");

    return $stmt->execute([
        $status,
        $id
    ]);
}
}