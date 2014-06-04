<?php

class Ingresocaja extends \Eloquent {
	protected $table = 'detingresocaja';
	protected $guarded = array();
	public static $rules = array();

	public function detcaja(){
		return $this->belongsTo('Detcaja', 'detallecaja_id');
	}
}