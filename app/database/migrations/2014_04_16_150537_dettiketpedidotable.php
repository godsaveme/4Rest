<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DettiketpedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dettiketpedido', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pedido_id');
			$table->integer('ticket_id')->nullable()->unsigned();
			$table->string('nombre');
			$table->decimal('precio',5, 2);
			$table->decimal('preciou',5, 2);
			$table->integer('cantidad');
			$table->integer('combinacion_id')->nullable();
			$table->decimal('descuento',5, 2);
			$table->foreign('combinacion_id')->references('id')->on('combinacion');
			$table->foreign('ticket_id')->references('id')->on('ticketventa');
			$table->foreign('pedido_id')->references('id')->on('pedido');
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
