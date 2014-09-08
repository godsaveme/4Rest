<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdencompra extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordencompra', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('area_id')->unsigned();
			$table->timestamp('fechainicio');
			$table->timestamp('fechatermino');
			$table->timestamp('fechacancelacion');
			$table->boolean('estado')->default(0);
			$table->integer('usuario_id')->unsigned();
			$table->foreign('area_id')->references('id')->on('areadeproduccion');
			$table->foreign('usuario_id')->references('id')->on('usuario');
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
		Schema::drop('ordencompra');
	}

}
