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

	public function getShow($id= NULL)
	{
		if (isset($id)) {
			$almacen = Almacen::find($id);
			$insumos = $almacen->insumos()->selectraw('insumo.id,insumo.nombre,insumo.descripcion,insumo.unidadMedida,"Insumos" as Tipo')->get();
			//$productos = $almacen->productos()->get();

			//$productosReceta = $almacen->productos()->where('producto.receta','=',1)->get();

			//$productosReceta = DB::statement(DB::raw('CALL select_stock_prod('.$almacen->id.');'));	

			$productosReceta = DB::select('call select_stock_prod(' . $almacen->id . ')');

			$arrX;
			foreach ($productosReceta as $x) {
				$arrX[] = $x->xid;
			}
            if (!isset($arrX)) {
                $arrX[] = 0;
            }
			$prodRecNoDispo = Producto::selectraw('producto.id,"Productos" as Tipo,nombre,descripcion,unidadMedida,"No disponible" as disponible')
					->where('receta', '=', 1)
					->whereNotIn('producto.id',$arrX)
					->get();
			//print_r($productosReceta); die();

			$productosNoReceta = $almacen->productos()->where('producto.receta','=',0)
                              	 ->selectraw('producto.id,producto.nombre,producto.descripcion,producto.unidadMedida,"Productos" as Tipo')
			                     ->get();

			//falta prod con receta no disponibles

			$productos = $productosNoReceta;
			//print_r($prodRecNoDispo); die();
			return View::make('almacenes.stock', compact('almacen', 'insumos', 'productos','productosReceta','prodRecNoDispo'));
		}else{
			return Redirect::back();
		}
	}

	public function getCreatestock($id = NULL)
	{
		if (isset($id)) {
			$almacen = Almacen::find($id);
			return View::make('almacenes.createstockinsumo', compact('almacen'));
		}else{
			return Redirect::back();
		}
	}

	public function postCreatestock()
	{
		$insumo_id = Input::get('insumo_id');
		if ($insumo_id == 0) {
			return Response::json(array('estado' => false,
				'route' => '/almacenes/show/'.$almacen->id));
		}

		$almacen = Almacen::find(Input::get('almacen_id'));
		if (Input::get('tipo') == 'Insumos') {
			$almacen->insumos()->attach($insumo_id,
					array('stockActual' => Input::get('stock')));
		}elseif(Input::get('tipo') == 'Productos'){
			$almacen->productos()->attach($insumo_id,array('stockActual' => Input::get('stock')));
		}
		
		
		return Response::json(array('estado' => true, 'route' => '/almacenes/show/'.$almacen->id));
	}

	public function getEditarstock($id = NULL,$insumo_id = NULL)
	{
		if (isset($id)) {
			$almacen = Almacen::find($id);
			$insumo = $almacen->insumos()
						->where('stockInsumo.insumo_id', '=', $insumo_id)->first();
			$tipo = 'Insumos';			
			return View::make('almacenes.editstockinsumo', compact('insumo','almacen','tipo'));
		}else{
			return Redirect::back();
		}
	}

	public function getStockedit($id = NULL,$insumo_id = NULL)
	{
		if (isset($id)) {
			$almacen = Almacen::find($id);
			$insumo = $almacen->productos()
						->where('stockProducto.producto_id', '=', $insumo_id)->first();
			$tipo = 'Productos';
			return View::make('almacenes.editstockinsumo', compact('insumo','almacen','tipo'));
		}else{
			return Redirect::back();
		}
	}

	public function postEditarstock()
	{
		$almacen = Almacen::find(Input::get('almacen_id'));
		if (Input::get('tipo') == 'Insumos') {
			$insumo = $almacen->insumos()
					->where('stockInsumo.insumo_id', '=', Input::get('insumo_id'))->first();

			$insumo->pivot->stockActual = Input::get('stock');
			$insumo->pivot->save();
		}elseif(Input::get('tipo') == 'Productos'){
			$producto = $almacen->productos()
					->where('stockProducto.producto_id', '=', Input::get('insumo_id'))->first();

			$producto->pivot->stockActual = Input::get('stock');
			$producto->pivot->save();
		}

		return Response::json(array('estado' => true, 'route' => '/almacenes/show/'.$almacen->id));
	}
}
