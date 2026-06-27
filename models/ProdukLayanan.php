<?php
require_once __DIR__ . '/../config/database.php';

class ProdukLayanan {
    private $conn;
    private $table_name = "produk_layanan";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($id_user_vendor, $nama_produk, $kategori, $stok, $safety_stock, $harga) {
        $query = "INSERT INTO " . $this->table_name . " (id_user_vendor, nama_produk, kategori, stok, safety_stock, harga) VALUES (:id_user_vendor, :nama_produk, :kategori, :stok, :safety_stock, :harga)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_user_vendor', $id_user_vendor);
        $stmt->bindParam(':nama_produk', $nama_produk);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':safety_stock', $safety_stock);
        $stmt->bindParam(':harga', $harga);

        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT p.*, u.nama as nama_vendor FROM " . $this->table_name . " p LEFT JOIN users u ON p.id_user_vendor = u.id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByVendor($id_user_vendor) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user_vendor = :id_user_vendor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user_vendor', $id_user_vendor);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStok($id_produk, $jumlah) {
        $query = "UPDATE " . $this->table_name . " SET stok = :stok WHERE id_produk = :id_produk";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':stok', $jumlah);
        $stmt->bindParam(':id_produk', $id_produk);
        return $stmt->execute();
    }

    public function getLowStockAlerts($id_user_vendor) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user_vendor = :id_user_vendor AND stok <= safety_stock";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user_vendor', $id_user_vendor);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
