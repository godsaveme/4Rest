<?php

class RecetasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /recetas
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$productos = Producto::join('receta','receta.producto_id', '=', 'producto.id')
					->groupby('id')
					->get();
		return View::make('recetas.index', compact('productos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /recetas/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('recetas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /recetas
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		DB::beginTransaction();	
		try {
			$insumos = Input::get('insumos');
			$preproductos = Input::get('preproductos');
			$receta = Receta::insert($insumos);
			if (count($preproductos) > 0) {
				$preproductos = Preproducto::insert($preproductos);
			}
			$producto_id = Input::get('producto_id');
			$costo = Input::get('costo');
			$producto = Producto::find($producto_id);
			$producto->costo = $costo;
			$producto->save();
		}catch (Exception $e){
			DB::rollback();
			return Response::json(array('estado'=>false, 'route' => '/recetas/create',  'msg' =>'Operacion no completada'));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/recetas'));
	}

	/**
	 * Display the specified resource.
	 * GET /recetas/{id}
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
	 * GET /recetas/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /recetas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /recetas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}