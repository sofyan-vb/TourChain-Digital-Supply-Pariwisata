<?php
require_once __DIR__ . '/../models/ProdukLayanan.php';

class ProductController {
    private $produkModel;

    public function __construct() {
        $this->produkModel = new ProdukLayanan();
    }

    public function store() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['peran'] !== 'Vendor') {
            header("Location: /views/auth/login.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user_vendor = $_SESSION['user_id'];
            $nama_produk = $_POST['nama_produk'] ?? '';
            $kategori = $_POST['kategori'] ?? '';
            $stok = (int)($_POST['stok'] ?? 0);
            $safety_stock = (int)($_POST['safety_stock'] ?? 0);
            $harga = (float)($_POST['harga'] ?? 0);

            if($this->produkModel->create($id_user_vendor, $nama_produk, $kategori, $stok, $safety_stock, $harga)) {
                header("Location: /views/vendor/index.php?msg=success");
            } else {
                header("Location: /views/vendor/tambah_produk.php?msg=error");
            }
        }
    }

    public function listVendorProducts($id_vendor) {
        return $this->produkModel->getByVendor($id_vendor);
    }

    public function listAllProducts() {
        return $this->produkModel->getAll();
    }

    public function checkLowStock($id_vendor) {
        return $this->produkModel->getLowStockAlerts($id_vendor);
    }
}
?>
