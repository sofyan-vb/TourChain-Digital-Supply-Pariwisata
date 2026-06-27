<?php
require_once __DIR__ . '/../config/database.php';

class Pesanan {
    private $conn;
    private $table_pesanan = "pesanan";
    private $table_detail = "detail_pesanan";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createOrder($id_user_pembeli, $total_harga, $items) {
        try {
            $this->conn->beginTransaction();

            // Insert Pesanan
            $query = "INSERT INTO " . $this->table_pesanan . " (id_user_pembeli, status_pesanan, total_harga, status_dana) VALUES (:id_pembeli, 'Menunggu', :total_harga, 'Pending')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_pembeli', $id_user_pembeli);
            $stmt->bindParam(':total_harga', $total_harga);
            $stmt->execute();
            $id_pesanan = $this->conn->lastInsertId();

            // Insert Detail Pesanan
            $queryDetail = "INSERT INTO " . $this->table_detail . " (id_pesanan, id_produk, jumlah_beli, subtotal) VALUES (:id_pesanan, :id_produk, :jumlah_beli, :subtotal)";
            $stmtDetail = $this->conn->prepare($queryDetail);

            foreach ($items as $item) {
                $stmtDetail->bindParam(':id_pesanan', $id_pesanan);
                $stmtDetail->bindParam(':id_produk', $item['id_produk']);
                $stmtDetail->bindParam(':jumlah_beli', $item['jumlah']);
                $subtotal = $item['harga'] * $item['jumlah'];
                $stmtDetail->bindParam(':subtotal', $subtotal);
                $stmtDetail->execute();

                // Kurangi stok (bisa dipisah di service/controller lain, tapi sementara di sini)
                $this->conn->exec("UPDATE produk_layanan SET stok = stok - " . (int)$item['jumlah'] . " WHERE id_produk = " . (int)$item['id_produk']);
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getOrdersByPembeli($id_pembeli) {
        $query = "SELECT * FROM " . $this->table_pesanan . " WHERE id_user_pembeli = :id_pembeli ORDER BY tanggal_pesan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pembeli', $id_pembeli);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id_pesanan, $status) {
        $query = "UPDATE " . $this->table_pesanan . " SET status_pesanan = :status WHERE id_pesanan = :id_pesanan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_pesanan', $id_pesanan);
        return $stmt->execute();
    }

    public function updateStatusDana($id_pesanan, $status_dana) {
        $query = "UPDATE " . $this->table_pesanan . " SET status_dana = :status_dana WHERE id_pesanan = :id_pesanan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status_dana', $status_dana);
        $stmt->bindParam(':id_pesanan', $id_pesanan);
        return $stmt->execute();
    }
    public function getAllOrders() {
        $query = "SELECT p.*, u.nama as nama_pembeli FROM " . $this->table_pesanan . " p 
                  LEFT JOIN users u ON p.id_user_pembeli = u.id_user 
                  ORDER BY p.tanggal_pesan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
