<?php

class Notas extends Eloquent {
	protected $table = 'notas';
	protected $fillable = array('descripcion');
	protected $guarded = array();
	public static $rules = array();
}