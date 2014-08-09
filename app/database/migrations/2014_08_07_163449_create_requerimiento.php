<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequerimiento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requerimiento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('areaproduccion_id')->unsigned();
			$table->integer('ordendeproduccion_id')->unsigned();
			$table->string('descripcion');
			$table->string('observacion');
			$table->boolean('estado');
			$table->timestamp('fechatermino');
			$table->timestamp('fechadecancelacion');
			$table->foreign('areaproduccion_id')->references('id')->on('areadeproduccion');
			$table->foreign('ordendeproduccion_id')->references('id')->on('ordendeproduccion');
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
		Schema::drop('requerimiento');
	}

}
