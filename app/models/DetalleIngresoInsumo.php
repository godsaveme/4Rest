<?php

class DetalleIngresoInsumo extends Eloquent {
	protected $table = 'DetalleIngresoInsumo';
	protected $fillable = array('ingreso_id', 'insumo_id', 'cantidad', 'costo', 'importe_final', 'descuento_final', 'created_at', 'updated_at');
	protected $guarded = array();
	public static $rules = array();
}
