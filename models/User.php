<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($nama, $email, $password, $peran) {
        $query = "INSERT INTO " . $this->table_name . " (nama, email, password, peran) VALUES (:nama, :email, :password, :peran)";
        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':peran', $peran);

        return $stmt->execute();
    }

    public function getByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
