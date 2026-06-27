<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// Create default admin
$email = 'admin@tourchain.com';
$password = password_hash('password123', PASSWORD_DEFAULT);
$nama = 'Admin Sistem';
$peran = 'Admin';

$query = "INSERT INTO users (nama, email, password, peran) VALUES (:nama, :email, :password, :peran)";
$stmt = $db->prepare($query);
$stmt->execute([':nama' => $nama, ':email' => $email, ':password' => $password, ':peran' => $peran]);

echo "Admin user created: $email / password123";
?>
