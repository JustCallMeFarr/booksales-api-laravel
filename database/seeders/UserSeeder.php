<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Book Sales',
                'email' => 'admin@booksales.test',
                'password' => 'admin12345',
                'role' => 'admin',
            ],
            [
                'name' => 'User Biasa',
                'email' => 'user@booksales.test',
                'password' => 'user12345',
                'role' => 'user',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrNew(['email' => $data['email']]);
            $user->forceFill([
                'name' => $data['name'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ])->save();
        }
    }
}
