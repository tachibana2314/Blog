<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_m_allergies', function (Blueprint $table) {
            $table->increments('id')->comment('商品アレルギーID');
            $table->integer('product_id')->unsigned()->comment('商品ID');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('m_allergy_id')->unsigned()->comment('アレルギーマスタID');
            $table->foreign('m_allergy_id')->references('id')->on('m_allergies');
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
        Schema::dropIfExists('product_m_allergies');
    }
}
