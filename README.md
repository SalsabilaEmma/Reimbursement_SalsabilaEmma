<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Dokumentasi

Dokumentasi Langkah Installasi / Deployment
Mini Task Reimbursemen - Laravel Developer Kasir Pintar
Salsabila Emma N

Persiapan Awal:

1. Install komponen-komponen seperti PHP, composer, dan PostgreSQL untuk server database
2. Clone repository https://github.com/SalsabilaEmma/Reimbursement_SalsabilaEmma dengan menggunakan perintah di terminal git clone
   Langkah Installasi:
3. Masuk ke direktori proyek yang telah di clone
4. Salin file .env.example menjadi .env.
5. Konfigurasi file .env
6. Jalankan perintah – perintah berikut:
   • php artisan key:generate
   • composer install
   • composer update
7. Jalankan migrasi untuk membuat table
   • Buat database terlebih dahulu di server database dengan nama reimbursement_salsabila
   • php artisan migrate
   • php artisan db:seed
8. Setelah instalasi selesai, jalankan menggunakan perintah
   • npm run build
   • php artisan serve
