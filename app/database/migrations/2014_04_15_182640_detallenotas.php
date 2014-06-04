<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Detallenotasrr extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallenotas', function(Blueprint $table)
		{
			$table->integer('detallePedido_id');
			$table->integer('notas_id');
			$table->foreign('detallePedido_id')->references('id')->on('detallepedido');
			$table->foreign('notas_id')->references('id')->on('notas');
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
		//
	}

}
