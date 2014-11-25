<?php

class Persona extends Eloquent {
	protected $table = 'persona';
	protected $guarded = array();
	protected $fillable = array('nombres', 'razonSocial', 'apPaterno', 'apMaterno', 'dni', 'ruc', 'direccion', 
								'pais','departamento', 'provincia', 'distrito', 'tel', 'cel', 'email', 'comentarios', 'habilitado', 
								'created_at', 'updated_at', 'perfil_id');
	public static $rules = array();

	public function usuario(){
        return $this->hasOne('Usuario','persona_id');
    }

    public function perfil(){
        return $this->belongsTo('Perfil','perfil_id');
    }

    public function tickets(){
        return $this->hasMany('Ticket','persona_id');
    }
}
