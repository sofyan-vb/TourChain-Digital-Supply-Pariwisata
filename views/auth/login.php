<?php
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-md mx-auto mt-16 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-3xl blur opacity-30 animate-pulse"></div>
    <div class="relative bg-white p-10 rounded-3xl shadow-2xl border border-white/50 backdrop-blur-sm">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">Selamat Datang</h2>
            <p class="text-slate-500 mt-2">Masuk ke ekosistem TourChain</p>
        </div>

        <?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg font-medium text-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Email atau Password salah!
            </div>
        <?php endif; ?>
        <?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg font-medium text-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Registrasi berhasil! Silakan login.
            </div>
        <?php endif; ?>
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'logout'): ?>
            <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-700 rounded-r-lg font-medium text-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Anda telah berhasil keluar (logout) dari sistem.
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none" placeholder="nama@email.com">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-blue-200 hover:-translate-y-0.5 transition-all duration-300">Masuk Sekarang</button>
        </form>
        <p class="mt-8 text-center text-sm text-slate-500 font-medium">
            Belum bergabung? <a href="/register" class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Daftar sebagai mitra</a>
        </p>
    </div>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
