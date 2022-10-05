<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_id')->nullable()->unsigned()->comment('購入履歴ID');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('set null');
            $table->string('product_no')->nullable()->comment('商品番号');
            $table->text('name')->nullable()->comment('商品名');
            $table->float('price', 8, 2)->comment('金額');
            $table->float('tax', 8, 2)->comment('税');
            $table->smallInteger('quantity')->comment('個数');
            $table->string('currency')->nullable()->comment('通貨');
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
        Schema::dropIfExists('purchase_products');
    }
}
