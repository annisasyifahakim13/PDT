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

            $menunggu = 0;
            $ditemukan = 0;

            foreach($reports as $report)
            {
                if($report['status'] == 'Menunggu Verifikasi')
                {
                    $menunggu++;
                }

                if($report['status'] == 'Ditemukan')
                {
                    $ditemukan++;
                }
            }

            require __DIR__ . '/../views/admin/dashboard.php';
        }
        else
        {
            $reports = $this->reportModel->getByUser(
                $_SESSION['user']['id']
            );

            $totalAduan = count($reports);

            $menunggu = 0;
            $ditemukan = 0;

            foreach($reports as $report)
            {
                if($report['status'] == 'Menunggu Verifikasi')
                {
                    $menunggu++;
                }

                if($report['status'] == 'Ditemukan')
                {
                    $ditemukan++;
                }
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

    $this->reportModel->updateStatus(
        $id,
        $status
    );

    header('Location: index.php?page=reports');
    exit;
}
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $foto = '';
            if (!empty($_FILES['foto']['name'])) {
                $foto = time() . '_' . $_FILES['foto']['name'];
                move_uploaded_file(
                    $_FILES['foto']['tmp_name'],
                    __DIR__ . '/../assets/uploads/' . $foto
                );
            }

            $transaksi = $this->reportModel->create([
                'user_id' => $_SESSION['user']['id'],
                'nama_barang'    => $_POST['nama_barang'],
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
}