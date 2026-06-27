<?php
require_once __DIR__ . '/../config/database.php';

class DashboardController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // AI Demand Predictor Logic
    public function getDemandPrediction($kategori = null) {
        $bulan_sekarang = date('n'); // 1-12
        
        $query = "SELECT * FROM kalender_pariwisata WHERE bulan = :bulan";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':bulan', $bulan_sekarang);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $multiplier = 1.0; // Default

        foreach ($events as $event) {
            if ($event['skala'] === 'Besar') {
                $multiplier = max($multiplier, 1.5);
            } elseif ($event['skala'] === 'Sedang') {
                $multiplier = max($multiplier, 1.2);
            }
        }

        // Simulasi rata-rata pesanan bulan lalu
        // Ini hardcode untuk simulasi prototype. Di realita, query SUM/AVG dari pesanan bulan lalu.
        $rataPesananBulanLalu = 100; 

        $prediksi = $rataPesananBulanLalu * $multiplier;
        $saranBelanja = $prediksi * 1.2;

        return [
            'bulan' => $bulan_sekarang,
            'event_aktif' => count($events),
            'multiplier' => $multiplier,
            'prediksi_kebutuhan' => $prediksi,
            'saran_stok' => $saranBelanja
        ];
    }

    public function getAdminStats() {
        $stats = [];
        // Total Users
        $stmt = $this->db->query("SELECT count(*) as total FROM users");
        $stats['total_users'] = $stmt->fetch()['total'] ?? 0;
        
        // Total Products
        $stmt = $this->db->query("SELECT count(*) as total FROM produk_layanan");
        $stats['total_produk'] = $stmt->fetch()['total'] ?? 0;
        
        // Total Orders
        $stmt = $this->db->query("SELECT count(*) as total, SUM(total_harga) as revenue FROM pesanan");
        $orderStats = $stmt->fetch();
        $stats['total_pesanan'] = $orderStats['total'] ?? 0;
        $stats['total_revenue'] = $orderStats['revenue'] ?? 0;

        return $stats;
    }
}
?>
