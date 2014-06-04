<?php

class Regitrodegastos extends Eloquent {
	protected $table = 'registrogastoscaja';
	protected $guarded = array();
	public static $rules = array();

	public function tipogasto(){
		return $this->belongsTo('Tiposdegatos','tipogasto_id');
	}
}