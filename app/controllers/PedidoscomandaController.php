<?php

class PedidoscomandaController extends \BaseController {

	public function getIndex() {
		$usuarios = Usuario::where('id_restaurante', '=', Auth::user()->id_restaurante)->lists('id');
		$platoscontrol = DetPedido::select('usuario.login', 'mesa.nombre as mesa', 'detallepedido.id', 
								'detallepedido.estado', 'producto.nombre', 'detallepedido.cantidad',
								'detallepedido.fechaInicio')
								->join('producto', 'producto.id', '=', 'detallepedido.producto_id')
								->join('pedido', 'pedido.id', '=', 'detallepedido.pedido_id')
								->join('detmesa', 'detmesa.pedido_id', '=', 'pedido.id')
								->join('mesa', 'detmesa.mesa_id', '=', 'mesa.id')
								->join('usuario','usuario.id', '=', 'pedido.usuario_id')
								->where('pedido.estado','!=', 'T')
								->where('detallepedido.estado','!=', 'D')
								->where('detallepedido.estado','!=', 'A')
								->wherein('pedido.usuario_id',$usuarios)
								->whereNull('detallepedido.detalle_id')
								->get();
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
										mesa.id,pedido.id as pedidoid , usuario.login, SUM(dettiketpedido.precio) as consumo')
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
								$arrayocupadas['pagado_'.$ocupada->id] = Mesa::selectraw('SUM(dettiketpedido.precio) as pagado')
										->leftJoin('detmesa', 'detmesa.mesa_id', '=', 'mesa.id')
										->leftJoin('pedido', 'pedido.id','=', 'detmesa.pedido_id')
										->leftJoin('usuario', 'pedido.usuario_id','=', 'usuario.id')
										->leftJoin('dettiketpedido', 'dettiketpedido.pedido_id','=', 'pedido.id')
										->where('pedido.estado', '!=','T')
										->where('pedido.estado', '!=','A')
										->whereNull('dettiketpedido.ticket_id')
										->where('mesa.id', '=', $ocupada->id)
										->first();	
							}
						}
					}
				}
		return View::make('pedidoscomanda.index', compact('salones', 'arraymesas', 'detcaja','platoscontrol','arrayocupadas'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getCargarmesa($id = NULL, $mozoid = NULL) {
		$usuarios = Usuario::where('id_restaurante', '=', Auth::user()->id_restaurante)->lists('id');
		$platoscontrol = DetPedido::select('usuario.login', 'mesa.nombre as mesa', 'detallepedido.id', 
								'detallepedido.estado', 'producto.nombre', 'detallepedido.cantidad',
								'detallepedido.fechaInicio')
								->join('producto', 'producto.id', '=', 'detallepedido.producto_id')
								->join('pedido', 'pedido.id', '=', 'detallepedido.pedido_id')
								->join('detmesa', 'detmesa.pedido_id', '=', 'pedido.id')
								->join('mesa', 'detmesa.mesa_id', '=', 'mesa.id')
								->join('usuario','usuario.id', '=', 'pedido.usuario_id')
								->where('pedido.estado','!=', 'T')
								->where('detallepedido.estado','!=', 'D')
								->where('detallepedido.estado','!=', 'A')
								->wherein('pedido.usuario_id',$usuarios)
								->whereNull('detallepedido.detalle_id')
								->get();
		if ($mozoid) {
			$infomozo = Usuario::find($mozoid);
			$idusuario = $infomozo->id;
		}
		if ($id) {
			/*CARTA*/
			$familias = Familia::select('familia.nombre', 'familia.id')
						 ->join('producto', 'producto.familia_id', '=', 'familia.id')
						 ->join('precio', 'precio.producto_id', '=', 'producto.id')
						 ->where('precio.combinacion_id', '=', 1)
						 ->groupby('familia.nombre')
						 ->get();
			$tiposcomb = DB::select( DB::raw("select * from (select tipocomb.id as TipoCombinacionId, tipocomb.nombre as TipoCombinacionNombre, 
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
						and x.CombinacionNombre != 'Normal' group by x.TipoCombinacionId"));
			$combinaciones = array();
			foreach ($tiposcomb as $dato) {
				$combinaciones[$dato->TipoCombinacionId] = DB::select( DB::raw("select * from (select tipocomb.id as TipoCombinacionId, tipocomb.nombre as TipoCombinacionNombre, 
						combinacion.id as CombinacionId, combinacion.precio as CombinacionPrecio,combinacion.nombre as CombinacionNombre, horComb.FechaInicio AS x1, 
						horComb.FechaTermino AS x2, horComb.id AS horComb_id 
					    from combinacion inner join tipocomb
						on tipocomb.id = combinacion.TipoComb_id inner join horComb
						on combinacion.id = horComb.combinacion_id ) as x
						WHERE curdate() BETWEEN CAST(x.x1 AS DATE) AND CAST(x.x2 AS DATE)
						AND	CASE WHEN  DATE_FORMAT(x.x1,'%H:%i') <=  DATE_FORMAT(x.x2,'%H:%i') THEN 
						curtime() BETWEEN DATE_FORMAT(x.x1,'%H:%i') AND DATE_FORMAT(x.x2,'%H:%i') ELSE 
						curtime() NOT BETWEEN DATE_FORMAT(x.x2,'%H:%i') AND DATE_FORMAT(x.x1,'%H:%i') END 
						AND DAYOFWEEK(curdate()) IN ( SELECT dias_id FROM det_dias WHERE det_dias.horcomb_id = x.horComb_id)
						and x.TipoCombinacionId =".$dato->TipoCombinacionId." GROUP BY CombinacionId"));
			}
			$platosfamilia = array();
			foreach ($familias as $dato) {
				$platosfamilia[$dato->nombre] = Producto::select('producto.nombre', 'producto.id', 'precio.precio', 'producto.cantidadsabores')
												 ->join('precio', 'precio.producto_id', '=', 'producto.id')
												 ->join('combinacion', 'combinacion.id', '=', 'precio.combinacion_id')
												 ->where('combinacion.nombre', '=', 'Normal')
												 ->where('producto.familia_id', '=', $dato->id, 'AND')
												 ->where('producto.estado', '=', 1)
												 ->get();
			}
			/*fincarta*/
			$mesa = Mesa::find($id);
			$Opedido = $mesa->pedidos()->whereIn('pedido.estado', array('I'))->first();
			if (isset($Opedido)) {
				$idusuario = $Opedido->usuario->id;
			}
			if ($Opedido) {
				$combinacionesp = DetPedido::selectraw('detallepedido.cantidad , combinacion.nombre,detallepedido.combinacion_id, 
							 combinacion.precio as preciotcomb,detallepedido.combinacion_c')->join('combinacion', 'combinacion.id', '=', 'detallepedido.combinacion_id')->join('precio', 'combinacion.id', '=', 'precio.combinacion_id')->whereraw("pedido_id =".$Opedido->id." AND combinacion_c IS NOT NULL")->groupby('combinacion_id', 'combinacion_c')->orderby('detallepedido.id', 'DESC')->get();
				$platosp = DetPedido::select('detallepedido.pedido_id', 'producto.nombre as pnombre', 'detallepedido.combinacion_c', 
							'detallepedido.ordenCocina', 'detallepedido.cantidad', 'detallepedido.id', 'detallepedido.estado', 'detallepedido.importefinal')->join('producto', 'producto.id', '=', 'detallepedido.producto_id')
				            ->where('detallepedido.pedido_id', '=', $Opedido->id)
				            ->where('detallepedido.combinacion_c', '=', NULL, 'AND')
				            ->where('detallepedido.estado', '!=', 'A', 'AND')
				            ->orderby('detallepedido.id', 'DESC')
				            ->get();
				$placombinacionp = array();
				foreach ($combinacionesp as $dato) {
					$placombinacionp[$dato->combinacion_id.'_'.$dato->combinacion_c] = DetPedido::select('detallepedido.pedido_id', 'producto.nombre as pnombre', 'detallepedido.combinacion_c', 'detallepedido.ordenCocina', 'detallepedido.cantidad', 'detallepedido.id', 'detallepedido.estado')->join('producto', 'producto.id', '=', 'detallepedido.producto_id')->where('detallepedido.pedido_id', '=', $Opedido->id)->where('detallepedido.combinacion_c', '=', $dato->combinacion_c, 'AND')->where('detallepedido.combinacion_id', '=', $dato->combinacion_id, 'AND')->orderby('detallepedido.id', 'DESC')->get();
				}
				$infomozo = NULL;
			}elseif (!isset($idusuario)) {
				$mesa->actividad = NULL;
				$mesa->estado = 'L';
				$mesa->save();
				return Redirect::to('/pedidoscomanda');
			} else {
				$mesa->actividad = $idusuario;
				$mesa->estado = 'L';
				$mesa->save();
			}
			return View::make('pedidoscomanda.cargarmesa', compact('mesa', 'Opedido', 'combinacionesp', 'platosp', 'placombinacionp', 
							'familias', 'tiposcomb', 'platosfamilia', 'combinaciones', 'infomozo','platoscontrol'));
		}else {
			return Redirect::to('/pedidoscomanda');
		}
	}

}