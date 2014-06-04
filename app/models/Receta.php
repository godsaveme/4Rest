<?php

class Receta extends Eloquent {

	protected $table = 'Receta';

	protected $fillable = array('producto_id','insumo_id','cantidad','created_at','updated_at');

	protected $guarded = array();

	public static $rules = array();
}
