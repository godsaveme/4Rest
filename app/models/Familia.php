<?php

class Familia extends Eloquent {

	protected $table = 'familia';
	
	protected $guarded = array();

	public static $rules = array();

	public function productos(){
		return $this->hasMany('Producto','familia_id');
	}
}
