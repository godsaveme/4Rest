<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreInsumo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preInsumo', function(Blueprint $tabla) 
        {
            $tabla->increments('id');            
			$tabla->integer('insumo_id');
			$tabla->integer('preinsumo_id');
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('insumo_id')->references('id')->on('insumo');
            $tabla->foreign('preinsumo_id')->references('id')->on('insumo');
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
