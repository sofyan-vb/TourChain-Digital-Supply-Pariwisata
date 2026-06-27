-- Schema database SQLite untuk TourChain

-- Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id_user INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    peran TEXT CHECK(peran IN ('Hotel', 'Restoran', 'Vendor', 'Admin')) NOT NULL,
    created_at DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Produk/Layanan
CREATE TABLE IF NOT EXISTS produk_layanan (
    id_produk INTEGER PRIMARY KEY AUTOINCREMENT,
    id_user_vendor INTEGER,
    nama_produk TEXT NOT NULL,
    kategori TEXT CHECK(kategori IN ('Pangan', 'Souvenir', 'Transport')),
    stok INTEGER DEFAULT 0,
    safety_stock INTEGER DEFAULT 0,
    harga REAL NOT NULL,
    FOREIGN KEY (id_user_vendor) REFERENCES users(id_user)
);

-- Tabel Pesanan
CREATE TABLE IF NOT EXISTS pesanan (
    id_pesanan INTEGER PRIMARY KEY AUTOINCREMENT,
    id_user_pembeli INTEGER,
    tanggal_pesan TEXT DEFAULT CURRENT_TIMESTAMP,
    status_pesanan TEXT CHECK(status_pesanan IN ('Menunggu', 'Diproses', 'Dikirim', 'Selesai')) DEFAULT 'Menunggu',
    total_harga REAL NOT NULL,
    status_dana TEXT CHECK(status_dana IN ('Pending', 'Escrow', 'Cleared', 'Refunded')) DEFAULT 'Pending',
    FOREIGN KEY (id_user_pembeli) REFERENCES users(id_user)
);

-- Tabel Detail Pesanan
CREATE TABLE IF NOT EXISTS detail_pesanan (
    id_detail INTEGER PRIMARY KEY AUTOINCREMENT,
    id_pesanan INTEGER,
    id_produk INTEGER,
    jumlah_beli INTEGER NOT NULL,
    subtotal REAL NOT NULL,
    FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan),
    FOREIGN KEY (id_produk) REFERENCES produk_layanan(id_produk)
);

-- Tabel Pengiriman
CREATE TABLE IF NOT EXISTS pengiriman (
    id_pengiriman INTEGER PRIMARY KEY AUTOINCREMENT,
    id_pesanan INTEGER,
    kurir TEXT,
    resi TEXT,
    estimasi_tiba TEXT,
    status_kirim TEXT CHECK(status_kirim IN ('Dikemas', 'Dalam Perjalanan', 'Tiba')) DEFAULT 'Dikemas',
    FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan)
);

-- Tabel Kalender Pariwisata
CREATE TABLE IF NOT EXISTS kalender_pariwisata (
    id_event INTEGER PRIMARY KEY AUTOINCREMENT,
    nama_event TEXT NOT NULL,
    bulan INTEGER NOT NULL,
    skala TEXT CHECK(skala IN ('Besar', 'Sedang', 'Kecil')),
    multiplier REAL DEFAULT 1.0
);
