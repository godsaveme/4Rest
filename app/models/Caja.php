<?php

class Caja extends Eloquent {
	protected $table = 'caja';
	protected $guarded = array();
	public static $rules = array();

	public function detallecaja(){
		return $this->hasMany('Detcaja', 'caja_id');
	}

	public function restaurante(){
		return $this->belongsTo('Restaurante', 'restaurante_id');
	}

	public function tickets(){
		return $this->hasMany('Ticket','caja_id');
	}
}
