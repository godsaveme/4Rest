<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetTransferencia extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detTransferencia', function(Blueprint $tabla) 
        {
            $tabla->increments('id');            
			$tabla->integer('transferencia_id')->unsigned();
			$tabla->integer('preinsumo_id')->unsigned();
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('transferencia_id')->references('id')->on('transferencia');
            $tabla->foreign('preinsumo_id')->references('id')->on('preInsumo');
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
