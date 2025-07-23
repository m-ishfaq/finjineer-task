<?php

namespace Database\Seeders;

use App\Models\PricingRule;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::pluck('id');

        // Time-based pricing
        PricingRule::create([
            'product_id' => $products->random(),
            'type' => 'time',
            'conditions' => json_encode([
                'days' => ['Monday', 'Tuesday', 'Wednesday'],
                'start_time' => '09:00',
                'end_time' => '21:00'
            ]),
            'discount' => 10,
            'discount_type' => 'percent',
            'start_at' => now()->subDays(1),
            'end_at' => now()->addDays(30),
        ]);

        // Quantity-based pricing
        PricingRule::create([
            'product_id' => $products->random(),
            'type' => 'quantity',
            'conditions' => json_encode([
                'min_qty' => 10,
                'max_qty' => 50
            ]),
            'discount' => 15,
            'discount_type' => 'fixed',
            'start_at' => now()->subDays(1),
            'end_at' => now()->addDays(30),
        ]);
    }
}
