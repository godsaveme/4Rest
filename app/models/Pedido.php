<?php

class Pedido extends Eloquent {

	protected $table = 'pedido';

	protected $guarded = array();

	public static $rules = array();

	public function mesas(){
		return $this->belongsToMany('Mesa','detmesa','pedido_id','mesa_id')
				->withPivot('estado');
	}

	public function usuario(){
		return $this->belongsTo('Usuario', 'usuario_id');
	}

	public function combinaciones(){
		return $this->belongsToMany('Combinacion', 'detallepedido', 'pedido_id', 'combinacion_id')
				->withPivot('importeFinal', 'cantidad','combinacion_id', 'pedido_id');
	}

	public function combinacionesguardarprecuenta(){
		return $this->belongsToMany('Combinacion', 'detallepedido', 'pedido_id', 'combinacion_id')
				->withPivot('combinacion_id', 'pedido_id');
	}

	public function productos(){
		return $this->belongsToMany('Producto', 'detallepedido', 'pedido_id', 'producto_id')
				->withPivot('importeFinal', 'cantidad', 'pedido_id');
	}

	public function productosguardarprecuenta(){
		return $this->belongsToMany('Producto', 'detallepedido', 'pedido_id', 'producto_id')
				->withPivot('pedido_id');
	}

	public function tickets(){
		return $this->hasMany('Ticket', 'pedido_id');
	}
}