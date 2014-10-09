<?php
class DetPedido extends Eloquent {
	protected $table = 'detallepedido';
	protected $guarded = array();
	public static $rules = array();

	public function notas(){
		return $this->belongsToMany('Notas','detallenotas','detallePedido_id', 'notas_id');
	}

	public function producto(){
		return $this->belongsTo('Producto', 'producto_id');
	}

	public function sabores(){
		return $this->belongsToMany('Sabor','detpedidosabores','detpedido_id', 'sabor_id');
	}

	public function adicionales(){
		return $this->hasMany('DetPedido', 'detalle_id');
	}
}
