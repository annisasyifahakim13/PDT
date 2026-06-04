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
        $reports = $this->reportModel->getAll();

        require __DIR__ . '/../views/reports/index.php';
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

            $this->reportModel->create([
                'user_id' => $_SESSION['user']['id'],
                'nama_barang'    => $_POST['nama_barang'],
                'kategori' => $_POST['kategori'],
                'lokasi_hilang' => $_POST['lokasi_hilang'],
                'tanggal_hilang' => $_POST['tanggal_hilang'],
                'deskripsi' => $_POST['deskripsi'],
                'foto' => $foto
            ]);

            redirect('index.php?page=reports');
        }

        require __DIR__ . '/../views/reports/create.php';
    }
}