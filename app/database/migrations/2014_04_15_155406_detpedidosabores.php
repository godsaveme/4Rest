<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetpedidosaboresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detpedidosabores', function(Blueprint $table)
		{
			$table->integer('detpedido_id');
			$table->integer('sabor_id')->unsigned();
			$table->foreign('detpedido_id')->references('id')->on('detallepedido');
			$table->foreign('sabor_id')->references('id')->on('sabor');
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
