<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id')->comment('管理者ID');
            $table->string('email')->length(100)->unique()->comment('メールアドレス');
            $table->string('password')->length(100)->comment('パスワード');
            $table->string('first_name')->length(100)->comment('名');
            $table->string('last_name')->length(100)->comment('姓');
            $table->string('first_name_kana')->length(100)->comment('メイ');
            $table->string('last_name_kana')->length(100)->comment('セイ');
            $table->string('department')->length(100)->nullable()->comment('部署');
            $table->string('position')->length(100)->nullable()->comment('役職');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
