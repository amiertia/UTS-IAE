<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'user_id' => 1,
            'total_price' => 500000,
        ]);

        Order::create([
            'user_id' => 1,
            'total_price' => 750000,
        ]);
    }
}