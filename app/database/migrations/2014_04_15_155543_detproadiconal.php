<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Detproadiconal extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detproadicional', function(Blueprint $table)
		{
			$table->integer('producto_id');
			$table->integer('proadi_id');
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->foreign('proadi_id')->references('id')->on('producto');
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
