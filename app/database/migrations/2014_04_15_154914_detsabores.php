<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Detsabores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detsabores', function(Blueprint $table)
		{
			$table->integer('producto_id');
			$table->integer('sabor_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('producto');
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
