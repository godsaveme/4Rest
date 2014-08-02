<?php

class Preproducto extends \Eloquent {
	protected $table = 'preProducto';
	protected $fillable = array('producto_id','preproducto_id','cantidad','created_at','updated_at');
	protected $guarded = array();
	public static $rules = array();
}