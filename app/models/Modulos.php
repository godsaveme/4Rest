<?php

class Modulos extends Eloquent {
	protected $table = 'modulos';
	protected $fillable = array('id', 'controlador', 'proceso', 'activo', 'nombre', 'nmodulo');
	protected $guarded = array();
	public static $rules = array();
	public function perfiles(){
    	return $this->belongsToMany('Perfil','Permisos', 'id_modulo','id_perfil');
    }
}
