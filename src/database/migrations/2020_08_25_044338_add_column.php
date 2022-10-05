<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->nullable()->comment('商品');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('store_id')->unsigned()->nullable()->comment('店舗');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->integer('coupon_id')->unsigned()->nullable()->comment('クーポン');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->integer('information_id')->unsigned()->nullable()->comment('お知らせ');
            $table->foreign('information_id')->references('id')->on('informations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            //
        });
    }
}
