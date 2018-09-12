<?php

namespace App\DataBase;

class PDOHandler
{
    private static $pdo;

    private function __construct()
    {
        $jsonContent = file_get_contents(__DIR__ . "/../../config/database.json");
        $database = json_decode($jsonContent);

        if (!isset($database) && !isset($username) && !isset($password) && !isset($host)) {
            throw new \RunTimeException("Database not good ");
        }

        self::$pdo = new \PDO("mysql:dbname="
            . $database->database
            . ";host=" . $database->host
            . ";charset=utf8",
            $database->username,
            $database->password,
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public static function getPDO()
    {
        if (!self::$pdo) {
            new self();
        }
        return self::$pdo;
    }
}