<?php

require_once __DIR__.'/../models/PenemuanModel.php';

class PenemuanController
{
    private $model;

    public function __construct()
    {
        $this->model = new PenemuanModel();
    }

    public function simpan()
    {
        $reportId = $_POST['report_id'];

        $userId = $_SESSION['user']['id'];

        $this->model->create(
            $reportId,
            $userId
        );

        header('Location:index.php?page=saluran_barang');
        exit;
    }
    
}