<?php

class Producto extends Eloquent {

	protected $table = 'producto';
	protected $guarded = array();

	protected $fillable = array('nombre','descripcion','stock','unidadMedida','familia_id',
								'estado','stockMin', 'stockMax', 'selector_adicional', 
								'lista_prod','id_tipoarepro','imagen',
								'receta','costo');
	public static $rules = array();

	public function combinaciones(){
		return $this->belongsToMany('Combinacion','precio','producto_id','combinacion_id');
	}

	public function insumos(){
		return $this->belongsToMany('Insumo','receta','producto_id','insumo_id')->withPivot('cantidad','precio','created_at','updated_at');
	}
	
	public function precios(){
		return $this->hasMany('Precio', 'producto_id');
	}

	public function familia(){
		 return $this->belongsTo('Familia', 'familia_id');
	}

	public function adicionales(){
		return $this->belongsToMany('Producto', 'detproadicional', 'producto_id', 'proadi_id');
	}

	public function sabores(){
		return $this->belongsToMany('Sabor', 'detsabores','producto_id', 'sabor_id');
	}

	public function detsabores(){
		return $this->hasMany('Detsabores', 'producto_id');
	}

	public function pedidos(){
		return $this->belongsToMany('Pedido', 'detallepedido', 'producto_id','pedido_id')
				->withPivot('importeFinal', 'cantidad','combinacion_id', 'pedido_id');
	}

	public function preproductos(){
		return $this->belongsToMany('Producto', 'preProducto', 'producto_id','preproducto_id')->withPivot('cantidad');
	}

	public function almacenes(){
		return $this->belongsToMany('Almacen','stockProducto','producto_id','almacen_id');
	}

    public function stock(){
        return $this->hasMany('StockProducto','producto_id');
    }
}
