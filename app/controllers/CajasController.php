<?php
class CajasController extends BaseController {
	public $detcaja;
	public function __construct() {
		$this->detcaja = Detcaja::where('estado', '=', 'A')
						->where('usuario_id', '=', Auth::user()->id, 'AND')
						->first();
	}

	public function getIndex($idcaja = NULL) {
		$usuarios = Usuario::where('id_restaurante', '=', Auth::user()->id_restaurante)->lists('id');
		/*$platoscontrol = DetPedido::select('usuario.login', 'mesa.nombre as mesa', 'detallepedido.id', 
								'detallepedido.estado', 'producto.nombre', 'detallepedido.cantidad',
								'detallepedido.fechaInicio', 'detallepedido.fechaProceso', 
								'detallepedido.fechaDespacho', 'detallepedido.fechaDespachado')
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
		*/						
		if ($idcaja) {
			$caja = Caja::find($idcaja);
			$detcaja = $caja->detallecaja()->where('estado', '=', 'A')
					 ->where('usuario_id', '=', Auth::user()->id, 'AND')
					 ->first();
			if (count($detcaja) > 0) {
                //add salon habilitado 30-05-15
				$salones = Salon::where('restaurante_id', '=', Auth::user()->id_restaurante)->where('habilitado','=',1)->get();
				$arraymesas = array();
				$arrayocupadas = array();
				foreach ($salones as $salon) {
					$oarraymesas[$salon->id] = Mesa::where('salon_id', '=', $salon->id)->get();
					//print_r($oarraymesas); die();
                    //limpiar mesas
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
                    //fin limpiar mesas
                    //add mesa habilitada 30-05-15
					$arraymesas[$salon->id] = Mesa::where('salon_id', '=', $salon->id)->where('habilitado','=',1)->get();
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
				//para las mesas juntadas
				$arrPedJuntar = array();
				$ContJuntar = 1;
				foreach ($arrayocupadas as $dato) {
					if (count(DetMesa::where('pedido_id','=',$dato['pedidoid'])->get()) > 1) {
						if (array_search($dato['pedidoid'],$arrPedJuntar) != null) continue;
						$arrPedJuntar[$ContJuntar] = $dato['pedidoid'];
						$ContJuntar++;
					}
					
				}
				//print_r($arrPedJuntar);
				//die();
				//fin
				return View::make('cajas.index2', compact('salones', 'arraymesas', 'detcaja', 'platoscontrol','arrayocupadas','arrPedJuntar'));
			} else {
				$cajas = Caja::where('id','=',0);
				if (Auth::user()->persona->perfil->nombre === 'Caja') {
					
				
				$cajas = Caja::where('restaurante_id', '=', Auth::user()->id_restaurante)->where('estado', '=', '0')->lists('descripcion','id');
				}
				return View::make('cajas.abrircaja', compact('cajas'));
			}
		} else {
			$detcaja = Detcaja::where('estado', '=', 'A')->where('usuario_id', '=', Auth::user()->id)->first();
			if (count($detcaja) > 0) {
				//print_r('asd'); die();
				return Redirect::to('/cajas/index/'.$detcaja->caja_id);
			} else {
				$cajas = Caja::where('id','=',0);
				if (Auth::user()->persona->perfil->nombre === 'Caja') {
					
				
				$cajas = Caja::where('restaurante_id', '=', Auth::user()->id_restaurante)->where('estado', '=', '0')->lists('descripcion','id');
				}
				return View::make('cajas.abrircaja', compact('cajas'));
			}
		}
	}

	public function postIndex() {
		$reglas = array(
			'caja_id' => array(
				'required',
				'numeric',
			),
			'montoInicial' => array(
				'required',
				'regex:/^[0-9]{1,3}([0-9]{3})*\.[0-9]+$/',
			),
		);
		$validator = Validator::make(Input::all(), $reglas);
		if ($validator->fails()) {
			return Redirect::to('/cajas')->withErrors($validator)->withInput();
		} else {
			$caja_id = Input::get('caja_id');
			$ocaja = Caja::find($caja_id);
            //comprueba si la caja está abierta.
			if ($ocaja->estado == 0) {
				$detallecaja = Detcaja::create(Input::all(), $reglas);
				$ocaja = $detallecaja->caja;
				$ocaja->estado = 1;
				$ocaja->save();
				$detallecaja->usuario_id = Auth::user()->id;
				$detallecaja->estado = 'A';
				$detallecaja->fechaInicio = $detallecaja->created_at;
				$detallecaja->save();
				return Redirect::to('/cajas/index/'.$caja_id);
			} else {
				return Redirect::to('/cajas');
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getCargarmesa($id = NULL, $mozoid = NULL) {
		$usuarios = Usuario::where('id_restaurante', '=', Auth::user()->id_restaurante)->lists('id');
		/*$platoscontrol = DetPedido::select('usuario.login', 'mesa.nombre as mesa', 'detallepedido.id', 
								'detallepedido.estado', 'producto.nombre', 'detallepedido.cantidad',
								'detallepedido.fechaInicio', 'detallepedido.fechaProceso', 
								'detallepedido.fechaDespacho', 'detallepedido.fechaDespachado')
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
		*/						
		if ($mozoid) {
			$infomozo = Usuario::find($mozoid);
			$idusuario = $infomozo->id;
		}
		if ($id) {
			$detcaja = Detcaja::where('estado', '=', 'A')->where('usuario_id', '=', Auth::user()->id, 'AND')->first();
			/*CARTA*/
			$oComb = Combinacion::where('nombre','=','Normal')->first();
			/*$familias = Familia::select('familia.nombre', 'familia.id')
								->join('producto', 'producto.familia_id', '=', 'familia.id')
								->join('precio', 'precio.producto_id', '=', 'producto.id')
								->where('precio.combinacion_id', '=', $oComb->id)
								->groupby('familia.nombre')
								->get();*/
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

			/*$platosfamilia = array();
			foreach ($familias as $dato) {
				$platosfamilia[$dato->nombre] = Producto::select('producto.nombre', 'producto.id', 'precio.precio', 'producto.cantidadsabores', 'producto.imagen')
												 ->join('precio', 'precio.producto_id', '=', 'producto.id')
												 ->join('combinacion', 'combinacion.id', '=', 'precio.combinacion_id')
												 ->where('combinacion.nombre', '=', 'Normal')
												 ->where('producto.familia_id', '=', $dato->id, 'AND')
												 ->where('producto.estado', '=', 1)
												 ->orderby('producto.nombre','ASC')
												 ->get();
			}*/
			//print_r($platosfamilia); die();
			/*fincarta*/
			$mesa = Mesa::find($id);
			$Opedido = $mesa->pedidos()->whereIn('pedido.estado', array('I'))->first();
			if (isset($Opedido)) {
				$idusuario = $Opedido->usuario->id;
			}
			//print_r($idusuario); die();
			if ($Opedido) {
				$combinacionesp = DetPedido::selectraw('detallepedido.cantidad , combinacion.nombre,detallepedido.combinacion_id, 
							 combinacion.precio as preciotcomb,detallepedido.combinacion_c')
							->join('combinacion', 'combinacion.id', '=', 'detallepedido.combinacion_id')
							->join('precio', 'combinacion.id', '=', 'precio.combinacion_id')
							->whereraw("pedido_id =".$Opedido->id." AND combinacion_c IS NOT NULL")
							//add 08-12-14 11:07
							->where('detallepedido.estado','!=','A')
							//
							->groupby('combinacion_id', 'combinacion_c')
							->orderby('detallepedido.id', 'DESC')
							->get();
				$platosp = DetPedido::select('detallepedido.pedido_id', 'producto.nombre as pnombre', 'detallepedido.combinacion_c',
							'detallepedido.ordenCocina', 'detallepedido.cantidad', 'detallepedido.id', 'detallepedido.estado', 'detallepedido.importefinal')
                            ->join('producto', 'producto.id', '=', 'detallepedido.producto_id')
                            //->leftjoin('detallenotas','detallenotas.detallePedido_id','=','detallepedido.id')
                            //->leftjoin('notas','notas.id','=','detallenotas.notas_id')
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
			} elseif (!isset($idusuario)) {
				$mesa->actividad = NULL;
				$mesa->estado = 'L';
				$mesa->save();
				return Redirect::to('/cajas');
			} else {
				$mesa->actividad = $idusuario;
				$mesa->estado = 'O';
				$mesa->save();
			}
			$listamesas = array();
			$restaurante = Restaurante::find(Auth::user()->id_restaurante);
			$salones = $restaurante->salones()->get();
			foreach ($salones as $salon) {
				$omesasa = $salon->mesas()->where('estado', '=', 'L')->lists('nombre', 'id');
					$listamesas[$salon->nombre] = $omesasa;
			}
            foreach ($salones as $salon) {
                $omesasa = $salon->mesas()->lists('nombre', 'id');
                $listamesasJuntar[$salon->nombre] = $omesasa;
            }
			$autorizados = Usuariosautorizados::all()->lists('usuario_id');
			$usuariosautorizados = Usuario::selectraw("usuario.id, Concat(persona.nombres,' ' , persona.apPaterno) as nombre")
									->join('persona','persona.id', '=', 'usuario.persona_id')
									->wherein('usuario.id', $autorizados)
									->lists('nombre', 'id');
			//print_r($combinacionesp);
			//die();
			return View::make('cajas.cargarmesa2', compact('mesa', 'Opedido', 'combinacionesp', 
															'platosp', 'placombinacionp', 'familias', 
															'tiposcomb', 'platosfamilia', 'combinaciones', 
															'infomozo', 'detcaja', 'listamesas','listamesasJuntar','platoscontrol', 'usuariosautorizados'));
		} else {
			return Redirect::to('/cajas');
		}
	}

	public function getRegistrargasto($iddetalle = NULL) {
		if (isset($iddetalle)) {
            $cajaabierta =  Detcaja::find($iddetalle);
            if ($cajaabierta->estado == 'A' and $cajaabierta->usuario_id == \Illuminate\Support\Facades\Auth::user()->id) {
                $detcaja = $this->detcaja;
                //print_r($detcaja->toJson()); die();
                $tiposdegastos = Tiposdegatos::lists('descripcion', 'id');
                return View::make('cajas.registrargasto', compact('iddetalle', 'detcaja', 'tiposdegastos'));
            }else{
                return Redirect::to('/cajas');
            }
		} else {
			return Redirect::to('/cajas');
		}
	}

	public function postRegistrargasto() {
		$reglas = array(
			'detallecaja_id' => array(
				'required',
				'numeric',
			),
			'tipogasto_id' => array(
				'required',
				'numeric',
			),
			'importetotal' => array(
				'required',
				'regex:/^[0-9]{1,3}([0-9]{3})*\.[0-9]+$/',
			),
			'igv' => array(
				'regex:/^[0-9]{1,3}([0-9]{3})*\.[0-9]+$/',
			),
			'subtotal' => array(
				'regex:/^[0-9]{1,3}([0-9]{3})*\.[0-9]+$/',
			),
			'descripcion' => array(
				'required',
			),
			'numerodecomprobante' => array(),
			'seriecomprobante' => array(),
			'numerocargo' => array(),
		);
		$validator = Validator::make(Input::all(), $reglas);
		if ($validator->fails()) {
			return Redirect::to('/cajas/registrargasto/'.Input::get('detallecaja_id'))->withErrors($validator)->withInput();
		} else {
			$oGasto = Regitrodegastos::create(Input::all());
			return Redirect::to('/cajas');
		}
	}

	public function getRegistraringreso($iddetalle = NULL) {
		if (isset($iddetalle)) {
            //print_r(\Illuminate\Support\Facades\Auth::user()->id); die();
            $cajaabierta =  Detcaja::find($iddetalle);
            if ($cajaabierta->estado == 'A' and $cajaabierta->usuario_id == \Illuminate\Support\Facades\Auth::user()->id) {
                $detcaja = $this->detcaja;
                $tiposdeingresos = Tiposdeingresos::lists('descripcion', 'id');
                return View::make('cajas.registraringreso', compact('iddetalle', 'detcaja', 'tiposdeingresos'));
            }else{
                return Redirect::to('/cajas');
            }
		} else {
			return Redirect::to('/cajas');
		}
	}

	public function postRegistraringreso() {
        $reglas = array(
            'detallecaja_id' => array(
                'required',
                'numeric',
            ),
            'tipoingreso_id' => array(
                'required',
                'numeric',
            ),
            'importetotal' => array(
                'required',
                'regex:/^[0-9]{1,3}([0-9]{3})*\.[0-9]+$/',
            ),
            'igv' => array(
                'regex:/^[0-9]{1,3}([0-9]{3})*\.[0-9]+$/',
            ),
            'subtotal' => array(
                'regex:/^[0-9]{1,3}([0-9]{3})*\.[0-9]+$/',
            ),
            'descripcion' => array(
                'required',
            ),
            'numerodecomprobante' => array(),
            'seriecomprobante' => array(),
            'numerocargo' => array(),
        );
		$validator = Validator::make(Input::all(), $reglas);
		if ($validator->fails()) {
			return Redirect::to('/cajas/registraringreso/'.Input::get('detallecaja_id'))->withErrors($validator)->withInput();
		} else {
			$oIngreso = Ingresocaja::create(Input::all());
			return Redirect::to('/cajas');
		}
	}

	public function getCerrarcaja($detallecaja_id = NULL) {
		if (isset($detallecaja_id)) {
			$detcaja = $this->detcaja;
            if (empty($detcaja)) return Redirect::to('/cajas');
			//$detcaja = Detcaja::find('420');
			//$totalventas = $detcaja->tickets()->where('ticketventa.estado', '=', 0)->sum('importe');
			//print_r($totalventas);
			//die();
			$totalventas = $detcaja->tickets()->where('ticketventa.estado', '=', 0)
							->where('ticketventa.importe', '>=', 0)->sum('importe');
			$efectivo = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 1)
						->where('ticketventa.estado', '=', 0)
						->where('ticketventa.importe', '>=', 0)
						//->sum('ticketventa.importe');
                        ->sum('Detformadepago.importe');
			$tarjetas = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 2)
						->where('ticketventa.estado', '=', 0)
						->where('ticketventa.importe', '>=', 0)
						//->sum('ticketventa.importe');
                        ->sum('Detformadepago.importe');
			$descuentosautorizados = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 3)
						->where('ticketventa.estado', '=', 0)
						->where('ticketventa.importe', '>=', 0)
						->sum('ticketventa.idescuento');
			$valespersonal = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 4)
						->where('ticketventa.estado', '=', 0)
						->where('ticketventa.importe', '>=', 0)
						->sum('ticketventa.idescuento');
			$promociones = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 5)
						->where('ticketventa.estado', '=', 0)
						->where('ticketventa.importe', '>=', 0)
						->sum('ticketventa.idescuento');
			$totalgastos = $detcaja->gastos()->where('estado','=',1)->sum('importetotal');
			$totalingresoscaja = $detcaja->abonocaja()->sum('importetotal');
			$importetotal = number_format($totalventas+$detcaja->montoInicial+$totalingresoscaja -$totalgastos, 2, '.', '');
			return View::make('cajas.cerrarcaja', compact('importetotal', 'totalventas', 
							'odetcaja', 'totalgastos', 'detcaja', 'totalingresoscaja','efectivo',
							'tarjetas', 'descuentosautorizados', 'valespersonal', 'promociones'));
		} else {
			return Redirect::to('/cajas');
		}
	}

