<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockProductoRepeat extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stockProducto', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->decimal('stockActual',10,2);
			$tabla->decimal('stockMin',10,2);
			$tabla->decimal('stockMax',10,2);
			$tabla->integer('producto_id');
			$tabla->integer('almacen_id')->unsigned();
			$tabla->foreign('almacen_id')->references('id')->on('almacen');
            $tabla->foreign('producto_id')->references('id')->on('producto');
            //$tabla->integer('almacen_id');

 
            //campos para controlar inserts y updates
            //created_at updated_at
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
