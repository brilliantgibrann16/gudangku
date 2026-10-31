# GudangKu - Sistem Manajemen Inventaris Gudang

Aplikasi web full-stack berbasis Laravel + MySQL untuk mengelola inventaris gudang: kategori, supplier, produk, dan pergerakan stok (masuk/keluar), dengan autentikasi dan kontrol akses berbasis peran (admin/staff).

## Tech Stack
- PHP 8.3, Laravel 13
- MySQL 8.0
- Blade + Tailwind CSS (via CDN)
- Clever Cloud (deployment)

## Fitur
- Autentikasi: registrasi, login, logout, remember me
- Dashboard: total produk, produk stok rendah, total pergerakan stok, 10 pergerakan terbaru
- CRUD Kategori (admin)
- CRUD Supplier (admin)
- CRUD Produk dengan pencarian & filter kategori + indikator stok rendah (admin)
- Pencatatan pergerakan stok masuk/keluar dengan update stok otomatis & validasi stok cukup
- Pembatalan pergerakan stok (revert stok)
- Pagination

## Live Application
- **URL:** https://gudangkuprojectsid.cleverapps.io
- **Admin:** admin@gudangku.test / password
- **Staff:** staff@gudangku.test / password

## Instalasi (Local)
1. Clone repository:
   ```bash
   git clone https://github.com/brilliantgibrann16/gudangku.git
   cd gudangku
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Salin environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Konfigurasi database di `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gudangku
   DB_USERNAME=gudangku
   DB_PASSWORD=Gudangku!2026
   ```
   Buat database & user MySQL:
   ```sql
   CREATE DATABASE gudangku CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   CREATE USER 'gudangku'@'127.0.0.1' IDENTIFIED BY 'Gudangku!2026';
   GRANT ALL PRIVILEGES ON gudangku.* TO 'gudangku'@'127.0.0.1';
   FLUSH PRIVILEGES;
   ```
5. Migrasi & seed:
   ```bash
   php artisan migrate --seed
   ```
   (Atau import `database/gudangku.sql`.)
6. Jalankan server:
   ```bash
   php artisan serve
   ```
   Akses: http://127.0.0.1:8000

## Deployment
Live application: https://gudangkuprojectsid.cleverapps.io (Clever Cloud, PHP + MySQL). Alternatif lokal: `php artisan serve` (http://127.0.0.1:8000).

## Struktur MVC
- `app/Http/Controllers/` - Controller
- `app/Models/` - Model (Eloquent)
- `app/Http/Middleware/` - Middleware (auth, admin)
- `resources/views/` - View (Blade)
- `routes/web.php` - Routing
- `database/migrations/` - Skema DB
- `database/seeders/` - Data awal

## Lisensi
Tugas UAS - Cakrawala University.