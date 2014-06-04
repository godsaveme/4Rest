<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetprecioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detprecio', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('restaurante_id');
			$table->integer('precio_id');
			$table->timestamps();
			$table->foreign('restaurante_id')->references('id')->on('restaurante');
			$table->foreign('precio_id')->references('id')->on('precio');
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
