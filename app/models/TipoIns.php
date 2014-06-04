<?php

class TipoIns extends Eloquent {
	protected $table = 'tipoins';
	protected $fillable = array();
	protected $guarded = array();
	public static $rules = array();

	public function insumos(){
		return $this->hasMany('insumo','tipoins_id');
	}
}