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
        \App\Models\User::create([
            'name' => 'Jelly McSquid',
            'email' => 'jelly@laravel.livewire.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        \App\Models\Store::create([
            'name' => 'MLM Industries',
            'user_id' => 1,
        ]);

        \App\Models\Product::create(['name' => 'Energy Drink', 'store_id' => 1]);
        \App\Models\Product::create(['name' => 'Water Purifier', 'store_id' => 1]);
        \App\Models\Product::create(['name' => 'Toothpaste', 'store_id' => 1]);
        \App\Models\Product::create(['name' => 'Magic Bracelet', 'store_id' => 1]);

        \App\Models\Order::factory()->count(902)->create(['product_id' => '1']);
        \App\Models\Order::factory()->count(760)->create(['product_id' => '2']);
        \App\Models\Order::factory()->count(543)->create(['product_id' => '3']);
        \App\Models\Order::factory()->count(632)->create(['product_id' => '4']);
    }
}
