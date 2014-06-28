<?php

class DetallepediController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /detallepedi
	 *
	 * @return Response
	 */
	public function getIndex($idrestaurante = 2)
	{
		if (isset($idrestaurante)) {
			$restaurante = Restaurante::find($idrestaurante);
			return View::make('detallepedidos.reportetiempos',compact('restaurante'));
		}else{
			return Redirect::to('/web');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /detallepedi/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /detallepedi
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /detallepedi/{id}
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
	 * GET /detallepedi/{id}/edit
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
	 * PUT /detallepedi/{id}
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
	 * DELETE /detallepedi/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}