<?php

class Combinacion extends Eloquent {
	protected $table = 'combinacion';
	protected $fillable = array('nombre','precio','cantidad','descripcion','TipoComb_id');
	protected $guarded = array();
	public static $rules = array();

	public function cprecios(){
		return $this->hasMany('Precio', 'combinacion_id');
	}

	public function productos(){
		return $this->belongsToMany('Producto','precio','combinacion_id','producto_id');
	}

	public function tipocomb(){
		return $this->belongsTo('TipoComb', 'TipoComb_id');
	}

	public function horcomb(){
		return $this->hasOne('Horcomb','combinacion_id');
	}

}
