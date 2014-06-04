<?php

class Pedidocompra extends Eloquent {
	protected $table = 'PedidoCompra';
	protected $fillable = array('proveedor_id', 'importeFinal', 'descuentofinal', 'usuario_id', 'estado', 'id_documento', 'tipo_orden', 'created_at', 'updated_at');
	protected $guarded = array();
	public static $rules = array();
}
