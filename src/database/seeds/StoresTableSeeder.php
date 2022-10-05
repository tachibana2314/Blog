<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            [
                'id' => 1,
                'name' => 'Chateraise Scotts',
                'address' => '350 Orchard Road Shaw House Singapore 238868 B1F',
                'tel' => '+65 8280 3594',
                'latitude' => 1.305645,
                'longitude' => 103.831528,
                'mon_start_time' => '10:00',
                'mon_end_time' => '21:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '21:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '21:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '21:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '21:30',
                'sat_start_time' => '10:00',
                'sat_end_time' => '21:30',
                'sun_start_time' => '10:00',
                'sun_end_time' => '21:30',
                'hol_start_time' => '10:00',
                'hol_end_time' => '21:30',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'Chateraise Novena Square 2',
                'address' => '10 Sinaran Drive #01-36/41 Square 2 Singapore 307506',
                'tel' => '+65 6352 7990',
                'latitude' => 1.320651,
                'longitude' => 103.844369,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'name' => 'Chateraise Chinatown Point',
                'address' => '133 New bridge Road ♯1・40 Chinatown Point',
                'tel' => '+65 6444 7262',
                'latitude' => 1.285209,
                'longitude' => 103.844723,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'name' => 'Chateraise Serangoon Nex',
                'address' => '23 Serangoon Central, Nex, #B2-49A Singapore 556083',
                'tel' => '+65 6634 0014',
                'latitude' => 1.285209,
                'longitude' => 103.844723,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'name' => 'Chateraise Hillion Mall',
                'address' => '10 Jelebu Rd,Singapore 678270 #B1-44',
                'tel' => '+65 6266 2056',
                'latitude' => 1.378640,
                'longitude' => 103.764239,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => 1,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'name' => 'Chateraise Tampines 1',
                'address' => '10 Tampines Central 1 #01-60 Singapore 529536',
                'tel' => '+65 6509 8803',
                'latitude' => 1.354212,
                'longitude' => 103.945035,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'name' => 'Chateraise Toa Payoh HDB Hub',
                'address' => 'BLK 490 Toa Payoh Lorong 6 #01-15,Singapore 310490',
                'tel' => '+65 6266 0858',
                'latitude' => 1.332700,
                'longitude' => 103.848561,
                'mon_start_time' => '09:00',
                'mon_end_time' => '21:30',
                'tue_start_time' => '09:00',
                'tue_end_time' => '21:30',
                'wed_start_time' => '09:00',
                'wed_end_time' => '21:30',
                'thu_start_time' => '09:00',
                'thu_end_time' => '21:30',
                'fri_start_time' => '09:00',
                'fri_end_time' => '21:30',
                'sat_start_time' => '09:00',
                'sat_end_time' => '21:30',
                'sun_start_time' => '09:00',
                'sun_end_time' => '21:30',
                'hol_start_time' => '09:00',
                'hol_end_time' => '21:30',
                'cafe_flg' => 1,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'name' => 'Chateraise AMK Hub',
                'address' => '53 Ang Mo Kio Avenue 3 #01-06 Singapore 569933',
                'tel' => '+65 6481 3110',
                'latitude' => 1.369530,
                'longitude' => 103.848440,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'name' => 'Chateraise Ion Orchard',
                'address' => '2 Orchard Turn #B4-45/46 Singapore 238801',
                'tel' => '+65 6904 9409',
                'latitude' => 1.303929,
                'longitude' => 103.831951,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'name' => 'Chateraise Clementi Mall',
                'address' => '#B1-03/04 3155 Commonwealth Avenue West Singapore 129588',
                'tel' => '+65 6694 4612',
                'latitude' => 1.314918,
                'longitude' => 103.764309,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'name' => 'Chateraise Junction 8',
                'address' => '9 Bishan Place #B1-19B Junction Shopping centre Singapore 579837',
                'tel' => '+65 6734 4355',
                'latitude' => 1.350681,
                'longitude' => 103.848763,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'name' => 'Chateraise Compass One',
                'address' => 'No.1 sengkang square,Compass One #03-39/40/41 Singapore 545078',
                'tel' => '+65 6386 5436',
                'latitude' => 1.392207,
                'longitude' => 103.895249,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => 1,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'name' => 'Chateraise Sun Plaza',
                'address' => '30 Sembawang Drive #01-07 Sun Plaza Singapore 757713',
                'tel' => '+65 9625 2806',
                'latitude' => 1.448268,
                'longitude' => 103.819689,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'name' => 'Chateraise Lot 1',
                'address' => '21 Choa Chu Kang Avenue 4 #B1-15 Singapore 689812',
                'tel' => '+65 6769 0676',
                'latitude' => 1.385209,
                'longitude' => 103.744937,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'name' => 'Chateraise Kampung Admiralty',
                'address' => '#01-08 Kampung Admiralty, Blk 676 Woodlands Drive 71, Singapore 730676',
                'tel' => '+65 6252 5863',
                'latitude' => 1.439603,
                'longitude' => 103.800777,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'name' => 'Chateraise Singapore Post Centre',
                'address' => '#01-134/135, SINGAPORE POST CENTRE, 10 Eunos Road 8 SINGAPORE 408600',
                'tel' => '+65 6747 0560',
                'latitude' => 1.318912,
                'longitude' => 103.894535,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => 1,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 17,
                'name' => 'Chateraise Changi City Point',
                'address' => '5 Changi Business Park Central Changi City Point B1/22 486038',
                'tel' => '+65 6443 1429',
                'latitude' => 1.334638,
                'longitude' => 103.962387,
                'mon_start_time' => '10:30',
                'mon_end_time' => '21:30',
                'tue_start_time' => '10:30',
                'tue_end_time' => '21:30',
                'wed_start_time' => '10:30',
                'wed_end_time' => '21:30',
                'thu_start_time' => '10:30',
                'thu_end_time' => '21:30',
                'fri_start_time' => '10:30',
                'fri_end_time' => '21:30',
                'sat_start_time' => '10:30',
                'sat_end_time' => '21:30',
                'sun_start_time' => '10:30',
                'sun_end_time' => '21:30',
                'hol_start_time' => '10:30',
                'hol_end_time' => '21:30',
                'cafe_flg' => null,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 18,
                'name' => 'Chateraise North Point City',
                'address' => '#01-152, 1 NORTHPOINT DRIVE, NORTHPOINT CITY SINGAPORE 768019',
                'tel' => '+65 6873 2088',
                'latitude' => 1.428473,
                'longitude' => 103.835986,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:30',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:30',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:30',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:30',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:30',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:30',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:30',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:30',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 19,
                'name' => 'Chateraise Seletar Mall',
                'address' => 'Unit No.#B2-19/20, 33 Sengkang west avenue, the Seletar mall, Singapore 797653',
                'tel' => '+65 6904 9582',
                'latitude' => 1.391521,
                'longitude' => 103.876083,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 20,
                'name' => 'Chateraise Causeway Point',
                'address' => '1 Woodlands Square, Singapore 738099',
                'tel' => '+65 6760 0389',
                'latitude' => 1.436093,
                'longitude' => 103.785947,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => 1,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 21,
                'name' => 'Chateraise Oasis Terraces',
                'address' => 'Blk 681 Punggol drive #02-11 Singapore 820681',
                'tel' => '+65 6244 8481',
                'latitude' => 1.405090,
                'longitude' => 103.908671,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => 1,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 22,
                'name' => 'Chateraise Jurong Point',
                'address' => 'Jurong West Central 2 #B1-21 Jurong Point Shopping Centre Singapore 648886',
                'tel' => '+65 6254 4318',
                'latitude' => 1.339744,
                'longitude' => 103.706730,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 23,
                'name' => 'Chateraise West Mall',
                'address' => '1 Bukit Batok Central Link #01-06,Singapore 658713',
                'tel' => '+65 6252 2274',
                'latitude' => 1.350011,
                'longitude' => 103.749285,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 24,
                'name' => 'Chateraise Tiong Bahru Plaza',
                'address' => '302 TiongBahru Rd Tiong Bahru Plaza B1-127 Singapore 168732',
                'tel' => '+65 6970 9818',
                'latitude' => 1.286621,
                'longitude' => 103.826909,
                'mon_start_time' => '10:00',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:00',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:00',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:00',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:00',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:00',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:00',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:00',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 25,
                'name' => 'Chateraise Westgate',
                'address' => '3 Gateway Dr, Singapore 608532 B1-24',
                'tel' => '+65 6252 8525',
                'latitude' => 1.334378,
                'longitude' => 103.742784,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => 1,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 26,
                'name' => 'Chateraise Bedok Mall',
                'address' => '311 New Upper Changi Road #B2-19, Singapore 467360',
                'tel' => null,
                'latitude' => 1.324592,
                'longitude' => 103.929263,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 27,
                'name' => 'Chateraise Parkway Parade',
                'address' => '#03-30B, 80 Marine Parade Rd, #B1-78/79 Parkway Parade, Singapore 449269',
                'tel' => null,
                'latitude' => 1.301100,
                'longitude' => 103.892745,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 28,
                'name' => 'Chateraise Waterway Point',
                'address' => 'Waterway Point #B1-01, 83 Punggol Central, Singapore 828761',
                'tel' => null,
                'latitude' => 1.406690,
                'longitude' => 103.902174,
                'mon_start_time' => '10:30',
                'mon_end_time' => '22:00',
                'tue_start_time' => '10:30',
                'tue_end_time' => '22:00',
                'wed_start_time' => '10:30',
                'wed_end_time' => '22:00',
                'thu_start_time' => '10:30',
                'thu_end_time' => '22:00',
                'fri_start_time' => '10:30',
                'fri_end_time' => '22:00',
                'sat_start_time' => '10:30',
                'sat_end_time' => '22:00',
                'sun_start_time' => '10:30',
                'sun_end_time' => '22:00',
                'hol_start_time' => '10:30',
                'hol_end_time' => '22:00',
                'cafe_flg' => null,
                'wine_flg' => null,
                'oven_flg' => null,
                'status' => 1,
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
