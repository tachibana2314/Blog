<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'r.takahashi@soushin-lab.co.jp',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => '$2y$10$X9ACKvMPPn4ra1aVkq0aReGKZuHUdBENuNK8buOW1zu423v30b8Pq',
                'nickname' => 'ryu takahashi',
                'gender' => 1,
                'birthday' => date("Y-m-d", strtotime("-25 year")),
                'logged_in_at' => date('Y-m-d H:i:s'),
                'left_at' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'r.takahashi+1@soushin-lab.co.jp',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => '$2y$10$X9ACKvMPPn4ra1aVkq0aReGKZuHUdBENuNK8buOW1zu423v30b8Pq',
                'nickname' => 'ryuko takahashi',
                'gender' => 2,
                'birthday' => date("Y-m-d", strtotime("-25 year")),
                'logged_in_at' => date('Y-m-d H:i:s'),
                'left_at' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'r.takahashi+2@soushin-lab.co.jp',
                'email_verified_at' => date('Y-m-d H:i:s', strtotime("yesterday")),
                'password' => '$2y$10$X9ACKvMPPn4ra1aVkq0aReGKZuHUdBENuNK8buOW1zu423v30b8Pq',
                'nickname' => 'ryuji takahashi',
                'gender' => 1,
                'birthday' => date("Y-m-d", strtotime("-25 year")),
                'logged_in_at' => date('Y-m-d H:i:s', strtotime("yesterday")),
                'left_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s', strtotime("yesterday")),
                'updated_at' => date('Y-m-d H:i:s', strtotime("yesterday"))
            ]
        ]);
    }
}
