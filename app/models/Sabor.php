<?php

class Sabor extends Eloquent {
	protected $table = 'sabor';
	protected $guarded = array();

	protected $fillable = array('nombre','porcion', 'insumo_id');
	public static $rules = array();
}