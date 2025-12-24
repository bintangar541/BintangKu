# 🌟 BintangKu - Modern Game Top-Up Platform

**BintangKu** adalah platform top-up game digital yang dirancang untuk portofolio teknis, mendemonstrasikan integrasi antara *Backend* Laravel dan *Frontend* React dengan arsitektur yang terpisah (*Decoupled*).

> "BintangKu, Cemerlang Bersama Game-mu"

---

## 🚀 Fitur Utama

### 👤 Sisi Pengguna (Frontend)
* **Pencarian Instan:** Menemukan game favorit dengan hasil yang muncul secara real-time.
* **Form Dinamis:** Input field (User ID/Zone ID/Riot ID) otomatis berubah sesuai jenis game yang dipilih.
* **Kalkulasi Real-time:** Harga total dan biaya admin (QRIS, E-Wallet, VA) terhitung otomatis saat checkout.
* **Lacak Pesanan:** Cek status transaksi (UNPAID/PAID) hanya menggunakan nomor invoice.
* **Simulasi Bayar:** Tombol khusus untuk mencoba alur pembayaran sukses tanpa integrasi payment gateway asli.

### 🔐 Sisi Admin (Back-office)
* **Analytics Dashboard:** Grafik penjualan (Pie Chart) dan statistik transaksi terpopuler.
* **Manajemen Produk:** Fitur CRUD lengkap untuk Game dan Item Produk.
* **Financial Tracking:** Pengaturan Harga Modal vs Harga Jual untuk memantau profit.

---

## 🛠️ Tech Stack

### **Backend (API & Logic)**
* **Framework:** Laravel 9
* **Database:** PostgreSQL
* **Admin Panel:** AdminLTE 3
* **Auth:** Laravel Sanctum

### **Frontend (User Interface)**
* **Library:** React 19 + Vite
* **Styling:** Tailwind CSS 4
* **Routing:** React Router DOM 6
* **HTTP Client:** Axios

---

## 📸 Screenshots

### 🛡️ User Journey
<details>
  <summary>Lihat Screenshot Alur User</summary>
  
  **Beranda & Detail Game**
  <img src="https://github.com/user-attachments/assets/206fe3c3-eacd-4f69-b03b-c2aed3247471" width="100%" />
  <img src="https://github.com/user-attachments/assets/29da6884-9bb5-4239-b326-8703b3427b3a" width="100%" />
  
  **Checkout & Invoice**
  <img src="https://github.com/user-attachments/assets/e0e56498-c717-40fc-a7c7-b1efbbe20158" width="100%" />
  <img src="https://github.com/user-attachments/assets/9b345556-b2bd-4727-b433-d80c8a18993a" width="100%" />
</details>

### 🔐 Admin Panel
<details>
  <summary>Lihat Screenshot Alur Admin</summary>
  
  **Dashboard & Statistik**
  <img src="https://github.com/user-attachments/assets/0cc2e9a2-8d47-4f95-9b53-0a8fa3954c88" width="100%" />
  
  **Manajemen Produk**
  <img src="https://github.com/user-attachments/assets/221eff2f-d44d-4580-9b7f-67bce0fdc942" width="100%" />
</details>

---

## ⚙️ Instalasi Cepat

### **1. Backend**
```bash
cd topup-game-backend
composer install
cp .env.example .env # Sesuaikan DB_DATABASE ke PostgreSQL Anda
php artisan key:generate
php artisan migrate --seed
php artisan serve

. Frontend
Bash

cd topup-game-frontend
npm install
npm run dev
Made with ❤️ by Bintang Ardhian Pratama


### Keunggulan Format ini:
1.  **Scannable:** Menggunakan bullet points sehingga fitur mudah dibaca dalam hitungan detik.
2.  **Rapi:** Screenshot disembunyikan dalam `<details>`, sehingga tidak membuat halaman README terasa penuh sesak.
3.  **To the point:** Langsung menjelaskan Tech Stack dan Instalasi, hal yang paling dicari oleh Tech Recruiter.

**Saran Terakhir:** Di bagian **Description** (yang limit 350 karakter tadi), cukup tulis:
*"Platform top-up game & voucher digital berbasis Laravel 9 dan React 19. Dilengkapi fitur input dinamis, kalkulasi harga real-time, dan dashboard admin analytics."*
