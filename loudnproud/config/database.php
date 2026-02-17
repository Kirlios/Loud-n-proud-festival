<?php

class Database {

    public static function connect(): PDO {
        try {
            return new PDO(
                "mysql:host=localhost;dbname=loudnproud;charset=utf8mb4",
                "root",
                "",
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}
