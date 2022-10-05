<?php

use Illuminate\Database\Seeder;

class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pictures')->insert([
            [
                'product_id' => 1,
                'path' => 'product/ZQ7d9neqUmYexiAfqrxNUpU1QAsQFSy8qtgkLV8h.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 1,
                'path' => 'product/3kyOmFxLwg8NRUdcs07LOkPRsyOEsB1SqutjeFv4.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 2,
                'path' => 'product/KQR2Vm4XcxgVz5Eq7Fmf9hUnVjXZvkQeQtaK4vDn.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 2,
                'path' => 'product/wS552ZLfzu4NMDKRDz38q0gkrwHB4J24cO87AWIB.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 3,
                'path' => 'product/JPwj33K4Iu6plQBSIooSuGJqgr7JorzwN1Q5Olld.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 3,
                'path' => 'product/xEjbHlGFBxXgEixa9ipCTshMbtpOoxhkCyCGXPSY.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 4,
                'path' => 'product/fUplLqPK4roUGjjsk4VaSB1UL1gq7MZGFcyEeoFt.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 4,
                'path' => 'product/LPO8RVN3kgGF3QYsdC6C59beiaU1am8NL360J6Wx.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 5,
                'path' => 'product/Ue1UMtfl4BCfySjD9v47SY7OpjzYu47O81UbEUrF.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 5,
                'path' => 'product/tqC6uKe6DtYNYcF4svrQVD9BOH5L1ifk6INF5Xtz.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
