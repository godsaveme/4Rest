<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetformadepagoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Detformadepago', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('formadepago_id')->unsigned()->nullable();
			$table->integer('ticket_id')->unsigned()->nullable();
			$table->decimal('importe',5,2);
			$table->string('codigotarjeta');
			$table->string('codigovale');
			$table->timestamps();
			$table->foreign('formadepago_id')->references('id')->on('formadepago');
			$table->foreign('ticket_id')->references('id')->on('ticketventa');
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
