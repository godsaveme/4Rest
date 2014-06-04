<?php

class Notasxproductos extends Eloquent {
	protected $table = 'notaxproducto';
	protected $fillable = array('producto_id', 'nota_id', 'created_at', 'updated_at');
	protected $guarded = array();
	public static $rules = array();
}
