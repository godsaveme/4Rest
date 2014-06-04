<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipodeGastoTable extends Migration {

	public function up()
	{
		Schema::create('tipodegasto', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion');
			$table->timestamps();
		});
	}
	public function down()
	{
		//
	}

}
