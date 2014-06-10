<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockPreInsumo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('stockPreInsumo', function(Blueprint $tabla) 
        {
            $tabla->increments('id');
            $tabla->decimal('stockActual',10,2);
			$tabla->decimal('stockMin',10,2);
			$tabla->decimal('stockMax',10,2);
			$tabla->integer('preinsumo_id')->unsigned();
			$tabla->integer('almacen_id')->unsigned();
			$tabla->foreign('almacen_id')->references('id')->on('almacen');
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
