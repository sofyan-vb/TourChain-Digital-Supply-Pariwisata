<?php
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-3xl mx-auto mt-12 mb-16 relative">
    <!-- Decorative background glow -->
    <div class="absolute inset-0 bg-gradient-to-tr from-blue-400 via-indigo-300 to-purple-400 rounded-[2.5rem] blur-xl opacity-30 animate-pulse"></div>
    
    <div class="relative bg-white/90 backdrop-blur-xl p-10 rounded-[2.5rem] shadow-2xl border border-white/50">
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-100">
            <div>
                <h2 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-indigo-700">Tambah Komoditas Baru</h2>
                <p class="text-slate-500 mt-2 font-medium">Lengkapi detail produk atau layanan untuk B2B Katalog</p>
            </div>
            <a href="/vendor/dashboard" class="w-12 h-12 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </a>
        </div>

        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'error'): ?>
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg font-medium text-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Gagal menambahkan produk. Cek kembali data yang diinput.
            </div>
        <?php endif; ?>

        <form action="/vendor/produk/store" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Produk / Layanan</label>
                <input type="text" name="nama_produk" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none font-medium" placeholder="Contoh: Kopi Bubuk Arabika 1Kg">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Kategori</label>
                    <select name="kategori" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none appearance-none font-medium text-slate-700">
                        <option value="Pangan">Bahan Pangan (F&B)</option>
                        <option value="Souvenir">Souvenir & Oleh-Oleh</option>
                        <option value="Transport">Layanan Transportasi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Harga Jual (B2B)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold">Rp</span>
                        </div>
                        <input type="number" name="harga" required class="w-full pl-12 p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none font-bold text-slate-900" placeholder="0">
                    </div>
                </div>
            </div>

            <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-50">
                <h4 class="text-sm font-bold text-indigo-900 mb-4 flex items-center uppercase tracking-wide">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Manajemen Inventaris
                </h4>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Stok Tersedia</label>
                        <input type="number" name="stok" required class="w-full p-4 bg-white border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none font-bold" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Batas Safety Stock</label>
                        <input type="number" name="safety_stock" required class="w-full p-4 bg-white border border-slate-200 rounded-xl focus:ring-4 focus:ring-red-100 focus:border-red-400 transition-all outline-none font-bold text-red-600" placeholder="Minimal stok">
                    </div>
                </div>
                <p class="text-xs text-indigo-600/70 mt-3 font-medium">*Sistem akan mengirim peringatan jika stok mencapai batas Safety Stock.</p>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-4 rounded-xl font-bold text-lg hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all duration-300 mt-4 flex justify-center items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan ke Katalog
            </button>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
