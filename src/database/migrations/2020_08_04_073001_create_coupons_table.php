<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id')->comment('クーポンID');
            $table->string('title')->length(100)->comment('タイトル');
            $table->integer('product_id')->unsigned()->comment('商品');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->text('description')->nullable()->comment('説明');
            $table->smallInteger('status')->comment('1. 公開　2. 非公開');
            $table->smallInteger('type')->comment('1. 通常クーポン 2. 誕生日クーポン');
            $table->date('start_date')->nullable()->comment('ご利用開始日');
            $table->date('end_date')->nullable()->comment('ご利用期限日');
            $table->date('release_date')->comment('リリース日');
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
        Schema::dropIfExists('coupons');
    }
}
