<?php

class Precio extends Eloquent {
	protected $table = 'precio';
	protected $guarded = array();
	protected $fillable = array('producto_id','combinacion_id', 'precio', 'seleccionador','created_at','updated_at'); 
	public static $rules = array();
}
