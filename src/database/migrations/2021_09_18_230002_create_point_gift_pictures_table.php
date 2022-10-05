<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointGiftPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_gift_pictures', function (Blueprint $table) {
            $table->increments('id')->comment('写真ID');
            $table->integer('point_gift_id')->unsigned()->comment('ポイント景品ID');
            $table->foreign('point_gift_id')->references('id')->on('point_gifts')->onDelete('cascade');
            $table->text('path')->comment('画像のパス');
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
        Schema::dropIfExists('point_gift_pictures');
    }
}
