<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotaAlmacen extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('notaAlmacen', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->string('motivo');
            $tabla->string('comentarios');
            $tabla->tinyInteger('estado');
            $tabla->integer('almacen_id')->unsigned();
			$tabla->foreign('almacen_id')->references('id')->on('almacen');
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
