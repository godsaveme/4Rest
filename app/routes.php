<?php
define('TIKET_DIR', public_path('temp/'));

Route::get('/', function () {
	return Redirect::to('login');
});

Route::get('login', function () {
	if (Auth::check()) {
		return Redirect::to('web');
	} else {
		return View::make('login');
	}
});

Route::post('login', function () {
	if (Auth::attempt(array('login' => Input::get('login'), 'password' => Input::get('password'), 'estado' => 1), true)) {
		if (Input::has('remember')) {
			Session::put('TIME_SESSION', 43200);
		} else {
			Session::put('TIME_SESSION', 2700);
		}
		return Redirect::to('web');
	} else {
		return Redirect::to('login')->with('mensaje_login', 'Ingreso invalido');
	}
});

Route::group(array('before' => 'auth'), function (){
	Route::get('logout', function () {
		if (Auth::check()) {
			Auth::logout();return 
			Redirect::to('login');
		} else {
			return Redirect::to('login');
		}
	});
	Route::controller('/usuarios', 'UsuariosController');
	Route::controller('/insumos', 'InsumosController');
	Route::controller('/productos', 'ProductosController');
	Route::controller('/web', 'WebController');
	Route::controller('/notas', 'NotasController');
	Route::controller('/cocina', 'CocinaController');
	Route::controller('/pedidos', 'PedidosController');
	Route::controller('/combinacions', 'CombinacionController');
	Route::controller('/tipocombinacions', 'TipoCombinacionController');
	Route::controller('/tipocombinacions', 'TipoCombinacionController');
	Route::controller('/personas', 'PersonasController');
	Route::controller('/perfiles', 'PerfilesController');
	Route::controller('/pedidoscompras', 'PedidosdeCompraController');
	Route::controller('/cajas', 'CajasController');
	Route::controller('/pedidoscomanda', 'PedidoscomandaController');
	Route::controller('/eventos', 'EventosController');
	Route::controller('/tickets', 'TicketsController');
	Route::post('provincias', function () {
	$patron = '';
		if (Request::ajax()) {
			$patron = Input::get('parametro');
			if (isset($patron)) {
				$provincias = Ubigeo::where('departamento', 'like', $patron.'%')->groupBy('provincia')->get();
				return Response::json($provincias);
			}
		}
	});

	Route::post('distritos', function () {
		if (Request::ajax()) {
			$patron = Input::get('parametro');
			if (isset($patron)) {
				$distritos = Ubigeo::where('provincia', 'like', $patron.'%')->get();
				return Response::json($distritos);
			}
		}
	});
	Route::post('bpernom', function () {
		if (Request::ajax()) {
			$patron = Input::get('parametro');
			if (isset($patron)) {
				$personas = DB::select('select persona.id, persona.nombres, persona.apPaterno, persona.apMaterno
                            from persona left join usuario on persona.id = usuario.persona_id where usuario.persona_id
                            is NULL and nombres like ? or apPaterno like ? or apMaterno like ?', array($patron.'%', $patron.'%', $patron.'%'));
				return Response::json($personas);
			}
		}
	}
	);Route::post('bperdni', function () {
		if (Request::ajax()) {
			$patron = Input::get('parametro');
			if (isset($patron)) {
				$personas = DB::select('select persona.id, persona.nombres, persona.apPaterno, persona.apMaterno
                            from persona left join usuario on persona.id = usuario.persona_id where usuario.persona_id
                            is NULL and dni like ?', array($patron.'%'));;return Response::json($personas);
			}
		}
	}
	);Route::post('buscar_provedores', function () {
		if (Request::ajax()) {
			$patron = Input::get('parametro');
			$provedores = Persona::whereraw("razonSocial like '".$patron."%' and perfil_id = '4'")->take(10)->get();
			return $provedores->toJson();
		}
	}
	);
	Route::post('buscarinsumos', function () {
		if (Request::ajax()) {
			$patron = Input::get('parametro');
			$insumos = Insumo::where('nombre', 'like', $patron.'%')->take(10)->get();
			return $insumos->toJson();
		}
	}
	);
	Route::post('buscarareasp', function () {
		if (Request::ajax()) {
			$patron = Input::get('parametro');
			$insumos = Areadeproduccion::where('id_restaurante', 'like', $patron.'%')->get();
			return $insumos->toJson();
		}
	}
	);
	Route::post('enviarcocina', function () {
		if (Request::ajax()) {
			$pedido = Input::get('pedido');
			$id_area = Input::get('idarea');
			$orden = Input::get('orden');
			$arraydatoscocina = array();
			DetPedido::whereraw("detallepedido.pedido_id =".$pedido." and detallepedido.estado = 'I' 
						and idarea = ".Auth::user()->id_tipoareapro)
						->update(array('detallepedido.estado' => 'C'));
			$detallepedido = DetPedido::select('detallepedido.estado', 'detallepedido.ordenCocina', 'detallepedido.cantidad', 
				'producto.id as productoid', 'producto.nombre', 'detallepedido.cantidad', 
				'detallepedido.id', 'detallepedido.pedido_id', 'detallepedido.detalle_id')
				->join('producto', 'detallepedido.producto_id', '=', 'producto.id')
				->whereraw("detallepedido.pedido_id =".$pedido." and detallepedido.estado
                             = 'C' and idarea = ".Auth::user()->id_tipoareapro." and 
                             detallepedido.ordenCocina = ".$orden)
				->groupBy('detallepedido.id')
				->get();

			foreach ($detallepedido as $detalleitem) {
				$adi = $detalleitem->detalle_id;
				if(!isset($adi)){
					$adicionales = DetPedido::select('producto.nombre','detallepedido.cantidad')
									->join('producto', 'detallepedido.producto_id', '=', 'producto.id')
									->where('detallepedido.detalle_id', '=', $detalleitem->id)
									->groupBy('detallepedido.id')
									->get();
					$notas = $detalleitem->notas()->lists('descripcion');
					$sabores = $detalleitem->sabores()->lists('nombre');
					$arraydatoscocina[] = array('estado'=>$detalleitem->estado,
												'ordenCocina'=>$detalleitem->ordenCocina,
												'cantidad'=>$detalleitem->cantidad,
												'productoid'=>$detalleitem->productoid,
												'nombre'=>$detalleitem->nombre,
												'id'=>$detalleitem->id,
												'pedido_id'=>$detalleitem->pedido_id,
												'adicionales'=>json_decode($adicionales->toJson()),
												'sabores'=>$sabores,
												'notas'=>$notas,
												'cornometro'=>date('Y-m-d').'T'.date('H:i:s'));
				}
			}

			return Response::json($arraydatoscocina);
		}
	});

	Route::post('verificarcocinas', function () {
		if (Request::ajax()) {
			$local = Input::get('parametro');
			$areas = Areadeproduccion::select('tipoareadeproduccion.nombre', 'areadeproduccion.id_tipo', 
					'areadeproduccion.id', 'areadeproduccion.nombre as areanombre')
					->join('tipoareadeproduccion', 'tipoareadeproduccion.id', '=', 'areadeproduccion.id_tipo')
					->whereraw("id_restaurante = '".$local."' and  id_tipo != 2")
					->get();
			return $areas->toJson();
		}
	});

	Route::post('mozonotificaciones', function () {
		if (Request::ajax()) {
			$getestado = Input::get('estado');
			$estado = $getestado;
			$iddetalle = Input::get('iddetallep');
			if ($estado != '') {
				$opedido = DetPedido::select('pedido.id','usuario.login', 'mesa.nombre', 
							'producto.nombre as pnombre', 'detallepedido.combinacion_c',
							'usuario.id_tipoareapro', 'areadeproduccion.nombre as anombre')
						->join('producto', 'producto.id', '=', 'detallepedido.producto_id')
						->join('pedido', 'pedido.id', '=', 'detallepedido.pedido_id')
						->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
						->join('detmesa', 'detmesa.pedido_id', '=', 'detallepedido.pedido_id')
						->join('mesa', 'mesa.id', '=', 'detmesa.mesa_id')
						->join('areadeproduccion', 'areadeproduccion.id', '=', 'usuario.id_tipoareapro')
						->where('detallepedido.id', '=', $iddetalle)
						->first();
				$odepedido = DetPedido::find(Input::get('iddetallep'), array('id'));
					if ($getestado == 'I' || $getestado == "C") {
						$estado = 'P';
						$odepedido->fechaProceso = date('Y-m-d H:i:s');
					} elseif ($getestado == 'P') {
						$estado = 'E';
						$odepedido->fechaDespacho = date('Y-m-d H:i:s');
					} elseif ($getestado == 'E') {
						$estado = 'D';
						$odepedido->fechaDespachado = date('Y-m-d H:i:s');
					}
				$adicionales = DetPedido::where('detalle_id', '=', $iddetalle)->get();
				if(!empty($adicionales)){
					foreach ($adicionales as $adicional) {
						if ($getestado == 'I' || $getestado == "C") {
							$estado = 'P';
							$adicional->fechaProceso = date('Y-m-d H:i:s');
						} elseif ($getestado == 'P') {
							$estado = 'E';
							$adicional->fechaDespacho = date('Y-m-d H:i:s');
						} elseif ($getestado == 'E') {
							$estado = 'D';
							$adicional->fechaDespachado = date('Y-m-d H:i:s');
						}
						$adicional->estado= $estado;
						$adicional->save();
					}
				}
				$odepedido->estado = $estado;
				$odepedido->save();
				$arrayco = array('estado' => $estado, 
							'iddetallep' => Input::get('iddetallep'), 
							'usuario' => $opedido->login, 
							'mesa' => $opedido->nombre, 
							'pedido' => $opedido->id, 
							'producto' => $opedido->pnombre, 
							'combinacion_c' => $opedido->combinacion_c,
							'areapro'=>$opedido->anombre.'_'.$opedido->id_tipoareapro);
				return Response::json($arrayco);
			}
		}
	}
	);
	Route::post('listarproductos', function () {
		if (Request::ajax()) {
			$orden = Input::get('pedido');
			$productos = DetPedido::select('pedido.id', 'usuario.login', 'mesa.nombre', 'producto.nombre as pnombre', 'detallepedido.combinacion_c', 'detallepedido.ordenCocina', 'detallepedido.cantidad', 'detallepedido.id as detpedid', 'detallepedido.estado')->join('producto', 'producto.id', '=', 'detallepedido.producto_id')->join('pedido', 'pedido.id', '=', 'detallepedido.pedido_id')->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')->join('detmesa', 'detmesa.pedido_id', '=', 'detallepedido.pedido_id')->join('mesa', 'mesa.id', '=', 'detmesa.mesa_id')->whereraw("detallepedido.pedido_id =".Input::get('pedido')." and detallepedido.estado != 'D'")->get();
			return $productos->toJson();
		}
	});
	Route::post('guardarnotas', function () {
		if (Request::ajax()) {
			$familias = Input::get('familias');
			$idnota = Input::get('idnota');
			$insertanotas = array();
			foreach ($familias as $familia) {
				$dato = Familia::find($familia['id']);
				$arradatos = $dato->productos;
				foreach ($arradatos as $datos) {
					$insertanotas[] = array('nota_id' => $idnota, 'producto_id' => $datos->id);
				}
			}
			$numero = Notasxproductos::insert($insertanotas);
			if ($numero) {
				$familias = Notasxproductos::select('familia.id', 'familia.nombre')->join('producto', 'notaxproducto.producto_id', '=', 'producto.id')->join('familia', 'familia.id', '=', 'producto.familia_id')->where('notaxproducto.nota_id', '=', $idnota)->groupBy('familia_id')->get();
			}
			return $familias->toJson();
		}
	}
	);
	Route::post('eliminarnotas', function () {
		if (Request::ajax()) {
			$id = Input::get('idfamilia');
			$borrar = Notasxproductos::select('notaxproducto.id')
					   ->join('producto', 'notaxproducto.producto_id', '=', 'producto.id')
					   ->join('familia', 'producto.familia_id', '=', 'familia.id')
					   ->where('familia.id', '=', $id)
					   ->lists('id');
			Notasxproductos::wherein('id', $borrar)->delete();return json_encode($borrar);
		}
	}
	);
	Route::controller('/modulos', 'ModulosController');Route::post('mostrarnotas', function () {
		if (Request::ajax()) {
			$idpro = Input::get('idpro');
			$notas = Notas::Select('notas.id', 'notas.descripcion')->join('notaxproducto', 'notaxproducto.nota_id', '=', 'notas.id')->where('notaxproducto.producto_id', '=', $idpro)->get();
			return $notas->toJson();
		}
	}
	);
	Route::post('mostrarnotascocina', function () {
		if (Request::ajax()) {
			$iddet = Input::get('iddet');
			$notas = DetPedido::find($iddet)->notas;
			return $notas->toJson();
		}
	}
	);
	Route::post('traermozos', function () {
		$idres = Input::get('idres');
		$mozos = Usuario::where('colaborador', '=', '2')->where('id_restaurante', '=', Auth::user()->id_restaurante, 'AND')->get();
		return $mozos->toJson();
	}
	);
	Route::post('getcombinaciones', function () {
		if (Request::ajax()) {
			$idcombi = Input::get('idcombi');
			$familias = Familia::selectraw('familia.id , familia.nombre, sum(DISTINCT precio.cantidad) as fcantidad')
						 ->join('producto', 'producto.familia_id', '=', 'familia.id')
						 ->join('precio', 'precio.producto_id', '=', 'producto.id')
						 ->where('precio.combinacion_id', '=', $idcombi)
						 ->groupBy('familia.id')
						 ->get();
			$procombi = array();
			foreach ($familias as $dato) {
				$productosc = Producto::select('producto.id', 'producto.nombre', 'precio.precio')
							 ->join('precio', 'producto.id', '=', 'precio.producto_id')
							 ->join('familia', 'familia.id', '=', 'producto.familia_id')
							 ->where('familia.id', '=', $dato->id)
							 ->where('precio.combinacion_id', '=', $idcombi, 'AND')
							 ->get()
							 ->toJson();
				$procombi[] = array('familiaid' => $dato->id, 
								'familianombre' => $dato->nombre, 
								'cantidad' => $dato->fcantidad, 
								'productos' => json_decode($productosc));
			}
			return json_encode($procombi);
		}
	}
	);
	Route::post('enviarpedidos', function () {

		if (Request::ajax()) {
			$profami = Input::get('prof');
			$procombi = Input::get('proc');
			$cocinas = Input::get('cocinas');
			$pedidoid = Input::get('pedidoid');
			$mozoid = Input::get('mozoid');
			$idmesa = Input::get('idmesa');
			if ($pedidoid == 0) {
				$mesa = Mesa::find($idmesa);
				$Opedido = $mesa->pedidos()->whereIn('pedido.estado', array('I'))->first();
				if (!isset($Opedido)) {
					$Opedido = Pedido::create(array('estado' => 'I', 'usuario_id' => $mozoid));
					$pedidoid = $Opedido->id;
					$detMesa = DetMesa::create(array('mesa_id' => $idmesa, 'pedido_id' => $pedidoid));
				}
			}
			$arrayprof = array();
			$arrayproco = array();
			$arrayimprimir = array();
			foreach ($cocinas as $cdato) {
				$arrayimprimir[$cdato] = array();
			}
			if (isset($profami)) {
				foreach ($profami as $datoprof) {
					$producto = Producto::find($datoprof['idpro']);
					foreach ($cocinas as $cocina) {
						$ococina = Areadeproduccion::find(substr($cocina, -1));
						if ($ococina->id_tipo == $producto->id_tipoarepro) {
							$areapro = substr($cocina, -1);
							$ordencocina = $ococina->ordennumber+1;
							$arrayimprimir[$cocina][] = $datoprof;
						}
					}
					$datitos1 = array('pedido_id' => $pedidoid, 'producto_id' => $datoprof['idpro'], 
									'cantidad' => $datoprof['cantidad'], 
									'ImporteFinal' => $datoprof['preciot'], 
									'estado' => 'I', 'descuento' => 0, 
									'idarea' => $areapro, 
									'ordenCocina' => $ordencocina, );
					$odetpe = DetPedido::create($datitos1);
					$flagnotas = 0;
					if (isset($datoprof['notas'])) {
						$arrayinsertnotas = array();
						foreach ($datoprof['notas'] as $anota) {
							$arrayinsertnotas[] = array('notas_id' => $anota['idnota'], 
												'detallePedido_id' => $odetpe->id, );
							$flagnotas = 1;
						}

						Detallenotas::insert($arrayinsertnotas);
					}
					$flagadicional = 0;
					if (isset($datoprof['adicionales'])) {
						foreach ($datoprof['adicionales'] as $datadi) {
							$inputadi = array('pedido_id' => $pedidoid, 
											'producto_id' => $datadi['idadicional'], 
											'cantidad' => $datadi['cantidad'], 
											'ImporteFinal' => $datadi['precio'], 
											'estado' => 'I', 'descuento' => 0, 
											'idarea' => $areapro, 
											'ordenCocina' => $ordencocina, 
											'detalle_id' => $odetpe->id);
							$odetpeadi = DetPedido::create($inputadi);
							$flagadicional = 1;
							$arrayprof[] = array('iddetpedido' => $odetpeadi->id, 
												'pronombre' => $datadi['nombre'], 
												'pestado' => $odetpeadi->estado, 
												'notas' => 0, 
												'cantidad' => $datadi['cantidad'], 
												'precio' => $datadi['precio'], 
												'idpedido' => $pedidoid, 
												'adicionales' => 2, 
												'sabores' => 0, );
						}
					}
					$flagsabor = 0;
					if (isset($datoprof['sabores'])) {
						$arraysabores = array();
						foreach ($datoprof['sabores'] as $datosabor) {
							$arraysabores[] = array('detpedido_id' => $odetpe->id, 'sabor_id' => $datosabor['idsabor'], );
							$flagsabor = 1;
						}

						Detpedidosabores::insert($arraysabores);
					}
					$arrayprof[] = array('iddetpedido' => $odetpe->id, 'pronombre' => $datoprof['nombre'], 'pestado' => $odetpe->estado, 'notas' => $flagnotas, 'cantidad' => $datoprof['cantidad'], 'precio' => $datoprof['preciot'], 'idpedido' => $pedidoid, 'adicionales' => $flagadicional, 'sabores' => $flagsabor, );
				}
			}
			if (isset($procombi)) {
				foreach ($procombi as $datoproc) {
					$procomb = array();
					$id_comb = $datoproc['idcombi'];
					$cont_comb_c = DB::select('select max(detallepedido.combinacion_c) as max from detallepedido
                    where detallepedido.pedido_id = ? and detallepedido.combinacion_id=?', array($pedidoid, $id_comb));
					foreach ($cont_comb_c as $ccc) {
						$cont_comb_c2 = $ccc->max;
					}
					if ($cont_comb_c2 == '') {
						$cont_comb_c2 = 0;
					}
					$cont_comb_c2 = $cont_comb_c2+1;
					foreach ($datoproc['producombi'] as $procom) {
						if ($datoproc[$procom]['nombre'] != '-') {
							$producto = Producto::find($datoproc[$procom]['idprocombi']);
							foreach ($cocinas as $cocina) {
								$ococina = Areadeproduccion::find(substr($cocina, -1));
								if ($ococina->id_tipo == $producto->id_tipoarepro) {
									$areapro = substr($cocina, -1);
									$ordencocina = $ococina->ordennumber+1;
									$oprocom2 = $datoproc[$procom] + array('cantidad'=>$datoproc['cantidad']);
									$arrayimprimir[$cocina][] = $oprocom2;
								}
							}
							$datitos2 = array('pedido_id' => $pedidoid, 
										'producto_id' => $datoproc[$procom]['idprocombi'], 
										'cantidad' => $datoproc['cantidad'], 
										'ImporteFinal' => $datoproc[$procom]['precio'], 
										'estado' => 'I', 'descuento' => 0, 
										'combinacion_id' => $datoproc['idcombi'], 
										'combinacion_c' => $cont_comb_c2, 
										'combinacion_cant' => $datoproc['cantidad'], 
										'idarea' => $areapro, 
										'ordenCocina' => $ordencocina);
							$oprocom = DetPedido::create($datitos2);
							$flagnotas = 0;
							if (isset($datoproc[$procom]['notas'])) {
								$arrayinsertnotasc = array();
								foreach ($datoproc[$procom]['notas'] as $anota) {
									$arrayinsertnotasc[] = array('notas_id' => $anota['idnota'], 'detallePedido_id' => $oprocom->id, );
									$flagnotas = 1;
								}

								Detallenotas::insert($arrayinsertnotasc);
							}
							$procomb[] = array('iddetpedido' => $oprocom->id, 'pronombre' => $datoproc[$procom]['nombre'], 'pestado' => $oprocom->estado, 'notas' => $flagnotas, );
						}
					}
					$arrayproco[] = array('combinombre' => $datoproc['nombrecombi'], 'precio' => $datoproc['preciot'], 'produccomb' => $procomb, 'cantidad' => $datoproc['cantidad'], 'idpedido' => $pedidoid, );
				}
			}
			$j = 0;
			foreach ($cocinas as $cocina) {
				$max = DetPedido::whereraw("pedido_id = ".$pedidoid."
                    and idarea = ".substr($cocina, -1))->first();
				$ordenes = 0;
				if (isset($max)) {
					$areap = Areadeproduccion::find(substr($cocina, -1));
					$ordenes = $areap->ordennumber+1;
					$areap->ordennumber = $ordenes;
					$areap->save();
				}
				$orden[] = array('cocina' => $cocina, 'orden' => $ordenes, );
				$j++;
			}

			Event::fire('imprimirpedidos', compact('arrayimprimir','mozoid','idmesa', 'cocinas'));
			return json_encode(compact('orden', 'arrayproco', 'arrayprof', 'pedidoid'));
		}
	});
	Route::post('adicionales', function () {
		if (Request::ajax()) {
			$idpro = Input::get('idpro');
			$producto = Producto::find($idpro);
			$adicionales = $producto->adicionales;
			$arrayadicionales = array();
			foreach ($adicionales as $dato) {
				$precio = $dato->precios()->where('combinacion_id', '=', 1)->first();
				$arrayadicionales[] = array('id' => $dato->id, 'nombre' => $dato->nombre, 'precio' => $precio->precio, );
			}
			return json_encode($arrayadicionales);
		}
	});

	Route::post('sabores', function () {
		if (Request::ajax()) {
			$idpro = Input::get('idpro');
			$producto = Producto::find($idpro);
			$sabores = $producto->sabores;
			return $sabores->toJson();
		}
	});

	Route::post('precuenta', function () {
		if (Request::ajax()) {
			$idpedido = Input::get('idpedido');
			$tipopre = Input::get('tipopre');
			$nombremesa = Input::get('mesa');
			$nombremozo = Input::get('mozo');
			$precuenta = Input::get('precuenta');
			if ($tipopre == 1) {
				$detallespro = Pedido::find($idpedido)->productos()
				               ->where('detallepedido.estado_t', '=', 0)
				               ->where('detallepedido.estado', '!=', 'A', 'AND')
				               ->where('detallepedido.combinacion_id', '=', NULL, 'AND')
				               ->groupBy('detallepedido.producto_id')
				               ->get();

				$detallesproprecuen = Pedido::find($idpedido)->productosguardarprecuenta()
				               ->where('detallepedido.estado_t', '=', 0)
				               ->where('detallepedido.estado', '!=', 'A', 'AND')
				               ->where('detallepedido.combinacion_id', '=', NULL, 'AND')
				               ->groupBy('detallepedido.producto_id')
				               ->get();
				$detallescom = Pedido::find($idpedido)->combinaciones()
								->where('detallepedido.estado_t', '=', 0)
								->groupBy('combinacion_id')->get();

				$detallescomprecuen = Pedido::find($idpedido)->combinacionesguardarprecuenta()
								->where('detallepedido.estado_t', '=', 0)
								->groupBy('combinacion_id')->get();
				
				$arrayproprecuenta = array();
				if ($detallespro){
					foreach ($detallespro as $detallepro) {
						$cantidadre = $detallepro->pivot->where('detallepedido.producto_id', '=', $detallepro->id)
						              ->where('detallepedido.pedido_id', '=', $detallepro->pivot->pedido_id, 'AND')
						              ->where('detallepedido.estado_t', '=', 0, 'AND')
						              ->where('detallepedido.combinacion_id', '=', NULL, 'AND')
						              ->sum('cantidad');
						$preciou = $detallepro->pivot->importeFinal/$detallepro->pivot->cantidad;
						$preciot = $preciou * $cantidadre;
						
						$oprecuenta = Detpedidotick::where('nombre', '=', $detallepro->nombre)
						             ->where('pedido_id', '=', $idpedido, 'AND')
						             ->whereNull('ticket_id')
						             ->first();
						$arraycreaprecuenta = array('nombre' => $detallepro->nombre, 
													'cantidad' => $cantidadre, 
													'precio' => $preciot, 
													'combinacion_id' => $detallepro->pivot->combinacion_id, 
													'preciou' => $preciou, 
													'pedido_id' => $detallepro->pivot->pedido_id,
													'producto_id'=>$detallepro->id);
						if(count($oprecuenta) > 0) {
							$newcantidad = $oprecuenta->cantidad + $cantidadre;
							$newprecio = $oprecuenta->preciou * $newcantidad;
							$oprecuenta->cantidad = $newcantidad;
							$oprecuenta->precio = $newprecio;
							$oprecuenta->save();
						}else{
							$oprecuenta = Detpedidotick::create($arraycreaprecuenta);
							$newcantidad = $oprecuenta->cantidad;
							$newprecio = $oprecuenta->precio;
						}
					}
					foreach ($detallesproprecuen as $detalleestado) {
						$detalleestado->pivot->estado_t = 1;
						$detalleestado->pivot->save();
					}
				}
				if ($detallescom) {
					foreach ($detallescom as $detallecom) {
						$cantidadcr = DetPedido::where('detallepedido.estado_t', '=', 0)
					 				->where('detallepedido.combinacion_id', '=', $detallecom->id, 'AND')
					 				->where('detallepedido.pedido_id', '=', $idpedido)
					 				->groupBy('combinacion_id', 'combinacion_c')
					 				->get();
						$cantidadcombi = 0;
						foreach ($cantidadcr as $datocan) {
							$cantidadcombi = $cantidadcombi+$datocan->cantidad;
						}
						$preciocom = $detallecom->precio*$cantidadcombi;
						$arraycreaprecuenta = array('nombre' => $detallecom->nombre, 
											'cantidad' => $cantidadcombi, 
											'precio' => $preciocom, 
											'combinacion_id' => $detallecom->pivot->combinacion_id, 
											'preciou' => $detallecom->precio, 
											'pedido_id' => $detallecom->pivot->pedido_id);
						
						$oprecuenta = Detpedidotick::where('nombre', '=', $detallecom->nombre)->where('pedido_id', '=', $idpedido, 'AND')->whereNull('ticket_id')->first();
						if (count($oprecuenta) > 0) {
							$newcantidad = $oprecuenta->cantidad + $cantidadcombi;
							$newprecio = $oprecuenta->preciou*$newcantidad;
							$oprecuenta->cantidad = $newcantidad;
							$oprecuenta->precio = $newprecio;
							$oprecuenta->save();
						} else {
							$oprecuenta = Detpedidotick::create($arraycreaprecuenta);
							$newcantidad = $oprecuenta->cantidad;
							$newprecio = $oprecuenta->precio;
						}
					}

					foreach ($detallescomprecuen as $detalleestadocom) {
						$detalleestadocom->pivot->estado_t = 1;
						$detalleestadocom->pivot->save();
					}
				}

				$precuentaf = Detpedidotick::where('pedido_id', '=', $idpedido)
							 ->whereNull('ticket_id')
							 ->get();
				return Response::json($precuentaf);

			} elseif ($tipopre == 2) {
				$token = sha1(microtime().'tk');
				$html = '<!doctype html>
                        <html lang="es">
                        <head>
                        <meta charset="UTF-8">
                        </head>
                        <style>
                            body{
                                 width: 250px;
                                 font-family: arial;
                                 font-size: 13px;
                                 padding: 10px;
                                 margin-bottom:-45px;
                                 margin-left: -45px;
                                 margin-top:-45px;
                            }
                            table{
                                width: 100%;
                                font-size: 13px;
                            }
                            .importetotal{
                                font-size: 14px;
                                text-align: right;
                                font-weight: 900;
                                width: 100%;
                                border-top: 1px solid #000;
                            }
                            .titulos{
                                border-bottom: 1px solid #000;
                            }
                            p {
                                padding: 0;
                                margin: 2px;
                            }
                        </style>
                        <body>
                        <center><h3><strong>PRE-CUENTA</strong></h3></center>
                        <table>
                        <thead class="titulos">
                            <tr >
                                <td>Descripcion</td>
                                <td>P.Uni.</td>
                                <td>Cant.</td>
                                <td>S/.</td>
                            </tr>
                        </thead>
                        </table>
                        <table>';
				$importetotal = 0;
				foreach ($precuenta as $predato) {
					$html .= '<tr>
                            <td>'.$predato['nombre'].'</td>
                            <td>'.$predato['preciou'].'</td>
                            <td>'.$predato['cantidad'].'</td>
                            <td>'.$predato['precio'].'</td>
                        </tr>';
					$importetotal = $importetotal+$predato['precio'];
				}
				$html .= '</table>
                        <p class="importetotal">Total S/. '.number_format($importetotal, 2).' </p>
                        <p>Descuentos:</p>
                        <p>Mesa Atendida:'.$nombremesa.'</p>
                        <p>Atendido por:'.$nombremozo.'</p>
                        <br>
                        <br>
                        <hr>
                        </body>
                        </html>';
                $headers = array('Content-Type' => 'application/pdf', );
				$pdfPath = TIKET_DIR.$token.'.pdf';
				File::put($pdfPath, PDF::load($html, 'A7', 'portrait')->output());
				$cmd = "lpr -Pbarraeliasa ";
				$cmd .= $pdfPath;
				if (Auth::user()->id_restaurante == 2) {
					$response = shell_exec($cmd);
				}
				File::delete($pdfPath);
				return Response::json('true');
			}
		}
	});

	Route::post('cobrarmesa', function () {
		if (Request::ajax()) {
			$tipo = Input::get('tipo');
			$cobrar = Input::get('cobrar');
			$itotal = Input::get('itotal');
			$iefectivo = Input::get('iefectivo');
			$itarjeta = Input::get('itarjeta');
			$dtarjeta = Input::get('dtarjeta');
			$ivale = Input::get('ivale');
			$idescuento = Input::get('idescuento');
			$descuento = Input::get('descuento');
			$ipagado = Input::get('ipagado');
			$vuelto = Input::get('vuelto');
			$total = $ipagado+$idescuento+$ivale;
			$idpedido = Input::get('pedidoid');
			$nombremesa = Input::get('mesa');
			$nombremozo = Input::get('mozo');
			$cliente = Input::get('cliente');
			$caja_id = Input::get('caja_id');
			$infocaja = Caja::find($caja_id);
			$detcajaid = Input::get('detcajaid');
			$arrayudateprecuenta = array();
			$subtotal = 0;
			$newtotal = 0;
			$parsetotal = $total - $itotal;
			if ($parsetotal >= 0) {
				if ($tipo == 1) {
					foreach ($cobrar as $dato) {
						if ($dato['cobrar'] == 1) {
							$itemprecuenta = Detpedidotick::find($dato['proid']);
							$subtotal = $itemprecuenta->preciou*$dato['cantidad'];
							$newtotal = $newtotal+$subtotal;
							if ($dato['modificar'] == 1) {
								$newcantidad = $itemprecuenta->cantidad-$dato['cantidad'];
								$newprecio = $itemprecuenta->preciou*$newcantidad;
								$itemprecuenta->cantidad = $newcantidad;
								$itemprecuenta->precio = $newprecio;
								$arraycreaprecuenta = array('nombre' => $dato['nombre'], 
													'cantidad' => $dato['cantidad'], 
													'precio' => $dato['precio'], 
													'combinacion_id' => $itemprecuenta->combinacion_id, 
													'preciou' => $dato['preciou'], 
													'pedido_id' => $itemprecuenta->pedido_id, 
													'producto_id'=>$itemprecuenta->producto_id);
								$inserteditem = Detpedidotick::create($arraycreaprecuenta);
								$arrayudateprecuenta[] = $inserteditem->id;
								$itemprecuenta->save();
							} else {
								$arrayudateprecuenta[] = $itemprecuenta->id;
							}
						}
					}
				} else {
					foreach ($cobrar as $dato) {
						$itemprecuenta = Detpedidotick::find($dato['proid']);
						$subtotal = $itemprecuenta->precio;
						$newtotal = $newtotal+$subtotal;
						$arrayudateprecuenta[] = $dato['proid'];
					}
				}
				$newparse = round($total,2) - round($newtotal,2);
				if ($newparse >= 0) {
					$restaurante = Restaurante::find(Auth::user()->id_restaurante);
					$datoscaja = Caja::find($caja_id);
					$newnumero = $datoscaja->numero + 1;
					$datoscaja->numero = sprintf('%07d', $newnumero);
					$newdescuento = $idescuento+$ivale;
					$osubtotal = $itotal/1.18;
					$igv = $itotal - $osubtotal;
					$tickete = Ticket::create(array('descuento' => $descuento, 
											   'idescuento' => number_format($newdescuento, 2), 
											   'importe' => $itotal, 
											   'numero' => $newnumero, 
											   'serie' => $datoscaja->serie, 
											   'detcaja_id' => $detcajaid, 
											   'caja_id' => $caja_id, 
											   'pedido_id' => $idpedido, 
											   'vuelto' => $vuelto, 
											   'IGV' => number_format($igv, 2), 
											   'subtotal' => number_format($osubtotal, 2), 
											   'ipagado' => $ipagado,
											   'cliente' =>$cliente['nombres'],
											   'documento'=>$cliente['dni'],
											   'direccion'=>$cliente['direccion'],
											   'mesa'=>$nombremesa,
											   'mozo'=>$nombremozo,
											   'cajero'=>Auth::user()->login));
					Detpedidotick::whereIn('id', $arrayudateprecuenta)->update(array('ticket_id' => $tickete->id));
					$odetallestickete = $tickete->detallest;
					
					$token = sha1(microtime().'tk');
					$html = '<!doctype html>
                                <html lang="es">
                                <head>
                                <meta charset="UTF-8">
                                </head>
                                <style>
                                    body{
                                    	 width: 220px;
                                         font-family: sans-serif;
                                         font-size: 10px;
                                         color: #000;
                                    }
                                    table{
                                        width: 100%;
                                        font-size: 11px;
                                        border-bottom: 1px solid #000;
                                    }
                                    .importetotal{
                                        font-size: 14px;
                                        text-align: right;
                                        font-weight: 900;
                                        width: 100%;
                                    }
                                    .titulos{
                                        border-bottom: 1px solid #000;
                                    }
                                    .head{
                                        font-size: 16px;
                                        font-weight: 900;
                                    }
                                    .subhead{
                                        font-size: 14px;
                                        font-weight: 900;
                                    }
                                    p {
                                        padding: 0;
                                        margin: 2px;
                                    }
                                    .datos{
                                        width: 52px;
                                    }
                                    .productos td{
									line-height: 15px;
									text-align: left;
								    }
								   .container{
									height:auto;
								   }
								   .encabezado, .subencabezado{
								   	text-align: center;
								   	font-weight: 900;
								   	margin-left:-20px;
								   	width: 100%;
								   }
								   .subencabezado{
								   	font-size: 11px;
								   }
                                </style>
                                <body>
                                <div class="container">
                                <div class="encabezado">
                                <strong>KANGO CAFE</strong><br>
                                <strong>'.$restaurante->razonSocial.'</strong><br>
                                </div>
                                <div class="subencabezado">
                                <strong>RUC Nº '.$restaurante->ruc.'</strong><br>
                                <strong>'.$restaurante->direccion.'&nbsp;-&nbsp;'.$restaurante->provincia.'
                                 &nbsp;-&nbsp;'.$restaurante->departamento.'</strong><br>
                                <strong>Ticket:&nbsp;'.sprintf('%07d', $tickete->numero).' &nbsp;&nbsp;Serie:&nbsp;'.$tickete->serie.'</strong><br>
                                <strong>Fecha:'.date('d-m-Y').'&nbsp;&nbsp;Hora:'.date('H:i:s').'</strong>
               					</div>
                                <br>
                                <table>
                                    <tr>
                                        <td style="width: 120px">Descripcion</td>
                                        <td style="width: 25px;text-align: right">P.Uni.</td>
                                        <td style="width: 15px; text-align: right">Cant.</td>
                                        <td style="width: 50px;text-align: right">S/.</td>
                                    </tr>
                                </table>
                                <table style="width:220px">';
					$newtamaño = 4*count($odetallestickete);
					foreach ($odetallestickete as $predato) {
						$html .= '<tr class="productos">
                                    <td style="width: 115px">'.substr($predato['nombre'], 0, 14).'.</td>
                                    <td style="width: 25px;text-align: right">'.$predato['preciou'].'</td>
                                    <td style="width: 15px; text-align: right">'.$predato['cantidad'].'</td>
                                    <td style="width: 55px;text-align: right">'.$predato['precio'].'</td>
                                </tr>';
					}
					$html .= '</table>
                                <table style="border: none">
                                    <tr>
                                    <td style="width: 110px">Descuento S/.</td>
                                    <td style="width:110px; text-align: right">-'.$tickete->idescuento.'</td>
                                    </tr>
                                    <tr>
                                    <td style="width: 110px">&nbsp;</td>
                                    <td style="width:110px; text-align: right">&nbsp;</td>
                                    </tr>
                                    <tr>
                                    <td style="width: 110px">Subtotal S/.</td>
                                    <td style="width:110px; text-align: right">'.$tickete->subtotal.'</td>
                                    </tr>
                                    <tr>
                                    <td style="width: 110px">IGV S/.</td>
                                    <td style="width:110px; text-align: right">'.$tickete->IGV.'</td>
                                    </tr>
                                    <tr>
                                    <td style="width: 110px">Total S/.</td>
                                    <td style="width:110px; text-align: right;font-weight: bold;">'.$tickete->importe.'</td>
                                    </tr>
                                </table>
                                <br>
                                <table style="border: none">
                                    <tr>
                                        <td class="datos">Cliente</td>
                                        <td>'.$cliente['nombres'].'</td>
                                    </tr>
                                    <tr>
                                        <td class="datos">DNI/RUC</td>
                                        <td>'.$cliente['dni'].'</td>
                                    </tr>
                                    <tr>
                                        <td class="datos">Dirección</td>
                                        <td>'.$cliente['direccion'].'</td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                                <table style="border: none">
                                    <tr>
                                    <td style="width: 110px">Importe Pagado S/.</td>
                                    <td style="width:110px; text-align: right">'.$tickete->ipagado.'</td>
                                    </tr>
                                    <tr>
                                    <td style="width: 110px">Vuelto S/. </td>
                                    <td style="width:110px; text-align: right">'.$tickete->vuelto.'</td>
                                    </tr>
                                    <tr>
                                    <td style="width: 110px">Mesa Atendida</td>
                                    <td style="width:110px;">: '.$nombremesa.'</td>
                                    </tr>
                                    <tr>
                                    <td style="width: 110px">Atendido por</td>
                                    <td style="width:110px;">: '.$nombremozo.'</td>
                                    </tr>
                                    <tr>
                                    <td style="width: 110px">Cajero:</td>
                                    <td style="width:110px;">: '.Auth::user()->login.'</td>
                                    </tr>
                                </table>
                                </div>
                                </body>
                                </html>';
                    $headers = array('Content-Type' => 'application/pdf', );
					$pdfPath = TIKET_DIR.$token.'.pdf';
					$tamaño = 125+$newtamaño;
					$html2pdf = new HTML2PDF('V', array('72', $tamaño), 'fr', true, 'UTF-8', 0);
					$html2pdf->WriteHTML($html);
					$html2pdf->Output($pdfPath, 'F');
					$cmd = "lpr -P".$infocaja->impresora." ";
					$cmd .= $pdfPath;
					$response = shell_exec($cmd);
					File::delete($pdfPath);
					
					if ($iefectivo > 0) {
					$oefectivo = Detformadpago::create(array('importe' => $iefectivo, 'ticket_id' => $tickete->id, 'formadepago_id' => 1));
					}
					if ($itarjeta > 0) {
						$otarjeta = Detformadpago::create(array('importe' => $itarjeta, 'ticket_id' => $tickete->id, 'formadepago_id' => 2, 'codigotarjeta' => $dtarjeta));
					}
					if ($ivale > 0) {
						$ovale = Detformadpago::create(array('importe' => $ivale, 'ticket_id' => $tickete->id, 'formadepago_id' => 3));
					}
					$datoscaja->save();
					return json_encode('True');
				} else {
					return json_encode('Ingrese un monto válido');
				}
			}
		}
	});

	Route::post('cerrarmesa', function () {
		if (Request::ajax()) {
			$idpedido = Input::get('idpedido');
			$odetallepedidos = Detpedidotick::where('pedido_id', '=', $idpedido)
			                  ->where('ticket_id', '=', NULL, 'AND')->get();
			$contelementos = count($odetallepedidos);
			if ($contelementos == 0) {
				$opedido = Pedido::find($idpedido);
				$newimporte = $opedido->tickets()->sum('importe');
				$newdescuento = $opedido->tickets()->sum('idescuento');
				$omesas = $opedido->mesas()->where('detmesa.estado', '=', 0)->get();
				$arrayupdatemesas = array();
				foreach ($omesas as $dato) {
					$arrayupdatemesas[] = $dato->id;
				}

				DetMesa::whereIn('mesa_id', $arrayupdatemesas)->where('pedido_id', '=', $idpedido, 'AND')->where('estado', '=', 0, 'AND')->update(array('estado' => 1));Mesa::whereIn('id', $arrayupdatemesas)->update(array('estado' => 'L'));$opedido->estado = "T";
				$opedido->importeFinal = $newimporte;
				$opedido->descuento = $newdescuento;
				$opedido->save();return json_encode('true');
			} else {
				return json_encode('No puedes cerrar la mesa, tienes pedidos por cobrar');
			}
		}
	});

	Route::get('prueba', function () {
		$valor = $_REQUEST["filter"]["filters"][0]["value"];
		$persona = Persona::where('dni', 'like', $valor.'%')
				 ->where('ruc', 'like', $valor.'%', 'or')
				 ->where('nombres', 'like', $valor.'%', 'or')
				 ->where('apMaterno', 'like', $valor.'%', 'or')
				 ->where('apPaterno', 'like', $valor.'%', 'or')
				 ->where('razonSocial', 'like', $valor.'%', 'or')
				 ->get();
		$arraydatos = array();
		foreach ($persona as $dato) {
			if ($dato->ruc) {
				$arraydatos[] = array('nombres' => $dato->razonSocial, 'direccion' => $dato->direccion, 'dni' => $dato->ruc, );
			}
			else {
				$arraydatos[] = array('nombres' => $dato->nombres.' '.$dato->apPaterno.' '.$dato->apMaterno, 'direccion' => $dato->direccion, 'dni' => $dato->dni, );
			}
		}
		return Response::json($arraydatos);
	});

	Route::post('registrarcliente', function () {
		$datos = Input::get('datos');
		$rtipo = Input::get('rtipo');
		$responsedatos = array();
		if ($rtipo == 1) {
			$newpersona = Persona::create(array('nombres' => $datos['nombres'], 'apPaterno' => $datos['apPaterno'], 'apMaterno' => $datos['apMaterno'], 'dni' => $datos['dni'], 'direccion' => $datos['direccion']));
			$responsedatos[] = array('nombres' => $newpersona->nombres.' '.$newpersona->apPaterno, 'dni' => $newpersona->dni, 'direccion' => $newpersona->direccion, );
		} elseif ($rtipo == 2) {
			$newpersona = Persona::create(array('razonSocial' => $datos['nombres'], 'ruc' => $datos['ruc'], 'direccion' => $datos['direccion']));
			$responsedatos[] = array('nombres' => $newpersona->razonSocial.' '.$newpersona->apPaterno, 'dni' => $newpersona->ruc, 'direccion' => $newpersona->direccion, );
		}
		return Response::json($responsedatos);
	});

	Route::get('listadegastos', function () {
		if (Request::ajax()) {
			$detcaja = Detcaja::where('estado', '=', 'A')->where('usuario_id', '=', Auth::user()->id, 'AND')->first();
			$listadegastos = $detcaja->gastos()->get();
			return Response::json($listadegastos);
		}
	});

	Route::get('listadeventas', function () {
		if (Request::ajax()) {
			$detcaja = Detcaja::where('estado', '=', 'A')
					 ->where('usuario_id', '=', Auth::user()->id, 'AND')
					 ->first();
			$listadeventas = $detcaja->tickets()->get();
			return Response::json($listadeventas);
		}
	});

	/*pedidos movil*/
	Route::post('/abrirmesa', function () {
		if (Request::ajax()) {
			$idmesa = Input::get('mesaid');
			$mesa = Mesa::find($idmesa);
			$nombremesa = $mesa->nombre;
			$mesa->estado = 'O';
			$mesa->save();$Opedido = $mesa->pedidos()->whereIn('pedido.estado', array('I', 'D'))->first();
			$nombreusuario = '';
			if (isset($Opedido)) {
				$nombreusuario = $Opedido->usuario->login;
				$idmozo = $Opedido->usuario->id;
			}
			if ($Opedido) {
				$platosp = DetPedido::select('detallepedido.pedido_id', 'producto.nombre as pnombre', 'detallepedido.combinacion_c', 'detallepedido.ordenCocina', 'detallepedido.cantidad', 'detallepedido.id', 'detallepedido.estado', 'detallepedido.importefinal', 'detallepedido.detalle_id')->join('producto', 'producto.id', '=', 'detallepedido.producto_id')->where('detallepedido.pedido_id', '=', $Opedido->id)->where('detallepedido.combinacion_c', '=', NULL, 'AND')->orderby('detallepedido.id', 'DESC')->get();
				$arrayprof = array();
				$flagadicional = 0;
				foreach ($platosp as $dato) {
					if (isset($dato->detalle_id)) {
						$flagadicional = 2;
					}
					$arrayprof[] = array('iddetpedido' => $dato->id, 'pronombre' => $dato->pnombre, 'pestado' => $dato->estado, 'notas' => 'notas', 'cantidad' => $dato->cantidad, 'precio' => $dato->importefinal, 'idpedido' => $Opedido->id, 'adicionales' => $flagadicional, 'sabores' => 'no', );
					$flagadicional = 0;
				}
				$placombinacionp = array();
				$arrayproco = array();
				$combinacionesp = DetPedido::selectraw('detallepedido.cantidad , combinacion.nombre,detallepedido.combinacion_id,
                         combinacion.precio,detallepedido.combinacion_c, combinacion.precio')
						 ->join('combinacion', 'combinacion.id', '=', 'detallepedido.combinacion_id')
						 ->join('precio', 'combinacion.id', '=', 'precio.combinacion_id')
						 ->whereraw("pedido_id =".$Opedido->id." AND combinacion_c IS NOT NULL")
						 ->groupby('combinacion_id', 'combinacion_c')
						 ->orderby('detallepedido.id', 'DESC')
						 ->get();
				foreach ($combinacionesp as $datoc) {
					$procomb = array();
					$placombinacionp[$dato->combinacion_id.'_'.$dato->combinacion_c] = DetPedido::select('detallepedido.pedido_id', 'producto.nombre as pnombre', 'detallepedido.combinacion_c', 'detallepedido.ordenCocina', 'detallepedido.cantidad', 'detallepedido.id', 'detallepedido.estado')->join('producto', 'producto.id', '=', 'detallepedido.producto_id')->where('detallepedido.pedido_id', '=', $Opedido->id)->where('detallepedido.combinacion_c', '=', $datoc->combinacion_c, 'AND')->where('detallepedido.combinacion_id', '=', $datoc->combinacion_id, 'AND')->orderby('detallepedido.id', 'DESC')->get();
					foreach ($placombinacionp[$dato->combinacion_id.'_'.$dato->combinacion_c] as $dato) {
						$procomb[] = array('iddetpedido' => $dato->id, 'pronombre' => $dato->pnombre, 'pestado' => $dato->estado, 'notas' => 'c', );
					}
					$arrayproco[] = array('combinombre' => $datoc->nombre, 'precio' => $datoc->precio*$datoc->cantidad, 'produccomb' => $procomb, 'cantidad' => $datoc->cantidad, 'idpedido' => $Opedido->id, );
				}
				$idpedido = $Opedido->id;
				$respuesta = 'true';
				return Response::json(compact('arrayprof', 'arrayproco', 'nombremesa', 'nombreusuario', 'respuesta', 'idpedido', 'idmozo'));
			} else {
				$respuesta = 'false';
				return Response::json(compact('nombremesa', 'respuesta'));
			}
		}
	});
	/*finpedidos movil*/
	Route::get('getproductos', function(){
		if (Request::ajax()) {
			$familia_id = Input::get('familia_id');
			$familia = Familia::find($familia_id);
			$oproductos = $familia->productos;
			return Response::json($oproductos);
		}
	});

	Route::get('getcombinaciones', function(){
		if (Request::ajax()) {
			$tipocombinacion_id = Input::get('tcombi_id');
			$tipocombinacion = TipoComb::find($tipocombinacion_id);
			$ocombinaciones = $tipocombinacion->combinaciones;
			return Response::json($ocombinaciones);
		}
	});

	Route::post('postcancelarorden', function (){
		if (Request::ajax()) {
			$codigo = Input::get('codigo');
			$iddetallepedido = Input::get('iddetalle');
			$usuario = Codigousuario::where('codigo', '=', $codigo)->first();
			if(count($usuario)>0){
				$detpedido = DetPedido::find($iddetallepedido);
				$pedido= Pedido::find($detpedido->pedido_id);
				$detalles = $pedido->productos()->get();
				$oproducto = $detpedido->producto;
					$oprecuenta = Detpedidotick::where('nombre', '=', $oproducto->nombre)
					             ->where('pedido_id', '=', $detpedido->pedido_id, 'AND')
					             ->whereNull('ticket_id')
					             ->first();
					if (isset($oprecuenta)) {
						if ($oprecuenta->cantidad > 1) {
						$newcantidad = $oprecuenta->cantidad - $detpedido->cantidad;
						$newprecio = $oprecuenta->preciou*$newcantidad;
						$oprecuenta->cantidad = $newcantidad;
						$oprecuenta->precio = $newprecio;
						$oprecuenta->save();
						} else {
							Detpedidotick::where('nombre', '=', $oproducto->nombre)
						             ->where('pedido_id', '=', $detpedido->pedido_id, 'AND')
						             ->whereNull('ticket_id')
						             ->delete();
						}
					}
				$detpedido->estado = 'A';
				$detpedido->codigocancelacion= $usuario->usuario_id;
				$detpedido->save();
				$odetalles = $pedido->productos()->where('detallepedido.estado', '!=', 'A')->get(); 
				if(count($odetalles) == 0){
					$pedido->estado = 'A';
					$pedido->fechaCancelacion = date('Y-m-d H:i:s');
					$pedido->save();
					return Response::json('redirect');
				}else{
					return Response::json('true');
				}
			}else{
				return  Response::json('false');
			}
		}
	});

	Route::post('copiaticket', function (){
		if (Request::ajax()){
			$idticket = Input::get('idtick');
			$tickete = Ticket::find($idticket);
			$infocaja = $tickete->caja;
			$odetallestickete = $tickete->detallest;
			$restaurante = Restaurante::find(Auth::user()->id_restaurante);
			$token = sha1(microtime().'tk');
			$html = '<!doctype html>
                        <html lang="es">
                        <head>
                        <meta charset="UTF-8">
                        </head>
                        <style>
                            body{
                            	 width: 220px;
                                 font-family: sans-serif;
                                 font-size: 10px;
                                 color: #000;
                            }
                            table{
                                width: 100%;
                                font-size: 11px;
                                border-bottom: 1px solid #000;
                            }
                            .importetotal{
                                font-size: 14px;
                                text-align: right;
                                font-weight: 900;
                                width: 100%;
                            }
                            .titulos{
                                border-bottom: 1px solid #000;
                            }
                            .head{
                                font-size: 16px;
                                font-weight: 900;
                            }
                            subhead{
                                font-size: 14px;
                                font-weight: 900;
                            }
                            p {
                                padding: 0;
                                margin: 2px;
                            }
                            .datos{
                                width: 52px;
                            }
                            .productos td{
							line-height: 15px;
							text-align: left;
						    }
						   .container{
							height:auto;
						   }
						   .encabezado, .subencabezado{
						   	text-align: center;
						   	font-weight: 900;
						   	margin-left:-10px;
						   	width: 100%
						   }
						   .subencabezado{
						   	font-size: 11px;
						   }
                        </style>
                        <body>
                        <div class="container">
                        <div class="encabezado">
                        <strong>KANGO CAFE</strong><br>
                        <strong>'.$restaurante->razonSocial.'</strong><br>
                        </div>
                        <div class="subencabezado">
                        <strong>RUC Nº '.$restaurante->ruc.'</strong><br>
                        <strong>'.$restaurante->direccion.'&nbsp;-&nbsp;'.$restaurante->provincia.'
                        &nbsp;-&nbsp;'.$restaurante->departamento.'</strong><br>
                        <strong>Ticket:&nbsp;'.sprintf('%07d', $tickete->numero).' &nbsp;&nbsp;Serie:&nbsp;'.$tickete->serie.'</strong><br>
                        <strong>Fecha:'.date('d-m-Y').'&nbsp;&nbsp;Hora:'.date('H:i:s').'</strong>
       					</div>
                        <br>
                        <table>
                            <tr>
                                <td style="width: 120px">Descripcion</td>
                                <td style="width: 25px;text-align: right">P.Uni.</td>
                                <td style="width: 15px; text-align: right">Cant.</td>
                                <td style="width: 50px;text-align: right">S/.</td>
                            </tr>
                        </table>
                        <table style="width:220px">';
			$newtamaño = 4*count($odetallestickete);
			foreach ($odetallestickete as $predato) {
				$html .= '<tr class="productos">
                            <td style="width: 115px">'.substr($predato['nombre'], 0, 14).'.</td>
                            <td style="width: 25px;text-align: right">'.$predato['preciou'].'</td>
                            <td style="width: 15px; text-align: right">'.$predato['cantidad'].'</td>
                            <td style="width: 55px;text-align: right">'.$predato['precio'].'</td>
                        </tr>';
			}
			$html .= '</table>
                        <table style="border: none">
                            <tr>
                            <td style="width: 110px">Descuento S/.</td>
                            <td style="width:110px; text-align: right">-'.$tickete->idescuento.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">&nbsp;</td>
                            <td style="width:110px; text-align: right">&nbsp;</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Subtotal S/.</td>
                            <td style="width:110px; text-align: right">'.$tickete->subtotal.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">IGV S/.</td>
                            <td style="width:110px; text-align: right">'.$tickete->IGV.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Total S/.</td>
                            <td style="width:110px; text-align: right;font-weight: bold;">'.$tickete->importe.'</td>
                            </tr>
                        </table>
                        <br>
                        <table style="border: none">
                            <tr>
                                <td class="datos">Cliente</td>
                                <td>'.$tickete->cliente.'</td>
                            </tr>
                            <tr>
                                <td class="datos">DNI/RUC</td>
                                <td>'.$tickete->dni.'</td>
                            </tr>
                            <tr>
                                <td class="datos">Dirección</td>
                                <td>'.$tickete->direction.'</td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <table style="border: none">
                            <tr>
                            <td style="width: 110px">Importe Pagado S/.</td>
                            <td style="width:110px; text-align: right">'.$tickete->ipagado.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Vuelto S/. </td>
                            <td style="width:110px; text-align: right">'.$tickete->vuelto.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Mesa Atendida</td>
                            <td style="width:110px;">:'.$tickete->mesa.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Atendido por</td>
                            <td style="width:110px;">:'.$tickete->mozo.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Cajero:</td>
                            <td style="width:110px;">: '.$tickete->cajero.'</td>
                            </tr>
                        </table>
                        </div>
                        </body>
                        </html>';
            $headers = array('Content-Type' => 'application/pdf', );
			$pdfPath = TIKET_DIR.$token.'.pdf';
			$tamaño = 125+$newtamaño;
			$html2pdf = new HTML2PDF('V', array('72', $tamaño), 'fr', true, 'UTF-8', 0);
			$html2pdf->WriteHTML($html);
			$html2pdf->Output($pdfPath, 'F');
			$cmd = "lpr -P".$infocaja->impresora." ";
			$cmd .= $pdfPath;
			$response = shell_exec($cmd);
			File::delete($pdfPath);
			return Response::json('true');
		}
	});

	Route::post('anularticket', function (){
		if (Request::ajax()){
			$idticket = Input::get('idtick');
			$tickete = Ticket::find($idticket);
			if ($tickete->estado == 1) {
				return Response::json('false'); 
			}
			$tickete->estado = 1;
			$infocaja = $tickete->caja;
			$newnumero = $infocaja->numero + 1;
			$infocaja->numero = $newnumero;
			$newtickete = Ticket::create(array('descuento' => $tickete->descuento, 
											   'idescuento' => $tickete->idescuento, 
											   'importe' => -$tickete->importe, 
											   'numero' => $newnumero, 
											   'serie' => $tickete->serie, 
											   'detcaja_id' => $tickete->detcaja_id, 
											   'caja_id' => $tickete->caja_id, 
											   'pedido_id' => $tickete->pedido_id, 
											   'vuelto' => $tickete->vuelto, 
											   'IGV' => -$tickete->IGV, 
											   'subtotal' => -$tickete->subtotal, 
											   'ipagado' => $tickete->ipagado));
			$odetallestickete = $tickete->detallest;
			$restaurante = Restaurante::find(Auth::user()->id_restaurante);
			$token = sha1(microtime().'tk');
			$html = '<!doctype html>
                        <html lang="es">
                        <head>
                        <meta charset="UTF-8">
                        </head>
                        <style>
                            body{
                            	 width: 220px;
                                 font-family: sans-serif;
                                 font-size: 10px;
                                 color: #000;
                            }
                            table{
                                width: 100%;
                                font-size: 11px;
                                border-bottom: 1px solid #000;
                            }
                            .importetotal{
                                font-size: 14px;
                                text-align: right;
                                font-weight: 900;
                                width: 100%;
                            }
                            .titulos{
                                border-bottom: 1px solid #000;
                            }
                            .head{
                                font-size: 16px;
                                font-weight: 900;
                            }
                            subhead{
                                font-size: 14px;
                                font-weight: 900;
                            }
                            p {
                                padding: 0;
                                margin: 2px;
                            }
                            .datos{
                                width: 52px;
                            }
                            .productos td{
							line-height: 15px;
							text-align: left;
						    }
						   .container{
							height:auto;
						   }
						   .encabezado, .subencabezado{
						   	text-align: center;
						   	font-weight: 900;
						   	margin-left:-10px;
						   	width: 100%
						   }
						   .subencabezado{
						   	font-size: 11px;
						   }
                        </style>
                        <body>
                        <div class="container">
                        <div class="encabezado">
                        <strong>KANGO CAFE</strong><br>
                        <strong>'.$restaurante->razonSocial.'</strong><br>
                        </div>
                        <div class="subencabezado">
                        <strong>RUC Nº '.$restaurante->ruc.'</strong><br>
                        <strong>'.$restaurante->direccion.'&nbsp;-&nbsp;'.$restaurante->provincia.'
                        &nbsp;-&nbsp;'.$restaurante->departamento.'</strong><br>
                        <strong>Ticket:&nbsp;'.sprintf('%07d', $newnumero).' &nbsp;&nbsp;Serie:&nbsp;'.$tickete->serie.'</strong><br>
                        <strong>Fecha:'.date('d-m-Y').'&nbsp;&nbsp;Hora:'.date('H:i:s').'</strong>
       					</div>
                        <br>
                        <table>
                            <tr>
                                <td style="width: 120px">Descripcion</td>
                                <td style="width: 25px;text-align: right">P.Uni.</td>
                                <td style="width: 15px; text-align: right">Cant.</td>
                                <td style="width: 50px;text-align: right">S/.</td>
                            </tr>
                        </table>
                        <table style="width:220px">';
			$newtamaño = 4*count($odetallestickete);
			foreach ($odetallestickete as $predato) {
				$html .= '<tr class="productos">
                            <td style="width: 115px">'.substr($predato['nombre'], 0, 14).'.</td>
                            <td style="width: 25px;text-align: right">-'.$predato['preciou'].'</td>
                            <td style="width: 15px; text-align: right">'.$predato['cantidad'].'</td>
                            <td style="width: 55px;text-align: right">-'.$predato['precio'].'</td>
                        </tr>';
			}
			$html .= '</table>
                        <table style="border: none">
                            <tr>
                            <td style="width: 110px">Descuento S/.</td>
                            <td style="width:110px; text-align: right">'.$tickete->idescuento.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">&nbsp;</td>
                            <td style="width:110px; text-align: right">&nbsp;</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Subtotal S/.</td>
                            <td style="width:110px; text-align: right">-'.$tickete->subtotal.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">IGV S/.</td>
                            <td style="width:110px; text-align: right">-'.$tickete->IGV.'</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Total S/.</td>
                            <td style="width:110px; text-align: right;font-weight: bold;">-'.$tickete->importe.'</td>
                            </tr>
                        </table>
                        <br>
                        <table style="border: none">
                            <tr>
                                <td class="datos">Cliente</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td class="datos">DNI/RUC</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td class="datos">Dirección</td>
                                <td>-</td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <table style="border: none">
                            <tr>
                            <td style="width: 110px">Importe Pagado S/.</td>
                            <td style="width:110px; text-align: right">0.00</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Vuelto S/. </td>
                            <td style="width:110px; text-align: right">0.00</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Mesa Atendida</td>
                            <td style="width:110px;"> ------</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Atendido por</td>
                            <td style="width:110px;">: ------</td>
                            </tr>
                            <tr>
                            <td style="width: 110px">Cajero:</td>
                            <td style="width:110px;">: '.Auth::user()->login.'</td>
                            </tr>
                        </table>
                        </div>
                        </body>
                        </html>';
            $headers = array('Content-Type' => 'application/pdf', );
			$pdfPath = TIKET_DIR.$token.'.pdf';
			$tamaño = 125+$newtamaño;
			$html2pdf = new HTML2PDF('V', array('72', $tamaño), 'fr', true, 'UTF-8', 0);
			$html2pdf->WriteHTML($html);
			$html2pdf->Output($pdfPath, 'F');
			$cmd = "lpr -P".$infocaja->impresora." ";
			$cmd .= $pdfPath;
			$response = shell_exec($cmd);
			File::delete($pdfPath);
			$tickete->save();
			$infocaja->save();
			return Response::json('true');
		}
	});

	Route::post('reportediariocaja', function(){
		if (Request::ajax()) {
			$idrest = Input::get('idrest');
			$fecha = explode('/',Input::get('fecha'));
			$newfecha = $fecha[2].'-'.sprintf('%02d', $fecha[0]).'-'.sprintf('%02d', $fecha[1]);
			$restaurante = Restaurante::find($idrest);
			$cajas = $restaurante->cajas;
			$arraydatos = array();
			$contador = 0;
			foreach ($cajas as $cdato) {
				$cajones = $cdato->detallecaja()->where('FechaInicio', 'LIKE', $newfecha.'%')
							->orderby('FechaInicio')
							->get();
				foreach ($cajones as $cajon) {
					$usuario = Usuario::find($cajon->usuario_id);
					$totaltickets = $cajon->tickets()->count();
					$totalanulados = $cajon->tickets()->where('ticketventa.estado', '=', 1)->count();
					$totaldescuentos = $cajon->tickets()->sum('idescuento');
					$tickets = $cajon->tickets()->where('ticketventa.estado', '=', 0)->get();
					$ticketinicial = $cajon->tickets()->orderby('id', 'asc')->first();
					$ticketfinal = $cajon->tickets()->orderby('id', 'desc')->first();
					$efectivo = 0;
					$tarjeta = 0;
					$vale = 0;
					$totalproductosvendidos = 0;
					foreach ($tickets as $tickete) {
						$totalproductosvendidos = $totalproductosvendidos + $tickete->detallest()->sum('cantidad');
					}

					foreach ($tickets as $tickete) {
						$oefect = $tickete->tipopago()
						->where('formadepago_id', '=', 1)
						->sum('importe');
						if ($oefect > $tickete->importe){
							$oefect = $tickete->importe;
						}
						$newefec = $efectivo + $oefect;
						$efectivo = round($newefec, 2);
					}

					foreach ($tickets as $tickete) {
						$oefect = $tickete->tipopago()->where('formadepago_id', '=', 2)->sum('importe');
						if ($oefect > $tickete->importe) {
							$oefect = $tickete->importe;
						}
						$newefec = $tarjeta + $oefect;
						$tarjeta = round($newefec, 2);
					}

					foreach ($tickets as $tickete) {
						$oefect = $tickete->tipopago()->where('formadepago_id', '=', 3)->sum('importe');
						$newefec = $vale + $oefect;
						$vale = round($newefec, 2);
					}

					$arraydatos[] = array('usuario'=>$usuario->login,
									'totaltickets' => $totaltickets, 
									'totalanulados' => $totalanulados,
									'totalefectivo'=>number_format($efectivo,2,'.', ''),
									'totaltarjeta'=>number_format($tarjeta,2,'.', ''),
									'totalvale'=>number_format($vale,2,'.', ''),
									'totaldescuentos'=>$totaldescuentos,
									'fondodecaja'=>$cajon->montoInicial,
									'totalventas'=>$cajon->ventastotales,
									'turno'=>substr($cajon->fechaInicio, -8).'/'.
											substr($cajon->fechaCierre, -8),
									'arqueo'=>$cajon->arqueo,
									'tproductos'=>$totalproductosvendidos,
									'tinicial'=> $ticketinicial->numero,
									'tfinal'=>$ticketfinal->numero,
									'id'=>$contador,
									'ingresoscaja' =>$cajon->totalingresosacaja,
									'dif'=>$cajon->diferencia,
									'gastos'=>$cajon->gastos,
									'caja'=>$cajon->importetotal,
									'cajaid'=>$cajon->id);
					$contador++;
				}
			}
			return Response::json($arraydatos);
		}
	});	

	Route::post('crearnotapro', function (){
		if (Request::ajax()) {
			$idpro = Input::get('idpro');
			$producto = Producto::find($idpro);
			$productos = $producto->familia->productos;
			$notades = Input::get('nota');
			$nota = Notas::create(array('descripcion'=> $notades));
			$insertanotas = array();
			foreach ($productos as $datos) {
				$insertanotas[] = array('nota_id' => $nota->id, 'producto_id' => $datos->id);
			}
			$numero = Notasxproductos::insert($insertanotas);
			return Response::json($nota);
		}
	});

	Route::post('movermesa', function (){
		if (Request::ajax()) {
			$idmesaupdate = Input::get('idmesaupdate');
			$idmesa = Input::get('idmesa');
			$idpedido = Input::get('idpedido');
			$mesa = Mesa::find($idmesa);

			if($mesa->estado == 'L'){
				$updatemesa = DetMesa::where('pedido_id', '=', $idpedido)
							 ->where('mesa_id', '=', $idmesaupdate, 'AND')
							 ->update(array('mesa_id'=>$idmesa));
				if (count($updatemesa)> 0) {
					return Response::json('true');
				}else{
					return Response::json('false');
				}
			}else{
				return Response::json('false');
			}
		}
	});

	Route::post('imprimirdiariocaja', function (){
		if (Request::ajax()) {
			$arraydatos = array('totalefectivo'=>Input::get('totalefectivo'),
				               	'totaltarjeta'=>Input::get('totaltarjeta'),
				                'totalvale'=>Input::get('totalvale'),
				                'totalventas'=>Input::get('totalventas'),
				                'totalgastos'=>Input::get('totalgastos'),
				                'totalabonosacaja'=>Input::get('totalabonosacaja'),
				                'totalcaja'=>Input::get('totalcaja'),
				                'arqueo'=>Input::get('arqueo'),
				                'diferencia'=>Input::get('diferencia'),
				               	'anulados'=>Input::get('anulados'),
				                'emitidos'=>Input::get('emitidos'),
				                'pvendidos'=>Input::get('pvendidos'),
				                'fecha'=> Input::get('fecha'),
				                'rango'=> Input::get('rango'));
			Event::fire('imprimirreportediariocaja', compact('arraydatos'));
			return Response::json('true');
		}
	});

	Route::get('controlpedidos', function(){
		if (Request::ajax()) {
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

			return Response::json($platoscontrol);
		}
	});
	/*finrutas IVAN*/

	/*RUTAS JAVIER*/
	Route::controller('/salones', 'SalonesController');
	Route::controller('/mesas', 'MesasController');
	Route::controller('/familias', 'FamiliasController');
	Route::controller('/restaurantes', 'RestaurantesController');
	/*FIN RUTAS JAVIER*/
	Route::get('restaurandoproductos', function (){
        $productos = Producto::all();

        foreach ($productos as $producto) {
            $precio = $producto->precios()->where('combinacion_id', '=', 1)->first();
            if (count($precio)>0) {
                $precuentapro= Detpedidotick::where('nombre','=', $producto->nombre)
                        ->where('preciou', '=', $precio->precio)
                        ->where('producto_id', '=', NULL)
                        ->get();
                foreach ($precuentapro as $deta) {
                    $deta->producto_id = $producto->id;
                    $deta->save();
                }
            }
        }
    });

	Route::get('restaurandocombinaciones', function (){
        $productos = Combinacion::all();

        foreach ($productos as $producto) {
            $precio = $producto->precio;
            if ($precio>0) {
                $precuentapro= Detpedidotick::where('nombre','=', $producto->nombre)
                        ->where('preciou', '=', $producto->precio)
                        ->where('producto_id', '=', NULL)
                        ->get();
                foreach ($precuentapro as $deta) {
                    $deta->combinacion_id = $producto->id;
                    $deta->save();
                }
            }
        }
    });
});