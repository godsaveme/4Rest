<?php

class NotasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$notas = Notas::all();
        return View::make('notas.index', compact('notas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return View::make('notas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		Notas::create(Input::all());
		return Redirect::to('notas');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$nota = Notas::find($id);
        return View::make('notas.edit', compact('nota'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$nota = Notas::find(Input::get('id'));
		$nota->descripcion = Input::get('descripcion');
		$nota->save();
		return Redirect::to('notas');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		$nota = Notas::find($id);
		$nota->delete();
		return Redirect::to('notas');
	}

	public function getAgregarnotas($id){
		$nota = Notas::find($id);
		$familias= Familia::all()->lists('nombre', 'id');
		$productos = Producto::join('notaxproducto', 'notaxproducto.producto_id', '=', 'producto.id')
					->where('notaxproducto.nota_id', '=', $id)->groupBy('familia_id')->get();
		return View::make('notas.agregarnotas', compact('nota', 'familias', 'productos', 'familias2','id'));
	}
}