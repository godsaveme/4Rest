<?php

class Detcaja extends Eloquent {
	protected $table = 'detallecaja';
	protected $guarded = array();
	public static $rules = array();

	public function caja(){
		 return $this->belongsTo('Caja', 'caja_id');
	}

	public function tickets(){
		return $this->hasMany('Ticket', 'detcaja_id');
	}

	public function gastos(){
		return $this->hasMany('Regitrodegastos', 'detallecaja_id');
	}

	public function abonocaja(){
		return $this->hasMany('Ingresocaja', 'detallecaja_id');
	}
}