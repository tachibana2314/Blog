<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->comment('商品ID');
            $table->string('name')->length(100)->comment('商品名');
            $table->integer('m_product_category_id')->unsigned()->comment('カテゴリー');
            $table->foreign('m_product_category_id')->references('id')->on('m_allergies')->onDelete('cascade');
            $table->double('price', 6, 2)->comment('価格総桁6の小数点2行以内）');
            $table->text('description')->comment('説明');
            $table->double('calory', 6, 2)->nullable()->comment('カロリー（総桁6の小数点2行以内）');
            $table->smallInteger('status')->comment('1. 公開　2. 非公開');
            $table->smallInteger('order')->nullable()->comment('表示順（ランキング）');
            $table->string('url')->length(100)->nullable()->comment('外部リンクへのURL');
            $table->smallInteger('limited_flg')->nullable()->comment('1. 期間限定商品（limited）');
            $table->date('start_date')->nullable()->comment('開始期間（期間限定商品の場合）');
            $table->date('end_date')->nullable()->comment('終了期間（期間限定商品の場合）');
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
        Schema::dropIfExists('m_allergies');
        Schema::dropIfExists('products');
    }
}
