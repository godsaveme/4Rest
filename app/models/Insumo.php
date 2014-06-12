<?php

class Insumo extends Eloquent {

	protected $table = 'insumo';

	//$fillable = array('nombre', 'apellido');

	protected $fillable = array('nombre','descripcion','unidadMedida','tipoins_id','estado');

	public function productos(){
		return $this->belongsToMany('Producto','Receta','insumo_id','producto_id')
					->withPivot('cantidad','created_at','updated_at');
	}

	public function tipoins(){
		 return $this->belongsTo('TipoIns');
	}
	//protected $guarded = array('id', 'stockMin');

	//public static $rules = array();

	//public $timestamps = false;
}
