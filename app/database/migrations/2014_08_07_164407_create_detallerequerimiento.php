<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallerequerimiento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallerequerimiento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('insumo_id');
			$table->integer('requerimiento_id')->unsigned();
			$table->decimal('cantidad');
			$table->decimal('centidadentregada');
			$table->timestamp('fechainicio');
			$table->timestamp('fechaproceso');
			$table->timestamp('fechadespacho');
			$table->timestamp('fecharecepcion');
			$table->timestamp('fechacancelacion');
			$table->integer('estado');
			$table->foreign('insumo_id')->references('id')->on('insumo');
			$table->foreign('requerimiento_id')->references('id')->on('requerimiento');
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
		Schema::drop('detallerequerimiento');
	}

}
