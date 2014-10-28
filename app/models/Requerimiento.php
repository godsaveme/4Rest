<?php

class Requerimiento extends \Eloquent {
	protected $table = 'requerimiento';
	protected $guarded = array();
	public static $rules = array();

	public function insumos(){
		return $this->belongsToMany('Insumo','detallerequerimiento','requerimiento_id','insumo_id')
		->withPivot('cantidad','estado');
	}

	public function productos(){
		return $this->belongsToMany('Producto','detallerequerimiento','requerimiento_id','producto_id')
		->withPivot('cantidad','estado');
	}

	public function area(){
		return $this->belongsTo('Areadeproduccion','areaproduccion_id');
	}
}