<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin (hardcoded - single admin account)
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
            'status' => true,
        ]);

        // Kasir (hardcoded - managed by admin)
        \App\Models\User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('kasir123'),
            'role' => 'kasir',
            'status' => true,
        ]);

        // Pelanggan
        \App\Models\User::create([
            'name' => 'Pelanggan 1',
            'email' => 'pelanggan@cafe.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'pelanggan',
            'status' => true,
        ]);

        $cat1 = \App\Models\Category::create(['name' => 'Coffee']);
        $cat2 = \App\Models\Category::create(['name' => 'Non-Coffee']);
        $cat3 = \App\Models\Category::create(['name' => 'Snacks']);

        \App\Models\Menu::create([
            'name' => 'Americano',
            'price' => 20000,
            'category_id' => $cat1->id,
            'status' => 'tersedia',
        ]);

        \App\Models\Menu::create([
            'name' => 'Matcha Latte',
            'price' => 25000,
            'category_id' => $cat2->id,
            'status' => 'tersedia',
        ]);

        \App\Models\Menu::create([
            'name' => 'French Fries',
            'price' => 15000,
            'category_id' => $cat3->id,
            'status' => 'tersedia',
        ]);
    }
}
