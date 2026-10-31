# Book Sales API - Tugas Autentikasi & Otorisasi (JWT + Middleware)

Branch: `tugasLaravel6-auth`

REST API sederhana untuk sistem informasi penjualan buku (NF Academy) menggunakan Laravel. Pada tugas ini ditambahkan **autentikasi** dengan JWT dan **otorisasi berbasis peran (RBAC)** melalui middleware, sehingga:

- **Read All** dan **Show** pada Genre dan Author dapat diakses semua orang, termasuk yang belum login.
- **Create**, **Update**, dan **Destroy** hanya dapat diakses oleh **admin**.

## Tujuan

- Memahami konsep autentikasi dan otorisasi.
- Mengimplementasikan login dengan JWT (`tymon/jwt-auth`).
- Mengimplementasikan middleware dan RBAC untuk membatasi akses route.

## Struktur

| Komponen   | Lokasi |
|------------|--------|
| Routing    | `routes/api.php` |
| Middleware | `app/Http/Middleware/AdminMiddleware.php` |
| Controller | `app/Http/Controllers/AuthController.php`, `GenreController.php`, `AuthorController.php`, `BookController.php` |
| Model      | `app/Models/User.php` (implements `JWTSubject`), `Genre.php`, `Author.php`, `Book.php` |
| Konfigurasi| `config/auth.php` (guard `api` dengan driver `jwt`), `config/jwt.php` |
| Migration  | `database/migrations/` (users + kolom `role` dan `last_access`, genres, authors, books) |
| Seeder     | `database/seeders/` (UserSeeder, GenreSeeder, AuthorSeeder, BookSeeder) |

## Routing

```php
// Publik: bisa diakses siapa saja
Route::apiResource('books', BookController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);

// Khusus admin: wajib login (token JWT) dan role admin
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::apiResource('genres', GenreController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('authors', AuthorController::class)->only(['store', 'update', 'destroy']);
});
```

## Daftar Endpoint

Semua endpoint diawali `/api`.

### Autentikasi

| Method | URL | Akses | Keterangan |
|--------|-----|-------|------------|
| POST | `/api/register` | Publik | Daftar akun baru (role otomatis `user`) |
| POST | `/api/login` | Publik | Login dan dapatkan token JWT |
| GET | `/api/me` | Login | Data akun yang sedang login |
| POST | `/api/logout` | Login | Menonaktifkan token yang sedang dipakai |

### Data

| Method | URL | Akses |
|--------|-----|-------|
| GET | `/api/books`, `/api/books/{id}` | Publik |
| GET | `/api/genres`, `/api/genres/{id}` | Publik |
| GET | `/api/authors`, `/api/authors/{id}` | Publik |
| POST | `/api/genres`, `/api/authors` | **Admin** |
| PUT / PATCH | `/api/genres/{id}`, `/api/authors/{id}` | **Admin** |
| DELETE | `/api/genres/{id}`, `/api/authors/{id}` | **Admin** |

## Akun Uji (dibuat oleh seeder)

| Role | Email | Password |
|------|-------|----------|
| admin | `admin@booksales.test` | `admin12345` |
| user | `user@booksales.test` | `user12345` |

## Cara Memakai Token

1. Login lewat `POST /api/login`:
   ```json
   {
     "email": "admin@booksales.test",
     "password": "admin12345"
   }
   ```
2. Salin nilai `token` dari respons.
3. Untuk route khusus admin, kirim header berikut pada setiap request (di Postman: tab **Authorization**, tipe **Bearer Token**):
   ```
   Authorization: Bearer <token>
   ```

Token berlaku selama 1 jam. Setelah itu, login ulang untuk mendapatkan token baru.

## Format Response

Login berhasil (`200 OK`):

```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "user": { "id": 1, "name": "Admin Book Sales", "role": "admin" },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "Bearer",
    "expires_in": 3600
  }
}
```

| Kondisi | Status | Pesan |
|---------|--------|-------|
| Route admin tanpa token atau token tidak valid | `401` | Anda belum login atau token tidak valid |
| Route admin dengan token user biasa | `403` | Akses ditolak, hanya admin yang diizinkan |
| Email atau password salah | `401` | Email atau password salah |
| Data tidak ditemukan | `404` | Genre/Penulis tidak ditemukan |
| Validasi gagal | `422` | Validasi gagal (beserta daftar `errors`) |

## Cara Menjalankan

1. Clone repository dan pindah ke branch ini:
   ```bash
   git clone https://github.com/JustCallMeFarr/booksales-api-laravel.git
   cd booksales-api-laravel
   git checkout tugasLaravel6-auth
   ```
2. Pasang dependensi dan siapkan environment:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
3. Buat secret key JWT (wajib, karena file `.env` tidak ikut ke repository):
   ```bash
   php artisan jwt:secret
   ```
4. Atur koneksi database pada file `.env`, lalu jalankan migration dan seeder:
   ```bash
   php artisan migrate:fresh --seed
   ```
5. Jalankan server:
   ```bash
   php artisan serve
   ```
6. Uji endpoint lewat Postman atau `curl`, contohnya:
   ```bash
   # Publik: berhasil tanpa login
   curl http://127.0.0.1:8000/api/genres

   # Admin-only tanpa token: ditolak 401
   curl -X POST http://127.0.0.1:8000/api/genres \
     -H "Content-Type: application/json" -H "Accept: application/json" \
     -d '{"name":"Komik","description":"Buku cerita bergambar."}'
   ```

## Skenario Pengujian

| Skenario | Hasil yang diharapkan |
|----------|-----------------------|
| GET genres/authors tanpa login | 200 OK |
| POST/PUT/DELETE tanpa token | 401 Unauthorized |
| POST/PUT/DELETE dengan token user biasa | 403 Forbidden |
| POST/PUT/DELETE dengan token admin | 201 / 200 OK |

## Teknologi

- PHP dan Laravel
- JWT (`tymon/jwt-auth`)
- MySQL / SQLite
- Postman atau `curl` untuk pengujian
