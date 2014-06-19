<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreProducto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preProducto', function(Blueprint $tabla) 
        {
            $tabla->increments('id');            
			$tabla->integer('producto_id');
			$tabla->integer('preproducto_id');
			$tabla->decimal('cantidad',10,2);
			$tabla->foreign('producto_id')->references('id')->on('producto');
            $tabla->foreign('preproducto_id')->references('id')->on('producto');
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
