<?php

class NotasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		/*$notas = Notas::all();*/
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
		DB::beginTransaction();	

		try {
		Notas::create(Input::all());
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/notas'));
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
		DB::beginTransaction();	

		try {
		$nota = Notas::find(Input::get('id'));
		$nota->update(Input::all());
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/notas'));
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

		$nota = Notas::find($id);
		$nota->delete();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);



	}

	public function getAgregarnotas($id){
		$nota = Notas::find($id);
		$familias= Familia::all()->lists('nombre', 'id');
		$productos = Producto::join('notaxproducto', 'notaxproducto.producto_id', '=', 'producto.id')
					->where('notaxproducto.nota_id', '=', $id)->groupBy('familia_id')->get();
		return View::make('notas.agregarnotas', compact('nota', 'familias', 'productos', 'familias2','id'));
	}

	public function getAllnotas(){
		$notas = Notas::select('notas.descripcion', 'notas.id', 'notaxproducto.producto_id')
				->join('notaxproducto', 'notaxproducto.nota_id', '=', 'notas.id' )
				->join('producto', 'producto.id', '=', 'notaxproducto.producto_id')
				->where('notas.descripcion', '!=', '')
				->where('producto.id', '=', Session::get('sesionproducto'))
				->orderby('descripcion', 'ASC')
				->groupBy('descripcion')
				->get();
		return Response::json($notas);
	}
}
