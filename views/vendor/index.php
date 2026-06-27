<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['peran'] !== 'Vendor') {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/../../controllers/ProductController.php';
$productController = new ProductController();
$products = $productController->listVendorProducts($_SESSION['user_id']);
$lowStockAlerts = $productController->checkLowStock($_SESSION['user_id']);

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg font-bold text-sm flex items-center shadow-sm">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Produk berhasil ditambahkan ke katalog B2B Anda!
        </div>
    <?php endif; ?>

    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-slate-900">Dashboard Vendor</h1>
        <a href="/vendor/produk/tambah" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">Tambah Produk</a>
    </div>

    <?php if (count($lowStockAlerts) > 0): ?>
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Peringatan Stok Menipis!</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            <?php foreach ($lowStockAlerts as $alert): ?>
                                <li><?= htmlspecialchars($alert['nama_produk']) ?> tersisa <?= $alert['stok'] ?> (Safety Stock: <?= $alert['safety_stock'] ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden sm:rounded-2xl mt-4">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="text-xl font-bold text-slate-800">Katalog Produk Anda</h3>
            <span class="text-sm font-medium text-slate-500"><?= count($products) ?> Total Item</span>
        </div>
        <div>
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Harga</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-50">
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $p): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-slate-900"><?= htmlspecialchars($p['nama_produk']) ?></td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-50 text-indigo-700">
                                        <?= htmlspecialchars($p['kategori']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <?php if($p['stok'] <= $p['safety_stock']): ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800">
                                            Kritis (Sisa <?= $p['stok'] ?>)
                                        </span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                            Aman (<?= $p['stok'] ?>)
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-slate-700">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-sm font-medium text-slate-400">Belum ada produk. Mulai tambahkan sekarang.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
