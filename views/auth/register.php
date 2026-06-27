<?php
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-md mx-auto mt-12 relative mb-12">
    <div class="absolute inset-0 bg-gradient-to-r from-teal-400 to-blue-500 rounded-3xl blur opacity-30 animate-pulse"></div>
    <div class="relative bg-white p-10 rounded-3xl shadow-2xl border border-white/50 backdrop-blur-sm">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-teal-600 to-blue-600">Mulai Bermitra</h2>
            <p class="text-slate-500 mt-2">Buat akun untuk bergabung di rantai pasok.</p>
        </div>

        <?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg font-medium text-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Gagal mendaftar! Email mungkin sudah digunakan.
            </div>
        <?php endif; ?>

        <form action="/register" method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Bisnis / Individu</label>
                <input type="text" name="nama" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-teal-100 focus:border-teal-500 transition-all outline-none" placeholder="PT Sukses Pariwisata">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email Resmi</label>
                <input type="email" name="email" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-teal-100 focus:border-teal-500 transition-all outline-none" placeholder="info@bisnis.com">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Peran Akses</label>
                <select name="peran" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-teal-100 focus:border-teal-500 transition-all outline-none appearance-none">
                    <option value="Hotel">Hotel</option>
                    <option value="Restoran">Restoran</option>
                    <option value="Vendor">Vendor (UMKM/Supplier)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-teal-100 focus:border-teal-500 transition-all outline-none" placeholder="Buat kata sandi yang kuat">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-blue-600 text-white p-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-teal-200 hover:-translate-y-0.5 transition-all duration-300 mt-2">Daftar Akun Baru</button>
        </form>
        <p class="mt-8 text-center text-sm text-slate-500 font-medium">
            Sudah terdaftar? <a href="/login" class="text-teal-600 font-bold hover:text-teal-800 transition-colors">Login di sini</a>
        </p>
    </div>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
