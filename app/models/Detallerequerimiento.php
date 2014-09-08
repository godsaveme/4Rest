<?php

class Detallerequerimiento extends \Eloquent {
	protected $table = 'detallerequerimiento';
	protected $guarded = array();
	public static $rules = array();

	public function areaproduccion(){
		return $this->belongsTo('Areadeproduccion','areaproduccion_id');
	}

	public function producto(){
		return $this->belongsTo('Producto','producto_id');
	}

	public function insumo(){
		return $this->belongsTo('Insumo','insumo_id');
	}

	public function requerimiento(){
		return $this->belongsTo('Requerimiento','requerimiento_id');
	}
}