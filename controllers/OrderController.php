<?php
require_once __DIR__ . '/../models/Pesanan.php';

class OrderController {
    private $pesananModel;

    public function __construct() {
        $this->pesananModel = new Pesanan();
    }

    public function checkout() {
        session_start();
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['peran'], ['Hotel', 'Restoran'])) {
            header("Location: /login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pembeli = $_SESSION['user_id'];
            $items_post = $_POST['items'] ?? [];
            
            $items_to_order = [];
            $total_harga = 0;

            foreach ($items_post as $id_produk => $jumlah) {
                if ((int)$jumlah > 0) {
                    $harga = $_POST['harga_' . $id_produk];
                    $items_to_order[] = [
                        'id_produk' => $id_produk,
                        'jumlah' => $jumlah,
                        'harga' => $harga
                    ];
                    $total_harga += ($harga * $jumlah);
                }
            }

            if (!empty($items_to_order) && $total_harga > 0) {
                if ($this->pesananModel->createOrder($id_pembeli, $total_harga, $items_to_order)) {
                    header("Location: /pembeli/dashboard?msg=checkout_success");
                } else {
                    header("Location: /pembeli/dashboard?msg=error");
                }
            } else {
                header("Location: /pembeli/dashboard?msg=empty");
            }
        }
    }

    public function processPayment($id_pesanan) {
        $this->pesananModel->updateStatusDana($id_pesanan, 'Escrow');
        $this->pesananModel->updateStatus($id_pesanan, 'Diproses');
    }

    public function completeOrder($id_pesanan) {
        $this->pesananModel->updateStatus($id_pesanan, 'Selesai');
    }

    public function clearFunds() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['peran'] !== 'Admin') {
            header("Location: /login");
            exit();
        }
        
        if (isset($_POST['id_pesanan'])) {
            $id_pesanan = $_POST['id_pesanan'];
            $this->pesananModel->updateStatusDana($id_pesanan, 'Cleared');
            header("Location: /admin/dashboard?msg=cleared");
            exit();
        }
    }

    public function rejectFunds() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['peran'] !== 'Admin') {
            header("Location: /login");
            exit();
        }
        
        if (isset($_POST['id_pesanan'])) {
            $id_pesanan = $_POST['id_pesanan'];
            $this->pesananModel->updateStatusDana($id_pesanan, 'Refunded');
            $this->pesananModel->updateStatus($id_pesanan, 'Dibatalkan');
            header("Location: /admin/dashboard?msg=rejected");
            exit();
        }
    }
}
?>
