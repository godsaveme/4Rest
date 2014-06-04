<?php

class Salon extends Eloquent {

	protected $table= 'salon';
	protected $guarded = array();

	public static $rules = array();

	public function restaurante(){
		return $this->belongsTo('Restaurante','restaurante_id');
	}

	public function mesas(){
		return $this->hasMany('Mesa', 'salon_id');
	}
}