	public function postCerrarcaja() {
		$detcaja = $this->detcaja;
        //$detcaja = Detcaja::find(420);
		$reglas = array(
			'arqueo' => array(
				'required',
				'regex:/^[0-9]{1,3}([0-9]{3})*\.[0-9]+$/',
			),
		);
		$validator = Validator::make(Input::all(), $reglas);
		if ($validator->fails()) {
			return Redirect::to('/cajas/cerrarcaja/'.$detcaja->id)->withErrors($validator)->withInput();
		} elseif($detcaja->estado == 'A' && $detcaja->caja->estado == '1') {

			$totalventas = $detcaja->tickets()->where('ticketventa.estado', '=', 0)->where('ticketventa.importe','>=',0)->sum('importe');
			//print_r($totalventas);
			//die();
			$totalgastos = $detcaja->gastos()->where('estado','=',1)->sum('importetotal');
			$totalingresoscaja = $detcaja->abonocaja()->sum('importetotal'); //VERIFICAR SI YA SE CERRO CAJA (FIX) arreglado!!
            //modify total ingreso caja: round($detcaja->totalingresoscaja,2) cambia a round($totalingresoscaja,2)
			$importetotal = round($totalventas,2) + round($detcaja->montoInicial,2) + round($totalingresoscaja,2) - round($totalgastos,2);
			$arqueo = Input::get('arqueo');
			$diferencia = round($importetotal,2) - round($arqueo,2);
			$caja = $detcaja->caja;
			$caja->estado = 0;
			$caja->save();
			$detcaja->totalingresosacaja = $totalingresoscaja;
			$detcaja->ventastotales = $totalventas;
			$detcaja->gastos = $totalgastos;
			$detcaja->importetotal = $importetotal;
			$detcaja->diferencia = $diferencia;
			$detcaja->arqueo = $arqueo;
			$detcaja->estado = 'C';
			$detcaja->fechaCierre = date('Y-m-d H:i:s');
			$detcaja->save();
			return Redirect::to('/cajas');
		}else{
            $validator->getMessageBag()->add('arqueo', 'La caja ya está cerrada.');
            return Redirect::to('/cajas/cerrarcaja/'.$detcaja->id)->withErrors($validator)->withInput();
        }
	}
	
