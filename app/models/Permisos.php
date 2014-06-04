<?php

class Permisos extends Eloquent {
	protected $table = 'Permisos';
	protected $fillable = array('id_perfil', 'id_modulo');
	protected $guarded = array();
	public static $rules = array();
}
