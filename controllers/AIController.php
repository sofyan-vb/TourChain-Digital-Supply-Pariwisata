<?php
require_once __DIR__ . '/../config/database.php';

class AIController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getDemandPrediction() {
        $query = "SELECT * FROM kalender_pariwisata WHERE bulan = " . date('m');
        $stmt = $this->db->query($query);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        $multiplier = $event ? $event['multiplier'] : 1.0;
        
        // Simulating data: take avg sales from last month as baseline
        $baseline = 100; 
        return $baseline * $multiplier;
    }
}
