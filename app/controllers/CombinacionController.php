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
		//var_dump(Input::all());
		//var_dump('fin');
		$wl = Input::get('wordlist');
		$prods = json_decode($wl);
		//foreach ($prods as $prod) {
		//	var_dump($prod->nombre);
		//}
		// die();
		// var_dump(count($prods));
		
		// if (count($prods)>0) {
		// 	echo 'ok';
		// }
		//var_dump(Input::get('FechaInicio'));
		//die();


		$combinacion = Combinacion::create(Input::all());
		$insertedId = $combinacion->id;

		$horComb = new Horcomb;
		$horComb->FechaInicio = Input::get('FechaInicio');
		$horComb->FechaTermino = Input::get('FechaTermino');
		$horComb->combinacion_id = $insertedId;
		$horComb->save();

		$insertedIdHorComb = $horComb->id;

		// Input::get('foobar'.1);
		// Input::get('foobar'.2);
		// Input::get('foobar'.3);
		// Input::get('foobar'.4);
		// Input::get('foobar'.5);
		// Input::get('foobar'.6);
		// Input::get('foobar'.7);



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
				$precio->save();
			}


			
		 }
		

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
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
        return View::make('combinacions.edit',compact('tipodecombinacion','combinacion','familias'));
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
		//var_dump(Input::all());
		//die();

		DB::beginTransaction();	
		 try {

		$wl = Input::get('wordlist');
		$prods = json_decode($wl);

		$combinacion = Combinacion::find(Input::get('id'));
		$combinacion->update(Input::all());
		//$combinacion->save();
		$insertedId = $combinacion->id;



		$horComb = Horcomb::where('combinacion_id','=',$insertedId)->first(); 

		//$horComb = new Horcomb;
		$horComb->FechaInicio = Input::get('FechaInicio');
		$horComb->FechaTermino = Input::get('FechaTermino');
		//$horComb->combinacion_id = $insertedId;
		$horComb->save();

		$insertedIdHorComb = $horComb->id;

		// Input::get('foobar'.1);
		// Input::get('foobar'.2);
		// Input::get('foobar'.3);
		// Input::get('foobar'.4);
		// Input::get('foobar'.5);
		// Input::get('foobar'.6);
		// Input::get('foobar'.7);

		$det_dias = Detdias::where('horcomb_id','=',$insertedIdHorComb)->delete();

		//die();

		//$arrDetdias = 

		//Detdias::

		for ($i=1; $i < 8  ; $i++) { 

			if (!empty(Input::get('foobar'.$i))) {

				$det_dias = new Detdias;
				$det_dias->horcomb_id = $insertedIdHorComb;
				$det_dias->dias_id = Input::get('foobar'.$i);
				$det_dias->save();

			}
		}

		$precios = Precio::where('combinacion_id','=',$insertedId)->delete();

		//die();

		if(count($prods) > 0){
			foreach ($prods as $prod) {
				$precio = new Precio;
				$precio->producto_id = $prod->id;
				$precio->combinacion_id = $insertedId;
				$precio->cantidad = $prod->cantidad;
				$precio->save();
			}


			
		 }


		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
		$e= true;
		try {
		$tipocomb = TipoComb::find($id);
		$tipocomb->delete();
		} catch (Exception $e) {
			return false;
		}
		
		return json_encode($e);

	}

}
