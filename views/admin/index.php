<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['peran'] !== 'Admin') {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/../../controllers/DashboardController.php';
$dashboardController = new DashboardController();
$stats = $dashboardController->getAdminStats();

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Control Center Admin</h1>
        <p class="text-slate-500 mt-2">Monitoring ekosistem rantai pasok TourChain.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-sm border border-slate-100 p-6 relative overflow-hidden group hover:shadow-md transition">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-100 rounded-full opacity-50 group-hover:scale-110 transition"></div>
            <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider relative z-10">Total Pengguna</h3>
            <p class="text-4xl font-extrabold text-slate-900 mt-2 relative z-10"><?= $stats['total_users'] ?></p>
        </div>
        <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-sm border border-slate-100 p-6 relative overflow-hidden group hover:shadow-md transition">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-100 rounded-full opacity-50 group-hover:scale-110 transition"></div>
            <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider relative z-10">Katalog Komoditas</h3>
            <p class="text-4xl font-extrabold text-slate-900 mt-2 relative z-10"><?= $stats['total_produk'] ?></p>
        </div>
        <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-sm border border-slate-100 p-6 relative overflow-hidden group hover:shadow-md transition">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-100 rounded-full opacity-50 group-hover:scale-110 transition"></div>
            <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider relative z-10">Total Transaksi</h3>
            <p class="text-4xl font-extrabold text-slate-900 mt-2 relative z-10"><?= $stats['total_pesanan'] ?></p>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg p-6 relative overflow-hidden group hover:-translate-y-1 transition text-white">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/20 rounded-full opacity-50 group-hover:scale-110 transition"></div>
            <h3 class="text-green-50 text-sm font-bold uppercase tracking-wider relative z-10">Perputaran Dana</h3>
            <p class="text-3xl font-extrabold mt-2 relative z-10">Rp <?= number_format($stats['total_revenue'], 0, ',', '.') ?></p>
        </div>
    </div>

    <div class="bg-white shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden sm:rounded-2xl mt-8">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="text-xl font-bold text-slate-800">Manajemen Finansial & Clearing</h3>
            <span class="text-sm font-medium text-slate-500">Panel pencairan dana vendor</span>
        </div>
        
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'cleared'): ?>
            <div class="m-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg font-bold text-sm flex items-center shadow-sm">
                Dana berhasil dicairkan (Cleared) ke akun Vendor terkait.
            </div>
        <?php elseif(isset($_GET['msg']) && $_GET['msg'] == 'rejected'): ?>
            <div class="m-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-lg font-bold text-sm flex items-center shadow-sm">
                Transaksi dibatalkan. Dana otomatis di-Refund ke pihak Pembeli.
            </div>
        <?php endif; ?>

        <div>
            <?php
            require_once __DIR__ . '/../../models/Pesanan.php';
            $pesananModel = new Pesanan();
            $orders = $pesananModel->getAllOrders();
            ?>
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">ID / Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Pembeli</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pembayaran</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Dana (Escrow)</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi Admin</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-50">
                    <?php if (count($orders) > 0): ?>
                        <?php foreach ($orders as $o): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm font-bold text-slate-900">#ORD-<?= str_pad($o['id_pesanan'], 4, '0', STR_PAD_LEFT) ?></div>
                                    <div class="text-xs text-slate-500"><?= $o['tanggal_pesan'] ?></div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-700"><?= htmlspecialchars($o['nama_pembeli']) ?></td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-indigo-700">Rp <?= number_format($o['total_harga'], 0, ',', '.') ?></td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <?php if($o['status_dana'] == 'Pending'): ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-amber-100 text-amber-800">Pending</span>
                                    <?php elseif($o['status_dana'] == 'Escrow'): ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800">In Escrow</span>
                                    <?php elseif($o['status_dana'] == 'Cleared'): ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-emerald-100 text-emerald-800">Cleared</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                    <?php if($o['status_dana'] == 'Pending' || $o['status_dana'] == 'Escrow'): ?>
                                        <div class="flex justify-end gap-2">
                                            <form action="/admin/order/clear" method="POST" class="inline">
                                                <input type="hidden" name="id_pesanan" value="<?= $o['id_pesanan'] ?>">
                                                <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg font-bold text-xs hover:bg-emerald-600 transition shadow-sm">
                                                    Cairkan Dana
                                                </button>
                                            </form>
                                            <form action="/admin/order/reject" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi dan merefund dana?');">
                                                <input type="hidden" name="id_pesanan" value="<?= $o['id_pesanan'] ?>">
                                                <button type="submit" class="bg-rose-50 border border-rose-200 text-rose-600 px-3 py-2 rounded-lg font-bold text-xs hover:bg-rose-500 hover:text-white transition shadow-sm">
                                                    Tolak & Refund
                                                </button>
                                            </form>
                                        </div>
                                    <?php elseif($o['status_dana'] == 'Refunded'): ?>
                                        <span class="text-rose-500 font-bold text-xs px-3 py-1 bg-rose-50 rounded-full">Dibatalkan</span>
                                    <?php else: ?>
                                        <span class="text-slate-400 text-xs italic font-semibold">Telah Diselesaikan</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm font-medium text-slate-400">Belum ada transaksi di platform.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
