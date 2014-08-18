<?php

class Areadeproduccion extends Eloquent {
	protected $table = 'areadeproduccion';
	protected $guarded = array();
	public static $rules = array();

	public function ordenesdeproduccion(){
		return $this->hasMany('OrdendeProduccion', 'areaproduccion_id');
	}

	public function almacen(){
		return $this->hasOne('Almacen','id_tipoareapro');
	}
}
