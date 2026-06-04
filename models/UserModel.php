<?php

require_once __DIR__ . '/../config/db.php';

class UserModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = getDB();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO users
            (nama,email,password)
            VALUES (?,?,?)
        ");

        return $stmt->execute([
            $data['nama'],
            $data['email'],
            password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            )
        ]);
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM users
            WHERE email=?
        ");

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}