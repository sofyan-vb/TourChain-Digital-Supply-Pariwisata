<?php

class Database {
    private $db_path = __DIR__ . '/../database/tourchain.sqlite';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("sqlite:" . $this->db_path);

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $this->conn->exec(
                "PRAGMA foreign_keys = ON;"
            );

        } catch (PDOException $exception) {
            echo "Koneksi Error: " .
                 $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
