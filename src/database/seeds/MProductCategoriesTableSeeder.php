<?php

use Illuminate\Database\Seeder;

class MProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_product_categories')->insert([
            ['id' => 1, 'name' => 'Whole Cakes'],
            ['id' => 2, 'name' => 'Sliced Cakes'],
            ['id' => 3, 'name' => 'Chilled Items'],
            ['id' => 4, 'name' => 'Ice Cream'],
            ['id' => 5, 'name' => 'Gift Items'],
            ['id' => 6, 'name' => 'Bread'],
            ['id' => 7, 'name' => 'Wine'],
            ['id' => 8, 'name' => 'Allergy Free Cake']
        ]);
    }
}
