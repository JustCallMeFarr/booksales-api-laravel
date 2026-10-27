<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // genre_id: 1 Fiksi, 4 Sejarah | author_id: 1 Andrea Hirata, 2 Tere Liye,
        // 3 Pramoedya, 4 Dee Lestari, 5 Habiburrahman (lihat GenreSeeder & AuthorSeeder)
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'description' => 'Kisah sepuluh anak di Belitung yang berjuang bersekolah dengan segala keterbatasan.',
                'price' => 85000,
                'stock' => 20,
                'cover_photo' => 'laskar-pelangi.jpg',
                'genre_id' => 1,
                'author_id' => 1,
            ],
            [
                'title' => 'Pulang',
                'description' => 'Novel petualangan tentang perjalanan seorang pemuda kembali ke akar keluarganya.',
                'price' => 95000,
                'stock' => 15,
                'cover_photo' => 'pulang.jpg',
                'genre_id' => 1,
                'author_id' => 2,
            ],
            [
                'title' => 'Bumi Manusia',
                'description' => 'Novel sejarah awal Tetralogi Buru yang berlatar masa kolonial Hindia Belanda.',
                'price' => 120000,
                'stock' => 10,
                'cover_photo' => 'bumi-manusia.jpg',
                'genre_id' => 4,
                'author_id' => 3,
            ],
            [
                'title' => 'Filosofi Kopi',
                'description' => 'Kumpulan cerita tentang kopi, persahabatan, dan pencarian makna hidup.',
                'price' => 75000,
                'stock' => 25,
                'cover_photo' => 'filosofi-kopi.jpg',
                'genre_id' => 1,
                'author_id' => 4,
            ],
            [
                'title' => 'Ayat-Ayat Cinta',
                'description' => 'Novel tentang kehidupan seorang mahasiswa Indonesia di Kairo, Mesir.',
                'price' => 90000,
                'stock' => 18,
                'cover_photo' => 'ayat-ayat-cinta.jpg',
                'genre_id' => 1,
                'author_id' => 5,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
