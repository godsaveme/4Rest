<?php

class OrdendeProduccion extends \Eloquent {
	protected $table = 'ordendeproduccion';
	protected $guarded = array();
	public static $rules = array();

	public function productos(){
		return $this->belongsToMany('Producto','detalleodendeproduccion', 'ordendeproduccion_id', 'producto_id')->withPivot('cantidad');
	}

	public function requerimientos(){
		return $this->hasMany('Requerimiento','ordendeproduccion_id');
	}
}