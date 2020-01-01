<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('amount');
            $table->string('total');
            $table->string('method');
            $table->string('reference')->nullable();
            $table->string('expires_at')->nullable();
            $table->integer('review_id')->nullable();
            $table->integer('song_id');
            $table->integer('user_id');
            $table->string('status');
            $table->integer('coupon_id')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
