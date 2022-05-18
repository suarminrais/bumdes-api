<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'email' => 'admin@admin.com',
            'name' => 'admin',
        ]);

        $products = Product::factory(10)->create([
            'user_id' => $admin->id,
        ]);

        foreach ($products as $product) {
            $product->image()->create([
                'name' => 'default.png',
            ]);
        }
    }
}
