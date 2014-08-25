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

	public function getOrdenproduccion(){
		$areasproduccion = Areadeproduccion::where('id_restaurante', '=', 
							Auth::user()->id_restaurante)->lists('nombre','id');
		return View::make('almacenes.ordenproduccion',compact('areasproduccion'));
	}

	public function getDetalleordenes($id=NULL){
		if (isset($id)) {
			$ordendeproduccion = OrdendeProduccion::find($id);
			$productos =$ordendeproduccion->productos;
			$contador= 1;
			return View::make('almacenes.detalleordendeproduccion', compact('ordendeproduccion', 'productos','contador'));
		}else{
			return Redirect::to('/almacenes/ordenproduccion');
		}

	}

	public function getRequerimientos($id=NULL){
		if (isset($id)) {
			$ordendeproduccion = OrdendeProduccion::find($id);
			$requerimientos= $ordendeproduccion->requerimientos;
			return View::make('almacenes.requerimientos', compact('requerimientos','ordendeproduccion'));
		}else{
			return Redirect::to('/almacenes/ordenproduccion');
		}
	}

	public function getDetallerequerimiento($id=NULL){
		if (isset($id)) {
			$requerimiento = Requerimiento::find($id);
			$requerimientos = Detallerequerimiento::where('requerimiento_id', '=', $id)->get();
			$contador= 1;
			return View::make('almacenes.detallesrequerimientos', compact('requerimiento', 'requerimientos', 'contador'));
		}else{
			return Redirect::to('/almacenes/ordenproduccion');
		}
	}

	public function getRarea(){
		$areasproduccion = Areadeproduccion::select('areadeproduccion.id')
						->join('encargadoareaproduccion','areadeproduccion.id','=','encargadoareaproduccion.areaproduccion_id')
						->where('encargadoareaproduccion.usuario_id','=',Auth::user()->id)
						->lists('id');
		$detallesrequerimientos= Detallerequerimiento::wherein('areaproduccion_id', $areasproduccion)
								->where('estado','!=',4)
								->where('estado','!=',5)
								->where('estado','!=',6)
								->orderby('insumo_id', 'ASC')
								->get();
		return View::make('almacenes.procesarrequerimiento', compact('detallesrequerimientos'));
	}

	public function getOrdendecompra(){
		$areasproduccion = Areadeproduccion::select('areadeproduccion.id')
						->join('encargadoareaproduccion','areadeproduccion.id','=','encargadoareaproduccion.areaproduccion_id')
						->where('encargadoareaproduccion.usuario_id','=',Auth::user()->id)
						->lists('id');
		$ordenesdecompra = Ordendecompra::wherein('area_id',$areasproduccion)->get();

		return View::make('almacenes.ordenesdecompra', compact('ordenesdecompra'));
	}

	public function getDetalleordendecompra($id=NULL){
		if (isset($id)) {
			$ordendecompra = Ordendecompra::find($id);
			$detallesordendecompra = $ordendecompra->insumos()->get();
			return View::make('almacenes.detalleordendecompra', compact('ordendecompra', 'detallesordendecompra'));
		}else{
			return Redirect::to('/almacenes');
		}
	}
	
}
