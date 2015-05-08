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
		$productos = Producto::join('familia','familia.id','=','producto.familia_id')
					->leftjoin('receta','producto.id','=','receta.producto_id')
					->where('receta', '=', 1)
					->selectraw('producto.id as id,producto.nombre as nombreProd, sum(receta.precio) as costo, familia.nombre as nombreFam')
					->groupBy('producto.id')
					->get();
		//print_r($productos->toJson()); die();
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
			if (count($insumos) > 0) {
				$receta = Receta::insert($insumos);
			}
			
			if (count($preproductos) > 0) {
				/*$preproductos = Preproducto::insert($preproductos);*/
			}
			$producto_id = Input::get('producto_id');
			$costo = Input::get('costo');
			$producto = Producto::find($producto_id);
			$producto->receta = 1;
			$producto->costo = $costo;
			$producto->save();
		}catch (Exception $e){
			DB::rollback();
			return Response::json(array('estado'=>false, 'route' => '/recetas/create',  'msg' =>'Operacion no completada', 'error'=>$e));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/recetas'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /recetas/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$producto = Producto::find($id);
			$insumos = $producto->insumos()->get();
			$preproductos = $producto->preproductos()->get();
			return View::make('recetas.edit', compact('producto','insumos', 'preproductos'));
		}else{
			Redirect::to('/recetas');
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /recetas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		DB::beginTransaction();	
		try {
			$producto_id = Input::get('producto_id');
			$costo = Input::get('costo');
			$producto = Producto::find($producto_id);
			$detachinsumos = $producto->insumos()->detach();
			$detachproductos = $producto->preproductos()->detach();
			$insumos = Input::get('insumos');
			$preproductos = Input::get('preproductos');
			if (count($insumos) > 0) {

				$receta = Receta::insert($insumos);
			}
			if (count($preproductos) > 0) {
				/*$preproductos = Preproducto::insert($preproductos);*/
			}
			$producto->receta = 1;
			$producto->costo = $costo;
			$producto->save();
		}catch (Exception $e){
			DB::rollback();
			return Response::json(array('estado'=>false, 'route' => '/recetas/create',  'msg' =>'Operacion no completada', 'error'=>$e));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/recetas'));
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