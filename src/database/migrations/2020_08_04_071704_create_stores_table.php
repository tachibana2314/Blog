<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id')->comment('店舗ID');
            $table->string('name')->length(100)->comment('店舗名');
            $table->integer('zip_code')->nullable()->comment('郵便番号');
            $table->string('address1')->length(50)->comment('住所1');
            $table->string('address2')->length(50)->comment('住所2');
            $table->string('address3')->length(50)->comment('住所3');
            $table->integer('tel')->nullable()->comment('電話番号');
            $table->decimal('latitude', 15, 10)->comment('緯度');
            $table->decimal('longitude', 15, 10)->comment('経度');
            $table->time('start_time')->comment('営業開始時間');
            $table->time('end_time')->comment('営業終了時間');
            $table->smallInteger('cafe_flg')->nullable()->comment('カフェ（1. あり）');
            $table->smallInteger('wine_flg')->nullable()->comment('ワイン（1. あり）');
            $table->smallInteger('oven_flg')->nullable()->comment('オーブン（1. あり）');
            $table->smallInteger('status')->nullable()->comment('1. 公開　2. 非公開');
            $table->text('description')->nullable()->comment('説明文・備考');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
