<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPointGiftIdToPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('points', function (Blueprint $table) {
            $table->dropForeign('points_product_id_foreign');
            $table->dropColumn('product_id');
            $table->integer('point_gift_id')->nullable()->unsigned()->comment('ポイント景品ID')->after('purchase_id');
            $table->foreign('point_gift_id')->references('id')->on('point_gifts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('points', function (Blueprint $table) {
            $table->dropColumn('point_gift_id');
            $table->integer('product_id')->nullable()->unsigned()->comment('商品ID')->after('purchase_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
        });
    }
}
