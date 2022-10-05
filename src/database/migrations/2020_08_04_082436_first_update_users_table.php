<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FirstUpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('first_name')->length(100)->comment('名')->after('password');
            $table->string('last_name')->length(100)->comment('姓')->after('first_name');
            $table->smallInteger('gender')->nullable()->comment('性別（1. 男性　2. 女性）')->after('last_name');
            $table->date('birthday')->nullable()->comment('生年月日')->after('gender');
            $table->timestamp('logged_in_at')->nullable()->comment('最終ログイン日時')->after('remember_token');
            $table->timestamp('left_at')->nullable()->comment('退会日時')->after('logged_in_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('logged_in_at');
            $table->dropColumn('left_at');
            $table->dropColumn('deleted_at');
        });
    }
}
