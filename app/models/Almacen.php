<?php

class Almacen extends Eloquent {

	protected $table = 'almacen';

	protected $guarded = array();

	protected $fillable = array('nombre','descripcion','restaurante_id','capacidad');

	public static $rules = array();

	public function restaurante(){
		return $this->belongsTo('Restaurante','restaurante_id');
	}
}