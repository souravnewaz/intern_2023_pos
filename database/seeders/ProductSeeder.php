<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for($i=0; $i <100; $i++) {
            
            Product::create([
                'name' => $faker->word(),
                'image' => 'assets/images/items/product.jpg',
                'price' => 599,
                'stock_in' => 100,
                'stock_out' => rand(1, 90),
                'is_active' => rand(0, 1),
            ]);
        }
    }
}
