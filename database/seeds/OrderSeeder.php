<?php

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'order_code' => 20021,
            'user_id' => 3,
            'total_price' => 200,
            'payment_method' => 1,
            'payment_status' => 1,
            'delivery_status' => 1,
        ]);

        Order::create([
            'order_code' => 20022,
            'user_id' => 3,
            'total_price' => 200,
            'payment_method' => 1,
            'payment_status' => 1,
            'delivery_status' => 1,
        ]);

        Order::create([
            'order_code' => 20023,
            'user_id' => 3,
            'total_price' => 200,
            'payment_method' => 1,
            'payment_status' => 1,
            'delivery_status' => 1,
        ]);
    }
}
