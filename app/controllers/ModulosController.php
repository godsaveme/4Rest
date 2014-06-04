<?php
class ModulosController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$modulos = Modulos::all();
        return View::make('modulos.index', compact('modulos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return View::make('modulos.create');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		$modulo = Modulos::create(Input::all());
		return Redirect::to('modulos');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('modulos.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$modulo = Modulos::find($id);
        return View::make('modulos.edit', compact('modulo'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate()
	{
		$modulo = Modulos::find(Input::get('id'));
		$modulo->update(Input::all());
		$modulo->save();
		return Redirect::to('modulos');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		$modulo = Modulos::find($id);
		$modulo->delete();
		return Redirect::to('modulos'); 
	}

}
