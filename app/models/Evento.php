<?php

class Evento extends \Eloquent {
	protected $table = 'eventos';
	protected $guarded = array();
	public static $rules = array();

	public function ticketsevento(){
		return $this->belongsToMany('Ticket', 'detalleevento', 'evento_id', 'ticket_id');
	}
}