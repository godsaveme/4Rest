<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HorComb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('horComb', function(Blueprint $tabla) 
        {

            $tabla->increments('id');
            $tabla->timestamp('FechaInicio');
            $tabla->timestamp('FechaTermino');
			$tabla->integer('combinacion_id')->nullable();
			$tabla->foreign('combinacion_id')->references('id')->on('combinacion');
            $tabla->timestamps();
 
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
