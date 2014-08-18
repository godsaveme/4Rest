<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleordendecompra extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalleordendecompra', function(Blueprint $table)
		{
			$table->boolean('estado')->default(0);
			$table->decimal('cantidad',10,5);
			$table->decimal('cantidadcomprada',10,5);
			$table->foreign('insumo_id')->references('id')->on('insumo');
			$table->foreign('ordendecompra_id')->references('id')->on('ordencompra');
			$table->increments('id');
			$table->integer('compra_id')->unsigned()->nullable();
			$table->integer('insumo_id');
			$table->integer('ordendecompra_id')->unsigned();
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
		Schema::drop('detalleordendecompra');
	}

}
