<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetNotaAlmacen extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detNotaAlmacen', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->integer('preinsumo_id')->unsigned();
            $tabla->integer('notaalmacen_id')->unsigned();
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('preinsumo_id')->references('id')->on('preInsumo');
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
