<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetNotaAlmProd extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detNotaAlmProd', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->integer('producto_id');
            $tabla->integer('notaalmacen_id')->unsigned();
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('producto_id')->references('id')->on('producto');
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
