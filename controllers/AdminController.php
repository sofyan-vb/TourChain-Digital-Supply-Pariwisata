<?php
require_once __DIR__ . '/../config/database.php';

class AdminController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getDashboardStats() {
        $stats = [
            'total_users' => $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'total_orders' => $this->db->query("SELECT COUNT(*) FROM pesanan")->fetchColumn(),
            'total_revenue' => $this->db->query("SELECT SUM(total_harga) FROM pesanan WHERE status_dana = 'Cleared'")->fetchColumn()
        ];
        return $stats;
    }
}
