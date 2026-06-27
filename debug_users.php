<?php
require_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
$query = "SELECT * FROM users";
$stmt = $db->query($query);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($users);
?>
