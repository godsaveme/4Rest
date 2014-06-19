<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetNotaAlmIns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detNotaAlmIns', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->integer('insumo_id');
            $tabla->integer('notaalmacen_id')->unsigned();
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('insumo_id')->references('id')->on('insumo');
            $tabla->foreign('notaalmacen_id')->references('id')->on('notaAlmacen');
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
