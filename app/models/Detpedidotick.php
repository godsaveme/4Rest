<?php

class Detpedidotick extends Eloquent {
	protected $table = 'dettiketpedido';
	protected $guarded = array();
	public static $rules = array();
	protected $fillable = array('pedido_id', 'ticket_id',
						  'nombre','precio',
						  'preciou', 'cantidad','combinacion_id', 'producto_id',
						  'descuento', 'created_at','updated_at');
}