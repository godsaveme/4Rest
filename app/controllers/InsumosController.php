<?php

class InsumosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$insumos = Insumo::all();
        return View::make('insumos.index', array('insumos' => $insumos));
        //return View::make('insumos.index');
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$tipoins = TipoIns::all()->lists('nombre','id');
        return View::make('insumos.create' , compact('tipoins'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//
		 Insumo::create(Input::all());
		 return Redirect::to('insumos');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$insumo = Insumo::find($id);
        // para buscar al usuario utilizamos el metido find que nos proporciona Laravel 
        // este método devuelve un objete con toda la información que contiene un usuario
    
   		return View::make('insumos.show', array('insumo' => $insumo));
        //return View::make('insumos.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$insumo = Insumo::find($id);
		$tipoins = TipoIns::all()->lists('nombre','id');
        return View::make('insumos.edit', compact('insumo','tipoins'));
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
		$insumo = Insumo::find($id);
		$insumo->update(Input::all());
		$insumo->save();
		return Redirect::to('insumos');
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
		$insumo = Insumo::find($id);
		$insumo->delete();
		} catch (Exception $e) {
			return json_encode($e);
		}
		
		return json_encode($e);
	}

}
