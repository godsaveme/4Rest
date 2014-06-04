<?php

class PedidosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$arraymesas = array();
		$salones = Salon::all();
		foreach ($salones as $dato) {
			$mesas = Mesa::where('salon_id','=',$dato->id)->get();
			$arraymesas[$dato->id] =$mesas; 
		}
        return View::make('pedidos.index',compact('salones','arraymesas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($salon, $mesa_nombre,$id_mesa)
	{
		$familias = Familia::where('nombre','!=', 'Adicionales')->get();
		$arrayproductos = array();
		foreach ($familias as $dato) {
			$arrayproductos[$dato->id] = Producto::select()->join('precio', 'precio.producto_id' ,'=', 'producto.id')->whereraw('producto.familia_id ='.$dato->id.' and producto.estado = 1 and precio.combinacion_id = 1')->get();
		}
        return View::make('pedidos.create', compact('salon','mesa_nombre', 'id_mesa', 'familias','arrayproductos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('pedidos.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('pedidos.edit');
	}

	/**
	 * Update the specified resource in storage.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
