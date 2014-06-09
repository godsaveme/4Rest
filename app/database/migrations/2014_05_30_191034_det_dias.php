<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetDias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('det_dias', function(Blueprint $tabla) 
        {

            $tabla->increments('id');
            $tabla->integer('horcomb_id')->unsigned();
            $tabla->integer('dias_id')->unsigned();
			$tabla->foreign('horcomb_id')->references('id')->on('horComb');
			$tabla->foreign('dias_id')->references('id')->on('dias');			
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
