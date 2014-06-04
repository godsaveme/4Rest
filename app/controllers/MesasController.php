<?php

class MesasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$mesas = Mesa::all();
        return View::make('mesas.index', compact('mesas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$salones = Salon::all()->lists('nombre','id');
        return View::make('mesas.create',compact('salones'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		Mesa::create(Input::all());
		return Redirect::to('mesas');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('mesas.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$mesa = Mesa::find($id);
		$salones = Salon::all()->lists('nombre','id');
        return View::make('mesas.create', compact('mesa','salones'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		//
		$mesa = Mesa::find($id);
		$mesa->nombre = Input::get('nombre');
		$mesa->descripcion = Input::get('descripcion');
		$mesa->salon_id = Input::get('salon_id');
		$mesa->habilitado = Input::get('habilitado');
		$mesa->save();

		return Redirect::to('mesas');
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
		$mesa = Mesa::find($id);
		$mesa->delete();
		} catch (Exception $e) {
			return false;
		}
		
		return json_encode($e);
	}

}
