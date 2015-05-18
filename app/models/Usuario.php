<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {
	protected $table    = 'usuario';
	protected $fillable = array(
		'login',
		'password',
		'persona_id',
		'colaborador',
		'id_restaurante',
		'id_tipoareapro',
		'estado',
	);

	// este metodo se debe implementar por la interfaz
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	//este metodo se debe implementar por la interfaz
	// y sirve para obtener la clave al momento de validar el inicio de sesión
	public function getAuthPassword() {
		return $this->password;
	}

	public function getRememberToken()
	{
		return $this->remember_token;
	}
	
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}
	
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function persona() {
		return $this->belongsTo('Persona', 'persona_id');
	}

	public function areaproduccion() {
		return $this->belongsTo('Areadeproduccion', 'id_tipoareapro');
	}

	public function pedidos(){
		return $this->hasMany('Pedido','usuario_id');
	}

    public function restaurante(){
        return $this->belongsTo('Restaurante','id_restaurante');
    }
}
