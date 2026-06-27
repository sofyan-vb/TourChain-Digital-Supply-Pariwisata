<?php
require_once __DIR__ . '/layouts/header.php';
?>

<!-- Hero Section with Animated Gradient -->
<section class="relative overflow-hidden py-32 text-center bg-gradient-to-br from-indigo-900 via-blue-800 to-purple-900 text-white rounded-b-[3rem] shadow-2xl mb-12">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6">
        <h1 class="text-6xl font-extrabold tracking-tight mb-8 bg-clip-text text-transparent bg-gradient-to-r from-blue-200 to-teal-200 drop-shadow-sm">
            Connecting Local Vendors <br/> to Global Tourism
        </h1>
        <p class="text-2xl text-blue-100/90 max-w-3xl mx-auto mb-12 font-light leading-relaxed">
            Platform B2B terintegrasi untuk rantai pasok pariwisata yang efisien, cerdas, dan berbasis data masa depan.
        </p>
        <div class="flex justify-center gap-6 mt-10">
            <a href="/login" class="group relative px-8 py-4 bg-white text-blue-900 rounded-full font-bold text-lg hover:scale-105 transition-all duration-300 shadow-[0_0_40px_rgba(255,255,255,0.3)] hover:shadow-[0_0_60px_rgba(255,255,255,0.5)]">
                Mulai Sekarang
                <span class="inline-block ml-2 group-hover:translate-x-1 transition-transform">→</span>
            </a>
            <a href="#fitur" class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full font-bold text-lg hover:bg-white/20 transition-all duration-300">
                Pelajari Fitur
            </a>
        </div>
    </div>
</section>

<!-- Features Section with Glassmorphism & Hover Effects -->
<section id="fitur" class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-10">
    
    <!-- Card 1 -->
    <div class="group relative bg-white p-8 rounded-3xl border border-slate-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-full mix-blend-multiply filter blur-2xl opacity-50 group-hover:bg-blue-200 transition-colors"></div>
        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200 mb-6 text-white">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-4">Manajemen Stok Cerdas</h3>
        <p class="text-slate-600 leading-relaxed">Monitor stok secara real-time. Dapatkan notifikasi dan peringatan otomatis ketika mencapai batas *safety stock*.</p>
    </div>

    <!-- Card 2 -->
    <div class="group relative bg-white p-8 rounded-3xl border border-slate-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-purple-100 rounded-full mix-blend-multiply filter blur-2xl opacity-50 group-hover:bg-purple-200 transition-colors"></div>
        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg shadow-purple-200 mb-6 text-white">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-4">Prediksi Permintaan AI</h3>
        <p class="text-slate-600 leading-relaxed">Algoritma otomatis mengoptimalkan pengadaan barang hotel & restoran berdasarkan tren kalender wisata.</p>
    </div>

    <!-- Card 3 -->
    <div class="group relative bg-white p-8 rounded-3xl border border-slate-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-teal-100 rounded-full mix-blend-multiply filter blur-2xl opacity-50 group-hover:bg-teal-200 transition-colors"></div>
        <div class="w-14 h-14 bg-gradient-to-br from-teal-400 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-teal-200 mb-6 text-white">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-4">Rantai Pasok Terintegrasi</h3>
        <p class="text-slate-600 leading-relaxed">Ekosistem finansial Escrow yang aman mengamankan aliran transaksi antara hotel, UMKM, dan penyedia logistik.</p>
    </div>

</section>

<?php
require_once __DIR__ . '/layouts/footer.php';
?>
