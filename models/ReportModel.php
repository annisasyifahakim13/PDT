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
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("CALL sp_insert_report(?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $data['user_id'],
                $data['nama_barang'],
                $data['kategori'],
                $data['lokasi_hilang'],
                $data['tanggal_hilang'],
                $data['deskripsi'],
                $data['foto']
            ]);

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
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
    try {

        $this->db->beginTransaction();

        $stmt = $this->db->prepare("
            SELECT *
            FROM reports
            WHERE id = ?
            FOR UPDATE
        ");

        $stmt->execute([$id]);

        $report = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$report){
            throw new Exception("Laporan tidak ditemukan");
        }

        $statusLama = $report['status'];

        $stmt = $this->db->prepare("
            INSERT INTO admin_activity
            (
                admin_id,
                aktivitas
            )
            VALUES (?, ?)
        ");

        $stmt->execute([
            $_SESSION['user']['id'],
            'Update Status'
        ]);
        sleep(15);
        $stmt = $this->db->prepare("
            UPDATE reports
            SET status = ?
            WHERE id = ?
        ");

        $stmt->execute([
            $status,
            $id
        ]);
        $stmt = $this->db->prepare("
            INSERT INTO status_logs
            (
                report_id,
                status_lama,
                status_baru
            )
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $id,
            $statusLama,
            $status
        ]);

        $this->db->commit();

        return true;

    } catch(Exception $e){

        $this->db->rollBack();

        die($e->getMessage());
    }
}
    public function getByUser($userId)
    {
    $stmt = $this->db->prepare("
        SELECT *
        FROM v_aduan_user
        WHERE user_id = ?
        ORDER BY id DESC
    ");

    $stmt->execute([$userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAduanSaya($userId)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM v_semua_aduan 
            WHERE user_id = ? 
            ORDER BY tanggal_hilang DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalAduan($userId)
    {
    $stmt = $this->db->prepare("
        SELECT total_aduan_user(?) AS total
    ");

    $stmt->execute([$userId]);

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countStatus($userId, $status)
    {
    $stmt = $this->db->prepare("
        SELECT COUNT(*) as total
        FROM reports
        WHERE user_id = ?
        AND status = ?
    ");

    $stmt->execute([$userId, $status]);

    return $stmt->fetch()['total'];
    }

    public function getHistoryUnion()
    {
        $stmt = $this->db->query("SELECT * FROM v_semua_aduan ORDER BY tanggal_hilang DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}