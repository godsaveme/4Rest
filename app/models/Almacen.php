<?php

class Almacen extends Eloquent {

	protected $table = 'almacen';

	protected $guarded = array();

	protected $fillable = array('nombre','descripcion','restaurante_id','capacidad','id_tipoareapro');

	public static $rules = array();

	public function restaurante(){
		return $this->belongsTo('Restaurante','restaurante_id');
	}

	public function insumos(){
		return $this->belongsToMany('Insumo','stockInsumo','almacen_id','insumo_id')->withPivot('stockActual');
	}

	public function productos(){
		return $this->belongsToMany('Producto', 'stockProducto','almacen_id','producto_id')->withPivot('stockActual');
	}
}