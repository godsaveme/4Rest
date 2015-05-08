<?php

class Insumo extends Eloquent {

	protected $table = 'insumo';

	//$fillable = array('nombre', 'apellido');

	protected $fillable = array('nombre','descripcion','unidadMedida','tipoins_id','estado','ultimocosto');

	public function productos(){
		return $this->belongsToMany('Producto','receta','insumo_id','producto_id');
	}

	public function tipoins(){
		 return $this->belongsTo('TipoIns');
	}

	public function almacenes(){
		return $this->belongsToMany('Almacen','stockInsumo','insumo_id','almacen_id');
	}

}
