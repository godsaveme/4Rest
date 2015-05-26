<?php

class ProductosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		/*$productos = Producto::all();*/
        return View::make('productos.index');
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
		$tipoarea = Tipoareadeproduccion::where('nombre','!=', 'Salon')->where('nombre','!=','almacen')->lists('nombre', 'id');
		$areas = Areadeproduccion::all()->lists('nombre', 'id');
        return View::make('productos.create', compact('familias','tipoarea','areas'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{


		//var_dump(Input::all());
		//die();
		 DB::beginTransaction();	
		 	try {
				 $producto = Producto::create(Input::all());
				 $provedor_id = Input::get('proveedor_id');
				 $insertedId = $producto->id;

				 if($provedor_id > 0){
				 	$producto->proveedor_id = $provedor_id;
				 	$producto->save();
				 }
					 if (!empty(Input::get('precio'))) {
					 		 $precio = new Precio;
							 $precio->producto_id = $insertedId;
							 $oComb = Combinacion::where('nombre','=','Normal')->first();
							 $precio->combinacion_id = $oComb->id;
							 $precio->precio=Input::get('precio');
							 //$precio->seleccionador = '';
							 //$precio->cantidad = '';
							 $precio->save();
					 }

                if(Input::get('prodAttrSend') == 'sabores'){
                    $producto->cantidadsabores = Input::get('cantdef');
                    $producto->save();
                }

                if(Input::hasFile('imagen') and substr(Input::file('imagen')->getMimeType(), 0, 5) == 'image'){
                    $file = Input::file('imagen');
                    $extension = Input::file('imagen')->getClientOriginalExtension();
                    //print_r($file);
                    //print_r('mime: '.$extension);
                    Image::make($file)->resize(200, 200)->save(public_path().'/images/productos/'.$producto->id.'.'.$extension);
                    //echo public_path();
                    $producto->imagen = '/images/productos/'.$producto->id.'.'.$extension;
                    $producto->save();
                }

				 
				} catch (Exception $e) {
					DB::rollback();
					//return Response::json(array('estado' => $e->getMessage()));
                    $msg = array('status' => false,'msg1' => 'Error!','msg2' => 'Producto no creado');
                    return Response::view('productos.index',compact('msg'));

				}
		DB::commit();
		//return Response::json(array('estado' => true, 'route' => '/productos'));
        $msg = array('status' => true,'msg1' => 'Hecho!','msg2' => 'Producto creado con éxito');
        return Response::view('productos.index',compact('msg'));
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
					$precio = Precio::join('combinacion','combinacion.id','=','precio.combinacion_id')
					->where('producto_id', '=', $producto->id)
					->where('combinacion.nombre', '=', 'Normal', 'AND')
					->select('precio.precio as precio') 
					->first();
					//print_r($precio->toJson()); die();
					$tipoarea = Tipoareadeproduccion::where('nombre','!=', 'Salon')->where('nombre','!=','almacen')->lists('nombre', 'id');
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
		DB::beginTransaction();	
		try {
				$producto = Producto::find(Input::get('id'));
				$producto->update(Input::all());
				$producto->save();
				$insertedId = $producto->id;

				$oComb = Combinacion::where('nombre','=','Normal')->first();

				if (!empty(Input::get('precio'))) {
						
						
					 	$prod_comb_normal = $producto->precios()->where('combinacion_id', '=', $oComb->id)->first();
						 	if(!empty($prod_comb_normal)){
						 	//var_dump($prod_comb_normal->precio);
						 	//die();
						 	$prod_comb_normal->precio = Input::get('precio');
						 	$prod_comb_normal->save();
						 }else{
						 			$precio = new Precio;
									 $precio->producto_id = $insertedId;
									 $precio->combinacion_id = $oComb->id;
									 $precio->precio=Input::get('precio');
									 $precio->save();
						 }
				 }else{
				 	$prod_comb_normal = $producto->precios()->where('combinacion_id', '=', $oComb->id)->first();
                    //print_r($prod_comb_normal->toJson()); die();
				 	if(!empty($prod_comb_normal)){
				 	$prod_comb_normal->delete();
				 	}
				 }

                if (Input::get('receta') == 1){
                    $stockProd = $producto->almacenes()->detach();
                    //print_r($stockProd->toJson()); die();
                    //if(!empty($stockProd)){
                    //    $stockProd->detach();
                    //}
                }

                if(Input::hasFile('imagen') and substr(Input::file('imagen')->getMimeType(), 0, 5) == 'image'){
                    $file = Input::file('imagen');
                    $extension = Input::file('imagen')->getClientOriginalExtension();
                    //print_r($file);
                    //print_r('mime: '.$extension);
                    Image::make($file)->resize(200, 200)->save(public_path().'/images/productos/'.$producto->id.'.'.$extension);
                    //echo public_path();
                    $producto->imagen = '/images/productos/'.$producto->id.'.'.$extension;
                    $producto->save();
                }

                if(Input::get('prodAttrSend') == 'sabores'){
                    $producto->cantidadsabores = Input::get('cantdef');
                    $producto->save();
                }else{
                    $producto->cantidadsabores = null;
                    $producto->save();
                }

		} catch (Exception $e) {
			DB::rollback();
			//return Response::json(array('estado' => $e->getMessage()));
            $msg = array('status' => false,'msg1' => 'Error!','msg2' => 'Producto no modificado');
            return Response::view('productos.index',compact('msg'));

		}
		DB::commit();
		//return Response::json(array('estado' => true, 'route' => '/productos'));
        $msg = array('status' => true,'msg1' => 'Hecho!','msg2' => 'Producto modificado con éxito');
        return Response::view('productos.index',compact('msg'));
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
		$producto = Producto::find($id);
		$producto->delete();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);

	}

	public function getProductos(){
		$combinaciones = DB::select( DB::raw("select * from (select tipocomb.id as TipoCombinacionId, tipocomb.nombre as TipoCombinacionNombre, 
						combinacion.id as CombinacionId, combinacion.precio as CombinacionPrecio,combinacion.nombre as CombinacionNombre, horComb.FechaInicio AS x1, 
						horComb.FechaTermino AS x2, horComb.id AS horComb_id 
					    from combinacion inner join tipocomb
						on tipocomb.id = combinacion.TipoComb_id inner join horComb
						on combinacion.id = horComb.combinacion_id ) as x
						WHERE curdate() BETWEEN CAST(x.x1 AS DATE) AND CAST(x.x2 AS DATE)
						AND	CASE WHEN  DATE_FORMAT(x.x1,'%H:%i') <=  DATE_FORMAT(x.x2,'%H:%i') THEN 
						curtime() BETWEEN DATE_FORMAT(x.x1,'%H:%i') AND DATE_FORMAT(x.x2,'%H:%i') ELSE 
						curtime() NOT BETWEEN DATE_FORMAT(x.x2,'%H:%i') AND DATE_FORMAT(x.x1,'%H:%i') END 
						AND DAYOFWEEK(curdate()) IN ( SELECT dias_id FROM det_dias WHERE det_dias.horcomb_id = x.horComb_id)
						GROUP BY CombinacionId order by CombinacionNombre asc"));
		$arraycombinaciones = array();
		foreach ($combinaciones as $dato) {
			$arraycombinaciones[] =$dato->CombinacionId;
		}

		array_push($arraycombinaciones,1);
		$productos = DB::table('stockproductos')->wherein('combinacion_id',$arraycombinaciones)
					->where('restaurante_id','=',Auth::user()->id_restaurante)
					->get();
		return Response::json($productos);
	}
}
