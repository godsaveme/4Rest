<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallemotivo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallemotivo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tiporesponsable_id');
			$table->integer('detallepedido');
			$table->string('descripcion');
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
		Schema::drop('detallemotivo');
	}

}
