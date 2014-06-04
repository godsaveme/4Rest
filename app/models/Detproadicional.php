<?php
class Detproadicional extends Eloquent {
	protected $table = 'detproadicional';
	protected $fillable = array('proadi_id', 'producto_id', 'created_at', 'updated_at');
	protected $guarded = array();
	public static $rules = array();
}