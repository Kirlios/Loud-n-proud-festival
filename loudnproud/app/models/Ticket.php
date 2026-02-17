<?php
require_once __DIR__ . '/../../config/database.php';

class Ticket {

    public static function all(): array {
        $db = Database::connect();
        return $db->query("SELECT * FROM tickets ORDER BY price ASC")->fetchAll();
    }
}
