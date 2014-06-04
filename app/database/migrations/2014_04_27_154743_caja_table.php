<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CajaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caja', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion');
			$table->boolean('estado');
			$table->integer('restaurante_id');
			$table->timestamps();
			$table->foreign('restaurante_id')->references('id')->on('restaurante');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
