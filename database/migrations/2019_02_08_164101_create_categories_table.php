<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('label');
            $table->string('label_en');
            $table->string('instructions')->nullable();
            $table->string('instructions_en')->nullable();
            $table->string('type');
            $table->integer('order');
            $table->integer('importance');
            $table->enum('subject', ['music', 'social-networks']);
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
        Schema::dropIfExists('categories');
    }
}
