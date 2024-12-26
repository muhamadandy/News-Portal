Portal Berita berbasis Laravel yang mendukung multi-user dengan fitur manajemen berita, dan kategori.

Fitur:
Manajemen Berita,
Sistem Pendaftaran dan Login,
Komentar oleh Pengguna Terdaftar,
Filter dan Pencarian Berita,
Dashboard Admin,
Dashboard User

Prasyarat
Pastikan Anda sudah menginstal:

PHP versi 8.x
Composer versi terbaru
MySQL
Laravel 11

Instalasi
Ikuti langkah-langkah berikut untuk menginstal proyek ini:

Clone Repository

git clone https://github.com/muhamadandy/News-Portal.git

cd nama-proyek

Instal Dependensi Jalankan perintah berikut untuk menginstal dependensi PHP dan JavaScript:

composer install

npm install

Konfigurasi Environment Salin file .env.example menjadi .env dan sesuaikan dengan konfigurasi database Anda:

cp .env.example .env

Update variabel berikut di file .env:

DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password

Generate App Key Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
php artisan key:generate

Migrasi Database Jalankan migrasi untuk membuat tabel di database:
php artisan migrate

Membuat admin user dengan seeder:
php artisan db:seed

Build Frontend Assets jalankan:
npm run dev

Jalankan Server Mulai server Laravel menggunakan:
php artisan serve



