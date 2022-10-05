<?php

use Illuminate\Database\Seeder;

class SlidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            [
                'pic_path' => 'slide/N7e9EubJlitPqFr6wufr8Q4m6jqQgwq2csZmRoZC.png',
                'status' => 1,
                'order' => 1,
                'url' => null,
                'type' => 2,
                'product_id' => 1,
                'store_id' => null,
                'coupon_id' => null,
                'information_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'pic_path' => 'slide/WR3KpNGodMQOPPIJv2AgoJTjDCVftdT6PUkxa0u4.png',
                'status' => 1,
                'order' => 2,
                'url' => 'https://www.chateraise.co.jp/',
                'type' => 4,
                'store_id' => 2,
                'product_id' => null,
                'coupon_id' => null,
                'information_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'pic_path' => 'slide/nz7kIYtkdES3fis2dtDEoLV5BxibRS6Ga58PlJgp.png',
                'status' => 1,
                'order' => 3,
                'url' => null,
                'type' => 3,
                'coupon_id' => 2,
                'product_id' => null,
                'store_id' => null,
                'information_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'pic_path' => 'slide/deZKRiRtKKe3tvTOr2Dc8XGuFX0307FE5UR7KJsq.png',
                'status' => 1,
                'order' => 4,
                'url' => null,
                'type' => 1,
                'information_id' => 1,
                'product_id' => null,
                'store_id' => null,
                'coupon_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'pic_path' => 'slide/r2SLO4L2vbyl5tR4AYXMr8LwXPTatQUKMNqyA34P.png',
                'status' => 1,
                'order' => 5,
                'url' => 'https://www.chateraise.co.jp/',
                'type' => 5,
                'information_id' => null,
                'product_id' => null,
                'store_id' => null,
                'coupon_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
