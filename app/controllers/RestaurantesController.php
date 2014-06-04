<?php

class RestaurantesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$restaurantes = Restaurante::all();
        return View::make('restaurantes.index', compact('restaurantes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return View::make('restaurantes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{

		$restaurante = Restaurante::create(Input::all());
		if(Input::hasFile('imagen'))
		{
		$path = $restaurante->id.'_'.Input::file('imagen')->getClientOriginalName();
		Input::file('imagen')->move('images/restaurantes/',$path);
		//$restaurante = Restaurante::find($restaurante->id);
		$restaurante->imagen = $path;
		$restaurante->save();
		}


		return Redirect::to('restaurantes');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
        return View::make('restaurantes.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$restaurante = Restaurante::find($id);
        return View::make('restaurantes.create', compact('restaurante'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{

		$restaurante = Restaurante::find($id);

		$restaurante->nombreComercial = Input::get('nombreComercial');
		$restaurante->razonSocial = Input::get('razonSocial');
		$restaurante->direccion = Input::get('direccion');
		$restaurante->ruc = Input::get('ruc');
		$restaurante->serie = Input::get('serie');
		$restaurante->numerodeticket = Input::get('numerodeticket');
		$restaurante->provincia = Input::get('provincia');
		$restaurante->departamento = Input::get('departamento');
		$restaurante->pais = Input::get('pais');
		$restaurante->tel = Input::get('tel');
		$restaurante->cel = Input::get('cel');
		$restaurante->fax = Input::get('fax');
		$restaurante->comentarios = Input::get('comentarios');
		$restaurante->save();
		//$restaurante->nombreComercial = Input::get('nombreComercial');

				if(Input::hasFile('imagen'))
		{
		$path = $restaurante->id.'_'.Input::file('imagen')->getClientOriginalName();
		Input::file('imagen')->move('images/restaurantes/',$path);
		//$restaurante = Restaurante::find($restaurante->id);
		$restaurante->imagen = $path;
		$restaurante->save();
		}

		return Redirect::to('restaurantes');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
		$e= true;
		try {
		$restaurante = Restaurante::find($id);
		$restaurante->delete();
		} catch (Exception $e) {
			return false;
		}
		
		return json_encode($e);
	}

	public function getCrearcarta(){
		$restaurantes = Restaurante::all()->lists('nombreComercial', 'id');
		$familias= Familia::all()->lists('nombre','id');
		$tipodecombinaciones = TipoComb::all()->lists('nombre', 'id');
		return View::make('restaurantes.crearcarta', compact('restaurantes', 'familias', 
						  'tipodecombinaciones'));
	}
}
