<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('link')->nullable();
            $table->string('file')->nullable();
            $table->string('genre');
            $table->string('author');
            $table->longText('description');
            $table->boolean('english');
            $table->integer('user_id');
            $table->integer('profile_id');
            $table->enum('status', ['paid', 'pending','cancel','critized']);
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
        Schema::dropIfExists('songs');
    }
}
