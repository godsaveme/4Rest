<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreReceta extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prereceta', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
			$tabla->integer('preinsumo_id')->unsigned();
			//insumo id no es unsigned...
			$tabla->integer('insumo_id');
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('preinsumo_id')->references('id')->on('preInsumo');
			$tabla->foreign('insumo_id')->references('id')->on('insumo');            
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
