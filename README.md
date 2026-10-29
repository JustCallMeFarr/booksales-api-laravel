# Book Sales API - Tugas Fitur Create (Genre & Author)

Branch: `tugasLaravel4-create`

REST API sederhana untuk sistem informasi penjualan buku (NF Academy) menggunakan Laravel. Pada tugas ini ditambahkan fitur **Create** (menambah data baru) untuk tabel **Genre** dan **Author**, di samping fitur **Read** yang sudah ada.

## Tujuan

- Membuat fitur Read all dan Create pada tabel Genre dan Author.
- Memvalidasi data yang dikirim sebelum disimpan ke database.
- Menguji endpoint menggunakan Postman.

## Struktur

| Komponen   | Lokasi |
|------------|--------|
| Routing    | `routes/api.php` |
| Controller | `app/Http/Controllers/GenreController.php`, `AuthorController.php`, `BookController.php` |
| Model      | `app/Models/Genre.php`, `Author.php`, `Book.php` |
| Migration  | `database/migrations/` (genres, authors, books) |
| Seeder     | `database/seeders/` (GenreSeeder, AuthorSeeder, BookSeeder) |

## Daftar Endpoint

Semua endpoint diawali `/api`.

| Method | URL | Keterangan |
|--------|-----|------------|
| GET    | `/api/genres` | Daftar semua genre (Read all) |
| GET    | `/api/genres/{id}` | Detail satu genre beserta bukunya |
| POST   | `/api/genres` | Tambah genre baru (Create) |
| GET    | `/api/authors` | Daftar semua penulis (Read all) |
| GET    | `/api/authors/{id}` | Detail satu penulis beserta bukunya |
| POST   | `/api/authors` | Tambah penulis baru (Create) |
| GET    | `/api/books` | Daftar buku beserta genre dan penulisnya |
| GET    | `/api/books/{id}` | Detail satu buku |

## Contoh Request Create

Kirim dengan body bertipe JSON. Di Postman: pilih **Body**, **raw**, lalu **JSON**.

**POST `/api/genres`**

| Field | Aturan |
|-------|--------|
| `name` | wajib, teks, maksimal 255 karakter |
| `description` | wajib, teks |

```json
{
  "name": "Komik",
  "description": "Buku cerita bergambar dengan alur bersambung."
}
```

**POST `/api/authors`**

| Field | Aturan |
|-------|--------|
| `name` | wajib, teks, maksimal 255 karakter |
| `photo` | opsional, teks (nama file), maksimal 255 karakter |
| `bio` | wajib, teks |

```json
{
  "name": "Eka Kurniawan",
  "photo": "eka-kurniawan.jpg",
  "bio": "Novelis Indonesia penulis Cantik Itu Luka."
}
```

## Format Response

Berhasil dibuat (`201 Created`):

```json
{
  "success": true,
  "message": "Genre berhasil ditambahkan",
  "data": {
    "name": "Komik",
    "description": "Buku cerita bergambar dengan alur bersambung.",
    "id": 6
  }
}
```

Validasi gagal (`422 Unprocessable Content`):

```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "name": ["The name field is required."],
    "description": ["The description field is required."]
  }
}
```

Data tidak ditemukan (`404 Not Found`):

```json
{
  "success": false,
  "message": "Genre tidak ditemukan"
}
```

## Cara Menjalankan

1. Clone repository dan pindah ke branch ini:
   ```bash
   git clone https://github.com/JustCallMeFarr/booksales-api-laravel.git
   cd booksales-api-laravel
   git checkout tugasLaravel4-create
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
5. Uji endpoint lewat Postman, atau `curl`:
   ```bash
   curl -X POST http://127.0.0.1:8000/api/genres \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{"name":"Komik","description":"Buku cerita bergambar."}'
   ```

## Teknologi

- PHP dan Laravel
- MySQL / SQLite
- Postman untuk pengujian
