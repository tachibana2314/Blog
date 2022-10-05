<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('password')->length(100)->nullable()->comment('パスワード')->change();
            $table->string('first_name')->length(100)->nullable()->comment('名')->change();
            $table->string('last_name')->length(100)->nullable()->comment('姓')->change();
            $table->string('first_name_kana')->length(100)->nullable()->comment('メイ')->change();
            $table->string('last_name_kana')->length(100)->nullable()->comment('セイ')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('password')->length(100)->comment('パスワード')->change();
            $table->string('first_name')->length(100)->comment('名')->change();
            $table->string('last_name')->length(100)->comment('姓')->change();
            $table->string('first_name_kana')->length(100)->comment('メイ')->change();
            $table->string('last_name_kana')->length(100)->comment('セイ')->change();
        });
    }
}
