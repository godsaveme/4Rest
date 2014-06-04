<?php

class TipoComb extends Eloquent {
	protected $table = 'tipocomb';
	protected $guarded = array();
	public static $rules = array();

	public function combinaciones(){
		return $this->hasMany('Combinacion', 'TipoComb_id');
	}
}
