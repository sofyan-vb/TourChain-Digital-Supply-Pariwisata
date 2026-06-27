<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$sql = file_get_contents('database/schema.sql');
$db->exec($sql);

echo "Database initialized successfully.";
?>
