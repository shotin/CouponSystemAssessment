<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponSeeder extends Seeder
{
    public function run()
    {
        // DB::table('cart_items')->truncate();
        DB::table('coupons')->insert([
            [
                'id' => (string) Str::uuid(),
                'code' => 'FIXED10',
                'rules' => json_encode([
                    ['type' => 'min_cart_total', 'value' => 50],
                    ['type' => 'min_item_count', 'value' => 1],
                ]),
                'discounts' => json_encode([
                    ['type' => 'fixed', 'value' => 10],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'code' => 'PERCENT10',
                'rules' => json_encode([
                    ['type' => 'min_cart_total', 'value' => 100],
                    ['type' => 'min_item_count', 'value' => 2],
                ]),
                'discounts' => json_encode([
                    ['type' => 'percent', 'value' => 10],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'code' => 'MIXED10',
                'rules' => json_encode([
                    ['type' => 'min_cart_total', 'value' => 200],
                    ['type' => 'min_item_count', 'value' => 3],
                ]),
                'discounts' => json_encode([
                    ['type' => 'mixed', 'fixed' => 10, 'percent' => 10],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'code' => 'REJECTED10',
                'rules' => json_encode([
                    ['type' => 'min_cart_total', 'value' => 1000],
                ]),
                'discounts' => json_encode([
                    ['type' => 'fixed', 'value' => 10],
                    ['type' => 'percent', 'value' => 10],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
