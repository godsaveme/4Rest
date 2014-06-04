<?php

class CombinacionController extends BaseController {

	public function getIndex()
	{
        $combinacions = Combinacion::all();
        return View::make('combinacions.index', compact('combinacions'));
	}

	public function getCreate()
	{
		$tipodecombinacion = TipoComb::all();
        return View::make('combinacions.create', compact('tipodecombinacion'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		$combinacion = Combinacion::create(Input::all());
		$insertedId = $combinacion->id;
		if(Input::get('flag_pro')== 1){
			for ($i=0; $i <= Input::get('contador'); $i++) {
			$dato= Input::get('pro_'.$i);
			if(isset($dato)){
				$precio = new Precio;
				$precio->producto_id = Input::get('pro_'.$i);
				$precio->combinacion_id = $insertedId;
				$precio->precio=Input::get('pro_pre_'.$i);
				$precio->seleccionador = Input::get('procant_'.$i);
				$precio->save();
			} 
			}
		}
		return Redirect::to('combinacions');
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
		$tipodecombinacion = TipoComb::all();
        return View::make('combinacions.edit',compact('tipodecombinacion','combinacion'));
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
