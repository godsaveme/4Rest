<?php

class Mesa extends Eloquent {

	protected $table = 'mesa';
	protected $guarded = array();

	public static $rules = array();

	public function salon(){
		return $this->belongsTo('Salon');
	}

	public function pedidos(){
		return $this->belongsToMany('Pedido','detmesa','mesa_id','pedido_id');
	}
}
