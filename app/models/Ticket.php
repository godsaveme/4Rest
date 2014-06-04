<?php

class Ticket extends Eloquent {
	protected $table= 'ticketventa';
	protected $guarded = array();
	public static $rules = array();

	public function detallest(){
		return $this->hasMany('Detpedidotick', 'ticket_id');
	}

	public function tipopago(){
		return $this->hasMany('Detformadpago', 'ticket_id');
	}

	public function detcaja(){
		return $this->belongsTo('Detcaja', 'detcaja_id');
	}

	public function caja(){
		return $this->belongsTo('Caja', 'caja_id');
	}

	public function evento(){
		return $this->belongsToMany('Ticket', 'detalleevento', 'ticket_id','evento_id');
	}
}