<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->bigInteger('purchase_id')->nullable()->unsigned()->comment('購入履歴ID');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('set null');
            $table->float('amount', 8, 2)->nullable()->comment('獲得ポイント');
            $table->float('residue', 8, 2)->nullable()->comment('ポイント残高');
            $table->float('use', 8, 2)->nullable()->comment('消費ポイント');
            $table->dateTime('acquired_at')->nullable()->comment('獲得日時');
            $table->dateTime('expired_at')->nullable()->comment('失効日時');
            $table->dateTime('used_at')->nullable()->comment('使用日時');
            $table->smallInteger('type')->nullable()->unsigned()->comment('種別（1:取得、2:消費）');
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
        Schema::dropIfExists('points');
    }
}
