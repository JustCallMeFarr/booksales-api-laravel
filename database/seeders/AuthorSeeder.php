<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'Andrea Hirata', 'photo' => 'andrea-hirata.jpg', 'bio' => 'Novelis asal Belitung, dikenal lewat tetralogi Laskar Pelangi.'],
            ['name' => 'Tere Liye', 'photo' => 'tere-liye.jpg', 'bio' => 'Penulis novel populer Indonesia dengan karya bertema keluarga, petualangan, dan fantasi.'],
            ['name' => 'Pramoedya Ananta Toer', 'photo' => 'pramoedya.jpg', 'bio' => 'Sastrawan Indonesia penulis Tetralogi Buru yang karyanya diterjemahkan ke banyak bahasa.'],
            ['name' => 'Dee Lestari', 'photo' => 'dee-lestari.jpg', 'bio' => 'Penulis dan penyanyi, terkenal lewat seri Supernova dan Filosofi Kopi.'],
            ['name' => 'Habiburrahman El Shirazy', 'photo' => 'habiburrahman.jpg', 'bio' => 'Novelis penulis Ayat-Ayat Cinta yang banyak diadaptasi ke layar lebar.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
