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
            ->query("SELECT * FROM reports ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("CALL sp_insert_report(?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['user_id'], $data['nama_barang'], $data['kategori'],
                $data['lokasi_hilang'], $data['tanggal_hilang'], $data['deskripsi'], $data['foto']
            ]);
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function updateStatus($id, $status)
    {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("SELECT * FROM reports WHERE id = ? FOR UPDATE");
            $stmt->execute([$id]);
            $report = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$report) throw new Exception("Laporan tidak ditemukan");

            $statusLama = $report['status'];

            $stmt = $this->db->prepare("INSERT INTO admin_activity (admin_id, aktivitas) VALUES (?, ?)");
            $stmt->execute([$_SESSION['user']['id'], 'Update Status']);
            
            $stmt = $this->db->prepare("UPDATE reports SET status = ? WHERE id = ?");
            $stmt->execute([$status, $id]);
            
            $stmt = $this->db->prepare("INSERT INTO status_logs (report_id, status_lama, status_baru) VALUES (?, ?, ?)");
            $stmt->execute([$id, $statusLama, $status]);

            $this->db->commit();
            return true;
        } catch(Exception $e){
            $this->db->rollBack();
            die($e->getMessage());
        }
    }

    public function delete($id) 
    {
        try {
            $this->db->beginTransaction();

            $report = $this->getById($id);
            if ($report && !empty($report['foto'])) {
                $filePath = __DIR__ . '/../assets/uploads/' . $report['foto'];
                if (file_exists($filePath)) unlink($filePath);
            }

            $this->db->prepare("DELETE FROM laporan_penemuan WHERE report_id = ?")->execute([$id]);
            $this->db->prepare("DELETE FROM status_logs WHERE report_id = ?")->execute([$id]);
            
            $stmt = $this->db->prepare("CALL sp_delete_report(?)");
            $stmt->execute([$id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getByUser($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM v_aduan_user WHERE user_id = ? ORDER BY id DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAduanSaya($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM v_semua_aduan WHERE user_id = ? ORDER BY tanggal_hilang DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHistoryUnion()
    {
        return $this->db->query("SELECT * FROM v_semua_aduan ORDER BY tanggal_hilang DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM reports WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRiwayatStatus($reportId)
    {
        $stmt = $this->db->prepare("SELECT * FROM status_logs WHERE report_id = ? ORDER BY created_at ASC");
        $stmt->execute([$reportId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}