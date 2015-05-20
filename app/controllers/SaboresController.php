<?php

class SaboresController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$sabores = Sabor::all();
		return Response::view('sabores.index', compact('sabores'));
	}

	public function getIndexdet(){
		$prod_sabor = Producto::has('sabores')->get();
		return Response::view('sabores.indexdet', compact('prod_sabor'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		//
		//$insumos = Insumo::lists('nombre','id');
		return Response::view('sabores.create',compact('insumos'));
	}

	public function getCreatedet(){
		return Response::view('sabores.createdet');
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
             if(Input::get('insumo_id') == ''){
                 $datos = array(
                     'nombre' 				 => Input::get('nombre'),
                     'descripcion'				 => Input::get('descripcion'),
                     'porcion'               => Input::get('porcion'),
                     'habilitado'                     => Input::get('habilitado')
                 );
                 Sabor::create($datos);
             }else{
                 Sabor::create(Input::all());
             }

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => $e->getMessage()));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/sabores'));
	}

	public function postStoredet()
	{
		DB::beginTransaction();	
		try {
		$wl = Input::get('wordlist');
		$sabores = json_decode($wl);
			if(count($sabores) > 0){
				foreach ($sabores as $sabor) {
					$detsabor = new DetSabor;
					$detsabor->producto_id = Input::get('producto_id');
					$detsabor->sabor_id = $sabor->id;
					$detsabor->save();
				}
			}
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/sabores/indexdet'));
	}

	/**
	 * Display the specified resource.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		//
		$sabor = Sabor::find($id);
		//$insumos = Insumo::lists('nombre','id');
		return Response::view('sabores.edit',compact('sabor','insumos'));
	}

	public function getEditdet($id)
	{
		$producto = Producto::find($id);
		$sabores = $producto->sabores->toJson();
		return Response::view('sabores.editdet', compact('producto','sabores'));
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
			$sabor = Sabor::find($id);
            if(Input::get('insumo_id') == ''){
                $datos = array(
                    'nombre' 				 => Input::get('nombre'),
                    'descripcion'				 => Input::get('descripcion'),
                    'insumo_id'         => null,
                    'porcion'               => Input::get('porcion'),
                    'habilitado'                     => Input::get('habilitado')
                );
                $sabor->update($datos);
            }else{
                $sabor->update(Input::all());
            }
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => $e->getMessage()));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/sabores'));
	}

	public function postUpdatedet()
	{
		DB::beginTransaction();	
		try {
		Producto::find(Input::get('producto_id'))->sabores()->detach();
		$wl = Input::get('wordlist');
		$sabores = json_decode($wl);
			if(count($sabores) > 0){
				foreach ($sabores as $sabor) {
					$detsabor = new DetSabor;
					$detsabor->producto_id = Input::get('producto_id');
					$detsabor->sabor_id = $sabor->id;
					$detsabor->save();
				}
				
			}
		
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/sabores/indexdet'));
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

		$sabor = Sabor::find($id);
		$sabor->delete();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}

	public function postDestroydet($id)
	{
		//
		DB::beginTransaction();	

		try {

		Producto::find($id)->sabores()->detach();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}

}