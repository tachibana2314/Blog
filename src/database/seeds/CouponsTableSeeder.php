<?php

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
                'title' => '50% Off Coupon',
                'product_id' => 1,
                'barcode' => 'barcode_test/ORjFpD6b3wcc1ya1Txi4qE5OHcoZ5AS4anOmsn6W.jpeg',
                'description' => 'This is a little description of the coupon code or deal. Just to let users know some additional details.',
                'status' => 1,
                'type' => 1,
                'target_month' => null,
                'start_date' => date("Y-m-d", strtotime("-2 month")),
                'end_date' => date("Y-m-d", strtotime("1 month")),
                'release_date' => date("Y-m-d H:i:s", strtotime("-10 day")),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => '30% Off Coupon',
                'product_id' => 2,
                'barcode' => 'barcode_test/ORjFpD6b3wcc1ya1Txi4qE5OHcoZ5AS4anOmsn6W.jpeg',
                'description' => 'This is a little description of the coupon code or deal. Just to let users know some additional details.',
                'status' => 1,
                'type' => 1,
                'target_month' => null,
                'start_date' => date("Y-m-d", strtotime("-2 month")),
                'end_date' => date("Y-m-d", strtotime("1 month")),
                'release_date' => date("Y-m-d H:i:s", strtotime("-10 day")),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Birthday 30% Off Coupon',
                'product_id' => 3,
                'barcode' => 'barcode_test/ORjFpD6b3wcc1ya1Txi4qE5OHcoZ5AS4anOmsn6W.jpeg',
                'description' => 'This is a little description of the coupon code or deal. Just to let users know some additional details.',
                'status' => 1,
                'type' => 2,
                'target_month' => 12,
                'start_date' => null,
                'end_date' => null,
                'release_date' => date("Y-m-d H:i:s", strtotime("-10 day")),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
