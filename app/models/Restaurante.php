<?php

class Restaurante extends Eloquent {
	protected $table = 'restaurante';
	protected $guarded = array();
	public static $rules = array();

	public function cajas(){
		return $this->hasMany('Caja', 'restaurante_id');
	}

	public function salones(){
		return $this->hasMany('Salon', 'restaurante_id');
	}
}
