<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Gateau assortment',
                'm_product_category_id' => 1,
                'price' => 15,
                'description' => '"Baked cheese tart" using cream cheese, "Baumkuchen" with rich flavor and no additives, "Madeleine" where you can thoroughly taste the taste of butter, "Finanche" with a moist texture, "Duckwords" with a crispy texture. "Coffee", "Duckwords (seasonal flavor)", and baked confectionery containing "Chateau Leisin" (15 pieces and 23 pieces only), which is made by mixing plenty of homemade raisins with a rich scent into cream and sandwiching them in cookies. It is an assortment.
                *Assortment may vary depending on the store.
                *Currently, the flavor of Duckwards (season) is "Duckwards Matcha".
                *Madeleine uses honey, so please do not give to children under 1 year old.',
                'calory' => 100,
                'status' => 1,
                'online_flg' => 1,
                'limited_flg' => null,
                'start_date' => null,
                'end_date' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Fruit dessert roll cup',
                'm_product_category_id' => 2,
                'price' => 3,
                'description' => 'A fluffy roll cake with plenty of whipped cream and custard cream with whipped cream. A dessert cake with mellow melting whipped cream and sweet and sour fruit. Decorated with fresh strawberries, kiwifruits and oranges.',
                'calory' => 401,
                'status' => 1,
                'online_flg' => null,
                'limited_flg' => null,
                'start_date' => null,
                'end_date' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Chocolate bucky vanilla',
                'm_product_category_id' => 4,
                'price' => 3,
                'description' => 'Crunchy sweet chocolate was laid on top of the vanilla ice cream. The creamy texture of vanilla ice cream with a more milky texture has been devised, and the way chocolate is put in has been modified so that the chocolate texture changes from the first mouth to the light taste of the chocolate until the end. Now you can have ice cream. Crisp, squeak, squeak, squeak. Because each ice cream has a different facial expression, you can enjoy the texture of chocolate that changes each time you eat it. Please enjoy the texture as if you are eating a plate chocolate and the satisfaction of chocolate irresistible for chocolate lovers. In addition, each ice cream has a unique handmade feel, making it the "one in the world" ice bar.',
                'calory' => 158,
                'status' => 1,
                'online_flg' => null,
                'limited_flg' => null,
                'start_date' => null,
                'end_date' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Summer strawberry crepe dessert',
                'm_product_category_id' => 2,
                'price' => 5,
                'description' => 'This crepe cake has plenty of looks and tastes, with plenty of seasonal summer strawberries sandwiched in between. A layer of layers of crepe skin with a crisp, egg-like taste, a mellow, whipped cream with a hint of Kirsch liqueur and a sweet and sour summer strawberry.
                *Do not give to children under 1 year old as honey is used.
                * Not available at some stores in Hiroshima Prefecture (Hiroshima Kabe store, Kokusaidori store, Sunliv Itsukaichi store, Hatsukaichi store, Higashihiroshima Saijo store), Shimane prefecture, Tottori prefecture and Yamaguchi prefecture.
                *Please contact the store directly for product handling',
                'calory' => 590,
                'status' => 1,
                'online_flg' => 1,
                'limited_flg' => 1,
                'start_date' => date("Y-m-d", strtotime("-1 month")),
                'end_date' => date("Y-m-d"),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Chocolate crunch',
                'm_product_category_id' => 4,
                'price' => 5,
                'description' => 'Finished with caramel almond chocolate crunch with caramel chocolate and brown rice puff with light texture, chewy sugar corn and almonds, and milk raisin chocolate crunch with brown rice puff, sugar corn, raisins and cinnamon added to milk chocolate. It was It is a chocolate candy that is a combination of two types of crunch.',
                'calory' => 200,
                'status' => 1,
                'online_flg' => 1,
                'limited_flg' => 1,
                'start_date' => date("Y-m-d", strtotime("-2 month")),
                'end_date' => date("Y-m-d", strtotime("1 month")),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
