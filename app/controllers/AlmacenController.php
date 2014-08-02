<?php

class AlmacenController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$almacenes = Almacen::all();
		return View::make('almacenes.index', compact('almacenes'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$restaurantes = Restaurante::lists('nombreComercial','id');
		return View::make('almacenes.create', compact('restaurantes'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		DB::beginTransaction();	
		try {
			Almacen::create(Input::all());
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/almacenes'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$almacen = Almacen::find($id);
		$restaurantes = Restaurante::lists('nombreComercial','id');
		return View::make('almacenes.edit', compact('almacen','restaurantes'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate()
	{
		DB::beginTransaction();	
		try {
			$almacen_id = Input::get('almacen_id');
			$almacen = Almacen::find(Input::get('almacen_id'));
			$almacen->update(Input::all());

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));
		}

		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/almacenes'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
		DB::beginTransaction();	

		try {

		$almacen = Almacen::find($id);
		$almacen->delete();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}


}
