<?php

session_start();

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helper.php';

$page = $_GET['page'] ?? 'login';

switch ($page) {

    case 'login':
        require_once __DIR__ . '/controllers/AuthController.php';
        (new AuthController())->login();
        break;

    case 'register':
        require_once __DIR__ . '/controllers/AuthController.php';
        (new AuthController())->register();
        break;

    case 'logout':
        require_once __DIR__ . '/controllers/AuthController.php';
        (new AuthController())->logout();
        break;

    case 'reports':
        require_once __DIR__ . '/controllers/ReportController.php';
        (new ReportController())->index();
        break;

    case 'create_report':
        require_once __DIR__ . '/controllers/ReportController.php';
        (new ReportController())->create();
        break;

    case 'update_status':
        require_once __DIR__ . '/controllers/ReportController.php';
        (new ReportController())->updateStatus();
        break;

    case 'aduan_saya':
        require_once __DIR__ . '/controllers/ReportController.php';
        (new ReportController())->aduanSaya();
        break;

    case 'history':
        require_once __DIR__ . '/controllers/ReportController.php';
        (new ReportController())->history();
        break;

    case 'backup':
        require 'views/admin/backup_list.php';
        break;

    default:
        header('Location: index.php?page=login');
        exit;
}