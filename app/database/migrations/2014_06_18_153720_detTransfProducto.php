<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetTransfProducto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detTransfProd', function(Blueprint $tabla) 
        {
            $tabla->increments('id');            
			$tabla->integer('transferencia_id')->unsigned();
			$tabla->integer('producto_id');
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('transferencia_id')->references('id')->on('transferencia');
            $tabla->foreign('producto_id')->references('id')->on('producto');
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
