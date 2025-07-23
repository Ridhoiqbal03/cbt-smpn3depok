<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# CBT-SMPN3 - Aplikasi Ujian Online Berbasis Web

Aplikasi ujian online berbasis web dengan menggunakan metode prototype pada SMPN 3 Depok.

## Fitur Terbaru - Validasi dan Pesan Sukses

### 1. Validasi Form Register
- **Validasi Real-time**: Form register sekarang memiliki validasi real-time dengan JavaScript
- **Pesan Error**: Menampilkan pesan error yang spesifik untuk setiap field
- **Styling Error**: Border merah pada field yang memiliki error
- **Validasi Server-side**: Tetap menggunakan validasi Laravel untuk keamanan

#### Field yang divalidasi:
- **Nama**: Minimal 2 karakter
- **Email**: Format email yang valid
- **Password**: Minimal 8 karakter
- **Konfirmasi Password**: Harus cocok dengan password

### 2. Validasi Form Login
- **Validasi Email**: Format email yang valid
- **Validasi Password**: Field password wajib diisi
- **Pesan Error**: Menampilkan pesan error dari server

### 3. Pesan Sukses Modal
- **Modal Animasi**: Pesan sukses ditampilkan dalam modal dengan animasi
- **Auto-close**: Modal akan otomatis tertutup setelah 5 detik
- **Manual Close**: User dapat menutup modal dengan tombol OK
- **Responsive**: Modal responsive untuk semua ukuran layar

#### Pesan Sukses yang Ditampilkan:
- **Register**: "Selamat, akun Anda berhasil dibuat!"
- **Login**: "Selamat datang! Anda berhasil masuk ke sistem."

### 4. Animasi dan Styling
- **CSS Animations**: Animasi fade in/out untuk modal
- **Hover Effects**: Efek hover pada tombol
- **Pulse Animation**: Animasi pulse pada pesan error
- **Bounce Animation**: Animasi bounce pada icon sukses

## Cara Penggunaan

### Register
1. Buka halaman register
2. Isi form dengan data yang valid
3. Klik "Create My Account"
4. Jika berhasil, akan muncul modal sukses
5. Klik "OK" untuk melanjutkan ke dashboard

### Login
1. Buka halaman login
2. Masukkan email dan password yang valid
3. Klik "Sign In to my Account"
4. Jika berhasil, akan muncul modal sukses
5. Klik "OK" untuk melanjutkan ke dashboard

## File yang Dimodifikasi

### Controllers
- `app/Http/Controllers/Auth/RegisteredUserController.php` - Menambahkan pesan sukses
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php` - Menambahkan pesan sukses

### Views
- `resources/views/auth/register.blade.php` - Menambahkan validasi error
- `resources/views/auth/login.blade.php` - Menambahkan validasi error
- `resources/views/layouts/app.blade.php` - Menambahkan modal sukses

### Assets
- `resources/css/app.css` - Menambahkan animasi dan styling
- `resources/js/app.js` - Menambahkan JavaScript untuk validasi dan modal

## Teknologi yang Digunakan

- **Laravel 11** - Framework PHP
- **Laravel Breeze** - Authentication scaffolding
- **Tailwind CSS** - Styling framework
- **JavaScript** - Client-side validation dan modal handling
- **CSS Animations** - Custom animations untuk UX yang lebih baik

## Instalasi

1. Clone repository
2. Install dependencies: `composer install`
3. Copy `.env.example` ke `.env`
4. Generate key: `php artisan key:generate`
5. Setup database dan jalankan migration
6. Install npm dependencies: `npm install`
7. Build assets: `npm run build`
8. Jalankan server: `php artisan serve`

## Kontribusi

Untuk berkontribusi pada proyek ini, silakan:
1. Fork repository
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi

Proyek ini dikembangkan untuk penelitian implementasi aplikasi ujian online berbasis web dengan metode prototype pada SMPN 3 Depok.
