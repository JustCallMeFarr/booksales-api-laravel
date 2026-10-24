# Book Sales API - Tugas MVC Genre & Author

Branch: `tugasLaravel1-mvc-genre-author`

Tugas membuat sistem MVC sederhana pada Laravel untuk menampilkan data array dari Model melalui View. Studi kasus yang dipakai adalah tabel **Genre** dan **Author** dari dokumen Brief *Sistem Informasi Penjualan Buku* (NF Academy).

## Tujuan

- Memahami alur MVC (Model, View, Controller) beserta routing pada Laravel.
- Menampilkan data dari Model (berupa array) ke halaman web melalui Controller dan View.

## Struktur MVC

| Komponen   | Lokasi |
|------------|--------|
| Model      | `app/Models/Genre.php`, `app/Models/Author.php` |
| Controller | `app/Http/Controllers/GenreController.php`, `app/Http/Controllers/AuthorController.php` |
| Routing    | `routes/web.php` |
| View       | `resources/views/layouts/app.blade.php`, `resources/views/genres/`, `resources/views/authors/` |

## Data

Setiap Model berisi 5 data array yang mengikuti kolom pada desain database di Brief.

- **Genre**: `id`, `name`, `description`
- **Author**: `id`, `name`, `photo`, `bio`

## Daftar Route

| Method | URL             | Controller@method        | Keterangan          |
|--------|-----------------|--------------------------|---------------------|
| GET    | `/genres`       | `GenreController@index`  | Daftar semua genre  |
| GET    | `/genres/{id}`  | `GenreController@show`   | Detail satu genre   |
| GET    | `/authors`      | `AuthorController@index` | Daftar semua author |
| GET    | `/authors/{id}` | `AuthorController@show`  | Detail satu author  |

## Cara Menjalankan

1. Clone repository dan pindah ke branch ini:
   ```bash
   git clone https://github.com/JustCallMeFarr/booksales-api-laravel.git
   cd booksales-api-laravel
   git checkout tugasLaravel1-mvc-genre-author
   ```
2. Pasang dependensi dan siapkan environment:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
3. Jalankan server:
   ```bash
   php artisan serve
   ```
4. Buka di browser:
   - http://127.0.0.1:8000/genres
   - http://127.0.0.1:8000/authors

Tugas ini tidak memakai database, jadi tidak perlu menjalankan migrasi.

## Teknologi

- PHP dan Laravel
- Blade template engine
