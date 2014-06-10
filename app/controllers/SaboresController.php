<?php

class SaboresController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
		$sabores = Sabor::all();
		//return View::make('sabores.index', compact('sabores'));
		//return Response::make('sabores.index');
		return Response::view('sabores.index', compact('sabores'));
	}

	public function getIndexDet(){
		$prod_sabor = Producto::sabores();
		return Response::view('sabores.indexDet', compact('$prod_sabor'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		//
		$insumos = Insumo::lists('nombre','id');
		return Response::view('sabores.create',compact('insumos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//
		//$x = Input::all();
		//print_r($x);
		//die();
		Sabor::create(Input::all());
		return Redirect::to('sabores');
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
		//
		$sabor = Sabor::find($id);
		$insumos = Insumo::lists('nombre','id');
		return Response::view('sabores.edit',compact('sabor','insumos'));
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
		$sabor = Sabor::find($id);
		//var_dump(Input::all());
		//die();
		$sabor->update(Input::all());
		//	$sabor->save();
		return Redirect::to('sabores');
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
		DB::beginTransaction();	

		try {

		$sabor = Sabor::find($id);
		$sabor->delete();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}

}