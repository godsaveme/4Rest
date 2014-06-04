<?php

class CocinaController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$pedidos = DetPedido::select('mesa.nombre','detallepedido.fechaInicio','detallepedido.pedido_id','detallepedido.ordenCocina')
						->join('detmesa', 'detmesa.pedido_id','=','detallepedido.pedido_id')
						->join('mesa', 'detmesa.mesa_id' , '=', 'mesa.id')
                        ->whereraw(" detallepedido.estado != 'T' and idarea = ".Auth::user()->id_tipoareapro)
                        ->where('detallepedido.estado', '!=', 'E')
                        ->where('detallepedido.estado', '!=', 'A')
                        ->where('detallepedido.estado', '!=', 'D')
                        ->whereNull('detallepedido.detalle_id', 'AND')
                        ->groupBy('ordenCocina')
                        ->orderBy('ordenCocina','asc')
                        ->get();
        $platos = array();   
        $platospanel = DetPedido::selectraw("detallepedido.producto_id , sum(detallepedido.cantidad) as sumcantidad ,
        				producto.nombre, detallepedido.estado")
        				->join('producto','detallepedido.producto_id','=','producto.id')
        				->where('detallepedido.estado','!=','D')
        				->where('detallepedido.estado','!=','E', 'AND')
        				->where('detallepedido.estado','!=','P', 'AND')
        				->where('detallepedido.estado','!=','A', 'AND')
        				->where('idarea','=' ,Auth::user()->id_tipoareapro , 'AND')
        				->groupBy('producto_id')
        				->get();
        foreach ($pedidos as $datos) {
        $platos[$datos->pedido_id.'_'.$datos->ordenCocina] = DetPedido::select('detallepedido.estado','detallepedido.producto_id',
        				'detallepedido.cantidad', 'producto.nombre', 'detallepedido.cantidad', 'detallepedido.id', 
        				'detallepedido.pedido_id', 'detallenotas.detallePedido_id as detnota')
        				->leftJoin('detallenotas', 'detallenotas.detallePedido_id', '=', 'detallepedido.id')
                        ->join('producto','detallepedido.producto_id','=','producto.id')
                        ->whereraw("pedido_id =".$datos->pedido_id." and ordenCocina =".$datos->ordenCocina."
                        	and detallepedido.estado != 'D' and detallepedido.idarea =".Auth::user()->id_tipoareapro)
                        ->whereNull('detallepedido.detalle_id', 'AND')
                        ->groupBy('detallepedido.id')
                        ->get();
        }
        return View::make('cocina.index', compact('pedidos', 'platos', 'platospanel'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('cocina.create');
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
        return View::make('cocina.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('cocina.edit');
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
