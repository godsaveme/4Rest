<?php

class DetalleOrdendeProduccion extends \Eloquent {
	protected $table = 'detalleodendeproduccion';
	protected $guarded = array();
	public static $rules = array();

	public function ordenproduccion(){
		return $this->belongsTo('OrdendeProduccion', 'ordendeproduccion_id');
	}
}