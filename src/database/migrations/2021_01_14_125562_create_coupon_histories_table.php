<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_histories', function (Blueprint $table) {
            $table->increments('id')->comment('クーポン使用履歴ID');
            $table->bigInteger('user_id')->unsigned()->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('coupon_id')->unsigned()->nullable()->comment('クーポンID');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->integer('stamp_coupon_id')->unsigned()->nullable()->comment('クーポンID');
            $table->foreign('stamp_coupon_id')->references('id')->on('stamp_coupons')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_histories');
    }
}
