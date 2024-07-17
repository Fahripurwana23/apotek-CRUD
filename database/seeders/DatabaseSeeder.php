<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      /* user::create([
        'name' => 'Administartor',
        'email' => 'admin@dev.com',
        'password' => hash::make('Admin123'),
        'role' => 'admin',
        'image' => 'sekarang',
       ]);
    }*/
}
