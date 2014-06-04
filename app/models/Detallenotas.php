<?php

class Detallenotas extends Eloquent {
	protected $table = 'detallenotas';
	protected $fillable = array('detallePedido_id', 'notas_id', 'created_at', 'updated_at');
	protected $guarded = array();
	public static $rules = array();

	public function detpedidos(){
		return $this->belongsToMany('Detpedidos','detallenotas','notas_id', 'detallePedido_id');
	}
}
