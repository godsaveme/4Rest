<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AreadeProduccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areadeproduccion', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nombre');
			$table->string('descripcion');
			$table->integer('id_tipo');
			$table->integer('id_restaurante');
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
		Schema::drop('');
	}

}
