<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SaborTable extends Migration {
	public function up()
	{
		Schema::create('sabor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->integer('insumo_id')->nullable();
			$table->foreign('insumo_id')->references('id')->on('insumo');
			$table->integer('porcion');
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
		Schema::drop('sabors');
	}

}
