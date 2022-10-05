<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStampCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamp_coupons', function (Blueprint $table) {
            $table->increments('id')->comment('クーポンID');
            $table->string('title')->length(100)->comment('タイトル');
            $table->text('path_main')->comment('メイン画像のパス');
            $table->text('path_sub')->comment('サブ画像のパス');
            $table->text('description')->nullable()->comment('説明');
            $table->text('barcode')->nullable()->comment('バーコード画像のパス');
            $table->integer('stamp_count')->comment('セットスタンプ数');
            $table->integer('card_id')->nullable()->comment('スタンプカードID');
            $table->smallInteger('status')->comment('1. 公開　2. 非公開');
            $table->integer('use_period')->nullable()->comment('ご利用期間');
            // $table->date('release_date')->comment('公開日');
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
        Schema::dropIfExists('stamp_coupons');
    }
}
