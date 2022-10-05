<?php

use Illuminate\Database\Seeder;

class InformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('informations')->insert([
            [
                'title' => 'First News',
                'body' => 'Whilst users get some idea of what your app is about from your description and screenshots in the App Store, where does their first impression of the actual app in-action come from?',
                'pic_path' => 'information/h68tDDqRzFev0P6EbQS6DJar0Layr5iN8vXbCzOu.jpeg',
                'status' => 1,
                'release_date' => date("Y-m-d H:i:s", strtotime("-10 day")),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Second News',
                'body' => 'Also referred to as a “splash screen”, this is the very first thing your app users will see when they click to open up your app — as such, its importance should not be underestimated!',
                'pic_path' => 'information/DPoLOvTIyF6FjByzOveYkgSO40zyhvwrWe5ls7Xz.png',
                'status' => 1,
                'release_date' => date("Y-m-d H:i:s", strtotime("-3 day")),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Third News',
                'body' => 'Get it right — bold, simple and relevant launch screens tend to work best — and you’ll make your audience sit up and take notice, feel genuinely excited about what’s in store for them, and make them far more willing to spend time trying your app out.',
                'pic_path' => 'information/h68tDDqRzFev0P6EbQS6DJar0Layr5iN8vXbCzOu.jpeg',
                'status' => 1,
                'release_date' => date("Y-m-d H:i:s", strtotime("-1 day")),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
