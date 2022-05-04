<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('picture')->nullable();
			$table->string('expertice');
			$table->string('phone');
			$table->longtext('summary');
			$table->string('genre');
			$table->integer('user_id');
			$table->string('paypal')->nullable();
			$table->string('pricing')->nullable();
			$table->string('status')->default('pending');
			$table->boolean('vip')->default(false);
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
		Schema::dropIfExists('profiles');
	}
}
