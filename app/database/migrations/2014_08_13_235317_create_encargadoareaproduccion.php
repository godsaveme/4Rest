<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEncargadoareaproduccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('encargadoareaproduccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('areaproduccion_id')->unsigned();
			$table->integer('usuario_id')->unsigned();
			$table->foreign('areaproduccion_id')->references('id')->on('areadeproduccion');
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
		Schema::drop('encargadoareaproduccion');
	}

}
