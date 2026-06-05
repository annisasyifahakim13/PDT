<?php

require_once __DIR__ . '/../models/ReportModel.php';

class ReportController
{
    private ReportModel $reportModel;

    public function __construct()
    {
        $this->reportModel = new ReportModel();
    }

    public function index()
    {
        if($_SESSION['user']['role'] == 'admin')
        {
            $reports = $this->reportModel->getAll();
            $totalAduan = count($reports);
            $menunggu = 0; $ditemukan = 0;

            foreach($reports as $report)
            {
                if($report['status'] == 'Menunggu Verifikasi') $menunggu++;
                if($report['status'] == 'Ditemukan') $ditemukan++;
            }
            require __DIR__ . '/../views/admin/dashboard.php';
        }
        else
        {
            $reports = $this->reportModel->getByUser($_SESSION['user']['id']);
            $totalAduan = count($reports);
            $menunggu = 0; $ditemukan = 0;
            
            foreach($reports as $report)
            {
                if($report['status'] == 'Menunggu Verifikasi') $menunggu++;
                if($report['status'] == 'Ditemukan') $ditemukan++;
            }
            require __DIR__ . '/../views/reports/index.php';
        }
    }

    public function verify()
    {
        $id = $_GET['id'];
        $this->reportModel->verify($id);
        redirect('index.php?page=reports');
    }

    public function updateStatus()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $this->reportModel->updateStatus($id, $status);
        header('Location: index.php?page=reports');
        exit;
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $foto = '';
            if (!empty($_FILES['foto']['name'])) {
                $foto = time() . '_' . $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . '/../assets/uploads/' . $foto);
            }

            $transaksi = $this->reportModel->create([
                'user_id' => $_SESSION['user']['id'],
                'nama_barang' => $_POST['nama_barang'],
                'kategori' => $_POST['kategori'],
                'lokasi_hilang' => $_POST['lokasi_hilang'],
                'tanggal_hilang' => $_POST['tanggal_hilang'],
                'deskripsi' => $_POST['deskripsi'],
                'foto' => $foto
            ]);

            if ($transaksi) {
                $_SESSION['flash_msg'] = "<div class='alert alert-success'>Transaksi Berhasil: Data aduan berhasil disimpan!</div>";
            } else {
                $_SESSION['flash_msg'] = "<div class='alert alert-danger'>Transaksi Gagal: Terjadi kesalahan saat menyimpan data.</div>";
            }
            redirect('index.php?page=reports');
        }
        require __DIR__ . '/../views/reports/create.php';
    }

    public function aduanSaya()
    {
        $stmt = getDB()->prepare("
            SELECT *
            FROM v_aduan_user
            WHERE user_id = ?
            ORDER BY id DESC
        ");

        $stmt->execute([
            $_SESSION['user']['id']
        ]);

        $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/reports/aduan_saya.php';
    }

    public function saluranBarang()
    {
        $reports = $this->reportModel->getAll();
        require __DIR__ . '/../views/reports/saluran_barang.php';
    }

    public function formPenemuan()
    {
        $id = $_GET['id'];
        $report = $this->reportModel->getById($id);
        require __DIR__ . '/../views/reports/form_penemuan.php';
    }

    public function simpanPenemuan()
    {
        $stmt = getDB()->prepare("INSERT INTO laporan_penemuan (report_id, nama_penemu, kontak, keterangan) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['report_id'], $_POST['nama_penemu'], $_POST['kontak'], $_POST['keterangan']]);
        header('Location: index.php?page=saluran_barang');
        exit;
    }

    public function laporanPenemuan()
    {
        $stmt = getDB()->query("SELECT lp.*, r.nama_barang FROM laporan_penemuan lp JOIN reports r ON lp.report_id = r.id ORDER BY lp.id DESC");
        $laporan = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require __DIR__ . '/../views/admin/laporan_penemuan.php';
    }

    public function history()
    {
        $stmt = getDB()->query("
            SELECT *
            FROM v_semua_aduan
            ORDER BY id DESC
        ");

        $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/admin/history.php';
    }

    public function riwayatStatus()
    {
        if (!isset($_GET['id'])) { header('Location: index.php?page=reports'); exit; }
        $id = $_GET['id'];
        $report = $this->reportModel->getById($id);
        $history = $this->reportModel->getRiwayatStatus($id);
        if (!$report) { header('Location: index.php?page=reports'); exit; }
        require __DIR__ . '/../views/reports/riwayat_status.php';
    }

    public function delete() 
    {
        if (isset($_GET['id'])) {
            $this->reportModel->delete($_GET['id']);
            $_SESSION['flash_msg'] = "<div class='alert alert-danger'>Data berhasil dihapus.</div>";
        }
        if ($_SESSION['user']['role'] == 'admin') {
            header('Location: index.php?page=reports'); 
        } else {
            header('Location: index.php?page=aduan_saya');
        }
        exit;
    }
    }