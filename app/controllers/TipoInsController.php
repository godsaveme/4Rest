<?php

class TipoInsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
		$tipoins = TipoIns::all();
		return View::make('tipoins.index', compact('tipoins'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('tipoins.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		TipoIns::create(Input::all());
		return Redirect::to('tipoins');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
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
		//
		$tipoins = TipoIns::find($id);
		return View::make('tipoins.edit', compact('tipoins'))
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		$tipoins = TipoIns::find($id);
		$tipoins->Update(Input::all());
		return Redirect::to('tipoins');

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
		$tipoins = TipoIns::find($id);
		$tipoins->delete();
		} catch (Exception $e) {
			return false;
		}
		
		return json_encode($e);
	}

}