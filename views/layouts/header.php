<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TourChain - Supply Chain Pariwisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-200/50 shadow-sm transition-all">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-200 group-hover:scale-105 transition-transform">
                    T
                </div>
                <span class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-indigo-800 tracking-tight">TourChain</span>
            </a>
            <div class="flex items-center gap-6">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="hidden md:flex flex-col text-right mr-2">
                        <span class="text-slate-900 font-bold text-sm leading-tight"><?= htmlspecialchars($_SESSION['nama']) ?></span>
                        <span class="text-blue-600 font-semibold text-xs bg-blue-50 px-2 py-0.5 rounded-full inline-block mt-1 w-max ml-auto"><?= $_SESSION['peran'] ?></span>
                    </div>
                    
                    <?php 
                        $dashUrl = '/';
                        if($_SESSION['peran'] === 'Admin') $dashUrl = '/admin/dashboard';
                        if($_SESSION['peran'] === 'Vendor') $dashUrl = '/vendor/dashboard';
                        if(in_array($_SESSION['peran'], ['Hotel', 'Restoran'])) $dashUrl = '/pembeli/dashboard';
                    ?>
                    <a href="<?= $dashUrl ?>" class="text-slate-600 hover:text-blue-600 font-bold transition-colors">Dashboard</a>
                    <a href="/logout" class="bg-rose-50 border border-rose-100 text-rose-600 px-5 py-2 rounded-xl hover:bg-rose-600 hover:text-white hover:shadow-lg hover:shadow-rose-200 transition-all font-bold text-sm">Logout</a>
                <?php else: ?>
                    <a href="/" class="text-slate-500 hover:text-blue-600 font-bold transition-colors">Beranda</a>
                    <a href="/login" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg hover:shadow-blue-300 hover:-translate-y-0.5 transition-all font-bold text-sm">Masuk / Daftar</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main class="min-h-screen">
