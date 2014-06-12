<?php

class Sabor extends Eloquent {
	protected $table = 'sabor';
	protected $guarded = array();

	protected $fillable = array('nombre','porcion','descripcion', 'habilitado', 'insumo_id');
	public static $rules = array();

	public function insumo(){
		return $this->belongsTo('Insumo');
	}

	public function productos(){
		return $this->belongsToMany('Producto','detsabores','sabor_id','producto_id');
	}

}