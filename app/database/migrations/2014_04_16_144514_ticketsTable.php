<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticketventa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('serie');
			$table->integer('numero');
			$table->decimal('importe', 5, 2);
			$table->decimal('descuento', 5, 2);
			$table->integer('caja_id')->nullable();
			$table->foreign('caja_id')->references('id')->on('caja');
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
