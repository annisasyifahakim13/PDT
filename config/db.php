<?php

function getDB()
{
    static $db = null;

    if ($db === null) {

        try {

           $db = new PDO(
    "mysql:host=localhost;dbname=losttrack;charset=utf8",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND =>
            "SET innodb_lock_wait_timeout=10"
    ]
);

        } catch(PDOException $e) {

            die($e->getMessage());

        }
    }

    return $db;
}