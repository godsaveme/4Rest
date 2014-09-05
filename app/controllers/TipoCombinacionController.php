<?php

class TipoCombinacionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$tipocombinacion = TipoComb::all();
        return View::make('tipocombinacions.index', compact('tipocombinacion'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return View::make('tipocombinacions.create');
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
				//$error = 'ERROR';
		 		//throw new Exception($error);
		$tipodecombinacion = TipoComb::create(Input::all());
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/tipocombinacions'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('tipocombinacions.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$tipocomb = TipoComb::find($id);
        return View::make('tipocombinacions.edit', compact('tipocomb'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		DB::beginTransaction();	

		try {
		$tipocomb = TipoComb::find($id);
		$tipocomb->Update(Input::all());
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/tipocombinacions'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
		//
		DB::beginTransaction();	

		try {
			$tipocomb = TipoComb::find($id);
			$tipocomb->delete();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}

	public function getTipocombinacion(){
		$tipocombinacion = DB::select( DB::raw("select * from (select tipocomb.id as TipoCombinacionId, tipocomb.nombre as TipoCombinacionNombre, 
						combinacion.id as CombinacionId, combinacion.nombre as CombinacionNombre, horComb.FechaInicio AS x1, 
						horComb.FechaTermino AS x2, horComb.id AS horComb_id 
					    from combinacion inner join tipocomb
						on tipocomb.id = combinacion.TipoComb_id inner join horComb
						on combinacion.id = horComb.combinacion_id ) as x
						WHERE curdate() BETWEEN CAST(x.x1 AS DATE) AND CAST(x.x2 AS DATE)
						AND	CASE WHEN  DATE_FORMAT(x.x1,'%H:%i') <=  DATE_FORMAT(x.x2,'%H:%i') THEN 
						curtime() BETWEEN DATE_FORMAT(x.x1,'%H:%i') AND DATE_FORMAT(x.x2,'%H:%i') ELSE 
						curtime() NOT BETWEEN DATE_FORMAT(x.x2,'%H:%i') AND DATE_FORMAT(x.x1,'%H:%i') END 
						AND DAYOFWEEK(curdate()) IN ( SELECT dias_id FROM det_dias WHERE det_dias.horcomb_id = x.horComb_id)
						and x.CombinacionNombre != 'Normal' group by x.TipoCombinacionId order by x.TipoCombinacionNombre DESC"));
		return Response::json($tipocombinacion);
	}
}
