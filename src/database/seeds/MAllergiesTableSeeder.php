<?php

use Illuminate\Database\Seeder;

class MAllergiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_allergies')->insert([
            ['name' => 'Egg'],
            ['name' => 'Milk'],
            ['name' => 'Wheat'],
            ['name' => 'Buckwheat'],
            ['name' => 'Peanut'],
            ['name' => 'Shrimp'],
            ['name' => 'Crab'],
            ['name' => 'Soybean'],
            ['name' => 'Gelation']
        ]);
    }
}
