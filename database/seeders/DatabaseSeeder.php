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
        $this->call([
            ProductSeeder::class,
            InventorySeeder::class,
            PricingSeeder::class,
            // TransactionSeeder::class, // we will not be seeding transaction data as it will be done by consuming API endpoints
        ]);
    }
}
