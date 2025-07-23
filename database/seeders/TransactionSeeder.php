<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::pluck('id');

        $t1 = Transaction::create([
            'product_id' => $products->random(),
            'quantity' => 5,
            'type' => 'sale',
            'price' => 115.00,
        ]);

        TransactionLog::create([
            'transaction_id' => $t1->id,
            'data' => json_encode(['action' => 'created', 'timestamp' => now()->toDateTimeString()]),
        ]);

        $t2 = Transaction::create([
            'product_id' => $products->random(),
            'quantity' => 20,
            'type' => 'restock',
            'price' => 85.00,
        ]);

        TransactionLog::create([
            'transaction_id' => $t2->id,
            'data' => json_encode(['action' => 'created', 'timestamp' => now()->toDateTimeString()]),
        ]);
    }
}
