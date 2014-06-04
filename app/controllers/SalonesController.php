<?php

class SalonesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$salones = Salon::all();
        return View::make('salones.index', compact('salones'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$restaurantes = Restaurante::all()->lists('nombreComercial','id');
        return View::make('salones.create', compact('restaurantes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//
		Salon::create(Input::all());
		return Redirect::to('salones');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('salones.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$salon = Salon::find($id);
		$restaurantes = Restaurante::all()->lists('nombreComercial','id');
        return View::make('salones.create', compact('salon','restaurantes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		$salon = Salon::find($id);
		$salon->nombre = Input::get('nombre');
		$salon->descripcion = Input::get('descripcion');
		$salon->restaurante_id = Input::get('restaurante_id');
		$salon->habilitado = Input::get('habilitado');
		$salon->save();
		return Redirect::to('salones');
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
		$salon = Salon::find($id);
		$salon->delete();
		} catch (Exception $e) {
		return false;
		}
		
		return json_encode($e);
	}

}
