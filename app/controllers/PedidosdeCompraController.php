<?php

class PedidosdeCompraController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$pedidos = Pedidocompra::all();
        return View::make('pedidosdecompras.index', compact('pedidos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return View::make('pedidosdecompras.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$peidocom = Pedidocompra::create(Input::all());
		$peidocom->usuario_id = Auth::user()->persona_id;
		$peidocom->save();
		$insertedid = $peidocom->id;
		for ($i=0; $i <=Input::get('contador') ; $i++){
			$insumoid = Input::get('pe_id_insu_'.$i); 
			if(isset($insumoid)){
				$datos = array('ingreso_id'=>$insertedid, 
								'insumo_id' => $insumoid, 
								'cantidad' =>Input::get('pe_cantinsu_'.$i), 
								'costo' =>Input::get('pe_preuins_'.$i), 
								'importe_final'=>Input::get('pe_pret_'.$i), 
								'descuento_final'=>Input::get('pe_des'.$i));
			DetalleIngresoInsumo::create($datos);
			}
		}
		return Redirect::to('pedidoscompras');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('pedidosdecompras.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('pedidosdecompras.edit');
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
