<?php

class ReportesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /reportes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /reportes/create
	 *
	 * @return Response
	 */
	public function getReportesemanal($id=NULL)
	{
		if (isset($id)) {
			$restaurante = Restaurante::find($id);
			return View::make('reportes.rotacionsemanal', compact('restaurante'));
		}else{
			return Redirect::to('/web');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /reportes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /reportes/{id}
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
	 * GET /reportes/{id}/edit
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
	 * PUT /reportes/{id}
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
	 * DELETE /reportes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}