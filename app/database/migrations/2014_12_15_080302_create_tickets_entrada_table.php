<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsEntradaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets_entrada', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo');
			$table->integer('persona_id');
			$table->integer('cantidad_personas');
			$table->integer('tipo_ticket_id');
			$table->integer('subticket'); //0 -> no | 1 -> si
			$table->foreign('persona_id')->references('id')->on('persona');
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
		Schema::drop('tickets_entrada');
	}

}
