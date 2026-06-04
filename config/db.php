<?php

function getDB()
{
    static $db = null;

    if ($db === null) {

        try {

            $db = new PDO(
                "mysql:host=localhost;dbname=losttrack;charset=utf8",
                "root",
                ""
            );

            $db->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch(PDOException $e) {

            die($e->getMessage());

        }
    }

    return $db;
}