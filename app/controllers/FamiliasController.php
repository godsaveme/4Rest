<?php

class FamiliasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$familias = Familia::all();
        return View::make('familias.index', compact('familias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return View::make('familias.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//Familia::create(Input::all());
		$familia = Familia::create(Input::all());
		//$familia = new Familia;
		//$familia->nombre = Input::get('nombre');
		//$familia->descripcion = Input::get('descripcion');
		//$familia->save();
		if(Input::hasFile('imagen'))
		{
		$path = $familia->id.'_'.Input::file('imagen')->getClientOriginalName();
		Input::file('imagen')->move('images/familias/',$path);
		$familia = Familia::find($familia->id);
		$familia->imagen = $path;
		$familia->save();
		}
		//$path = Input::file('image')->getRealPath();
		//print_r($path);
		//die();
		
		return Redirect::to('familias');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$familia = Familia::find($id);
        return View::make('familias.show', compact('familia'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$familia = Familia::find($id);
        return View::make('familias.edit', compact('familia'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		$familia = Familia::find($id);
		$familia->nombre = Input::get('nombre');
		$familia->descripcion = Input::get('descripcion');
		$familia->save();
		if(Input::hasFile('image'))
		{
		$path = $familia->id.'_'.Input::file('image')->getClientOriginalName();
		Input::file('image')->move('images/familias/',$path);

		$familia = Familia::find($familia->id);
		$familia->imagen = $path;
		$familia->save();
		}
		//$path = Input::file('image')->getRealPath();
		//print_r($path);
		//die();
		
		return Redirect::to('familias');
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
		$familia = Familia::find($id);
		$familia->delete();
		} catch (Exception $e) {
			return false;
		}
		
		return json_encode($e);

	}

}
