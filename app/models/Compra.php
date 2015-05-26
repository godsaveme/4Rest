<?php

class Compra extends \Eloquent {
	protected $table = 'compra';
	protected $guarded = array();
	public static $rules = array();

	public function restaurante(){
		return $this->belongsTo('Restaurante','restaurante_id');
	}

	public function provedor(){
		return $this->belongsTo('Persona','provedor_id');
	}

	public function usuario(){
		return $this->belongsTo('Usuario', 'usuario_id');
	}

	public function insumos(){
		return $this->belongsToMany('Insumo', 'detallecompra', 'compra_id', 'insumo_id')
		->withPivot('cantidad', 'costototal','costou', 'porcion','total', 'presentacion');
	}

    public function almacen(){
        return $this->belongsTo('Almacen','almacen_id');
    }
}