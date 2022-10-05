<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_gifts', function (Blueprint $table) {
            $table->increments('id')->comment('ポイント景品ID');
            $table->string('name')->length(100)->comment('商品名');
            $table->text('description')->comment('説明');
            $table->smallInteger('status')->comment('1. 公開　2. 非公開');
            $table->smallInteger('order')->nullable()->comment('表示順（ランキング）');
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
        Schema::dropIfExists('point_gifts');
    }
}
