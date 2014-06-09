<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dias', function(Blueprint $tabla) 
        {
 
            $tabla->increments('id');            
			$tabla->integer('valor');
			$tabla->string('dia');
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
