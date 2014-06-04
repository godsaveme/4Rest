<?php

class TipoCombinacionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$tipocombinacion = TipoComb::all();
        return View::make('tipocombinacions.index', compact('tipocombinacion'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return View::make('tipocombinacions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		$tipodecombinacion = TipoComb::create(Input::all());
		return Redirect::to('tipocombinacions');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('tipocombinacions.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$tipocomb = TipoComb::find($id);
        return View::make('tipocombinacions.edit', compact('tipocomb'));
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
		$tipocomb = TipoComb::find($id);
		$tipocomb->Update(Input::all());
		return Redirect::to('tipocombinacions');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
		//
		$e= true;
		try {
		$tipocomb = TipoComb::find($id);
		$tipocomb->delete();
		} catch (Exception $e) {
			return false;
		}
		
		return json_encode($e);
	}

}
