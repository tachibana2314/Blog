<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id')->comment('スライドID');
            $table->text('pic_path')->comment('写真のパス');
            $table->smallInteger('status')->comment('1. 公開　2. 非公開');
            $table->smallInteger('order')->nullable()->comment('表示順');
            $table->string('url')->length(100)->nullable()->comment('外部リンクへのURL');
            $table->integer('type')->nullable()->comment('1. お知らせ 2. 商品 3. クーポン 4. 店舗');
            $table->integer('content_id')->nullable()->comment('コンテントのID');
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
        Schema::dropIfExists('slides');
    }
}
