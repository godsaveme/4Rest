<?php

class DetPro extends Eloquent {
	protected $table = 'detprod';

	protected $fillable = array('parent_id','child_id','cantidad','created_at','updated_at');

	protected $guarded = array();

	public static $rules = array();
}
