<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetTransfInsumo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detTransfIns', function(Blueprint $tabla) 
        {
            $tabla->increments('id');            
			$tabla->integer('transferencia_id')->unsigned();
			$tabla->integer('insumo_id');
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('transferencia_id')->references('id')->on('transferencia');
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
