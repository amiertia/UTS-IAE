<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);

        User::create([
            'name' => 'Ani Wijaya',
            'email' => 'ani@example.com',
        ]);
    }
}