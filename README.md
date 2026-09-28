# TugasWeb-P10-BlogCRUD

**Tugas Rutin 10 — Blog CRUD Laravel**

Nama: Natalia Enjelina Sihotang  
Mata Kuliah: Pemrograman Web  
Framework: Laravel 12  
PHP: 8.2+  
Database: MySQL

## Requirement
- Route::resource('posts') + named routes
- PostController resource dengan 7 method
- Blade layout master
- 2 components: Alert dan Card
- Validasi + error per field + old input
- Flash message sukses/gagal
- CSRF + PUT/DELETE method spoofing
- Route Model Binding
- Pagination

## Menjalankan
```bash
composer install
copy .env.example .env
php artisan key:generate
```
Buat database MySQL `tugasweb_p10`, sesuaikan `.env`, lalu:
```bash
php artisan migrate
php artisan serve
```
Buka `http://127.0.0.1:8000`.

Folder `vendor/` dan file `.env` sengaja tidak disertakan; jalankan `composer install` setelah ekstrak.
