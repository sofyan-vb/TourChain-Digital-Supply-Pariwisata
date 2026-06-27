<?php
session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['peran'], ['Hotel', 'Restoran'])) {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/../../controllers/ProductController.php';
require_once __DIR__ . '/../../controllers/DashboardController.php';
require_once __DIR__ . '/../../controllers/OrderController.php';

$productController = new ProductController();
$dashboardController = new DashboardController();

$products = $productController->listAllProducts();
$aiPrediction = $dashboardController->getDemandPrediction();

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <?php if(isset($_GET['msg'])): ?>
        <?php if($_GET['msg'] == 'checkout_success'): ?>
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg font-bold text-sm flex items-center shadow-sm">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Pesanan berhasil dibuat! Dana Anda ditahan dalam sistem Escrow sampai barang diterima.
            </div>
        <?php elseif($_GET['msg'] == 'error'): ?>
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg font-bold text-sm flex items-center shadow-sm">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Terjadi kesalahan saat memproses pesanan.
            </div>
        <?php elseif($_GET['msg'] == 'empty'): ?>
            <div class="mb-6 p-4 bg-amber-50 border-l-4 border-amber-500 text-amber-700 rounded-r-lg font-bold text-sm flex items-center shadow-sm">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Anda belum mengisi jumlah pesanan pada produk manapun.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Dashboard Pembeli (<?= $_SESSION['peran'] ?>)</h1>
    </div>

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-6 mb-8 text-white">
        <h2 class="text-xl font-bold mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            AI Demand Predictor
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/10 rounded-lg p-4">
                <p class="text-blue-100 text-sm">Event Bulan Ini</p>
                <p class="text-2xl font-bold"><?= $aiPrediction['event_aktif'] ?> Event Aktif</p>
            </div>
            <div class="bg-white/10 rounded-lg p-4">
                <p class="text-blue-100 text-sm">Tren Permintaan</p>
                <p class="text-2xl font-bold"><?= $aiPrediction['multiplier'] ?>x Normal</p>
            </div>
            <div class="bg-white/10 rounded-lg p-4">
                <p class="text-blue-100 text-sm">Saran Peningkatan Stok</p>
                <p class="text-2xl font-bold">Naikkan <?= ($aiPrediction['multiplier'] - 1) * 100 ?>%</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-slate-900">Katalog Suplai B2B</h3>
        </div>
        <div class="border-t border-slate-200 p-6 bg-slate-50">
            <form action="/pembeli/checkout" method="POST">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <?php foreach ($products as $p): ?>
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div>
                                <div class="flex justify-between items-start mb-3">
                                    <span class="text-xs font-bold text-indigo-700 bg-indigo-50 px-3 py-1 rounded-full"><?= htmlspecialchars($p['kategori']) ?></span>
                                    <?php if ($p['stok'] > 0): ?>
                                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-1 rounded-md">Stok: <?= $p['stok'] ?></span>
                                    <?php else: ?>
                                        <span class="text-xs font-bold text-red-700 bg-red-50 px-2 py-1 rounded-md">Habis</span>
                                    <?php endif; ?>
                                </div>
                                <h4 class="text-xl font-extrabold text-slate-800 mb-1"><?= htmlspecialchars($p['nama_produk']) ?></h4>
                                <p class="text-sm text-slate-500 font-medium mb-4 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    <?= htmlspecialchars($p['nama_vendor']) ?>
                                </p>
                                <p class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                            </div>
                            <?php if ($p['stok'] > 0): ?>
                                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                    <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Jumlah Order</label>
                                    <input type="number" name="items[<?= $p['id_produk'] ?>]" min="0" max="<?= $p['stok'] ?>" class="w-full border-slate-200 rounded-lg p-3 text-center font-bold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-inner" placeholder="0">
                                    <input type="hidden" name="harga_<?= $p['id_produk'] ?>" value="<?= $p['harga'] ?>">
                                </div>
                            <?php else: ?>
                                <div class="bg-red-50 p-3 rounded-xl border border-red-100 text-center">
                                    <p class="text-red-500 font-bold">Tidak Tersedia</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if (count($products) > 0): ?>
                <div class="mt-10 flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-emerald-200 hover:-translate-y-1 transition-all duration-300">
                        Proses Checkout Pembelian
                    </button>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
