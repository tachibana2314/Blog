<?php

use Illuminate\Database\Seeder;

class CouponHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupon_histories')->insert([
            [
                'user_id' => 1,
                'coupon_id' => 1,
                // 'deleted_at' => '2020-08-29 11:05:30',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'coupon_id' => 3,
                // 'deleted_at' => '2020-08-31 14:23:150',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'coupon_id' => 2,
                // 'deleted_at' => '2020-09-01 13:05:25',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'coupon_id' => 3,
                // 'deleted_at' => '2020-08-24 17:45:15',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ]);
    }
}
