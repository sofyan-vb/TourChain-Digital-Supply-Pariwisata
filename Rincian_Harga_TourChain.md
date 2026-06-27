# Rincian Estimasi Valuasi Project TourChain
**Konteks Project:** Tugas Akhir Semester (UAS) / Prototype Skala Mahasiswa
**Teknologi:** PHP Native (MVC Architecture), SQLite, Tailwind CSS

Proyek ini menggunakan pola arsitektur MVC (Model-View-Controller) murni untuk memenuhi requirement teknis pembelajaran pengembangan perangkat lunak berskala tugas akhir.

Berikut adalah rincian estimasi biaya (*costing*) yang disesuaikan untuk skala pengerjaan proyek tingkat universitas:

| Modul & Fitur | Deskripsi | Estimasi Nilai (IDR) |
| :--- | :--- | :--- |
| **1. Arsitektur Inti & Database** | | **Rp 55.000** |
| - Setup MVC & Custom Router | Pembuatan *Front-controller* (`index.php`) dan struktur OOP | Rp 30.000 |
| - Database Design & Koneksi | Skema relasional SQLite & pengamanan koneksi basis PDO | Rp 25.000 |
| **2. Sistem Autentikasi (Multi-Role)** | | **Rp 45.000** |
| - Login & Registrasi | Pembuatan formulir & enkripsi password (*Bcrypt*) | Rp 20.000 |
| - Manajemen Session | Pemisahan tata letak (Admin, Vendor, Pembeli) | Rp 25.000 |
| **3. Modul Vendor (Manajemen Inventaris)**| | **Rp 50.000** |
| - CRUD Produk B2B | Pengelolaan katalog komoditas dari sisi penjual | Rp 25.000 |
| - Logic Safety Stock | Deteksi & peringatan saat stok mendekati minimum | Rp 25.000 |
| **4. Modul Pembeli (E-Procurement)** | | **Rp 55.000** |
| - Katalog & Form Pemesanan | Etalase digital B2B dan kalkulasi total keranjang | Rp 25.000 |
| - Checkout System | Penyimpanan *Order* ke dalam *Database Transaction* | Rp 30.000 |
| **5. Modul Admin (Finansial & Clearing)**| | **Rp 50.000** |
| - Dashboard Statistik | Agregasi data komoditas, pengguna, dan transaksi | Rp 20.000 |
| - Sistem Escrow & Clearing | Panel penahanan dana, *Clear*, serta opsi *Refund* | Rp 30.000 |
| **6. Front-End UI/UX Design** | | **Rp 45.000** |
| - Integrasi Tailwind CSS | Penataan antarmuka modern dan *Layouting* responsif | Rp 25.000 |
| - Error Handling & UX | Pembuatan notifikasi interaktif (*Success / Error*) | Rp 20.000 |
| | | |
| **TOTAL ESTIMASI BIAYA** | | **Rp 300.000** |

---
**Catatan:**
Estimasi di atas difokuskan murni pada *logic implementation* skala MVP untuk evaluasi akademis. Nominal dihitung dengan asumsi *rate* mahasiswa tanpa perhitungan lisensi perangkat lunak tambahan, biaya *hosting*, atau dukungan operasional tingkat produksi.
