<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::factory(10)->has(
            Budget::factory(3)
        )->create();
    }
}
