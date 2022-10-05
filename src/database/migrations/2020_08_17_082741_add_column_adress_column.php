<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAdressColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('address')->length(255)->after('tel')->comment('住所');
            $table->time('mon_start_time')->nullable()->after('longitude')->comment('月曜日営業開始時間');
            $table->time('mon_end_time')->nullable()->after('mon_start_time')->comment('月曜日営業終了時間');
            $table->time('tue_start_time')->nullable()->after('mon_end_time')->comment('火曜日営業開始時間');
            $table->time('tue_end_time')->nullable()->after('tue_start_time')->comment('火曜日営業終了時間');
            $table->time('wed_start_time')->nullable()->after('tue_end_time')->comment('水曜日営業開始時間');
            $table->time('wed_end_time')->nullable()->after('wed_start_time')->comment('水曜日営業終了時間');
            $table->time('thu_start_time')->nullable()->after('wed_end_time')->comment('木曜日営業開始時間');
            $table->time('thu_end_time')->nullable()->after('thu_start_time')->comment('木曜日営業終了時間');
            $table->time('fri_start_time')->nullable()->after('thu_end_time')->comment('金曜日営業開始時間');
            $table->time('fri_end_time')->nullable()->after('fri_start_time')->comment('金曜日営業終了時間');
            $table->time('sat_start_time')->nullable()->after('fri_end_time')->comment('土曜日営業開始時間');
            $table->time('sat_end_time')->nullable()->after('sat_start_time')->comment('土曜日営業終了時間');
            $table->time('sun_start_time')->nullable()->after('sat_end_time')->comment('日曜日営業開始時間');
            $table->time('sun_end_time')->nullable()->after('sun_start_time')->comment('日曜日営業終了時間');
            $table->time('hol_start_time')->nullable()->after('sun_end_time')->comment('祝日営業開始時間');
            $table->time('hol_end_time')->nullable()->after('hol_start_time')->comment('祝日営業終了時間');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
}
