<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableordendeproduccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordendeproduccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('areaproduccion_id')->unsigned();
			$table->string('descripcion');
			$table->string('observacion');
			$table->timestamp('fechacancelacion');
			$table->timestamp('fechainicio');
			$table->foreign('areaproduccion_id')->references('id')->on('areadeproduccion');
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
		Schema::drop('tableordendeproduccion');
	}

}
