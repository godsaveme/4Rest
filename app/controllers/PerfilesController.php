<?php

class PerfilesController extends BaseController {

	/*public function __construct()
    {
    	$segmento = Request::segment(2);
    	if (!isset($segmento)) {
    		$segmento = 'index';
    	}
    	$resultado = Modulos::where('proceso','=',$segmento)->select('id')->first();
    	$persona = Persona::find(Auth::user()->persona_id);
        $this->beforeFilter('modulo_habilitado:'.$resultado->id.','.$persona->perfil_id);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$perfiles = Perfil::all();
        return View::make('perfiles.index', compact('perfiles'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$modulos = Modulos::select()->where('activo','=', '1')->groupBY('nmodulo')->get();
		$totalmodulos = count($modulos);
        return View::make('perfiles.create', compact('modulos','totalmodulos'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		DB::beginTransaction();	
			try {
				$perfil = Perfil::create(Input::all());
				$insertedid = $perfil->id;
				for ($i=0; $i <= Input::get('contadormo') ; $i++) {
				$modulo =  Input::get('nmodulo_'.$i);
				if (isset($modulo)) {
					for ($j=0; $j <= Input::get('contadorp_'.$i) ; $j++) {
						$mod = Input::get('proc_'.$j);
						if (isset($mod)) {
							$modulo = new Permisos;
							$modulo->id_perfil = $insertedid;
							$modulo->id_modulo = Input::get('proc_'.$j);
							$modulo->save();
						}
					}
				}
				}
			} catch (Exception $e) {
						DB::rollback();	
			}
		 DB::commit();
		return Redirect::to('perfiles');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
        return View::make('perfiles.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$perfil = Perfil::find($id);
        return View::make('perfiles.edit', compact('perfil'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$perfil = Perfil::find(Input::get('id'));
		$perfil->nombre = Input::get('nombre');
		$perfil->descripcion = Input::get('descripcion');
		$perfil->selector = Input::get('selector');
		$perfil->save();
		return Redirect::to('perfiles'); 
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		$perfil = Perfil::find($id);
		$perfil->delete();
		return Redirect::to('perfiles'); 
	}

}
