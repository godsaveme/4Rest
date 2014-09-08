<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleodendeproduccion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalleodendeproduccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('producto_id');
			$table->integer('ordendeproduccion_id')->unsigned();
			$table->decimal('cantidad');
			$table->timestamp('fechainicio');
			$table->timestamp('fechacencelacion');
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->foreign('ordendeproduccion_id')->references('id')->on('ordendeproduccion');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detalleodendeproduccion');
	}

}
