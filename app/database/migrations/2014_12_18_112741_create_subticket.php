<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubticket extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subticket', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('postfijo');
			$table->decimal('costo',10,2);
			$table->string('estado');
			$table->integer('tickets_entrada_id')->unsigned();
			$table->foreign('tickets_entrada_id')->references('id')->on('tickets_entrada');
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
		Schema::drop('subticket');
	}

}
