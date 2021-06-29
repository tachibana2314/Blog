<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id')->comment('記事コンテンツID');
            $table->string('title')->comment('タイトル');
            $table->text('body')->comment('本文');
            $table->string('image_path')->nullable()->comment('サムネイル画像');
            $table->unsignedInteger('category_id')->nullable()->comment('記事カテゴリID');
            $table->unsignedInteger('tag_id')->nullable()->comment('記事タグID');
            $table->unsignedInteger('seq')->nullable()->comment('表示順');
            $table->date('release_date')->nullable()->comment('公開日');
            $table->smallInteger('headline_flg')->nullable()->comment('見出し記事（1.あり、2.なし）');
            $table->smallInteger('release_status')->nullable()->comment('公開ステータス（1.公開、2.非公開）');
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
        Schema::dropIfExists('contents');
    }
}
