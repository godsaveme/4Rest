<?php

class CombinacionController extends BaseController {

	public function getIndex()
	{
        $combinacions = Combinacion::all();
        return View::make('combinacions.index', compact('combinacions'));
	}

	public function getCreate()
	{
		$tipodecombinacion = TipoComb::where('nombre','!=','Normal')->get();
		$familias = Familia::lists('nombre','id');
        return View::make('combinacions.create', compact('tipodecombinacion', 'familias'));
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
		$wl = Input::get('wordlist');
		$prods = json_decode($wl);
		$combinacion = Combinacion::create(Input::all());
		$insertedId = $combinacion->id;

		$horComb = new Horcomb;
		$horComb->FechaInicio = Input::get('FechaInicio');
		$horComb->FechaTermino = Input::get('FechaTermino');
		$horComb->combinacion_id = $insertedId;
		$horComb->save();

		$insertedIdHorComb = $horComb->id;

		for ($i=1; $i < 8  ; $i++) { 

			if (!empty(Input::get('foobar'.$i))) {

				$det_dias = new Detdias;
				$det_dias->horcomb_id = $insertedIdHorComb;
				$det_dias->dias_id = Input::get('foobar'.$i);
				$det_dias->save();

			}
		}


		if(count($prods) > 0){
			foreach ($prods as $prod) {
				$precio = new Precio;
				$precio->producto_id = $prod->id;
				$precio->combinacion_id = $insertedId;
				$precio->cantidad = $prod->cantidad;
				$precio->precio = $prod->precio;
				$precio->save();
			}


			
		 }
		

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => $e->getMessage()));
		}

		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/combinacions'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('combinacions.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$combinacion = Combinacion::find($id);
		$tipodecombinacion = TipoComb::where('nombre','!=','Normal')->lists('nombre','id');
        $familias = Familia::lists('nombre','id');
        $productos = Combinacion::join('precio','precio.combinacion_id' ,'=','combinacion.id')
 							->join('producto','precio.producto_id','=','producto.id')
 							->join('familia','familia.id','=','producto.familia_id')
 							->where('combinacion.id','=',$combinacion->id)
 							->select('producto.id as id','producto.nombre as nombre','producto.descripcion as descripcion', 'precio.cantidad as cantidad', 'precio.precio as precio','familia.id as familiaid','familia.nombre as familianombre')
 							->get()->toJson();
        return View::make('combinacions.edit',compact('tipodecombinacion','combinacion','familias', 'productos'));
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

		$wl = Input::get('wordlist');
		$prods = json_decode($wl);

		$combinacion = Combinacion::find(Input::get('id'));
		$combinacion->update(Input::all());
		$insertedId = $combinacion->id;



		$horComb = Horcomb::where('combinacion_id','=',$insertedId)->first(); 
		$horComb->FechaInicio = Input::get('FechaInicio');
		$horComb->FechaTermino = Input::get('FechaTermino');
		$horComb->save();

		$insertedIdHorComb = $horComb->id;
		$det_dias = Detdias::where('horcomb_id','=',$insertedIdHorComb)->delete();

		for ($i=1; $i < 8  ; $i++) { 

			if (!empty(Input::get('foobar'.$i))) {

				$det_dias = new Detdias;
				$det_dias->horcomb_id = $insertedIdHorComb;
				$det_dias->dias_id = Input::get('foobar'.$i);
				$det_dias->save();

			}
		}

		$precios = Precio::where('combinacion_id','=',$insertedId)->delete();
		if(count($prods) > 0){
			foreach ($prods as $prod) {
				$precio = new Precio;
				$precio->producto_id = $prod->id;
				$precio->combinacion_id = $insertedId;
				$precio->cantidad = $prod->cantidad;
				$precio->precio = $prod->precio;
				$precio->save();
			}


			
		 }


		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));
		}

		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/combinacions'));
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

		$combinacion = Combinacion::find($id);
		$combinacion->delete();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}

	public function getListacombinaciones(){
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

		return Response::json($combinaciones);
	}

	public function getProductoscombinaciones(){
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
		foreach ($combinaciones as $combinacion) {
			$arraycombinaciones[] = $combinacion->CombinacionId;
		}
		$arrayproductos = array();
		if (count($arraycombinaciones) == 0) {
			return Response::json($arrayproductos);
		}
		
		$familias = DB::table('stockproductos')->wherein('combinacion_id', $arraycombinaciones)
					->where('restaurante_id','=',Auth::user()->id_restaurante)
					->groupby('combinacion_id')
					->groupby('familia_id')
					->get();

		foreach ($familias as $familia) {
			$productos = DB::table('stockproductos')
						->where('familia_id','=',$familia->familia_id)
						->where('combinacion_id','=',$familia->combinacion_id)
						->where('restaurante_id','=',Auth::user()->id_restaurante)
						->get();
			$arrayproductos[] = array('fnombre'=>$familia->fnombre,
							'combinacion_id'=>$familia->combinacion_id,
							'combcantidad'=>$familia->combcantidad,
							'combcantidad2'=>$familia->combcantidad,
							'productos'=>$productos
							);
		}

		return Response::json($arrayproductos);
	}

}
