# Book Sales API - Tugas CRUD Genre & Author

Branch: `tugasLaravel5-crud`

REST API sederhana untuk sistem informasi penjualan buku (NF Academy) menggunakan Laravel. Pada tugas ini ditambahkan fitur **Show**, **Update**, dan **Destroy** untuk tabel **Genre** dan **Author**, validasi ketika data yang dicari tidak ditemukan, serta penyederhanaan routing dengan `Route::apiResource`.

## Tujuan

- Melengkapi operasi CRUD (Create, Read, Update, Delete) pada Genre dan Author.
- Mengembalikan response 404 yang jelas ketika data tidak ditemukan.
- Menggunakan `Route::apiResource` untuk routing API.

## Struktur

| Komponen   | Lokasi |
|------------|--------|
| Routing    | `routes/api.php` |
| Controller | `app/Http/Controllers/GenreController.php`, `AuthorController.php`, `BookController.php` |
| Model      | `app/Models/Genre.php`, `Author.php`, `Book.php` |
| Migration  | `database/migrations/` (genres, authors, books) |
| Seeder     | `database/seeders/` (GenreSeeder, AuthorSeeder, BookSeeder) |

## Routing

```php
Route::apiResource('books', BookController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class);
Route::apiResource('authors', AuthorController::class);
```

## Daftar Endpoint

Semua endpoint diawali `/api`.

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/api/genres` | Daftar semua genre |
| POST | `/api/genres` | Tambah genre baru |
| GET | `/api/genres/{id}` | Detail satu genre beserta bukunya |
| PUT / PATCH | `/api/genres/{id}` | Ubah data genre |
| DELETE | `/api/genres/{id}` | Hapus genre |
| GET | `/api/authors` | Daftar semua penulis |
| POST | `/api/authors` | Tambah penulis baru |
| GET | `/api/authors/{id}` | Detail satu penulis beserta bukunya |
| PUT / PATCH | `/api/authors/{id}` | Ubah data penulis |
| DELETE | `/api/authors/{id}` | Hapus penulis |
| GET | `/api/books` | Daftar buku beserta genre dan penulisnya |
| GET | `/api/books/{id}` | Detail satu buku |

## Aturan Validasi

**Genre**

| Field | Aturan |
|-------|--------|
| `name` | wajib, teks, maksimal 255 karakter |
| `description` | wajib, teks |

**Author**

| Field | Aturan |
|-------|--------|
| `name` | wajib, teks, maksimal 255 karakter |
| `photo` | opsional, teks (nama file), maksimal 255 karakter |
| `bio` | wajib, teks |

Pada Update, field yang tidak dikirim tidak diubah, sehingga cukup mengirim field yang ingin diganti.

## Contoh Request

Kirim dengan body bertipe JSON. Di Postman: pilih **Body**, **raw**, lalu **JSON**.

**PUT `/api/genres/6`**

```json
{
  "name": "Komik Anak",
  "description": "Buku cerita bergambar untuk anak-anak."
}
```

**PUT `/api/authors/6`**

```json
{
  "name": "Eka Kurniawan",
  "bio": "Novelis Indonesia."
}
```

## Format Response

Berhasil (`200 OK`, atau `201 Created` untuk POST):

```json
{
  "success": true,
  "message": "Genre berhasil diubah",
  "data": {
    "id": 6,
    "name": "Komik Anak",
    "description": "Buku cerita bergambar untuk anak-anak."
  }
}
```

Data tidak ditemukan (`404 Not Found`, berlaku untuk Show, Update, dan Destroy):

```json
{
  "success": false,
  "message": "Genre tidak ditemukan"
}
```

Validasi gagal (`422 Unprocessable Content`):

```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "name": ["The name field is required."]
  }
}
```

## Catatan

Relasi buku ke genre dan penulis memakai `cascadeOnDelete`, sehingga menghapus genre atau penulis yang masih punya buku ikut menghapus bukunya. Untuk mengembalikan data awal, jalankan `php artisan migrate:fresh --seed`.

## Cara Menjalankan

1. Clone repository dan pindah ke branch ini:
   ```bash
   git clone https://github.com/JustCallMeFarr/booksales-api-laravel.git
   cd booksales-api-laravel
   git checkout tugasLaravel5-crud
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
5. Uji endpoint lewat Postman atau `curl`:
   ```bash
   curl -X PUT http://127.0.0.1:8000/api/genres/6 \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{"name":"Komik Anak"}'
   ```

## Teknologi

- PHP dan Laravel
- MySQL / SQLite
- Postman atau `curl` untuk pengujian
