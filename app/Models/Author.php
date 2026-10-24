<?php

namespace App\Models;

class Author
{
    /**
     * Data penulis (array) sesuai tabel authors pada desain database:
     * id, name, photo, bio
     */
    private static array $authors = [
        [
            'id' => 1,
            'name' => 'Andrea Hirata',
            'photo' => 'andrea-hirata.jpg',
            'bio' => 'Novelis asal Belitung, dikenal lewat tetralogi Laskar Pelangi.',
        ],
        [
            'id' => 2,
            'name' => 'Tere Liye',
            'photo' => 'tere-liye.jpg',
            'bio' => 'Penulis novel populer Indonesia dengan karya bertema keluarga, petualangan, dan fantasi.',
        ],
        [
            'id' => 3,
            'name' => 'Pramoedya Ananta Toer',
            'photo' => 'pramoedya.jpg',
            'bio' => 'Sastrawan Indonesia penulis Tetralogi Buru yang karyanya diterjemahkan ke banyak bahasa.',
        ],
        [
            'id' => 4,
            'name' => 'Dee Lestari',
            'photo' => 'dee-lestari.jpg',
            'bio' => 'Penulis dan penyanyi, terkenal lewat seri Supernova dan Filosofi Kopi.',
        ],
        [
            'id' => 5,
            'name' => 'Habiburrahman El Shirazy',
            'photo' => 'habiburrahman.jpg',
            'bio' => 'Novelis penulis Ayat-Ayat Cinta yang banyak diadaptasi ke layar lebar.',
        ],
    ];

    /**
     * Ambil semua data penulis.
     */
    public static function all(): array
    {
        return self::$authors;
    }

    /**
     * Cari satu penulis berdasarkan id. Mengembalikan null jika tidak ditemukan.
     */
    public static function find(int $id): ?array
    {
        foreach (self::$authors as $author) {
            if ($author['id'] === $id) {
                return $author;
            }
        }

        return null;
    }
}
