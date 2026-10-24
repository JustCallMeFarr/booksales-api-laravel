<?php

namespace App\Models;

class Genre
{
    /**
     * Data genre (array) sesuai tabel genres pada desain database:
     * id, name, description
     */
    private static array $genres = [
        [
            'id' => 1,
            'name' => 'Fiksi',
            'description' => 'Buku cerita rekaan seperti novel dan cerpen yang bersumber dari imajinasi penulis.',
        ],
        [
            'id' => 2,
            'name' => 'Non-Fiksi',
            'description' => 'Buku berbasis fakta dan peristiwa nyata, seperti biografi dan buku pengetahuan.',
        ],
        [
            'id' => 3,
            'name' => 'Teknologi',
            'description' => 'Buku seputar pemrograman, jaringan, basis data, dan perkembangan teknologi informasi.',
        ],
        [
            'id' => 4,
            'name' => 'Sejarah',
            'description' => 'Buku yang mengulas peristiwa, tokoh, dan peradaban pada masa lampau.',
        ],
        [
            'id' => 5,
            'name' => 'Pengembangan Diri',
            'description' => 'Buku motivasi dan panduan untuk meningkatkan kualitas diri dan kebiasaan positif.',
        ],
    ];

    /**
     * Ambil semua data genre.
     */
    public static function all(): array
    {
        return self::$genres;
    }

    /**
     * Cari satu genre berdasarkan id. Mengembalikan null jika tidak ditemukan.
     */
    public static function find(int $id): ?array
    {
        foreach (self::$genres as $genre) {
            if ($genre['id'] === $id) {
                return $genre;
            }
        }

        return null;
    }
}