	public function getListargastos() {
		$detcaja = $this->detcaja;
		return View::make('cajas.listargastos', compact('detcaja'));
	}

	public function getListaringresos() {
		$detcaja = $this->detcaja;
		$listaingresos = $detcaja->abonocaja()->get();
		$contador = 1;
		$totalingresos = $detcaja->abonocaja()->count();
		$totalsoles = $detcaja->abonocaja()->sum('importetotal');
		return View::make('cajas.listaringresos', compact('detcaja', 'listaingresos', 'totalsoles',
							'totalingresos', 'contador'));
	}

	public function getListarventas() {
		$detcaja = $this->detcaja;
		//$detcaja = Detcaja::find('406');
		$tipoconsulta = Input::get('tipoc');	
		$total = -1;
		switch ($tipoconsulta) {
					case 1: //todos
						$tickets = $detcaja->tickets()				
						->get();
						//print_r(count($tickets));
						//die();
						$efectivo = $detcaja->tickets()
										->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
										->where('Detformadepago.formadepago_id', '=', 1)
										->where('ticketventa.estado', '=', 0)
										->where('ticketventa.importe', '>=', 0) //no se agregan los tickets -xx.00 pq al no join con detformadepago
										//->sum('ticketventa.importe');
                                        ->sum('Detformadepago.importe');
						$tarjeta = $detcaja->tickets()
										->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
										->where('Detformadepago.formadepago_id', '=', 2)
										->where('ticketventa.estado', '=', 0)
										->where('ticketventa.importe', '>=', 0)
                                        //->sum('ticketventa.importe');
                                        ->sum('Detformadepago.importe');
					break;
					case 2://efectivo
						$tickets = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 1)
						->where('ticketventa.estado','=',0) //agregar a los demas
						->select('ticketventa.id','ticketventa.numero','ticketventa.subtotal','ticketventa.IGV','ticketventa.importe','ticketventa.idescuento')
						->get();
						//print_r($tickets);
						 //die();
						$total = $detcaja->tickets()
								->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
								->where('Detformadepago.formadepago_id', '=', 1)
								->where('ticketventa.estado','=',0)
                                //->sum('ticketventa.importe');
                                ->sum('Detformadepago.importe');
					break;
					case 3://tarjetas
						$tickets = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 2)
						->select('ticketventa.id','ticketventa.numero','ticketventa.subtotal','ticketventa.IGV','ticketventa.importe','ticketventa.idescuento')
						->get();
						$total = $detcaja->tickets()
								->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
								->where('Detformadepago.formadepago_id', '=', 2)
                                //->sum('ticketventa.importe');
                                ->sum('Detformadepago.importe');
					break;
					case 4://descuentos
						$tickets = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 3)
						->select('ticketventa.id','ticketventa.numero','ticketventa.subtotal','ticketventa.IGV','ticketventa.importe','ticketventa.idescuento')
						->get();
						$total = $detcaja->tickets()
								->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
								->where('Detformadepago.formadepago_id', '=', 3)
								->sum('ticketventa.idescuento');
					break;
					case 5://descuentos
						$tickets = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 4)
						->select('ticketventa.id','ticketventa.numero','ticketventa.subtotal','ticketventa.IGV','ticketventa.importe','ticketventa.idescuento')
						->get();
						$total = $detcaja->tickets()
								->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
								->where('Detformadepago.formadepago_id', '=', 4)
								->sum('ticketventa.idescuento');
					break;
					case 6://descuentos
						$tickets = $detcaja->tickets()
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 5)
						->select('ticketventa.id','ticketventa.numero','ticketventa.subtotal','ticketventa.IGV','ticketventa.importe','ticketventa.idescuento')
						//corregido problema de show importe total = 0.00 pq cogia del detformaped
						->get(); 
						//print_r($tickets);
						//die();
						$total = $detcaja->tickets()
								->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
								->where('Detformadepago.formadepago_id', '=', 5)
								->sum('ticketventa.idescuento');
					break;
				}
		return View::make('cajas.ventastotales', compact('detcaja', 'efectivo', 'tarjeta', 'vale','tickets', 'total'));
	}

	public function getReportescaja() {
		$restaurantes = Restaurante::all()->lists('nombreComercial', 'id');
		return View::make('cajas.reportes', compact('restaurantes'));
	}

	public function postReportediariocaja(){
		$idrestaurante = Input::get('restaurante_id');
		$restaurante = Restaurante::find($idrestaurante);
		return View::make('cajas.reportediario', compact('restaurante'));
	}

	public function getIngresocaja($detallecaja_id = NULL){
		if (isset($iddetalle)) {
			$detcaja = $this->detcaja;
			return View::make('cajas.ingresocaja', compact('detcaja'));
		} else {
			return Redirect::to('/cajas');
		}
	}

	public function getReporteproductoscaja($detallecaja_id = NULL, $flag=NULL){
		$oComb = Combinacion::where('nombre','=','Normal')->first();
		if (isset($detallecaja_id) && !isset($flag)) {
			//$oComb = Combinacion::where('nombre','=','Normal')->first();
			$detacaja = Detcaja::find($detallecaja_id);
			$ventastotales = $detacaja->tickets()->sum('importe');
			$restaurante = $detacaja->caja->restaurante;
			$descuento = Input::get('descuento');
			$totalcantidad= 0;
			$montototal = 0;
			$productos = Detcaja::selectraw('sum(dettiketpedido.precio) as preciot, dettiketpedido.preciou, 
						sum(dettiketpedido.cantidad) as cantidadpro, familia.nombre as fnombre, familia.id as famiid')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('producto', 'producto.id', '=', 'dettiketpedido.producto_id')
						->join('familia', 'familia.id', '=', 'producto.familia_id')
						->where('detallecaja.id', '=', $detallecaja_id)
						->where('ticketventa.estado', '=', 0, 'AND')
						->groupby('fnombre')
						->orderby('preciot', 'Desc')
						->get();
			foreach ($productos as $producto) {
				$totalcantidad = $totalcantidad + $producto->cantidadpro;
				$montototal = $montototal + $producto->preciot;
			}

			$combinaciones = Detcaja::selectraw('sum(dettiketpedido.precio) as preciot, dettiketpedido.preciou, 
						sum(dettiketpedido.cantidad) as cantidadpro, combinacion.nombre as cnombre, combinacion.id as idcomb')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('combinacion', 'combinacion.id', '=', 'dettiketpedido.combinacion_id')
						->where('detallecaja.id', '=', $detallecaja_id)
						->where('ticketventa.estado', '=', 0, 'AND')
						->where('combinacion.id','!=',$oComb->id)
						->groupby('cnombre')
						->orderby('preciot', 'Desc')
						->get();
			foreach ($combinaciones as $combinacion) {
				$totalcantidad = $totalcantidad + $combinacion->cantidadpro;
				$montototal = $montototal + $combinacion->preciot;
			}
			$importeneto = $montototal - $descuento;
			$contador = 1;
			$flag = '';
			return View::make('cajas.reporteproductosvendidos', 
				compact('productos', 'detacaja', 'restaurante', 'contador', 'combinaciones', 
						'flag', 'ventastotales', 'totalcantidad', 'montototal', 'importeneto'));
		}elseif (isset($detallecaja_id) && isset($flag)) {
			if($flag == 1){
				$detacaja = Detcaja::find($detallecaja_id);
				$restaurante = $detacaja->caja->restaurante;
				$cajas= $restaurante->cajas()->lists('id');
				$descuento = Input::get('descuento');
				$ventastotales = 0;
				$totalcantidad= 0;
				$montototal = 0;
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				$cajones = Detcaja::whereBetween('FechaInicio', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->lists('id');
				$ocajones = Detcaja::whereBetween('FechaInicio', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->get();
				foreach ($ocajones as $cajon) {
					$oventa = $cajon->tickets()->sum('importe');
					$ventastotales= $ventastotales + $oventa;
				}

				$productos = Detcaja::selectraw('sum(dettiketpedido.precio) as preciot, dettiketpedido.preciou, 
						sum(dettiketpedido.cantidad) as cantidadpro, familia.nombre as fnombre, familia.id as famiid')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('producto', 'producto.id', '=', 'dettiketpedido.producto_id')
						->join('familia', 'familia.id', '=', 'producto.familia_id')
						->wherein('detallecaja.id', $cajones)
						->where('ticketventa.estado', '=', 0, 'AND')
						->groupby('fnombre')
						->orderby('preciot', 'Desc')
						->get();
				foreach ($productos as $producto) {
				$totalcantidad = $totalcantidad + $producto->cantidadpro;
				$montototal = $montototal + $producto->preciot;
				}
				$combinaciones = Detcaja::selectraw('sum(dettiketpedido.precio) as preciot, dettiketpedido.preciou, 
						sum(dettiketpedido.cantidad) as cantidadpro, combinacion.nombre as cnombre, combinacion.id as idcomb')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('combinacion', 'combinacion.id', '=', 'dettiketpedido.combinacion_id')
						->wherein('detallecaja.id', $cajones)
						->where('ticketventa.estado', '=', 0, 'AND')
						->where('combinacion.id','!=',$oComb->id)
						->groupby('cnombre')
						->orderby('preciot', 'Desc')
						->get();
				foreach ($combinaciones as $combinacion) {
				$totalcantidad = $totalcantidad + $combinacion->cantidadpro;
				$montototal = $montototal + $combinacion->preciot;
				}
				$contador = 1;
				$diario = 1;
				$importeneto = $montototal - $descuento;
				return View::make('cajas.reporteproductosvendidos', 
				compact('ventastotales','productos', 'detacaja', 'restaurante', 'combinaciones','contador', 'diario','flag',
						'fechaInicio', 'fechaFin', 'totalcantidad', 'montototal','importeneto'));
			}else{
				return Redirect::to('/web');
			}
		}
		else {
			return Redirect::to('/web');
		}
	}

	public function getDetalleprovendidos($detallecaja_id = NULL, $familiaid = NULL, $flag = NULL){
		if (isset($detallecaja_id) && isset($familiaid) && !isset($flag)) {
			$detacaja = Detcaja::find($detallecaja_id);
			$restaurante = $detacaja->caja->restaurante;
			$ventastotales = $detacaja->tickets()->sum('importe');
			$productos = Detcaja::selectraw('sum(dettiketpedido.precio) as preciot, dettiketpedido.preciou, 
						sum(dettiketpedido.cantidad) as cantidadpro, producto.nombre as fnombre,
						producto.id as proid')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('producto', 'producto.id', '=', 'dettiketpedido.producto_id')
						->join('familia', 'familia.id', '=', 'producto.familia_id')
						->where('detallecaja.id', '=', $detallecaja_id)
						->where('familia.id', '=', $familiaid)
						->where('ticketventa.estado', '=', 0, 'AND')
						->groupby('fnombre')
						->orderby('preciot', 'Desc')
						->get();
			$contador = 1;
			$flag = '';
			return View::make('cajas.detalleproductosvendidos', 
				compact('productos', 'detacaja', 'restaurante', 'contador', 'flag', 'ventastotales'));
		}elseif (isset($detallecaja_id) && isset($familiaid) && isset($flag)) {
			if($flag == 1){
				$detacaja = Detcaja::find($detallecaja_id);
				$restaurante = $detacaja->caja->restaurante;
				$cajas= $restaurante->cajas()->lists('id');
				$newfecha = substr($detacaja->fechaInicio,0,10);
				$ventastotales = 0;
				$cajones = Detcaja::where('FechaInicio', 'LIKE', $newfecha.'%')
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->lists('id');
				$ocajones = Detcaja::where('FechaInicio', 'LIKE', $newfecha.'%')
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->get();
				foreach ($ocajones as $cajon) {
					$oventa = $cajon->tickets()->sum('importe');
					$ventastotales= $ventastotales + $oventa;
				}
				$productos = Detcaja::selectraw('sum(dettiketpedido.precio) as preciot, dettiketpedido.preciou, 
						sum(dettiketpedido.cantidad) as cantidadpro, producto.nombre as fnombre,
						producto.id as proid')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('producto', 'producto.id', '=', 'dettiketpedido.producto_id')
						->join('familia', 'familia.id', '=', 'producto.familia_id')
						->wherein('detallecaja.id', $cajones)
						->where('familia.id', '=', $familiaid, 'AND')
						->where('ticketventa.estado', '=', 0, 'AND')
						->groupby('fnombre')
						->orderby('preciot', 'Desc')
						->get();
				$contador = 1;
				$diario = 1;
				return View::make('cajas.detalleproductosvendidos', 
				compact('productos', 'detacaja', 'restaurante', 'contador', 'diario', 'flag', 'ventastotales'));
			}else{
				return Redirect::to('/web');
			}
		}else {
			return Redirect::to('/web');
		}
	}

	public function getDetalleticketproductosvendidos($detallecaja_id = NULL, $productoid = NULL, $flag =NULL){
		if (isset($detallecaja_id) && isset($productoid) && !isset($flag)) {
			$detacaja = Detcaja::find($detallecaja_id);
			$restaurante = $detacaja->caja->restaurante;
			$productos = Detcaja::selectraw('dettiketpedido.precio as preciot, dettiketpedido.preciou, 
						dettiketpedido.cantidad as cantidadpro, ticketventa.cajero, ticketventa.mozo,
						ticketventa.cliente, ticketventa.numero ,producto.nombre as fnombre, producto.id as idpro,
						ticketventa.id as idticket')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('producto', 'producto.nombre', '=', 'dettiketpedido.nombre')
						->where('detallecaja.id', '=', $detallecaja_id)
						->where('producto.id', '=', $productoid)
						->where('ticketventa.estado', '=', 0, 'AND')
						->orderby('preciot', 'Desc')
						->get();
			$contador = 1;
			return View::make('cajas.detalleticketxproducto', 
				compact('productos', 'detacaja', 'restaurante', 'contador'));
		}elseif (isset($detallecaja_id) && isset($productoid) && isset($flag)) {
			if($flag == 1){
				$detacaja = Detcaja::find($detallecaja_id);
				$restaurante = $detacaja->caja->restaurante;
				$cajas= $restaurante->cajas()->lists('id');
				$newfecha = substr($detacaja->fechaInicio,0,10);
				$cajones = Detcaja::where('FechaInicio', 'LIKE', $newfecha.'%')
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->lists('id');
				$productos = Detcaja::selectraw('dettiketpedido.precio as preciot, dettiketpedido.preciou, 
						dettiketpedido.cantidad as cantidadpro, ticketventa.cajero, ticketventa.mozo,
						ticketventa.cliente, ticketventa.numero ,producto.nombre as fnombre, producto.id as idpro,
						ticketventa.id as idticket')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('producto', 'producto.nombre', '=', 'dettiketpedido.nombre')
						->wherein('detallecaja.id', $cajones)
						->where('producto.id', '=', $productoid)
						->where('ticketventa.estado', '=', 0, 'AND')
						->orderby('preciot', 'Desc')
						->get();
				$contador = 1;
				$diario = 1;
				return View::make('cajas.detalleticketxproducto', 
				compact('productos', 'detacaja', 'restaurante', 'contador', 'diario'));
			}else{
				return Redirect::to('/web');
			}
		}else {
			return Redirect::to('/web');
		}
	}

	public function getReportestickets($detcajaid = NULL, $flag = NULL){
		if(isset($detcajaid) && !isset($flag)){
			$detacaja = Detcaja::find($detcajaid);
			$restaurante = $detacaja->caja->restaurante;
			
			$tipoconsulta = Input::get('tipoc');
				switch ($tipoconsulta) {
					case 1: //todos
						$tickets = $detacaja->tickets;
					break;
					case 2://efectivo
						$tickets = $detacaja->tickets()->select('ticketventa.id', 'ticketventa.estado', 'ticketventa.importe',
									'ticketventa.numero', 'ticketventa.mozo', 'ticketventa.cajero', 
									'ticketventa.idescuento', 'ticketventa.cliente')
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 1)
						->get();
					break;
					case 3://tarjetas
						$tickets = $detacaja->tickets()->select('ticketventa.id', 'ticketventa.estado', 'ticketventa.importe',
									'ticketventa.numero', 'ticketventa.mozo', 'ticketventa.cajero', 
									'ticketventa.idescuento','ticketventa.cliente')
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 2)
						->get();
					break;
					case 4://descuentos
						$tickets = $detacaja->tickets()->select('ticketventa.id', 'ticketventa.estado', 'ticketventa.importe',
									'ticketventa.numero', 'ticketventa.mozo', 'ticketventa.cajero', 
									'ticketventa.idescuento','ticketventa.cliente')
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->wherein('Detformadepago.formadepago_id', array(3,4,5))
						->get();
					break;
				}
			$contador = 1;
			$montototal = 0;
			$cantidadtickets = 0;
			$totaldescuentos = 0;
			foreach ($tickets as $ticket) {
				if ($ticket->estado == 0 && $ticket->importe >= 0) {
					$montototal = $montototal + $ticket->importe;
					$cantidadtickets++;
					$totaldescuentos = $totaldescuentos + $ticket->idescuento;
				}
			}
			return View::make('cajas.reportetickets', compact('tickets','detacaja', 
						'contador','restaurante', 'montototal','cantidadtickets', 'totaldescuentos'));
		}elseif (isset($detcajaid) && isset($flag)) {
			if($flag == 1){
				$detacaja = Detcaja::find($detcajaid);
				$restaurante = $detacaja->caja->restaurante;
				$cajas= $restaurante->cajas()->lists('id');
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				$cajones = Detcaja::whereBetween('FechaInicio', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->lists('id');
				$tipoconsulta = Input::get('tipoc');
				switch ($tipoconsulta) {
					case 1: //todos
						$tickets = Ticket::wherein('ticketventa.detcaja_id', $cajones)->get();
					break;
					case 2://efectivo
						$tickets = Ticket::select('ticketventa.id', 'ticketventa.estado', 'ticketventa.importe',
									'ticketventa.numero', 'ticketventa.mozo', 'ticketventa.cajero', 
									'ticketventa.idescuento', 'ticketventa.id', 'ticketventa.cliente')
						->wherein('ticketventa.detcaja_id', $cajones)
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 1)
						->get();
					break;
					case 3://tarjetas
						$tickets = Ticket::select('ticketventa.id', 'ticketventa.estado', 'ticketventa.importe',
									'ticketventa.numero', 'ticketventa.mozo', 'ticketventa.cajero', 
									'ticketventa.idescuento', 'ticketventa.id', 'ticketventa.cliente')
						->wherein('ticketventa.detcaja_id', $cajones)
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->where('Detformadepago.formadepago_id', '=', 2)
						->get();
					break;
					case 4://descuentosautorizados
						$tickets = Ticket::select('ticketventa.id', 'ticketventa.estado', 'ticketventa.importe',
									'ticketventa.numero', 'ticketventa.mozo', 'ticketventa.cajero', 
									'ticketventa.idescuento', 'ticketventa.id', 'ticketventa.cliente')
						->wherein('ticketventa.detcaja_id', $cajones)
						->join('Detformadepago', 'Detformadepago.ticket_id', '=', 'ticketventa.id')
						->wherein('Detformadepago.formadepago_id', array(3,4,5))
						->get();
					break;
				}
				$montototal = 0;
				$cantidadtickets = 0;
				$totaldescuentos = 0;
				//print_r($tickets); die();
				foreach ($tickets as $ticket) {
					if ($ticket->estado == 0 && $ticket->importe >= 0) {
						$montototal = $montototal + $ticket->importe;
						$cantidadtickets++;
						$totaldescuentos = $totaldescuentos + $ticket->idescuento;
					}
				}
				$contador = 1;
				$diario = 1;
				return View::make('cajas.reportetickets', compact('tickets','detacaja', 
						'contador','restaurante', 'diario','montototal','cantidadtickets', 'totaldescuentos',
						'fechaInicio', 'fechaFin'));
			}else{
				return Redirect::to('/web');
			}
		}else{
			return Redirect::to('/web');
		}
	}

	public function getReportegastos($detcajaid = NULL, $flag = NULL){
		if(isset($detcajaid) && !isset($flag)){
			$detacaja = Detcaja::find($detcajaid);
			$restaurante = $detacaja->caja->restaurante;
			$gastos = $detacaja->gastos()->get();
			$contador = 1;
			$totalgastos = 0;
			foreach ($gastos as $gasto) {
                if($gasto->estado == 1) {
                    $totalgastos = $totalgastos + $gasto->importetotal;
                }
			}
			return View::make('cajas.reportegastos', 
				compact('gastos','detacaja', 'contador','restaurante','totalgastos'));
		}elseif (isset($detcajaid) && isset($flag)) {
			if($flag == 1){
				$detacaja = Detcaja::find($detcajaid);
				$restaurante = $detacaja->caja->restaurante;
				$cajas= $restaurante->cajas()->lists('id');
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				$cajones = Detcaja::whereBetween('FechaInicio', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->lists('id');
				$gastos = Regitrodegastos::wherein('detallecaja_id', $cajones)
							 ->get();
				$totalgastos = 0;
				foreach ($gastos as $gasto) {
                    if($gasto->estado == 1) {
                        $totalgastos = $totalgastos + $gasto->importetotal;
                    }
				}
				$contador = 1;
				$diario = 1;
				return View::make('cajas.reportegastos', 
					compact('gastos','detacaja', 'contador','restaurante', 'diario','totalgastos', 
							'fechaInicio', 'fechaFin'));
			}else{
				return Redirect::to('/web');
			}
		}else{
			return Redirect::to('/web');
		}
	}

	public function getReportedescuentos($detcajaid = NULL, $flag = NULL){
		if(isset($detcajaid) && !isset($flag)){
			$detacaja = Detcaja::find($detcajaid);
			$restaurante = $detacaja->caja->restaurante;
			$descuentos = $detacaja->tickets()->where('ticketventa.estado','=',0)
						->where('ticketventa.importe', '>=', 0)
						->where('ticketventa.idescuento', '!=', 0)->get();
			$contador = 1;
			$montototal = 0;
			$totaldescuentos = 0;
			foreach ($descuentos as $descuento) {
				$montototal = $montototal + $descuento->importe;
				$totaldescuentos = $totaldescuentos + $descuento->idescuento;
			}
			return View::make('cajas.reportedescuentosxticket', compact('descuentos','detacaja', 
							'contador','restaurante', 'montototal', 'totaldescuentos'));
		}elseif (isset($detcajaid) && isset($flag)) {
			if($flag == 1){
				$detacaja = Detcaja::find($detcajaid);
				$restaurante = $detacaja->caja->restaurante;
				$cajas= $restaurante->cajas()->lists('id');
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				$cajones = Detcaja::whereBetween('FechaInicio', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->lists('id');
				$descuentos = Ticket::wherein('ticketventa.detcaja_id', $cajones)
							->where('ticketventa.estado','=',0)
							->where('ticketventa.importe', '>=', 0)
							 ->where('ticketventa.idescuento', '!=', 0, 'AND')->get();
				$montototal = 0;
				$totaldescuentos = 0;
				foreach ($descuentos as $descuento) {
					$montototal = $montototal + $descuento->importe;
					$totaldescuentos = $totaldescuentos + $descuento->idescuento;
				}
				$contador = 1;
				$diario = 1;
				return View::make('cajas.reportedescuentosxticket', compact('descuentos','detacaja', 
								'contador','restaurante', 'diario','fechaInicio', 'fechaFin','montototal',
								'totaldescuentos'));
			}else{
				return Redirect::to('/web');
			}
		}
		else{
			return Redirect::to('/web');
		}
	}

	public function getDetallecombinaciones($detallecaja_id = NULL, $combinacionid = NULL, $flag =NULL){

		if (isset($detallecaja_id) && isset($combinacionid) && !isset($flag)) {
			$detacaja = Detcaja::find($detallecaja_id);
			$restaurante = $detacaja->caja->restaurante;
			$combinaciones = Detcaja::selectraw('dettiketpedido.precio as preciot, dettiketpedido.preciou, 
						dettiketpedido.cantidad as cantidadpro, ticketventa.cajero, ticketventa.mozo,
						ticketventa.cliente, ticketventa.numero ,combinacion.nombre as nombrecomb, combinacion.id as idcomb,
						ticketventa.id as idticket')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('combinacion', 'combinacion.id', '=', 'dettiketpedido.combinacion_id')
						->where('detallecaja.id', '=', $detallecaja_id)
						->where('combinacion.id', '=', $combinacionid)
						->where('ticketventa.estado', '=', 0, 'AND')
						->orderby('preciot', 'Desc')
						->get();
			$contador = 1;
			return View::make('cajas.detalleticketxcomb', 
				compact('combinaciones', 'detacaja', 'restaurante', 'contador'));
		}elseif (isset($detallecaja_id) && isset($combinacionid) && isset($flag)) {
			if($flag == 1){
				$detacaja = Detcaja::find($detallecaja_id);
				$restaurante = $detacaja->caja->restaurante;
				$cajas= $restaurante->cajas()->lists('id');
				$newfecha = substr($detacaja->fechaInicio,0,10);
				$cajones = Detcaja::where('FechaInicio', 'LIKE', $newfecha.'%')
							->wherein('caja_id', $cajas)
							->orderby('FechaInicio')
							->lists('id');
				$combinaciones = Detcaja::selectraw('dettiketpedido.precio as preciot, dettiketpedido.preciou, 
						dettiketpedido.cantidad as cantidadpro, ticketventa.cajero, ticketventa.mozo,
						ticketventa.cliente, ticketventa.numero ,combinacion.nombre as nombrecomb, combinacion.id as idcomb,
						ticketventa.id as idticket')
						->join('ticketventa', 'ticketventa.detcaja_id', '=', 'detallecaja.id')
						->join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('combinacion', 'combinacion.id', '=', 'dettiketpedido.combinacion_id')
						->wherein('detallecaja.id', $cajones)
						->where('combinacion.id', '=', $combinacionid)
						->where('ticketventa.estado', '=', 0, 'AND')
						->orderby('preciot', 'Desc')
						->get();
				$contador = 1;
				$diario = 1;
				return View::make('cajas.detalleticketxcomb', 
				compact('combinaciones', 'detacaja', 'restaurante', 'contador', 'diario'));
			}else{
				return Redirect::to('/web');
			}
		}else {
			return Redirect::to('/web');
		}

	}
}
