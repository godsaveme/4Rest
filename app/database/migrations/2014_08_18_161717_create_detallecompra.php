<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallecompra extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallecompra', function(Blueprint $table)
		{
			$table->decimal('cantidad',10,2);
			$table->decimal('costototal',10,2);
			$table->decimal('costou',10,2);
			$table->decimal('porcion',10,2);
			$table->decimal('presentacion');
			$table->decimal('total',10,2);
			$table->foreign('compra_id')->references('id')->on('compra');
			$table->foreign('insumo_id')->references('id')->on('insumo');
			$table->increments('id');
			$table->integer('compra_id')->unsigned();
			$table->integer('insumo_id');
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
		Schema::drop('detallecompra');
	}

}
