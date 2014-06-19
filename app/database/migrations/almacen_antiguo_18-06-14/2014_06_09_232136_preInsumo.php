<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreInsumo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('preInsumo', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->string('nombre');
            $tabla->string('descripcion');
            $tabla->tinyInteger('estado');
            $tabla->integer('unidad_id')->unsigned();
			$tabla->foreign('unidad_id')->references('id')->on('unidades');
            //ejm: Unidades, Litros, Kilos, Porciones, Cucharadas, etc.
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
