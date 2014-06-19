<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transferencia extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transferencia', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->string('motivo');
            $tabla->string('comentarios');
            $tabla->tinyInteger('estado');
            $tabla->integer('almaceninicio_id')->unsigned();
			$tabla->foreign('almaceninicio_id')->references('id')->on('almacen');
            $tabla->integer('almacendestino_id')->unsigned();
			$tabla->foreign('almacendestino_id')->references('id')->on('almacen');
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
