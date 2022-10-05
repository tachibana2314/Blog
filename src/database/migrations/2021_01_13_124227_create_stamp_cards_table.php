<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStampCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamp_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->length(100)->comment('タイトル');
            $table->text('description')->nullable()->comment('説明');
            $table->integer('stamp_count')->comment('トータルスタンプ数');
            $table->date('start_date')->nullable()->comment('ご利用開始日');
            $table->date('end_date')->nullable()->comment('ご利用期限日');
            $table->date('release_date')->nullable()->comment('公開日');
            $table->smallInteger('status')->comment('1. 公開　2. 非公開');
            // $table->integer('coupon_id')->nullable()->comment('セットクーポンID');
            // $table->integer('set_card_number')->nullable()->comment('スタンプカード順番');
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
        Schema::dropIfExists('stamp_cards');
    }
}
