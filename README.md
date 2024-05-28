# CRUD Book API

Proyek ini menyediakan API RESTful untuk mengelola koleksi buku. API ini memungkinkan pengguna untuk melakukan registrasi, login, serta operasi CRUD (Create, Read, Update, Delete) pada resource buku. Otentikasi diterapkan menggunakan JSON Web Tokens (JWT) untuk memastikan akses yang aman ke endpoint API.

## Fitur

- Registrasi pengguna
- Login pengguna
- CRUD Buku (Create, Read, Update, Delete)
- Pagination dan pencarian buku
- Validasi input data
- Otentikasi dengan JWT

## Instalasi

1. Clone repositori ini:
   ```sh
   git clone https://github.com/username/crud-book-api.git
   ```
2. Masuk ke direktori proyek:

   ```sh
   cd crud-book-api
   ```

3. Install dependensi menggunakan Composer:
   ```sh
   composer install
   ```
4. Salin file .env.example ke .env dan sesuaikan pengaturan database::
   ```sh
   cp .env.example .env
   ```
5. Generate aplikasi key:
   ```sh
   php artisan key:generate
   ```
6. Migrasikan database:
   ```sh
   php artisan migrate
   ```
7. Menjalankan Server
   ```sh
   php artisan serve
   ```

## Dokumentasi API

Dokumentasi API dapat dilihat melalui
https://documenter.getpostman.com/view/34988620/2sA3Qtcqwr
atau dapat mendownload collection di Book API.postman_collection.json

