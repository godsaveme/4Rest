<?php

class Receta extends Eloquent {

	protected $table = 'receta';

	protected $fillable = array('producto_id','insumo_id','cantidad','precio','created_at','updated_at');

	protected $guarded = array();

	public static $rules = array();
}
