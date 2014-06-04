<?php

class ProductosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$productos = Producto::all();
        return View::make('productos.index', array('productos' => $productos));
	}

	public function postBuscar()
	{
		$patron = Input::get('parametro');
		$insumos = Insumo::where('nombre', 'like', $patron.'%')->take(10)->get();
		return $insumos->toJson();
	}

	public function postBuscarpro()
	{
		$patron = Input::get('parametro');
		$productos = Producto::where('nombre', 'like', $patron.'%')->take(10)->get();
		return $productos->toJson();
	}

	public function postBuscarproadi()
	{
		$fadional = Familia::where('nombre','=','Adicionales')->get();
		foreach ($fadional as $dato) {
			$idfami= $dato->id;
		}
		$patron = Input::get('parametro');
		$productos = Producto::whereRaw("familia_id =".$idfami." and nombre like '".$patron."%'")->take(10)->get();
		return $productos->toJson();
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$familias = Familia::all();
		$tipoarea = Tipoareadeproduccion::where('id','!=', '2')->lists('nombre', 'id');
        return View::make('productos.create', compact('familias','tipoarea'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$listaadicionales = '';
		// DB::beginTransaction();	
		// 	try {
				 $producto = Producto::create(Input::all());
				 $insertedId = $producto->id;
				 $select = Input::get('sel_pro_ins');
				 $precio = new Precio;
				 $precio->producto_id = $insertedId;
				 $precio->combinacion_id = 1;
				 $precio->precio=Input::get('precio');
				 $precio->seleccionador = 0;
				 $precio->save();
				 if(Input::get('selector_adicional') == 1){
				 	for ($i=0; $i <= Input::get('contaadic') ; $i++) {
				 		$adicional = Input::get('proadi_'.$i);
				 		if (isset($adicional)) {
				 			$listaadicionales = $listaadicionales.','.$adicional;
				 		}
				 	}
				 	$producto->lista_prod = substr($listaadicionales, 1);
				 	$producto->save();
				 }
				 if ($select == 1) {
				 for ($i=0; $i <= Input::get('containgre'); $i++) { 
				 $p = Input::get('ingre_'.$i);
				 	if(isset($p)){
				 		$receta = new Receta;
				 		$receta->producto_id = $insertedId;
				 		$receta->insumo_id = Input::get('ingre_'.$i);
				 		$receta->cantidad = Input::get('ingre_cant_'.$i);
				 		$receta->save();
				 	}
				 }
				 }elseif ($select == 2) {
				 for ($i=0; $i <= Input::get('containgre'); $i++) {
				 $p = Input::get('pro_'.$i);
				 	if(isset($p)){
				 		$detPro = new DetPro;
				 		$detPro->parent_id = $insertedId;
				 		$detPro->child_id = Input::get('pro_'.$i);
				 		$detPro->cantidad = Input::get('pro_cant_'.$i);
				 		$detPro->save();
				 	}
				 }
				 }
				// } catch (Exception $e) {
				// 		DB::rollback();
				// 	}
				// DB::commit();
		 return Redirect::to('productos');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$producto = Producto::find($id);
   		return View::make('productos.show', array('producto' => $producto));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$producto = Producto::find($id);
		if (count($producto)>0) {
					$familias = Familia::all();
					$precio = Precio::where('producto_id', '=', $producto->id)
					->where('combinacion_id', '=', 1, 'AND')->first();
					$tipoarea = Tipoareadeproduccion::where('id','!=', '2')->lists('nombre', 'id');
        			return View::make('productos.edit', compact('producto', 'familias', 'tipoarea', 'precio'));
		}else{
			return Response::view('errors.missing', array(), 404);
		}


	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$producto = Producto::find(Input::get('id'));
		$producto->update(Input::all());
		$producto->save();
		return Redirect::to('productos');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		$e= true;
		try {
		$producto = Producto::find($id);
		$producto->delete();
		} catch (Exception $e) {
			return false;
		}
		
		return json_encode($e);

	}

}
