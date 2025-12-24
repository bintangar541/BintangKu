🌟 BintangKu - Modern Game Top-Up Platform
BintangKu adalah platform top-up game modern yang dirancang untuk mensimulasikan ekosistem transaksi digital secara real-time. Proyek ini mendemonstrasikan integrasi antara backend yang kuat menggunakan Laravel dan frontend reaktif berbasis React 19.

"BintangKu, Cemerlang Bersama Game-mu"

🚀 Fitur Utama
Sisi Pengguna (Frontend)
Pencarian & Filter Cepat: Temukan game favorit melalui search bar dan filter kategori (Mobile, PC, Voucher) secara instan.

Form Input Dinamis: Validasi input yang cerdas, menyesuaikan kebutuhan tiap game (User ID, Zone ID, atau Riot ID).

Kalkulasi Real-time: Perhitungan otomatis harga total dan biaya admin (QRIS, E-Wallet, VA) sebelum melakukan pembayaran.

Lacak Pesanan: Cek status transaksi (UNPAID/PAID) secara real-time via kode invoice tanpa perlu login.

Simulasi Pembayaran: Fitur khusus untuk mendemonstrasikan perubahan status transaksi otomatis di lingkungan pengembangan.

Sisi Admin (Back-office)
Dashboard Analytics: Visualisasi data transaksi melalui grafik Pie Chart dan tabel leaderboard game terlaris.

Manajemen Konten (CMS): Sistem CRUD lengkap untuk pengelolaan data game, kategori, dan unggah aset gambar.

Financial Tracking: Fitur penetapan Harga Modal vs Harga Jual untuk pemantauan profitabilitas otomatis.

Inventory Control: Manajemen stok produk dan pengaturan nominal item secara fleksibel.

🛠️ Tech Stack
Backend (API & Logic)
Framework: Laravel 9 (PHP)

Database: PostgreSQL

Admin Panel: AdminLTE 3

Auth: Laravel Sanctum (API) & Laravel UI

Frontend (User Interface)
Library: React 19

Build Tool: Vite

Styling: Tailwind CSS 4

Routing: React Router DOM 6

HTTP Client: Axios

📦 Cara Instalasi (Deployment Guide)
Prasyarat
Pastikan Anda sudah menginstal: PHP >= 8.0, Composer, Node.js & NPM, dan PostgreSQL.

1. Clone Repository
Bash

git clone https://github.com/bintangar541/BintangKu.git
cd BintangKu
2. Setup Backend (Laravel)
Bash

cd topup-game-backend
composer install
cp .env.example .env
Sesuaikan konfigurasi DB di file .env (DB_CONNECTION=pgsql, dll).

Bash

php artisan key:generate
php artisan migrate:refresh --seed
php artisan serve
Backend berjalan di http://localhost:8000

3. Setup Frontend (React)
Bash

cd ../topup-game-frontend
npm install
npm run dev
Frontend berjalan di http://localhost:5173

👤 Akses Admin
Untuk mengakses Admin Dashboard (http://localhost:8000/admin):

Buka http://localhost:8000/register.

Daftarkan akun baru.

Setelah login, sistem akan otomatis mengarahkan Anda ke dashboard manajemen.

💳 Transparansi Biaya Admin (Simulasi)
QRIS: Flat Rp 1.000

E-Wallets: Flat Rp 2.000

Virtual Account: Persentase sesuai ketentuan bank

📸 Screenshots
### 🛡️ User Journey (Sisi Pengguna)
Alur transaksi yang mulus mulai dari pencarian game hingga halaman konfirmasi pembayaran.
<img width="1913" height="997" alt="image" src="https://github.com/user-attachments/assets/206fe3c3-eacd-4f69-b03b-c2aed3247471" />
<img width="1917" height="1000" alt="image" src="https://github.com/user-attachments/assets/29da6884-9bb5-4239-b326-8703b3427b3a" />
<img width="1909" height="998" alt="image" src="https://github.com/user-attachments/assets/e0e56498-c717-40fc-a7c7-b1efbbe20158" />
<img width="1916" height="999" alt="image" src="https://github.com/user-attachments/assets/edee2ef8-e238-409f-80fa-072f10de2d15" />
<img width="1913" height="1001" alt="image" src="https://github.com/user-attachments/assets/9b345556-b2bd-4727-b433-d80c8a18993a" />
<img width="1919" height="999" alt="image" src="https://github.com/user-attachments/assets/15009b7b-651d-4213-aa89-a9da89a8f93e" />

### 🔐 Admin Experience (Sisi Admin)
Dashboard manajemen operasional untuk mengelola database game dan memantau performa penjualan.
<img width="1916" height="998" alt="image" src="https://github.com/user-attachments/assets/0cc2e9a2-8d47-4f95-9b53-0a8fa3954c88" />
<img width="1916" height="998" alt="image" src="https://github.com/user-attachments/assets/39686841-d5ea-4f21-b192-68693ad9a1c7" />
<img width="1916" height="1007" alt="image" src="https://github.com/user-attachments/assets/221eff2f-d44d-4580-9b7f-67bce0fdc942" />
<img width="1912" height="1002" alt="image" src="https://github.com/user-attachments/assets/50ecd447-faa7-45d9-871a-73395fd7b25c" />








Note: Proyek ini dikembangkan sepenuhnya untuk keperluan portofolio teknis.

Made with ❤️ by Bintang Ardhian Pratama
