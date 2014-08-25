<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompra extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('compra', function(Blueprint $table)
		{
			$table->decimal('igv',10,2);
			$table->decimal('importetotal',10,2);
			$table->decimal('subtotal',10,2);
			$table->foreign('provedor_id')->references('id')->on('persona');
			$table->foreign('tipocomprobante_id')->references('id')->on('tipodocumento');
			$table->increments('id');
			$table->integer('provedor_id');
			$table->integer('tipocomprobante_id')->unsigned();
			$table->string('numero');
			$table->string('serie');
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
		Schema::drop('compra');
	}

}
