<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $code = str_pad($i, 3, '0', STR_PAD_LEFT);

            Product::create([
                'sku' => 'SKU-' . $code,
                'name' => 'Test Product ' . $code,
                'description' => 'Demo Product ' . $code . ' for seeding.'
            ]);
        }
    }
}
