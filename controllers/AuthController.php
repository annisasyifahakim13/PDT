<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = $this->userModel
                ->findByEmail($_POST['email']);

            if (
                $user &&
                password_verify(
                    $_POST['password'],
                    $user['password']
                )
            ) {

                $_SESSION['user'] = $user;
                redirect('index.php?page=reports');
            }

            $error = "Email atau Password salah";
        }

        require __DIR__ . '/../views/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->userModel->create($_POST);

            redirect('index.php?page=login');
        }

        require __DIR__ . '/../views/register.php';
    }

    public function logout()
    {
        session_destroy();

        redirect('index.php?page=login');
    }
}