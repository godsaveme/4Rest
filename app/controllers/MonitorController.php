<?php

class MonitorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /monitor
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$restaurantes = Restaurante::all()->lists('nombreComercial', 'id');
		return View::make('monitores.index', compact('restaurantes'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /monitor/create
	 *
	 * @return Response
	 */
	public function postIndex()
	{
		$idrestaurante = Input::get('restaurante_id');
		return Redirect::to('/monitores/monitorgeneral/'.$idrestaurante);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /monitor
	 *
	 * @return Response
	 */
	public function getArea($id=NULL)
	{
		$monitor= 1;
		if(isset($id)){
			$area = Areadeproduccion::find($id);
			$monitor = 1;
			if($area->id_tipo == 1 || $area->id_tipo == 3){
				$pedidos = DetPedido::select('mesa.nombre','detallepedido.fechaInicio','detallepedido.pedido_id','detallepedido.ordenCocina')
						->join('detmesa', 'detmesa.pedido_id','=','detallepedido.pedido_id')
						->join('mesa', 'detmesa.mesa_id' , '=', 'mesa.id')
                        ->whereraw(" detallepedido.estado != 'T' and idarea = ".$area->id)
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
		        				->where('detallepedido.estado','!=','A', 'AND')
		        				->where('idarea','=' ,$area->id , 'AND')
		        				->groupBy('producto_id')
		        				->get();
		        foreach ($pedidos as $datos) {
		        $platos[$datos->pedido_id.'_'.$datos->ordenCocina] = DetPedido::select('detallepedido.estado','detallepedido.producto_id',
		        				'detallepedido.cantidad', 'producto.nombre', 'detallepedido.cantidad', 'detallepedido.id', 
		        				'detallepedido.pedido_id', 'detallenotas.detallePedido_id as detnota')
		        				->leftJoin('detallenotas', 'detallenotas.detallePedido_id', '=', 'detallepedido.id')
		                        ->join('producto','detallepedido.producto_id','=','producto.id')
		                        ->whereraw("pedido_id =".$datos->pedido_id." and ordenCocina =".$datos->ordenCocina."
		                        	and detallepedido.estado != 'D' and detallepedido.idarea =".$area->id)
		                        ->whereNull('detallepedido.detalle_id', 'AND')
		                        ->groupBy('detallepedido.id')
		                        ->get();
		        }
		        return View::make('monitores.cocina', compact('pedidos', 'platos', 'platospanel', 'monitor', 'area'));
			}elseif ($area->id_tipo == 2) {
				$salones = Salon::where('restaurante_id', '=', Auth::user()->id_restaurante)->get();
				$arraymesas = array();
				$arrayocupadas = array();
				foreach ($salones as $salon) {
					$oarraymesas[$salon->id] = Mesa::where('salon_id', '=', $salon->id)->get();
					foreach ($oarraymesas[$salon->id] as $dato) {
						$mesa = Mesa::find($dato->id);
						$Opedido = $mesa->pedidos()->whereIn('pedido.estado', array('I'))->first();
						if (!isset($Opedido)) {
							$mesa->actividad = NULL;
							$mesa->estado = 'L';
						}else{
							$mesa->actividad = NULL;
							$mesa->estado = 'O';
						}
						$mesa->save();
					}
					$arraymesas[$salon->id] = Mesa::where('salon_id', '=', $salon->id)->get();
					$ocupadas = Mesa::selectraw('mesa.estado , mesa.nombre , pedido.created_at, 
										mesa.id , usuario.login, SUM(dettiketpedido.precio) as consumo')
										->leftJoin('detmesa', 'detmesa.mesa_id', '=', 'mesa.id')
										->leftJoin('pedido', 'pedido.id','=', 'detmesa.pedido_id')
										->leftJoin('usuario', 'pedido.usuario_id','=', 'usuario.id')
										->leftJoin('dettiketpedido', 'dettiketpedido.pedido_id','=', 'pedido.id')
										->where('pedido.estado', '!=','T')
										->where('pedido.estado', '!=','A')
										->where('salon_id', '=', $salon->id)
										->groupby('id')
										->get();
					foreach ($arraymesas[$salon->id]  as $mesita) {
						foreach ($ocupadas as $ocupada) {
							if($mesita->id == $ocupada->id){
								$arrayocupadas[$ocupada->id] = $ocupada;
							}
						}
					}
				}
				return View::make('monitores.caja', compact('salones', 'arraymesas', 'detcaja', 'platoscontrol','arrayocupadas', 'monitor', 'area'));
			}else{
				return Redirect::to('/monitores');
			}
		}else{
			return Redirect::to('/monitores');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /monitor/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getMonitorgeneral($id = NULL)
	{
		if (isset($id)) {
			$restaurante = Restaurante::find($id);
			$mesas = Mesa::select('mesa.id','mesa.nombre')
					->join('salon', 'salon.id', '=', 'mesa.salon_id')
					->where('salon.restaurante_id', '=',$id)->get();
			$arrayproductos = array();
			$arrayconsumos = array();
			$arrayprecuentas = array();
			foreach ($mesas as $mesa) {
			$arrayproductos['mesa_'.$mesa->id] = DetPedido::select('detallepedido.id','producto.nombre', 'detallepedido.estado', 'detallepedido.fechaInicio', 
												'detallepedido.fechaProceso','detallepedido.fechaDespacho', 'detallepedido.fechaDespachado',
												'detallepedido.cantidad')
												->join('producto', 'producto.id','=', 'detallepedido.producto_id')
												->join('pedido', 'pedido.id', '=', 'detallepedido.pedido_id')
												->join('detmesa', 'pedido.id', '=', 'detmesa.pedido_id')
												->where('pedido.estado', '!=','A')
												->where('pedido.estado', '!=', 'T')
												->where('detallepedido.estado', "!=", 'A')
												->where('detmesa.mesa_id', '=', $mesa->id)
												->get();
			}

			foreach ($mesas as $mesa) {
				$arrayconsumos['mesa_'.$mesa->id] = Detpedidotick::selectraw('pedido.id as idpedido, sum(dettiketpedido.precio) as preciot,
													usuario.login, pedido.fechaInicio')
													->join('pedido', 'pedido.id', '=', 'dettiketpedido.pedido_id')
													->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
													->join('detmesa', 'detmesa.pedido_id', '=', 'pedido.id')
													->where('pedido.estado', '!=', 'A')
													->where('pedido.estado', '!=', 'T')
													->where('detmesa.mesa_id', '=', $mesa->id)
													->groupby('idpedido')
													->first();
			}
			foreach ($mesas as $mesa) {
				$arrayprecuentas['mesa_'.$mesa->id] =Detpedidotick::join('pedido', 'pedido.id', '=', 'dettiketpedido.pedido_id')
													->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
													->join('detmesa', 'detmesa.pedido_id', '=', 'pedido.id')
													->where('pedido.estado', '!=', 'A')
													->where('pedido.estado', '!=', 'T')
													->where('detmesa.mesa_id', '=', $mesa->id)
													->whereNull('dettiketpedido.ticket_id')
													->count();
			}
			return View::make('monitores.monitorgeneral', 
				compact('mesas', 'restaurante', 'arrayproductos','arrayconsumos', 'arrayprecuentas'));
		}else{
			return Redirect::to('monitores');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /monitor/{id}/edit
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
	 * PUT /monitor/{id}
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
	 * DELETE /monitor/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}