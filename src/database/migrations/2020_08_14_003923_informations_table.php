<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->increments('id')->comment('お知らせID');
            $table->string('title')->length(100)->comment('タイトル');
            $table->text('body')->comment('本文');
            $table->text('pic_path')->nullable()->comment('写真のパス');
            $table->smallInteger('status')->comment('1. 公開　2. 非公開');
            $table->date('release_date')->nullable()->comment('リリース日');
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
        Schema::dropIfExists('informations');
    }
}
