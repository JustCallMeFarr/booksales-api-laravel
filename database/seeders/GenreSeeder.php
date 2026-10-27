<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Fiksi', 'description' => 'Buku cerita rekaan seperti novel dan cerpen yang bersumber dari imajinasi penulis.'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku berbasis fakta dan peristiwa nyata, seperti biografi dan buku pengetahuan.'],
            ['name' => 'Teknologi', 'description' => 'Buku seputar pemrograman, jaringan, basis data, dan perkembangan teknologi informasi.'],
            ['name' => 'Sejarah', 'description' => 'Buku yang mengulas peristiwa, tokoh, dan peradaban pada masa lampau.'],
            ['name' => 'Pengembangan Diri', 'description' => 'Buku motivasi dan panduan untuk meningkatkan kualitas diri dan kebiasaan positif.'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
