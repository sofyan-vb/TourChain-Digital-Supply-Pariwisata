# Panduan Menjalankan Aplikasi TourChain

Dokumen ini berisi panduan langkah demi langkah tentang apa saja yang perlu dipersiapkan dan bagaimana cara menjalankan aplikasi TourChain di komputer lokal Anda.

## 1. Persiapan Sistem (Prerequisites)

Sebelum menjalankan aplikasi, pastikan perangkat lunak berikut sudah terinstal di sistem Anda:

- **PHP** (Minimal versi 7.4, direkomendasikan PHP 8.x)
- Ekstensi PHP SQLite yang aktif. Pastikan ekstensi berikut tidak di-comment (tanpa tanda `;`) di file `php.ini` Anda:
  - `extension=pdo_sqlite`
  - `extension=sqlite3`
- (Opsional) **DB Browser for SQLite** - Aplikasi GUI untuk melihat dan memanajemen isi database secara langsung.

## 2. Cara Menjalankan Aplikasi

Ikuti langkah-langkah berikut secara berurutan di dalam terminal Anda:

### Langkah 1: Inisialisasi dan Seeding Database
Aplikasi ini menggunakan database SQLite yang sangat ringan dan berbasis file. Sebelum aplikasi bisa digunakan, Anda perlu membuat struktur tabel dan mengisi data pengguna awal.

Buka terminal pada direktori root proyek ini, lalu jalankan perintah seeding (berdasarkan file `seed_user.php` atau inisialisasi SQL yang tersedia):
```bash
php seed_user.php
```
*(Catatan: Anda juga bisa menggunakan file `schema.sql` dan `seed.sql` jika diperlukan, misal: `sqlite3 database.sqlite < schema.sql`)*

### Langkah 2: Menjalankan Server Lokal (PHP Built-in Server)
Karena ini adalah aplikasi PHP Native, Anda tidak perlu repot mengatur Apache/XAMPP. Anda bisa memanfaatkan server bawaan dari PHP.

Di direktori root aplikasi, jalankan perintah:
```bash
php -S localhost:8000
```

### Langkah 3: Mengakses Aplikasi di Browser
Buka web browser favorit Anda (Chrome, Firefox, Safari, dll) dan masukkan alamat berikut:
👉 **[http://localhost:8000](http://localhost:8000)**

## 3. Informasi Login Default
Setelah aplikasi terbuka, Anda dapat login menggunakan akun yang telah di-generate saat proses seeding.

Jika Anda perlu melihat atau melakukan debug daftar pengguna, Anda bisa membuka file:
👉 **[http://localhost:8000/debug_users.php](http://localhost:8000/debug_users.php)** 

## 4. Troubleshooting Umum
- **Gagal Terhubung ke Database:** Cek file `config/database.php` dan pastikan path ke file database `.sqlite` (atau `.db`) sudah benar. Pastikan juga folder proyek memiliki izin (permissions) yang cukup untuk membaca dan menulis file database tersebut.
- **Tampilan CSS Berantakan:** Aplikasi ini menggunakan Tailwind CSS. Pastikan Anda terkoneksi internet agar CDN Tailwind termuat, atau jika menggunakan kompilasi lokal, pastikan file CSS sudah di-build.
