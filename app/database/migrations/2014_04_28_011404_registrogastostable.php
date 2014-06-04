<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Registrogastostable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registrogastoscaja', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tipogasto_id')->unsigned();
			$table->decimal('importetotal', 5,2);
			$table->decimal('subtotal', 5,2)->nullable();
			$table->decimal('igv', 5,2)->nullable();
			$table->string('seriecomprobante')->nullable();
			$table->string('numerocomprobante')->nullable();
			$table->string('numerocargo')->nullable();
			$table->integer('detallecaja_id')->nullable();
			$table->string('descripcion')->nullable();
			$table->timestamps();
			$table->foreign('tipogasto_id')->references('id')->on('tipodegasto');
			$table->foreign('detallecaja_id')->references('id')->on('detallecaja');
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
