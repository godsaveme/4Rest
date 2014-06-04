<?php

class Perfil extends Eloquent {
	protected $table = 'perfil';
	protected $fillable = array('nombre', 'descripcion', 'selector', 'created_at', 'updated_at');
	protected $guarded = array();
	public static $rules = array();

	public function persona(){
        return $this->hasMany('Persona', 'perfil_id');
    }

    public function modulos(){
    	return $this->belongsToMany('Modulos','Permisos','id_perfil', 'id_modulo');
    }
}
