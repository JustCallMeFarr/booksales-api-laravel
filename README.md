# Book Sales API - Tugas API Laravel

Branch: `tugasLaravel3-api`

REST API sederhana untuk sistem informasi penjualan buku (NF Academy) menggunakan Laravel. Semua routing berada di `routes/api.php`, controller mengembalikan output JSON, dan file view yang tidak diperlukan sudah dihapus.

## Tujuan

- Memahami konsep API pada Laravel (`routes/api.php`).
- Menampilkan data dari database dalam format JSON melalui Controller.
- Menguji endpoint menggunakan alat uji API.

## Struktur

| Komponen   | Lokasi |
|------------|--------|
| Routing    | `routes/api.php` |
| Controller | `app/Http/Controllers/BookController.php`, `AuthorController.php`, `GenreController.php` |
| Model      | `app/Models/Book.php`, `Author.php`, `Genre.php` |
| Migration  | `database/migrations/` (genres, authors, books) |
| Seeder     | `database/seeders/` (GenreSeeder, AuthorSeeder, BookSeeder) |

## Daftar Endpoint

Semua endpoint diawali `/api` dan memakai method `GET`.

| URL | Keterangan |
|-----|------------|
| `/api/books` | Daftar buku beserta genre dan penulisnya |
| `/api/books/{id}` | Detail satu buku |
| `/api/authors` | Daftar penulis |
| `/api/authors/{id}` | Detail satu penulis beserta bukunya |
| `/api/genres` | Daftar genre |
| `/api/genres/{id}` | Detail satu genre beserta bukunya |

## Format Response

Berhasil (`200 OK`):

```json
{
  "success": true,
  "message": "Detail data buku",
  "data": { }
}
```

Data tidak ditemukan (`404 Not Found`):

```json
{
  "success": false,
  "message": "Buku tidak ditemukan"
}
```

## Cara Menjalankan

1. Clone repository dan pindah ke branch ini:
   ```bash
   git clone https://github.com/JustCallMeFarr/booksales-api-laravel.git
   cd booksales-api-laravel
   git checkout tugasLaravel3-api
   ```
2. Pasang dependensi dan siapkan environment:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
3. Atur koneksi database pada file `.env`, lalu jalankan migration dan seeder:
   ```bash
   php artisan migrate:fresh --seed
   ```
4. Jalankan server:
   ```bash
   php artisan serve
   ```
5. Uji endpoint lewat Postman, browser, atau `curl`:
   ```bash
   curl http://127.0.0.1:8000/api/books
   ```

## Teknologi

- PHP dan Laravel
- MySQL / SQLite
- Postman atau `curl` untuk pengujian
