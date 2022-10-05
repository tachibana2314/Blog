<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'email' => 'r.takahashi@soushin-lab.co.jp',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => '$2y$10$X9ACKvMPPn4ra1aVkq0aReGKZuHUdBENuNK8buOW1zu423v30b8Pq',
                'first_name' => '龍',
                'status' => 1,
                'last_name' => '髙橋',
                'first_name_kana' => 'リュウ',
                'last_name_kana' => 'タカハシ',
                'department' => '販売企画部',
                'position' => '海外販促企画課',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'kenichi.tachibana@leverages.jp',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'status' => 1,
                'password' => '$2y$10$X9ACKvMPPn4ra1aVkq0aReGKZuHUdBENuNK8buOW1zu423v30b8Pq',
                'first_name' => '健一',
                'last_name' => '橘',
                'first_name_kana' => 'ケンイチ',
                'last_name_kana' => 'タチバナ',
                'department' => '販売企画部',
                'position' => '海外販促企画課',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'kazuma-saito@chateraise.co.jp',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'status' => 1,
                'password' => '$2y$10$j6EMnz4R1BSgvyHO9AT7/uLEeAoZpQ5GzqQtfvpKxGBcNVqm.i2Ta',
                'first_name' => '一真',
                'last_name' => '斉藤',
                'first_name_kana' => 'カズマ',
                'last_name_kana' => 'サイトウ',
                'department' => '',
                'position' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'araki3176@chateraise.co.jp',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'status' => 1,
                'password' => '$2y$10$j6EMnz4R1BSgvyHO9AT7/uLEeAoZpQ5GzqQtfvpKxGBcNVqm.i2Ta',
                'first_name' => '秀幸',
                'last_name' => '荒木',
                'first_name_kana' => 'ヒデユキ',
                'last_name_kana' => 'アラキ',
                'department' => '情報システム部',
                'position' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
