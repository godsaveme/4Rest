<?php

class Ordendecompra extends \Eloquent {
	protected $table = 'ordencompra';
	protected $guarded = array();
	public static $rules = array();

	public function insumos(){
		return $this->belongsToMany('Insumo','detalleordendecompra','ordendecompra_id','insumo_id')
		->withPivot('cantidad','cantidadcomprada','estado');
	}
}