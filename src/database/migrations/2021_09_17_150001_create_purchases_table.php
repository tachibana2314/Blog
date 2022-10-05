<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('purchase_no')->nullable()->comment('購入番号');
            $table->string('cashier_no')->nullable()->comment('端末番号');
            $table->string('staff_no')->nullable()->comment('社員番号');
            $table->integer('purchase_timestamp')->nullable()->comment('購入日時（タイムスタンプ）');
            $table->float('sub_total', 8, 2)->nullable()->comment('小計');
            $table->float('tax', 8, 2)->nullable()->comment('税');
            $table->float('total', 8, 2)->nullable()->comment('合計');
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
        Schema::dropIfExists('purchases');
    }
}
