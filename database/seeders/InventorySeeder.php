<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $products = Product::pluck('id');

        foreach ($products as $productId) {
            Inventory::create([
                'product_id' => $productId,
                'quantity' => random_int(10, 50),
                'location' => $faker->city,
                'cost' => $faker->randomFloat(2, 50, 200),
                'lot_number' => 'LOT-' . strtoupper($faker->bothify('??##')),
            ]);
        }
    }
}
