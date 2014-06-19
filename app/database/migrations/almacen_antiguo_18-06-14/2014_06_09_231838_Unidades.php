<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Unidades extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('unidad', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->string('nombre');
            $tabla->string('descripcion');
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
