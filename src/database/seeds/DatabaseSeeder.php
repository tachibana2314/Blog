<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MProductCategoriesTableSeeder::class);
        $this->call(MAllergiesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ProductMAllergyTableSeeder::class);
        $this->call(InformationsTableSeeder::class);
        $this->call(PicturesTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(CouponHistoriesTableSeeder::class);
    }
}
