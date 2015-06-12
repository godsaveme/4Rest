<?php
define('TIKET_DIR', public_path('temp/'));
//\Debugbar::disable();

Route::get('/', function () {
		return Redirect::to('login');
	});

Route::get('/testing', function () {
    $detmesa = DetMesa::where('pedido_id','=',26647)->get();
    print_r($detmesa->toJson()); die();
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
			return Redirect::to('web');
            //View::make('','');
		} else {
			return Redirect::to('login')->with('mensaje_login', 'Ingreso invalido');
		}
	});

Route::group(array('before' => 'auth'), function () {

		Route::get('logout', function () {
				if (Auth::check()) {
					Auth::logout();return
					Redirect::to('login');
				} else {
					return Redirect::to('login');
				}
			});

        /*Route::when('usuarios*','admin');
        Route::when('insumos*','admin');
        Route::when('productos*','admin-caja');

    //Route::controller('/web', 'WebController');

        Route::when('notas*', 'admin');
        Route::when('cocina*', 'cocina');
        Route::when('pedidos*', 'mozo');
        Route::when('combinacions*', 'admin-caja');
        Route::when('tipocombinacions*', 'admin-caja');
        Route::when('personas*', 'admin-caja');
        Route::when('perfiles*', 'admin');
        Route::when('pedidoscompras*', 'admin');
        Route::when('cajas*', 'admin-caja');
        Route::when('pedidoscomanda*', 'mozo');
        Route::when('eventos*', 'admin');
        Route::when('tickets*', 'admin-caja');
        Route::when('detallepedidos*', 'admin'); //reporte de tiempos
        Route::when('sabores*', 'admin');
        Route::when('monitores*', 'admin-caja');
        Route::when('reportes*', 'admin');
        Route::when('recetas*', 'admin');
        Route::when('compras*', 'admin');*/


		Route::controller('/usuarios','UsuariosController');
		Route::controller('/insumos', 'InsumosController');
		Route::controller('/productos', 'ProductosController');
		Route::controller('/web', 'WebController');
		Route::controller('/notas', 'NotasController');
		Route::controller('/cocina', 'CocinaController');
		Route::controller('/pedidos', 'PedidosController');
		Route::controller('/combinacions', 'CombinacionController');
		Route::controller('/tipocombinacions', 'TipoCombinacionController');
		Route::controller('/personas', 'PersonasController');
		Route::controller('/perfiles', 'PerfilesController');
		Route::controller('/pedidoscompras', 'PedidosdeCompraController');
		Route::controller('/cajas', 'CajasController');
		Route::controller('/pedidoscomanda', 'PedidoscomandaController');
		Route::controller('/eventos', 'EventosController');
		Route::controller('/tickets', 'TicketsController');
		Route::controller('/detallepedidos', 'DetallepediController');
		Route::controller('/sabores', 'SaboresController');
		Route::controller('/monitores', 'MonitorController');
		Route::controller('/reportes', 'ReportesController');
		Route::controller('/recetas', 'RecetasController');
		Route::controller('/compras', 'ComprasController');
		Route::get('/error-reporting', function(){
			$datos= [1,2];
			return View::make('hello', $datos);
		});

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
		);
		Route::post('bperdni', function () {
				if (Request::ajax()) {
					$patron = Input::get('parametro');
					if (isset($patron)) {
						$personas = DB::select('select persona.id, persona.nombres, persona.apPaterno, persona.apMaterno
                            from persona left join usuario on persona.id = usuario.persona_id where usuario.persona_id
                            is NULL and dni like ?', array($patron.'%'));;return Response::json($personas);
					}
				}
			}
		);
		Route::post('buscar_provedores', function () {
				if (Request::ajax()) {
					$patron = Input::get('parametro');
					$provedores = Persona::whereraw("razonSocial like '".$patron."%' and perfil_id = '4'")->take(10)->get();
					return $provedores->toJson();
				}
			}
		);

		/*route javi*/

		//route para autocomplete de prod

		Route::get('colorao',function(){

			$productos = Producto::select('producto.nombre', 'producto.id', 'precio.precio', 'producto.cantidadsabores')
												 ->join('precio', 'precio.producto_id', '=', 'producto.id')
												 ->join('combinacion', 'combinacion.id', '=', 'precio.combinacion_id')
												 ->where('combinacion.nombre', '=', 'Normal')												 
												 ->where('producto.estado', '=', 1)
												 //->orderby('producto.nombre','ASC')
												 ->get();
			return Response::json($productos);

		});

			//fin rout autocomplete prod
		Route::get('bus_insumo_', function () {
				if (Request::ajax()) {
					$valor = $_REQUEST["filter"]["filters"][0]["value"];
					$insumos = Insumo::where('nombre', 'like', '%'.$valor.'%')->get();
					return Response::json($insumos);
				}
			});

		Route::get('bus_insumo_prod', function () {
				if (Request::ajax()) {
					$valor = $_REQUEST["filter"]["filters"][0]["value"];
					$insumos = Insumo::where('nombre', 'like', '%'.$valor.'%')
					                  ->selectraw('id, nombre, "Insumos" as Tipo')->get();
					$productos = Producto::where('nombre','like','%'.$valor.'%')
										->selectraw('id, nombre, "Productos" as Tipo')
					                   ->get();
					return Response::json(array_merge($insumos->toArray(),$productos->toArray()));
				}
		});

        Route::get('bus_insumo_prod_compras', function () {
            if (Request::ajax()) {
                $valor = $_REQUEST["filter"]["filters"][0]["value"];
                $insumos = Insumo::where('nombre', 'like', '%'.$valor.'%')
                    ->selectraw('id, nombre,unidadMedida,ultimocosto as costo, "Insumos" as Tipo')->get();
                $productos = Producto::where('nombre','like','%'.$valor.'%')->where('receta','=',0)
                    ->selectraw('id, nombre,unidadMedida,costo, "Productos" as Tipo')
                    ->get();
                return Response::json(array_merge($insumos->toArray(),$productos->toArray()));
            }
        });

		Route::get('bus_prepro_', function () {
				if (Request::ajax()) {
					$valor = $_REQUEST["filter"]["filters"][0]["value"];
					$productos = Producto::where('receta', '=', 1)
						->where('nombre', 'like', '%'.$valor.'%')
					->groupby('id')
						->get();
					return Response::json($productos);
				}
			});

		Route::get('bus_per_', function () {
				$valor = $_REQUEST["filter"]["filters"][0]["value"];
				$persona = Persona::where('dni', 'like', '%'.$valor.'%')
					->where('dni', 'like', '%'.$valor.'%', 'or')
				->where('ruc', 'like', '%'.$valor.'%', 'or')
					->where('nombres', 'like', '%'.$valor.'%', 'or')
				->where('apMaterno', 'like', '%'.$valor.'%', 'or')
					->where('apPaterno', 'like', '%'.$valor.'%', 'or')
				->where('razonSocial', 'like', '%'.$valor.'%', 'or')
					->get();
				$arraydatos = array();
				foreach ($persona as $dato) {
					if ($dato->ruc) {
						$arraydatos[] = array('id' => $dato->id, 'nombres' => $dato->razonSocial, 'direccion' => $dato->direccion, 'dni' => $dato->ruc, );
					} else {
						$arraydatos[] = array('id' => $dato->id, 'nombres' => $dato->nombres.' '.$dato->apPaterno.' '.$dato->apMaterno, 'direccion' => $dato->direccion, 'dni' => $dato->dni, );
					}
				}

				return Response::json($arraydatos);
			}
		);

		Route::get('bus_prod_', function () {
				$valor = $_REQUEST["filter"]["filters"][0]["value"];
				$productos = Producto::join('familia', 'familia.id', '=', 'producto.familia_id')
					->where('producto.nombre', 'like', '%'.$valor.'%')
				->select('producto.nombre as productoNombre','producto.unidadMedida as unidadMedida',  'producto.id as productoID', 'producto.descripcion as productoDescr', 'familia.id as familiaID', 'familia.nombre as familiaNombre')
					->get();
				$arrProd = array();
				foreach ($productos as $dato) {
					$arrProd[] = array('id' => $dato->productoID,
                                    'nombre' => $dato->productoNombre,
                                    'descripcion' => $dato->productoDescr,
                                    'cantidad' => '1.00',
                                    'precio' => '1.00',
                                    'familiaid' => $dato->familiaID,
                                    'familianombre' => $dato->familiaNombre,
                                    'unidadMedida'=>$dato->unidadMedida);
				}
				return Response::json($arrProd);
			});

                //para agregar sabores
                Route::get('bus_prod_saborYZ', function () {
                    $valor = $_REQUEST["filter"]["filters"][0]["value"];
                    $productos = Producto::join('familia', 'familia.id', '=', 'producto.familia_id')
                        ->where('producto.nombre', 'like', '%'.$valor.'%')
                        ->select('producto.nombre as productoNombre', 'producto.cantidadsabores as cantidadsabores','producto.id as productoID', 'producto.descripcion as productoDescr', 'familia.id as familiaID', 'familia.nombre as familiaNombre')
                        ->get();
                    $arrProd = array();
                    foreach ($productos as $dato) {
                        $arrProd[] = array('id' => $dato->productoID,
                            'nombre' => $dato->productoNombre,
                            'descripcion' => $dato->productoDescr,
                            'cant_sabores' => $dato->cantidadsabores,
                            'familiaid' => $dato->familiaID,
                            'familianombre' => $dato->familiaNombre
                            );
                    }
                    return Response::json($arrProd);
                });

		Route::get('bus_sabor_', function () {
				$valor = $_REQUEST["filter"]["filters"][0]["value"];
				//$productos = Producto::where('nombre','like',$valor.'%')->lists('id','nombre','descripcion');
				$sabores = Sabor::where('nombre', 'like', '%'.$valor.'%')->get();
				//var_dump($productos);
				//die();
				$arrSab = array();
				foreach ($sabores as $dato) {

					$arrSab[] = array('id' => $dato->id, 'nombre' => $dato->nombre, 'descripcion' => $dato->descripcion, 'cantidad' => '1');

				}
				return Response::json($arrSab);
			}
		);

		Route::post('compr_prod_sabr', function () {
				if (Request::ajax()) {
					$producto_id = Input::get('productoid');
					$prods = Sabor::whereHas('productos', function ($q) {
							$q->where('id', '=', Input::get('productoid'));

						})->get();

					if (count($prods) > 0) {
						return Response::json(true);

					} else {
						return Response::json(false);
					}
				}
			});

		Route::post('compr_prod_receta', function () {
				//if (Request::ajax()) {
					$producto_id = Input::get('productoid');
					$prods = Insumo::whereHas('productos', function ($q) {
							$q->where('producto.id', '=', Input::get('productoid'));
						})->get();

					if (count($prods) > 0) {
						return Response::json(true);

					} else {
						return Response::json(false);
					}
				//}
			});

		
		Route::post('compr_ins_stockInicial_prod_receta', function () {
				if (Request::ajax()) {

					$ins = [];
					$prod = [];
					$prodStock = [];
					if ( Input::get('tipo') == 'Insumos') {
						$ins = Insumo::whereHas('almacenes', function ($q) {
							$q->where('insumo.id', '=', Input::get('insumoid'))
								->where('stockInsumo.almacen_id','=',Input::get('almacenid'));
						})->get();
					}elseif(Input::get('tipo') == 'Productos'){
						$prod = Producto::where('receta','=',1)->where('id','=',Input::get('insumoid'))->get();
						$prodStock = Producto::whereHas('almacenes',function($q) {
							$q->where('producto.id','=', Input::get('insumoid'))
								->where('stockProducto.almacen_id','=', Input::get('almacenid'));

						})->get();
					}

					

					//$prod = Producto::where('receta','=',1)->where('id','=',Input::get('insumoid'))->get();

					                  //print_r($prod->toJson()); die();

					if (count($ins) > 0) {
						$data['msg'] = 'Insumo con stock inicial creado en este Almacén. Escoja otro.';
						$data['boolean'] = true;
 						return Response::json($data);

					} elseif(count($prod) > 0) {
						$data['msg'] = 'Producto con receta. Su Stock se determina a partir de sus ingredientes.';
						$data['boolean'] = true;
						return Response::json($data);
					}elseif(count($prodStock) > 0){
						$data['msg'] = 'Producto con stock inicial creado en este almacén. Escoja otro.';
						$data['boolean'] = true;
						return Response::json($data);
					}else{
						$data['boolean'] = false;
						return Response::json($data);
					}
				}
			});

		Route::post('compr_login', function () {
				if (Request::ajax()) {
					$login = Input::get('login');
					$user = Usuario::where('login', '=', $login)->lists('id');
					//var_dump($user);
					//die();
					if (count($user) > 0) {
						return Response::json(true);
					} else {
						return Response::json(false);
					}
				}
			});

		Route::controller('/almacenes', 'AlmacenController');
		/*FIN*/

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
						and idarea = ".$id_area)
						->update(array('detallepedido.cocinaonline' => 1));
					$detallepedido = DetPedido::select('detallepedido.estado', 'detallepedido.ordenCocina', 'detallepedido.cantidad',
						'producto.id as productoid', 'producto.nombre', 'detallepedido.cantidad',
						'detallepedido.id', 'detallepedido.pedido_id', 'detallepedido.detalle_id')
						->join('producto', 'detallepedido.producto_id', '=', 'producto.id')
					->whereraw("detallepedido.pedido_id =".$pedido." and detallepedido.cocinaonline
                             = 1 and idarea = ".$id_area." and
                             detallepedido.ordenCocina = ".$orden)
						->groupBy('detallepedido.id')
					->get();

					foreach ($detallepedido as $detalleitem) {
						$adi = $detalleitem->detalle_id;
						if (!isset($adi)) {
							$adicionales = DetPedido::select('producto.nombre', 'detallepedido.cantidad')
								->join('producto', 'detallepedido.producto_id', '=', 'producto.id')
							->where('detallepedido.detalle_id', '=', $detalleitem->id)
							->groupBy('detallepedido.id')
								->get();
							$notas = $detalleitem->notas()->lists('descripcion');
							$sabores = $detalleitem->sabores()->lists('nombre');
							$arraydatoscocina[] = array('estado' => $detalleitem->estado,
								'ordenCocina'                       => $detalleitem->ordenCocina,
								'cantidad'                          => $detalleitem->cantidad,
								'productoid'                        => $detalleitem->productoid,
								'nombre'                            => $detalleitem->nombre,
								'id'                                => $detalleitem->id,
								'pedido_id'                         => $detalleitem->pedido_id,
								'adicionales'                       => json_decode($adicionales->toJson()),
								'sabores'                           => $sabores,
								'notas'                             => $notas,
								'cornometro'                        => date('Y-m-d').'T'.date('H:i:s'));
						}
					}

					return Response::json($arraydatoscocina);
				}
			});

		Route::get('verificarcocinas', function () {
				$areas = Areadeproduccion::select('tipoareadeproduccion.nombre', 'areadeproduccion.id_tipo',
					'areadeproduccion.id', 'areadeproduccion.nombre as areanombre')
					->join('tipoareadeproduccion', 'tipoareadeproduccion.id', '=', 'areadeproduccion.id_tipo')
				->whereraw("id_restaurante = '".Auth::user()->id_restaurante."' and  id_tipo != 2")
				->orderBy('areadeproduccion.id_tipo','ASC')
				->get();
				return Response::json($areas);
			});

		Route::post('mozonotificaciones', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try{
					$getestado = Input::get('estado');
					$estado = $getestado;
					$iddetalle = Input::get('iddetallep');
					if ($estado != '') {
						$opedido = DetPedido::select('pedido.id', 'usuario.login', 'mesa.nombre',
							'producto.nombre as pnombre', 'detallepedido.combinacion_c',
							'usuario.id_tipoareapro', 'areadeproduccion.nombre as anombre',
							'detallepedido.cantidad', 'detallepedido.id as detpedidoid',
							'producto.id as proid')
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
						$adicArr = null;
						// no se cuentan los ANULADOS 19-03-15 whereNull('detalleanulacion_id')..
						$adicionales = DetPedido::where('detalle_id', '=', $iddetalle)
									   ->whereNull('detalleanulacion_id')
						               ->get();
						if (!empty($adicionales)) {
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
								$adicional->estado = $estado;
								$adicional->save();
								$adicArr[] = $adicional;
							}
						}
						//envia adicionales de un prod para ser actualizados
						$adicArr2 = null;
						if (isset($adicArr)) {
							foreach ($adicArr as $adicAr) {
								$adicArr2[] = array(
									'iddetallep'	=> $adicAr->id,
									'estado'		=> $adicAr->estado
									);
							}
						}
						//fin envi adc
						$odepedido->estado = $estado;
						$odepedido->save();
						$arrayco = array(
							'estado' 				  => $estado,
							'iddetallep'             => Input::get('iddetallep'),
							'usuario'                => $opedido->login,
							'mesa'                   => $opedido->nombre,
							'pedido'                 => $opedido->id,
							'producto'               => $opedido->pnombre,
							'combinacion_c'          => $opedido->combinacion_c,
							'areapro'                => $opedido->anombre.'_'.$opedido->id_tipoareapro,
							'proid'                  => $opedido->proid,
							'cantidad'               => $opedido->cantidad,
							'adicionales'			 => $adicArr2
							);
						//print_r(json_encode($arrayco)); die();
						DB::commit();
						return Response::json($arrayco);
					}
				}catch(Exception $e){
					DB::rollback();
				}
				}
			});
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
					Notasxproductos::wherein('id', $borrar)->delete();
					return json_encode($borrar);
				}
			}
		);
		Route::controller('/modulos', 'ModulosController');Route::post('mostrarnotas', function () {
				if (Request::ajax()) {
					$idpro = Input::get('idpro');
					$notas = Notas::Select('notas.id', 'notas.descripcion')
                                    ->join('notaxproducto', 'notaxproducto.nota_id', '=', 'notas.id')
                                    ->where('notaxproducto.producto_id', '=', $idpro)
                                    ->orderBy('id','DESC')
                                    ->get();
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
				/*$mozos = Usuario::where('colaborador', '=', '2')
					->where('estado', '=', 1)
				->where('id_restaurante', '=', Auth::user()->id_restaurante, 'AND')
				->get();*/
				//$mozos = Usuario::find(25);
				//$_perfil = Perfil::where('nombre','=','Mozo')->first()->id;
				//print_r($_perfil); die();
				//consulta $q es a los usuuarios y personas. Escogido!
				$mozos = Usuario::whereHas('persona',function($q){
					$q->where('perfil_id','=', Perfil::where('nombre','=','Mozo')->first()->id)
					  ->where('estado','=',1)
					  ->where('habilitado','=',1)
					  ->where('id_restaurante','=',Auth::user()->id_restaurante);
				})->get();
				//consulta $q es a los personas
				/*$mozos = Usuario::with(array('persona' => function($q){
					$q->where('perfil_id','=',2)
					  ->where('estado','=',1)
					  ->where('id_restaurante','=',Auth::user()->id_restaurante);
				}))->get();*/
				//$mozos = $mozos->persona->perfil->nombre;
				//return $mozos->toJson();
				return $mozos;
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
							'familianombre'                => $dato->nombre,
							'cantidad'                     => $dato->fcantidad,
							'productos'                    => json_decode($productosc));
					}
					return json_encode($procombi);
				}
			}
		);

        function descontarStock($prodID,$qant){
            $oProd = Producto::find($prodID);
            if($oProd->receta == 1){
                $almacen_id = Auth::user()->restaurante->almacen_id;
                $oAlmacen = Almacen::find($almacen_id);
                $insumosReceta = $oProd->insumos()->get();

                //hasta aqui entra pq no tiene receta aunq en prod esta activado. no errores

                foreach($insumosReceta as $insumo){
                    //aqui insumo no agregado al stock de insumos del almacen principal puede ser..
                    $insumoAlmacen = $oAlmacen->insumos()->where('stockInsumo.insumo_id', '=', $insumo->id)->first();
                    if(!empty($insumoAlmacen)) {
                        Almacen::find($almacen_id)->insumos()->updateExistingPivot($insumo->id,
                            array('stockActual' => $insumoAlmacen->pivot->stockActual - $qant * $insumo->pivot->cantidad));
                    }

                }


                //prod no agregado al stock del almacen principal.. posible error
            }elseif($oProd->receta == 0){
                //if()
                $almacen_id = Auth::user()->restaurante->almacen_id;
                $oAlmacen = Almacen::find($almacen_id);
                $productoAlmacen = $oAlmacen->productos()->where('stockProducto.producto_id', '=', $oProd->id)->first();
                if(!empty($productoAlmacen)) {
                    Almacen::find($almacen_id)->productos()->updateExistingPivot($oProd->id, array('stockActual' => $productoAlmacen->pivot->stockActual - $qant));
                }
            }
        }

    function descontarStockAttr($saborID,$qant){
        $oSabor = Sabor::find($saborID);
        $almacen_id = Auth::user()->restaurante->almacen_id;
        $oAlmacen = Almacen::find($almacen_id);
        //print_r($oSabor); die();
        if(!empty($oSabor->insumo->id)){
        	//print_r($oAlmacen); die();

        $insumoAlmacen = $oAlmacen->insumos()->where('stockInsumo.insumo_id', '=', $oSabor->insumo->id)->first();
	        if(!empty($insumoAlmacen)) {
	            Almacen::find($almacen_id)->insumos()->updateExistingPivot($oSabor->insumo->id,
	                array('stockActual' => $insumoAlmacen->pivot->stockActual - $qant*$oSabor->porcion));
	        }
    	}

    }


		Route::post('enviarpedidos', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try {
					$profami = Input::get('prof');
					$procombi = Input::get('proc');
					$cocinas = Input::get('cocinas'); //ver cocinas
					$pedidoid = Input::get('pedidoid');
					$mozoid = Input::get('mozoid');
					$idmesa = Input::get('idmesa');

                                    //orden cancelada
                        if ($pedidoid != 0) {
                            if (Pedido::find($pedidoid)->estado == 'T') {
                                DB::rollBack();
                                return Response::json('can_order');
                            }
                        }
                        //fin add

					if ($pedidoid == 0) {
						$mesa = Mesa::find($idmesa);
						$Opedido = $mesa->pedidos()->whereIn('pedido.estado', array('I'))->first();
						if (!isset($Opedido)) {
							$Opedido = Pedido::create(array('estado' => 'I', 'usuario_id' => $mozoid));
							$pedidoid = $Opedido->id;
							$detMesa = DetMesa::create(array('mesa_id' => $idmesa, 'pedido_id' => $pedidoid));
						}else{
							//fixed 10-04-15
							$pedidoid = $Opedido->id;
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
								$ococina = Areadeproduccion::find(substr(strrchr($cocina, "_"), 1));
								if ($ococina->id_tipo == $producto->id_tipoarepro) {
									//$areapro = substr($cocina, -1); para capturar id de 2 dígitos a más
									$areapro = substr(strrchr($cocina, "_"), 1);
									//print_r($areapro);
									$ordencocina = $ococina->ordennumber+1;
									$arrayimprimir[$cocina][] = $datoprof;
								}
							}
							$datitos1 = array(
								'pedido_id' 				 => $pedidoid,
							 	'producto_id'				 => $datoprof['idpro'],
								'cantidad'                   => $datoprof['cantidad'],
								'importeFinal'               => $datoprof['preciot'],
								'estado'                     => 'I', 
								'descuento'                  => 0,
								'idarea'                     => $areapro,
								'ordenCocina'                => $ordencocina
											);
							$odetpe = DetPedido::create($datitos1);


                            descontarStock($odetpe->producto_id,$odetpe->cantidad);
                            /*$oProd = Producto::find($odetpe->producto_id);
                            if($oProd->receta == 1){
                                $almacen_id = Auth::user()->restaurante->almacen_id;
                                $oAlmacen = Almacen::find($almacen_id);
                                $insumosReceta = $oProd->insumos()->get();

                                //hasta aqui entra pq no tiene receta aunq en prod esta activado. no errores

                                foreach($insumosReceta as $insumo){
                                    //aqui insumo no agregado al stock de insumos del almacen principal puede ser..
                                    $insumoAlmacen = $oAlmacen->insumos()->where('stockInsumo.insumo_id', '=', $insumo->id)->first();
                                    if(!empty($insumoAlmacen)) {
                                        Almacen::find($almacen_id)->insumos()->updateExistingPivot($insumo->id,
                                            array('stockActual' => $insumoAlmacen->pivot->stockActual - $odetpe->cantidad * $insumo->pivot->cantidad));
                                    }

                                }



                            //prod no agregado al stock del almacen principal.. posible error
                            }elseif($oProd->receta == 0){
                                //if()
                               $almacen_id = Auth::user()->restaurante->almacen_id;
                                $oAlmacen = Almacen::find($almacen_id);
                                $productoAlmacen = $oAlmacen->productos()->where('stockProducto.producto_id', '=', $oProd->id)->first();
                                if(!empty($productoAlmacen)) {
                                    Almacen::find($almacen_id)->productos()->updateExistingPivot($oProd->id, array('stockActual' => $productoAlmacen->pivot->stockActual - $odetpe->cantidad));
                                }
                            }*/

                            //


							$flagnotas = 0;
							if (isset($datoprof['notas'])) {
								$arrayinsertnotas = array();
								foreach ($datoprof['notas'] as $anota) {
									$arrayinsertnotas[] = array(
										'notas_id' => $anota['idnota'],
										'detallePedido_id' => $odetpe->id 
										);
									$flagnotas = 1;
								}

								Detallenotas::insert($arrayinsertnotas);
							}
							$flagadicional = 0;
							if (isset($datoprof['adicionales'])) {
								foreach ($datoprof['adicionales'] as $datadi) {
									$inputadi = array(
										'pedido_id'					 => $pedidoid,
										'producto_id'                => $datadi['idadicional'],
										'cantidad'                   => $datadi['cantidad'],
										'ImporteFinal'               => $datadi['precio'],
										'estado'                     => 'I',
										'descuento'                  => 0,
										'idarea'                     => $areapro,
										'ordenCocina'                => $ordencocina,
										'detalle_id'                 => $odetpe->id);
									$odetpeadi = DetPedido::create($inputadi);
									$flagadicional = 1;
									$arrayprof[] = array('iddetpedido' => $odetpeadi->id,
										'pronombre'                       => $datadi['nombre'],
										'pestado'                         => $odetpeadi->estado,
										'notas'                           => 0,
										'cantidad'                        => $datadi['cantidad'],
										'precio'                          => $datadi['precio'],
										'idpedido'                        => $pedidoid,
										'adicionales'                     => 2,
										'sabores'                         => 0, );
								}
							}
							$flagsabor = 0;
							if (isset($datoprof['sabores'])) {
								$arraysabores = array();
								foreach ($datoprof['sabores'] as $datosabor) {
									$arraysabores[] = array('detpedido_id' => $odetpe->id, 'sabor_id' => $datosabor['idsabor'], );
                                    descontarStockAttr($datosabor['idsabor'],$odetpe->cantidad);
									$flagsabor = 1;
								}

								Detpedidosabores::insert($arraysabores);
							}

                            //add 28-04-15
                            $arrNotas = array();
                            foreach ($odetpe->notas as $detnota){
                                $arrNotas[] = $detnota->descripcion;
                            }

                            //print_r($arrNotas);
                            //die();
                            $arrSabores = array();
                            foreach($odetpe->sabores as $detsabor){
                                $arrSabores[] = $detsabor->nombre;
                            }

                            //print_r($arrSabores);
                            //die();
                            //fin add*

							$arrayprof[] = array('iddetpedido' => $odetpe->id, 'pronombre' => $datoprof['nombre'], 'pestado' => $odetpe->estado, 'notas' => $flagnotas, 'cantidad' => $datoprof['cantidad'], 'precio' => $datoprof['preciot'], 'idpedido' => $pedidoid, 'adicionales' => $flagadicional, 'sabores' => $flagsabor, 'arrNotas' => $arrNotas, 'arrSabores' => $arrSabores );
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
											$oprocom2 = $datoproc[$procom]+array('cantidad' => $datoproc['cantidad']);
											$arrayimprimir[$cocina][] = $oprocom2;
										}
									}
									$datitos2 = array('pedido_id' => $pedidoid,
										'producto_id'                => $datoproc[$procom]['idprocombi'],
										'cantidad'                   => $datoproc['cantidad'],
										'ImporteFinal'               => $datoproc[$procom]['precio'],
										'estado'                     => 'I', 
										'descuento'                  => 0,
										'combinacion_id'             => $datoproc['idcombi'],
										'combinacion_c'              => $cont_comb_c2,
										'combinacion_cant'           => $datoproc['cantidad'],
										'idarea'                     => $areapro,
										'ordenCocina'                => $ordencocina);
									$oprocom = DetPedido::create($datitos2);

                                    descontarStock($oprocom->producto_id,$oprocom->cantidad);

									$flagnotas = 0;
									if (isset($datoproc[$procom]['notas'])) {
										$arrayinsertnotasc = array();
										foreach ($datoproc[$procom]['notas'] as $anota) {
											$arrayinsertnotasc[] = array('notas_id' => $anota['idnota'], 'detallePedido_id' => $oprocom->id, );
											$flagnotas = 1;
										}

										Detallenotas::insert($arrayinsertnotasc);
									}

                                                    //add 07-05-15
                                                    $arrNotas = array();
                                                    foreach ($oprocom->notas as $detnota){
                                                        $arrNotas[] = $detnota->descripcion;
                                                    }

                                                    //print_r($arrNotas);
                                                    //die();
                                                    //$arrSabores = array();
                                                    //foreach($odetpe->sabores as $detsabor){
                                                    //    $arrSabores[] = $detsabor->nombre;
                                                    //print_r($arrSabores);
                                                    //die();
                                                    //fin add*


									$procomb[] = array('iddetpedido' => $oprocom->id, 'pronombre' => $datoproc[$procom]['nombre'], 'pestado' => $oprocom->estado, 'notas' => $flagnotas, 'arrNotas' => $arrNotas,);
								}
							}
							$arrayproco[] = array('combinombre' => $datoproc['nombrecombi'], 'precio' => $datoproc['preciot'], 'produccomb' => $procomb, 'cantidad' => $datoproc['cantidad'], 'idpedido' => $pedidoid, );
						}
					}
					$j = 0;
					foreach ($cocinas as $cocina) {
				//$max = DetPedido::whereraw("pedido_id = ".$pedidoid." and idarea = ".substr($cocina, -1))->first();
			$max = DetPedido::whereraw("pedido_id = ".$pedidoid." and idarea = ".substr(strrchr($cocina, "_"), 1))->first();
						$ordenes = 0;
						if (isset($max)) {
							//$areap = Areadeproduccion::find(substr($cocina, -1));
							$areap = Areadeproduccion::find(substr(strrchr($cocina, "_"), 1));
							$ordenes = $areap->ordennumber+1;
							$areap->ordennumber = $ordenes;
							$areap->save();
						}
						$orden[] = array('cocina' => $cocina, 'orden' => $ordenes, );
						$j++;
					}
					} catch (Exception $e) {
						DB::rollBack();
						return Response::json($e->getMessage().'. L:'.$e->getLine());
					}
					Event::fire('imprimirpedidos', compact('arrayimprimir', 'mozoid', 'idmesa', 'cocinas'));
					DB::commit();
					return Response::json(compact('orden', 'arrayproco', 'arrayprof', 'pedidoid'));
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
					return Response::json($arrayadicionales);
				}
			});

		Route::post('sabores', function () {
				if (Request::ajax()) {
					$idpro = Input::get('idpro');
					$producto = Producto::find($idpro);
					$sabores = $producto->sabores;
					return Response::json($sabores);
				}
			});

		Route::post('precuenta', function () {
				if (Request::ajax()) {
					$idpedido = Input::get('idpedido');
					$tipopre = Input::get('tipopre');
					$nombremesa = Input::get('mesa');
					$nombremozo = Input::get('mozo');
					$precuenta = Input::get('precuenta');
					$pedido = Pedido::find($idpedido);
					$nombremesa = $pedido->mesas()->first()->nombre;
					$nombremozo = $pedido->usuario->login;
					if ($tipopre == 1) {
						DB::beginTransaction();
						try {
							$detallespro = $pedido->productos()
								->where('detallepedido.estado_t', '=', 0)
								->where('detallepedido.estado', '!=', 'A', 'AND')
								->where('detallepedido.combinacion_id', '=', NULL, 'AND')
								->groupBy('detallepedido.producto_id')
								->get();

							$detallesproprecuen = $pedido->productosguardarprecuenta()
								->where('detallepedido.estado_t', '=', 0)
								->where('detallepedido.estado', '!=', 'A', 'AND')
								->where('detallepedido.combinacion_id', '=', NULL, 'AND')
								->groupBy('detallepedido.producto_id')
								->get();
							$detallescom = $pedido->combinaciones()
								->where('detallepedido.estado_t', '=', 0)
								->groupBy('combinacion_id')->get();

							$detallescomprecuen = $pedido->combinacionesguardarprecuenta()
								->where('detallepedido.estado_t', '=', 0)
								->groupBy('combinacion_id')->get();

							$arrayproprecuenta = array();
							if ($detallespro) {
								foreach ($detallespro as $detallepro) {
									$cantidadre = $detallepro->pivot->where('detallepedido.producto_id', '=', $detallepro->id)
									->where('detallepedido.pedido_id', '=', $detallepro->pivot->pedido_id, 'AND')
									->where('detallepedido.estado_t', '=', 0, 'AND')
									->where('detallepedido.combinacion_id', '=', NULL, 'AND')
									->sum('cantidad');
									$preciou = $detallepro->pivot->importeFinal/$detallepro->pivot->cantidad;
									$preciot = $preciou*$cantidadre;

									$oprecuenta = Detpedidotick::where('nombre', '=', $detallepro->nombre)
									->where('pedido_id', '=', $idpedido, 'AND')
									->whereNull('ticket_id')
									->first();
									$oComb = Combinacion::where('nombre','=','Normal')->first();
									$arraycreaprecuenta = array('nombre' => $detallepro->nombre,
										'cantidad'                          => $cantidadre,
										'precio'                            => $preciot,
										'combinacion_id'                    => $oComb->id,
										'preciou'                           => $preciou,
										'pedido_id'                         => $detallepro->pivot->pedido_id,
										'producto_id'                       => $detallepro->id);
									if (count($oprecuenta) > 0) {
										$newcantidad = $oprecuenta->cantidad+$cantidadre;
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
										'cantidad'                          => $cantidadcombi,
										'precio'                            => $preciocom,
										'combinacion_id'                    => $detallecom->pivot->combinacion_id,
										'preciou'                           => $detallecom->precio,
										'pedido_id'                         => $detallecom->pivot->pedido_id);

									$oprecuenta = Detpedidotick::where('nombre', '=', $detallecom->nombre)->where('pedido_id', '=', $idpedido, 'AND')->whereNull('ticket_id')->first();
									if (count($oprecuenta) > 0) {
										$newcantidad = $oprecuenta->cantidad+$cantidadcombi;
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
						} catch (Exception $e) {
							DB::rollback();
							return Response::json($e->getMessage());
						}
						DB::commit();
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
                                 /*margin-bottom:-45px;
                                 margin-left: -45px;
                                 margin-top:-45px;*/
                                 /*padding:4px;*/
                                 margin:5px;
                            }
                            table{
                                width: 100%;
                                font-size: 13px;
                                border-bottom: 1px solid #000;
                                border-top: 1px solid #000;
                                margin: 2px 4px 2px 4px;                                
                            }
                            .importetotal{
                            	width: 150px;
                                font-size: 14px;
                                /*text-align: right;*/

                                font-weight: bold;
                                /*margin-right:30px;*/
                                border-top: 1px solid #000;
                                padding: 0;
                            }
                            .titulos{
                                border-bottom: 1px solid #000;
                            }
                            p {
                                padding: 0;
                                margin: 2px 4px 2px 4px;
                            }
                        </style>
                        <body>
                        <p style="text-align:center"><img src="'.public_path('/').'images/productos/tostao.jpg" width="98px" height="84px" alt=""/></p>
                        <p style="text-align:center"><h4><strong>PRE-CUENTA</strong></h4></p>
                        
                         <table>
        						<tr style="border-bottom: 5px solid #000;">
        							<td style="width: 110px; font-weight: bold;">Descripción</td>
        							<td style="width: 50px; text-align:center;font-weight: bold;">P. Unit.</td>
        							<td style="width: 40px; text-align:center;font-weight: bold;">Cant.</td>
        							<td style="width: 40px; text-align:center;font-weight: bold;  ">S/.</td>
        						</tr>
                        </table>
                        
                        <table style="width:260px">';
						$importetotal = 0;
						$newtamaño = 4*count($precuenta);
						foreach ($precuenta as $predato) {
							$html .= '<tr>
                            <td style="width: 180px;>'.str_pad(substr($predato['nombre'],0,12),12,'*').'.'.'</td>
                            <td style="width: 50px;text-align: right">'.$predato['preciou'].'</td>
                            <td style="width: 45px; text-align: right">'.$predato['cantidad'].'</td>
                            <td style="width: 45px;text-align: right">'.$predato['precio'].'</td>
                        </tr>';
							$importetotal = $importetotal+$predato['precio'];
						}
						$html .= '</table>
                        <table>
                        	<tr>
                        		<td style="width: 260px;text-align: right;font-weight: bold; font-size:13px;">TOTAL: S/.'.number_format($importetotal, 2).'</td>
                        	</tr>
                        </table>
                        <p>Mesa Atendida: '.$nombremesa.'</p>
                        <p>Atendido por: '.$nombremozo.'</p>
                        <div style="border-bottom: 1px solid #000; margin: 2px 0px 2px 4px; width:260px;">&nbsp;</div>
                        <p>[  ]&nbsp;
Boleta&nbsp;
&nbsp;
[  ] Factura&nbsp; [ ]Por Cons.&nbsp; [ ]Detall.</p>
                        <p>
                           	<p>Nombres/Rzn Soc: .....................................</p>
                        	<p>Direc.: .........................................................</p>
                        	<p>DNI/RUC: ...................................................</p>
                        	<br>                        	
                        	<p style="text-align:center">**No válido como documento contable**</p>


                        </p>
                        </body>
                        </html>';
						$headers = array('Content-Type' => 'application/pdf', );
						$pdfPath = TIKET_DIR.$token.'.pdf';
						$tamaño = 145+$newtamaño;
						//File::put($pdfPath, PDF::load($html,'A7', 'portrait')->output());
						$html2pdf = new HTML2PDF('V', array('78', $tamaño), 'fr', true, 'UTF-8', 0);
						$html2pdf->WriteHTML($html);
						$html2pdf->Output($pdfPath, 'F');
                        // init HTML2PDF
                        //$html2pdf = new HTML2PDF('P',array('74','130'), 'es', true, 'UTF-8', array(0, 0, 0, 0));

                        // display the full page
                        //$html2pdf->pdf->SetDisplayMode('fullpage');

                        // convert
                        //$html2pdf->writeHTML($html);

                        // add the automatic index
                        //$html2pdf->createIndex('Sommaire', 30, 12, false, true, 2);

                        // send the PDF
                        //$html2pdf->Output($pdfPath,'F');
						//$cmd = "lpr -PEpson-TM-T20II-1 ";
						$cmd = "lpr -P barra ";
						//$cmd = "lpr -P Photosmart-Plus-B209a-m ";
						$cmd .= $pdfPath;
						//if (Auth::user()->id_restaurante == 2) {
							$response = shell_exec($cmd);
						//}
						//File::delete($pdfPath);
						return Response::json('true');
					}
				}
			});

		Route::post('cobrarmesa', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try {
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
						$idmozo = Input::get('idmozo');
						$arrayudateprecuenta = array();
						$subtotal = 0;
						$newtotal = 0;
						$parsetotal = $total-$itotal;
						$impresora = $infocaja->impresora;
						$conteteoproductosporpagar = Detpedidotick::where('pedido_id', '=', $idpedido)->whereNull('ticket_id')->get();
						if (count($conteteoproductosporpagar) == 0) {
							return Response::json('false');
						}
						if ($parsetotal >= 0) {
							if ($tipo == 1) {
								//print_r($tipo); die();
								foreach ($cobrar as $dato) {
									if ($dato['cobrar'] == 1) {
										$itemprecuenta = Detpedidotick::find($dato['proid']);
										$subtotal = $itemprecuenta->preciou*$dato['cantidad'];
										$newtotal = $newtotal+$subtotal;
										if ($dato['modificar'] == 1) {
											//aqui solo pasan los prod por ejem: prod 1, cant 3, pagar 2. Si se pagan los 3
											// o sea todos, no pasan por aqui.
											$newcantidad = $itemprecuenta->cantidad-$dato['cantidad'];
											//print_r($newcantidad); die();
											$newprecio = $itemprecuenta->preciou*$newcantidad;
											$itemprecuenta->cantidad = $newcantidad;
											$itemprecuenta->precio = $newprecio;
											$arraycreaprecuenta = array(
												'nombre'         => $dato['nombre'],
												'cantidad'       => $dato['cantidad'],
												'precio'         => $dato['precio'],
												'combinacion_id' => $itemprecuenta->combinacion_id,
												'preciou'        => $dato['preciou'],
												'pedido_id'      => $itemprecuenta->pedido_id,
												'producto_id'    => $itemprecuenta->producto_id);
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
							$newparse = round($total, 2)-round($newtotal, 2);
							if ($newparse >= 0) {
								$restaurante = Restaurante::find(Auth::user()->id_restaurante);
								$datoscaja = Caja::find($caja_id);
								$newnumero = $datoscaja->numero+1;
								$datoscaja->numero = sprintf('%07d', $newnumero);
								$newdescuento = $idescuento+$ivale;
								$osubtotal = $itotal/1.18;
								$igv = $itotal-$osubtotal;
								$tickete = Ticket::create(array(
										'descuento'  => $descuento,
										'idescuento' => number_format($newdescuento, 2),
										'importe'    => $itotal,
										'numero'     => $newnumero,
										'serie'      => $datoscaja->serie,
										'detcaja_id' => $detcajaid,
										'caja_id'    => $caja_id,
										'pedido_id'  => $idpedido,
										'vuelto'     => $vuelto,
										'IGV'        => number_format($igv, 2),
										'subtotal'   => number_format($osubtotal, 2),
										'ipagado'    => $ipagado,
										'cliente'    => $cliente['nombres'],
										'documento'  => $cliente['dni'],
										'direccion'  => $cliente['direccion'],
                                        'persona_id' => $cliente['id'],
										'mesa'       => $nombremesa,
										'mozo'       => $nombremozo,
										'cajero'     => Auth::user()->login,
										'mozoid'     => $idmozo,
										'cajeroid'   => Auth::user()->id
									));
								Detpedidotick::whereIn('id', $arrayudateprecuenta)->update(array('ticket_id' => $tickete->id));
								$odetallestickete = $tickete->detallest;

								if ($iefectivo > 0) {
									$oefectivo = Detformadpago::create(array('importe' => $iefectivo, 'ticket_id' => $tickete->id, 'formadepago_id' => 1));
								}
								if ($itarjeta > 0) {
									$otarjeta = Detformadpago::create(array('importe' => $itarjeta, 'ticket_id' => $tickete->id, 'formadepago_id' => 2, 'codigotarjeta' => $dtarjeta));
								}
								if ($ivale > 0) {
									$ovale = Detformadpago::create(array('importe' => $ivale, 'ticket_id' => $tickete->id, 'formadepago_id' => 3));
								}
                                    //modificar poner $idescuento //cambiado ivale por idescuento
								if ($idescuento > 0) {
									$promocion = Detformadpago::create(array('importe' => $idescuento, 'ticket_id' => $tickete->id, 'formadepago_id' => 5));
								}
								$datoscaja->save();
							} else {
								return json_encode('Ingrese un monto válido');
							}
						}
					} catch (Exception $e) {
						DB::rollback();
						return Response::json($e);
					}
					$cajero = Auth::user()->login;
					/*Event::fire('imprimirticket', compact('odetallestickete', 'restaurante', 'tickete',
							'cliente', 'nombremesa', 'nombremozo', 'cajero', 'impresora'));*/
					//DB::rollback();
					//return json_encode('false del rollBack');
					DB::commit();
					return json_encode('True');
					//return Response::json($odetallestickete);
				}
			});

		Route::post('cobrarvale', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try {
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
						$idmozo = Input::get('idmozo');
						$arrayudateprecuenta = array();
						$subtotal = 0;
						$newtotal = 0;
						$parsetotal = $total-$itotal;
						$tipovale = Input::get('tipovale');
						$conteteoproductosporpagar = Detpedidotick::where('pedido_id', '=', $idpedido)->whereNull('ticket_id')->get();
						if (count($conteteoproductosporpagar) == 0) {
							return Response::json('false');
						}
						if ($parsetotal >= 0) {
							if ($tipo == 1) {
								//print_r($tipo.' de cobrarvale'); die();
								foreach ($cobrar as $dato) {
									if ($dato['cobrar'] == 1) {
										$itemprecuenta = Detpedidotick::find($dato['proid']);
										$subtotal = $itemprecuenta->preciou*$dato['cantidad'];
										$newtotal = $newtotal+$subtotal;
										if ($dato['modificar'] == 1) {
											$newcantidad = $itemprecuenta->cantidad-$dato['cantidad'];
											//print_r($newcantidad); die();
											$newprecio = $itemprecuenta->preciou*$newcantidad;
											$itemprecuenta->cantidad = $newcantidad;
											$itemprecuenta->precio = $newprecio;
											$arraycreaprecuenta = array(
												'nombre'         => $dato['nombre'],
												'cantidad'       => $dato['cantidad'],
												'precio'         => $dato['precio'],
												'combinacion_id' => $itemprecuenta->combinacion_id,
												'preciou'        => $dato['preciou'],
												'pedido_id'      => $itemprecuenta->pedido_id,
												'producto_id'    => $itemprecuenta->producto_id);
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
							$newparse = round($total, 2)-round($newtotal, 2);
							if ($newparse >= 0) {
								$restaurante = Restaurante::find(Auth::user()->id_restaurante);
								$impresora = $restaurante->impresoranocontable;
								$datoscaja = Caja::find($caja_id);
								if ($tipovale == 1) {
									$newnumero = $restaurante->numerodescuentoautorizado+1;
									$restaurante->numerodescuentoautorizado = sprintf('%07d', $newnumero);
								} else if ($tipovale == 2) {
									$newnumero = $restaurante->numerovale+1;
									$restaurante->numerovale = sprintf('%07d', $newnumero);
								}
								$newdescuento = $idescuento+$ivale;
								$osubtotal = $itotal/1.18;
								$igv = $itotal-$osubtotal;
								$tickete = Ticket::create(array(
										'descuento'  => $descuento,
										'idescuento' => number_format($newdescuento, 2),
										'importe'    => $itotal,
										'numero'     => $newnumero,
										'serie'      => $datoscaja->serie,
										'detcaja_id' => $detcajaid,
										'caja_id'    => $caja_id,
										'pedido_id'  => $idpedido,
										'vuelto'     => $vuelto,
										'IGV'        => number_format($igv, 2),
										'subtotal'   => number_format($osubtotal, 2),
										'ipagado'    => $ipagado,
										'cliente'    => $cliente['nombres'],
										'documento'  => $cliente['dni'],
										'direccion'  => $cliente['direccion'],
                                        'persona_id' => $cliente['id'],
										'mesa'       => $nombremesa,
										'mozo'       => $nombremozo,
										'cajero'     => Auth::user()->login,
										'mozoid'     => $idmozo,
										'cajeroid'   => Auth::user()->id,
										'contable'   => 2
									));
								Detpedidotick::whereIn('id', $arrayudateprecuenta)->update(array('ticket_id' => $tickete->id));
								$odetallestickete = $tickete->detallest;
								if ($tipovale == 1) {
									$promocion = Detformadpago::create(array('importe' => $ivale, 'ticket_id' => $tickete->id, 'formadepago_id' => 3));
								} else if ($tipovale == 2) {
									$promocion = Detformadpago::create(array('importe' => $ivale, 'ticket_id' => $tickete->id, 'formadepago_id' => 4));
								}
								$restaurante->save();
							} else {
								return json_encode('Ingrese un monto válido');
							}
						}
					} catch (Exception $e) {
						DB::rollback();
						return Response::json($e);
					}
					$cajero = Auth::user()->login;
					Event::fire('imprimirticket', compact('odetallestickete','restaurante','tickete',
					'cliente','nombremesa', 'nombremozo', 'cajero','impresora'));
					//DB::rollback();
					//return json_encode('false del rollBack');
					DB::commit();
					return json_encode('True');
				}
			});

		Route::post('cerrarmesa', function () {
				if (Request::ajax()) {
                    //isset corrección desde javascript
                    if(Pedido::find(Input::get('idpedido'))->estado == 'I'){


                    $idpedido = Input::get('idpedido');
                    $despachado = DetPedido::where('pedido_id', '=', $idpedido)->where('estado', '!=', 'D')
                        ->where('estado', '!=', 'A')->get();
                    $odetallepedidos = Detpedidotick::where('pedido_id', '=', $idpedido)
                        ->where('ticket_id', '=', NULL, 'AND')->get();
                    $contelementos = count($odetallepedidos);
                    if ($contelementos == 0) {
                        // == 20 por ningun rest
                        if (Auth::user()->id_restaurante == 2000) {
                            if (count($despachado) == 0) {
                                $opedido = Pedido::find($idpedido);
                                $newimporte = $opedido->tickets()->sum('importe');
                                $newdescuento = $opedido->tickets()->sum('idescuento');
                                $omesas = $opedido->mesas()->where('detmesa.estado', '=', 0)->get();
                                $arrayupdatemesas = array();
                                foreach ($omesas as $dato) {
                                    $arrayupdatemesas[] = $dato->id;
                                }
                                //pedido terminado
                                DetMesa::whereIn('mesa_id', $arrayupdatemesas)->where('pedido_id', '=', $idpedido, 'AND')->where('estado', '=', 0, 'AND')->update(array('estado' => 1));
                                //mesas libres
                                Mesa::whereIn('id', $arrayupdatemesas)->update(array('estado' => 'L'));
                                $opedido->estado = "T";
                                $opedido->importeFinal = $newimporte;
                                $opedido->descuento = $newdescuento;
                                $opedido->save();
                                return json_encode('true');
                            } else {
                                return json_encode('No puedes cerrar la mesa, tienes pedidos por entregar');
                            }
                        } else {
                            $opedido = Pedido::find($idpedido);
                            $newimporte = $opedido->tickets()->sum('importe');
                            $newdescuento = $opedido->tickets()->sum('idescuento');
                            $omesas = $opedido->mesas()->where('detmesa.estado', '=', 0)->get();
                            $arrayupdatemesas = array();
                            foreach ($omesas as $dato) {
                                $arrayupdatemesas[] = $dato->id;
                            }

                            DetMesa::whereIn('mesa_id', $arrayupdatemesas)->where('pedido_id', '=', $idpedido, 'AND')->where('estado', '=', 0, 'AND')->update(array('estado' => 1));
                            Mesa::whereIn('id', $arrayupdatemesas)->update(array('estado' => 'L'));
                            $opedido->estado = "T";
                            $opedido->importeFinal = $newimporte;
                            $opedido->descuento = $newdescuento;
                            $opedido->save();
                            return json_encode('true');
                        }
                    } else {
                        return json_encode('No puedes cerrar la mesa, tienes pedidos por cobrar.');
                    }
                }else{
                        return json_encode('La Mesa ya ha sido cerrada. Por favor actualiza el navegador.');
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
						$arraydatos[] = array('nombres' => $dato->razonSocial, 'direccion' => $dato->direccion, 'dni' => $dato->ruc, 'id' => $dato->id);
					} else {
						$arraydatos[] = array('nombres' => $dato->nombres.' '.$dato->apPaterno.' '.$dato->apMaterno, 'direccion' => $dato->direccion, 'dni' => $dato->dni, 'id' => $dato->id);
					}
				}
				return Response::json($arraydatos);
			});

		Route::post('registrarcliente', function () {
				$datos = Input::get('datos');
				$rtipo = Input::get('rtipo');
				$responsedatos = array();
				//print_r(Input::all()); die();

				if ($rtipo == 1) {
					$newpersona = Persona::create(array('nombres' => $datos['nombres'], 'apPaterno' => $datos['apPaterno'], 'apMaterno' => $datos['apMaterno'], 'dni' => $datos['dni'], 'direccion' => $datos['direccion'], 'perfil_id' => Perfil::where('nombre','=',$datos['cliente'])->first()->id));
					$responsedatos[] = array('nombres'            => $newpersona->nombres.' '.$newpersona->apPaterno,
											 'dni'            => $newpersona->dni,
											  'direccion'            => $newpersona->direccion,
											   'id'            => $newpersona->id);
				} elseif ($rtipo == 2) {
					$newpersona = Persona::create(array('razonSocial' => $datos['nombres'], 'ruc' => $datos['ruc'], 'direccion' => $datos['direccion'], 'perfil_id' => Perfil::where('nombre','=',$datos['cliente'])->first()->id));
					$responsedatos[] = array('nombres'                => $newpersona->razonSocial,
											 'dni'                => $newpersona->ruc,
											  'direccion'                => $newpersona->direccion,
											   'id'                => $newpersona->id);
				}
				return Response::json($responsedatos);
			});

		Route::get('listadegastos', function () {
				if (Request::ajax()) { //modify para q muestre tipo de gasto
					//$detcaja = Detcaja::where('estado', '=', 'A')->where('usuario_id', '=', Auth::user()->id, 'AND')->first();
                    $listadegastos = Detcaja::join('registrogastoscaja','registrogastoscaja.detallecaja_id','=','detallecaja.id')
                                        ->join('tipodegasto','tipodegasto.id','=','registrogastoscaja.tipogasto_id')
                                        ->where('detallecaja.estado', '=', 'A')->where('usuario_id', '=', Auth::user()->id, 'AND')
                                        ->select('registrogastoscaja.id as id','registrogastoscaja.descripcion as descripcion','registrogastoscaja.importetotal as importetotal','tipodegasto.descripcion as tipo_descripcion','registrogastoscaja.estado as tipo_estado')
                                        ->get();
					//$listadegastos = $detcaja->gastos()->get();
                    //print_r($listadegastos->toJson()); die();
					return Response::json($listadegastos);
				}
			});
        Route::post('changestate', function () {
            if (Request::ajax()) {
                $oGasto = Regitrodegastos::find(Input::get('id'));
                $estado = $oGasto->estado;
                if($estado == 1){
                    $oGasto->estado = 0;
                    $oGasto->save();
                    return Response::json(true);
                }elseif($estado == 0){
                    $oGasto->estado = 1;
                    $oGasto->save();
                    return Response::json(true);
                }
                return Respone::json(false);

            }
        });

		Route::get('getproductos', function () {
				if (Request::ajax()) {
					$familia_id = Input::get('familia_id');
					$familia = Familia::find($familia_id);
					$oproductos = $familia->productos;
					return Response::json($oproductos);
				}
			});

		Route::get('getcombinaciones', function () {
				if (Request::ajax()) {
					$tipocombinacion_id = Input::get('tcombi_id');
					$tipocombinacion = TipoComb::find($tipocombinacion_id);
					$ocombinaciones = $tipocombinacion->combinaciones;
					return Response::json($ocombinaciones);
				}
			});

		Route::post('postcancelarorden', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try{
					$codigo = Input::get('codigo');
					$iddetallepedido = Input::get('iddetalle');
					$usuario = Codigousuario::where('codigo', '=', $codigo)->first();
					$idusuarioauto = Input::get('usuarioautoriza');
					$motivo = Input::get('motivo');
					$flaganulacion = 0;
					$flagadicional = 0;
					//print_r($usuario);
					if (count($usuario) > 0) {
						$detpedido = DetPedido::find($iddetallepedido);
						$pedido = Pedido::find($detpedido->pedido_id);
						$detalles = $pedido->productos()->get();
						if (isset($detpedido->combinacion_id)) {
							$oprecuenta = Detpedidotick::where('combinacion_id', '=', $detpedido->combinacion_id)
								->where('pedido_id', '=', $detpedido->pedido_id, 'AND')
								->whereNull('ticket_id')
							->first();
						} else {
							$oprecuenta = Detpedidotick::where('producto_id', '=', $detpedido->producto_id)
							->where('pedido_id', '=', $detpedido->pedido_id, 'AND')
							->whereNull('ticket_id')
								->first();
						}
						if (isset($oprecuenta)) {
							if ($oprecuenta->cantidad > 1) {
								$newcantidad = $oprecuenta->cantidad-$detpedido->cantidad;
								//print_r($newcantidad);
								//die();
								if ($newcantidad < 0) {
									DB::rollBack();
									//para cuando mando 5 y pago 3. quiero eliminar los 5..
									return Response::json(array('status' => false, 'msg' => 'Algunos productos ya han sido pagados. Revise PRECUENTA'));
									//Response::json(data, status, headers, options)
								}
								if ($newcantidad == 0) {
									$oprecuenta->delete();
									$flaganulacion = 1;
									
								}else{

								$newprecio = $oprecuenta->preciou*$newcantidad;
								$oprecuenta->cantidad = $newcantidad;
								$oprecuenta->precio = $newprecio;
								$oprecuenta->save();
								$flaganulacion = 1;

								}

							} else {
								$newcantidad = $oprecuenta->cantidad-$detpedido->cantidad; 
								//para cuando mando 2 y pagó 1. si no ponía esto, se eliminaba 2 en detped y 1 en detticket
									if ($newcantidad < 0) {
										DB::rollBack();
										return Response::json(array('status' => false, 'msg' =>'Algunos productos adic ya han sido pagados. Revise PRECUENTA'));
										}
								$oprecuenta->delete();
								$flaganulacion = 1;
							}

							//eliminar prod adicionales
							$oprecuenta = null;
							$prodAdic = DetPedido::where('detalle_id','=',$detpedido->id)
                                                    ->whereNull('detalleanulacion_id')
							                        ->get();
							//print_r(count($prodAdic)); die();
							if (count($prodAdic)>0) {
								foreach ($prodAdic as $proAdc) {
									$oprecuenta = Detpedidotick::where('producto_id','=',$proAdc->producto_id)
											->where('pedido_id','=',$proAdc->pedido_id,'AND')
											->whereNull('ticket_id')
											->first();

											if (isset($oprecuenta)) {
												//print_r('entro'); die();
												if ($oprecuenta->cantidad > 1) {
													$newcantidad = $oprecuenta->cantidad-$proAdc->cantidad;
													//print_r($newcantidad); die();
													if ($newcantidad < 0) {
														DB::rollBack();
														//para cuando mando 5 y pagó 3. quiero eliminar los 5..
														return Response::json(array('status' => false, 'msg' =>'Algunos productos adic ya han sido pagados. Revise PRECUENTA'));
													}

													if ($newcantidad == 0) {
														$oprecuenta->delete();
														$flagadicional = 1;
														
													}else{

													$newprecio = $oprecuenta->preciou*$newcantidad;
													$oprecuenta->cantidad = $newcantidad;
													$oprecuenta->precio = $newprecio;
													$oprecuenta->save();
													$flagadicional = 1;

													}

												} else {

													//if ($oprecuenta->cantidad = 1) { 
													//para cuando mando 2 y pagó 1. si no ponía esto, se eliminaba 2 en detped y 1 en detticket
														$newcantidad = $oprecuenta->cantidad-$proAdc->cantidad; 
														if ($newcantidad < 0) {
															DB::rollBack();
															return Response::json(array('status' => false, 'msg' =>'Algunos productos adic ya han sido pagados. Revise PRECUENTA'));
														}
													//}
													//print_r('entreelse'); die();
													$oprecuenta->delete();
													$flagadicional = 1;
												}	


												
											}

								$oprecuenta = null;

								}
								
							}//fin if (count($prodAdic)>0)... <-- no es código comentado.. 
							


						}//

						if ($flaganulacion == 1) {
							$odetanulacion = Detalleanulacion::create(array(
									'motivo' 	 => $motivo,
									'usuario_id' => $idusuarioauto));

							if (isset($detpedido->combinacion_id)) {
								$actulizando = DetPedido::where('combinacion_id', '=', $detpedido->combinacion_id)
									->where('combinacion_c', '=', $detpedido->combinacion_c)
									->where('pedido_id', '=', $detpedido->pedido_id)
									->update(array('estado' => 'A',
												 'detalleanulacion_id' => $odetanulacion->id,
												 	//add 19-03-15
													 'codigocancelacion' => $usuario->usuario_id));
													//fin add

								//print_r($actulizando); die();
								$detalles = DetPedido::where('combinacion_id', '=', $detpedido->combinacion_id)
											->where('combinacion_c', '=', $detpedido->combinacion_c)
											->where('pedido_id', '=', $detpedido->pedido_id)
											->get();
								$productos = array();
								foreach ($detalles as $detalle) {
									$productos[] = ['estado'=> $detalle->estado, 'iddetallep'=>$detalle->id, 
											'proid'=>$detalle->producto_id,'cantidad'=>$detalle->cantidad];
								}
								$tipo = 2;
								//print_r($productos); die();
							} else {
								$detpedido->estado = 'A';
								$detpedido->detalleanulacion_id = $odetanulacion->id;
								$detpedido->codigocancelacion = $usuario->usuario_id;
								$detpedido->save();
								$productos = ['estado'=> $detpedido->estado, 'iddetallep'=>$detpedido->id, 
											'proid'=>$detpedido->producto_id,'cantidad'=>$detpedido->cantidad];
								$tipo = 1;
							}
							//print_r($flagadicional); die();
							$productosAdc = null;
								if ($flagadicional == 1) {
										$actualizandoAdc = DetPedido::where('detalle_id','=',$detpedido->id)
                                                    ->whereNull('detalleanulacion_id')
							                        ->update(array('estado' => 'A',
							                        				'detalleanulacion_id' => $odetanulacion->id,
							                        				'codigocancelacion' => $usuario->usuario_id
							                        				));

										$detallesAdc = DetPedido::where('detalle_id','=',$detpedido->id)
													->where('detalleanulacion_id','=',$odetanulacion->id)
                                                    ->get();
										$productosAdc = array();
										foreach ($detallesAdc as $detalle) {
											$productosAdc[] = ['estado'=> $detalle->estado, 'iddetallep'=>$detalle->id, 
													'proid'=>$detalle->producto_id,'cantidad'=>$detalle->cantidad];
										}
										//$tipo = 2;
								}


						} else {
							//no hay nada para eliminar
							DB::rollBack();
							return Response::json(array('status' => false, 'msg' =>'No hay nada para eliminar. Por favor, actualice la página'));
						}
						//si no queda nada, se anula el pedido
						$odetalles = $pedido->productos()->where('detallepedido.estado', '!=', 'A')->get();
						//print_r(count($odetalles)); die();
						if (count($odetalles) == 0) {
							$pedido->estado = 'A';
							$pedido->fechaCancelacion = date('Y-m-d H:i:s');
							$pedido->save();
							//print_r($productosAdc); die();
							$datos = ['response'=> 'redirect', 'tipo'=>$tipo, 'items'=>$productos, 'itemsAdc' => $productosAdc];
							//print_r(json_encode($datos)); die(); 
							DB::commit();
							return Response::json($datos);
						} else {
							//print_r($productosAdc); die();
							$datos = ['response'=> 'true', 'tipo'=>$tipo, 'items'=>$productos, 'itemsAdc' => $productosAdc];
							//print_r(json_encode($datos)); die(); 
							DB::commit();
							return Response::json($datos);
						}
					} else {
						//si clave no coincide..
						DB::rollBack();
						return Response::json(array('status' => false, 'msg' =>'Contraseña no coincide.'));
					}

					}catch(Exception $e){
						DB::rollBack();
						return Response::json(array('status' => false, 'msg' =>'Error 01'));

					}
					//DB::commit();
				}
			});

		Route::post('copiaticket', function () {
				if (Request::ajax()) {
					$idticket = Input::get('idtick');
					$tickete = Ticket::find($idticket);
					$infocaja = $tickete->caja;
					$cliente = array('nombres' => $tickete->cliente, 'dni' => $tickete->dni, 'direccion' => $tickete->direction);
					$cajero = $tickete->cajero;
					$nombremesa = $tickete->mesa;
					$nombremozo = $tickete->mozo;
					$odetallestickete = $tickete->detallest;
					$restaurante = Restaurante::find(Auth::user()->id_restaurante);
					if ($tickete->contable == 1) {
						$impresora = $infocaja->impresora;
					} else if ($tickete->contable == 2) {
						$impresora = $restaurante->impresoranocontable;
					}
					/*Event::fire('imprimirticket', compact('odetallestickete', 'restaurante', 'tickete',
							'cliente', 'nombremesa', 'nombremozo', 'cajero', 'impresora'));*/
					return Response::json('true');
				}
			});

		Route::post('anularticket', function () {
				if (Request::ajax()) {
					$idticket = Input::get('idtick');
					$tickete = Ticket::find($idticket);
					if ($tickete->estado == 1 or $tickete->importe < 0) {
						return Response::json('false');
					}

					//print_r("paso");
					//die();
					$tickete->estado = 1;
					$infocaja = $tickete->caja;
					$newnumero = $infocaja->numero+1;
					$infocaja->numero = $newnumero;
					$newtickete = Ticket::create(array('descuento' => $tickete->descuento,
							'idescuento'                                 => $tickete->idescuento,
							'importe'                                    => -$tickete->importe,
							'numero'                                     => $newnumero,
							'serie'                                      => $tickete->serie,
							'detcaja_id'                                 => $tickete->detcaja_id,
							'caja_id'                                    => $tickete->caja_id,
							'pedido_id'                                  => $tickete->pedido_id,
							'vuelto'                                     => $tickete->vuelto,
							'IGV'                                        => -$tickete->IGV,
							'subtotal'                                   => -$tickete->subtotal,
							'ipagado'                                    => $tickete->ipagado));
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
			<strong></strong><br>
			<strong>'.$restaurante->razonSocial.'</strong><br>
			</div>
			<div class="subencabezado">
			<strong>RUC Nº '.$restaurante->ruc.'</strong><br>
			<strong>'.$restaurante->direccion.'&nbsp;
-&nbsp;
'.$restaurante->provincia.'
			&nbsp;
-&nbsp;
'.$restaurante->departamento.'</strong><br>
			<strong>Ticket:&nbsp;
'.sprintf('%07d', $newnumero).' &nbsp;
&nbsp;
Serie:&nbsp;
'.$tickete->serie.'</strong><br>
			<strong>Fecha:'.date('d-m-Y').'&nbsp;
&nbsp;
Hora:'.date('H:i:s').'</strong>
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
			<td style="width:110px; text-align: right">&nbsp;
</td>
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
					//$response = shell_exec($cmd);
					//File::delete($pdfPath);
					$tickete->save();
					$infocaja->save();
					return Response::json('true');
				}
			});

		Route::post('reportediariocaja', function () {
				if (Request::ajax()) {
					$idrest = Input::get('idrest');
					$fechaInicio = Input::get('fechainicio');
					$fechaFin = Input::get('fechafin');
					$restaurante = Restaurante::find($idrest);
					$cajas = $restaurante->cajas;
					//print_r(count($cajas));
					//die();
					$arraydatos = array();
					$contador = 0;
					foreach ($cajas as $cdato) {
						$cajones = $cdato->detallecaja()
						->whereBetween('FechaInicio', array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
							->orderby('FechaInicio')
						->get();
						foreach ($cajones as $cajon) {
							$usuario = Usuario::find($cajon->usuario_id);
							$totaltickets = $cajon->tickets()->count();
							$totalanulados = $cajon->tickets()->where('ticketventa.estado', '=', 1)->count();
							$totaldescuentos = $cajon->tickets()->where('ticketventa.estado', '=', 0)
								->where('ticketventa.importe', '>=', 0)->sum('idescuento');
							// no cuenta anulados ni tickets en monto negativo
							$totalventas1 = $cajon->tickets()->where('ticketventa.estado', '=', 0)
								->where('ticketventa.importe', '>=', 0)->sum('importe');
							$tickets = $cajon->tickets()->where('ticketventa.estado', '=', 0)
								->where('ticketventa.importe', '>=', 0)->get();
							$ticketinicial = $cajon->tickets()->orderby('id', 'asc')->first();
							$ticketfinal = $cajon->tickets()->orderby('id', 'desc')->first();
							$efectivo = 0;
							$tarjeta = 0;
							$vale = 0;
							$dsctoAut = 0;
							$imProm = 0;
							$totalproductosvendidos = 0;
							foreach ($tickets as $tickete) {
								$totalproductosvendidos = $totalproductosvendidos+$tickete->detallest()->sum('cantidad');
							}

							foreach ($tickets as $tickete) {
								$oefect = $tickete->tipopago()
								->where('formadepago_id', '=', 1)
									->sum('importe');
								if ($oefect > $tickete->importe) {
									$oefect = $tickete->importe;
								}
								$newefec = $efectivo+$oefect;
								$efectivo = round($newefec, 2);
							}

							foreach ($tickets as $tickete) {
								$oefect = $tickete->tipopago()->where('formadepago_id', '=', 2)->sum('importe');
								if ($oefect > $tickete->importe) {
									$oefect = $tickete->importe;
								}
								$newefec = $tarjeta+$oefect;
								$tarjeta = round($newefec, 2);
							}

							foreach ($tickets as $tickete) {
								$oefect = $tickete->tipopago()->where('formadepago_id', '=', 3)->sum('importe');
								$newefec = $dsctoAut+$oefect;
								$dsctoAut = round($newefec, 2);
							}

							foreach ($tickets as $tickete) {
								$oefect = $tickete->tipopago()->where('formadepago_id','=',4)->sum('importe');
								$newefec = $vale+$oefect;
								$vale = round($newefec, 2);
							}

							foreach ($tickets as $tickete) {
								//$oefect = $tickete->tipopago()->where('formadepago_id','=',5)->sum('idescuento');
								$oefect = $tickete->tipopago()->join('ticketventa','ticketventa.id','=','Detformadepago.ticket_id')
												->where('Detformadepago.formadepago_id','=',5)->sum('idescuento');
								$newefec = $imProm+$oefect;
								$imProm = round($newefec, 2);
							}

							//print_r($imProm); die();

							if ($totaltickets > 0) {
								$arraydatos[] = array('usuario' => $usuario->login,
									'totaltickets'                 => $totaltickets,
									'totalanulados'                => $totalanulados,
									'totalefectivo'                => number_format($efectivo, 2, '.', ''),
									'totaltarjeta'                 => number_format($tarjeta, 2, '.', ''),
									'totaldsctoAut'                    => number_format($dsctoAut, 2, '.', ''),
									'totalvale'						=> number_format($vale, 2, '.',''),
									'totalImProm'					=> number_format($imProm,2,'.',''),
									'totaldescuentos'              => $totaldescuentos,
									'fondodecaja'                  => $cajon->montoInicial,
									'totalventas'                  => $totalventas1,
									'turno'                        => substr($cajon->fechaInicio, -8, -3).'/'.
									substr($cajon->fechaCierre, -8, -3),
									'arqueo'       => $cajon->arqueo,
									'tproductos'   => $totalproductosvendidos,
									'tinicial'     => $ticketinicial->numero,
									'tfinal'       => $ticketfinal->numero,
									'id'           => $contador,
									'ingresoscaja' => $cajon->totalingresosacaja,
									'dif'          => $cajon->diferencia,
									'gastos'       => $cajon->gastos,
									'caja'         => $cajon->importetotal,
									'cajaid'       => $cajon->id);
							} else {
								$arraydatos[] = array('usuario' => $usuario->login,
									'totaltickets'                 => $totaltickets,
									'totalanulados'                => $totalanulados,
									'totalefectivo'                => number_format($efectivo, 2, '.', ''),
									'totaltarjeta'                 => number_format($tarjeta, 2, '.', ''),
									'totaldsctoAut'                    => number_format($dsctoAut, 2, '.', ''),
									'totalvale'						=> number_format($vale, 2, '.',''),
									'totalImProm'					=> number_format($imProm,2,'.',''),
									'totaldescuentos'              => 0.00,
									'fondodecaja'                  => $cajon->montoInicial,
									'totalventas'                  => $cajon->ventastotales,
									'turno'                        => substr($cajon->fechaInicio, -8).'/'.
									substr($cajon->fechaCierre, -8),
									'arqueo'       => $cajon->arqueo,
									'tproductos'   => $totalproductosvendidos,
									'tinicial'     => 0,
									'tfinal'       => 0,
									'id'           => $contador,
									'ingresoscaja' => $cajon->totalingresosacaja,
									'dif'          => $cajon->diferencia,
									'gastos'       => $cajon->gastos,
									'caja'         => $cajon->importetotal,
									'cajaid'       => $cajon->id);
							}

							$contador++;
						}
					}
					return Response::json($arraydatos);
				}
			});

		Route::post('crearnotapro', function () {
				if (Request::ajax()) {
					$idpro = Input::get('idpro');
					$producto = Producto::find($idpro);
					$productos = $producto->familia->productos;
					$notades = Input::get('nota');
					$nota = Notas::create(array('descripcion' => $notades));
					$insertanotas = array();
					foreach ($productos as $datos) {
						$insertanotas[] = array('nota_id' => $nota->id, 'producto_id' => $datos->id);
					}
					$numero = Notasxproductos::insert($insertanotas);
					return Response::json($nota);
				}
			});

		Route::post('movermesa', function () {
				if (Request::ajax()) {
					$idmesaupdate = Input::get('idmesaupdate'); //mesa actual
					$idmesa = Input::get('idmesa'); //id de mesa donde se moverá
					$idpedido = Input::get('idpedido');
					$mesa = Mesa::find($idmesa); // mesa donde se moverá

					if ($mesa->estado == 'L') {
						$updatemesa = DetMesa::where('pedido_id', '=', $idpedido)
						->where('mesa_id', '=', $idmesaupdate, 'AND') //falta verificar si pedido ya está cerrado
							->update(array('mesa_id' => $idmesa)); //si no coincide su mesa actual y su pedido, no cambiará de mesa
						if (count($updatemesa) > 0) {
							return Response::json('true');
						} else {
							return Response::json('false');
						}
					} else {
						return Response::json('false');
					}
				}
			});

            Route::post('juntarmesa', function () {
                if (Request::ajax()) {
                    $idmesaupdate = Input::get('idmesaupdate'); //mesa actual
                    $idmesa = Input::get('idmesa'); //id de mesa donde se juntará
                    $idpedido = Input::get('idpedido');
                    $mesa = Mesa::find($idmesa); // mesa donde se juntará

                    //verificar si es la misma mesa y que si ya está juntada
                    $mesasCoin = DetMesa::where('mesa_id','=',$idmesa)->where('pedido_id','=',$idpedido)->get();
                    //print_r($idmesaupdate.' '.$idmesa); die();

                    if($idmesa != $idmesaupdate){

                        if(count($mesasCoin) > 0){
                            return Response::json(array('status'=>false,'msg' => 'Mesa ya juntada'));

                        }else{
                            if ($mesa->estado == 'L') {

                                $detMesa = DetMesa::create(array('mesa_id' => $idmesa, 'pedido_id' => $idpedido));
                                if (count($detMesa) > 0) {
                                    return Response::json(array('status'=>true,'msg' => 'Unido con mesa: '.$mesa->salon->nombre.' '.$mesa->nombre));
                                } else {
                                    return Response::json(array('status'=>false,'msg' => 'No se logró juntar las mesas'));
                                }
                            } elseif($mesa->estado == 'O') {
                                return Response::json(array('status'=>false,'msg' => 'Mesa Ocupada'));
                            }
                        }
                    }else{
                        return Response::json(array('status'=>false,'msg' => 'Mesa no puede ser la misma'));
                    }
                }
            });



		Route::post('imprimirdiariocaja', function () {
				if (Request::ajax()) {
					$arraydatos = array('totalefectivo' => Input::get('totalefectivo'),
						'totaltarjeta'                     => Input::get('totaltarjeta'),
                        'totalimprom'                       => Input::get('totalimprom'),
						'totalvale'                        => Input::get('totalvale'),
                        'totaldsctoaut'                     => Input::get('totaldsctoaut'),
                        'totaldscto'                        => Input::get('totaldscto'),
						'totalventas'                      => Input::get('totalventas'),
						'totalgastos'                      => Input::get('totalgastos'),
						'totalabonosacaja'                 => Input::get('totalabonosacaja'),
						'totalcaja'                        => Input::get('totalcaja'),
						'arqueo'                           => Input::get('arqueo'),
						'diferencia'                       => Input::get('diferencia'),
						'anulados'                         => Input::get('anulados'),
						'emitidos'                         => Input::get('emitidos'),
						'pvendidos'                        => Input::get('pvendidos'),
						'fecha'                            => Input::get('fecha'),
						'rango'                            => Input::get('rango'));
					Event::fire('imprimirreportediariocaja', compact('arraydatos'));
					return Response::json('true');
				}
			});

		Route::get('controlpedidos', function () {
				if (Request::ajax()) {
					$usuarios = Usuario::where('id_restaurante', '=', Auth::user()->id_restaurante)->lists('id');
					$platoscontrol = DetPedido::select('usuario.login', 'mesa.nombre as mesa', 'detallepedido.id',
						'detallepedido.estado', 'producto.nombre', 'detallepedido.cantidad',
						'detallepedido.fechaInicio', 'detallepedido.fechaProceso',
						'detallepedido.fechaDespacho', 'detallepedido.fechaDespachado')
						->join('producto', 'producto.id', '=', 'detallepedido.producto_id')
					->join('pedido', 'pedido.id', '=', 'detallepedido.pedido_id')
						->join('detmesa', 'detmesa.pedido_id', '=', 'pedido.id')
					->join('mesa', 'detmesa.mesa_id', '=', 'mesa.id')
						->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
					->where('pedido.estado', '!=', 'T')
						->where('detallepedido.estado', '!=', 'D')
					->where('detallepedido.estado', '!=', 'A')
						->wherein('pedido.usuario_id', $usuarios)
						//no prod adicionales de otro
					->whereNull('detallepedido.detalle_id')
						->get();

					return Response::json($platoscontrol);
				}
			});

		Route::post('pedidomesa', function () {
				if (Request::ajax()) {
					$idpedido = Input::get('idpedido');
					$mesaid = DetMesa::select('mesa_id')->where('pedido_id', '=', $idpedido)->first();
					return Response::json($mesaid);
				}
			});
		/*finrutas IVAN*/

		/*RUTAS JAVIER*/
		Route::controller('/salones', 'SalonesController');
		Route::controller('/mesas', 'MesasController');
		Route::controller('/familias', 'FamiliasController');
		Route::controller('/restaurantes', 'RestaurantesController');
		/*FIN RUTAS JAVIER*/
		Route::post('reportetiempos', function () {
				if (Request::ajax()) {
					$fechaInicio = Input::get('fechainicio');
					$fechaFin = Input::get('fechafin');
					$restauranteid = Input::get('idrestaurante');
					$detalletiempos = DetPedido::selectraw("
    			producto.nombre,producto_id, SUM(detallepedido.cantidad) AS cantidad,
				TIME_FORMAT(SEC_TO_TIME((avg(TIMESTAMPDIFF(MINUTE , fechaInicio, fechaDespachado )))*60), '%H:%i') AS tiempototalpromedio,
				TIME_FORMAT(SEC_TO_TIME((min(TIMESTAMPDIFF(MINUTE , fechaInicio, fechaProceso )))*60), '%H:%i') AS tiempoesperaminimo,
				TIME_FORMAT(SEC_TO_TIME((avg(TIMESTAMPDIFF(MINUTE , fechaInicio, fechaProceso )))*60), '%H:%i') AS tiempoesperapromedio,
				TIME_FORMAT(SEC_TO_TIME((avg(TIMESTAMPDIFF(MINUTE , fechaInicio, fechaProceso )))*60), '%H:%i') AS tiempoesperamaximo,
				TIME_FORMAT(SEC_TO_TIME((min(TIMESTAMPDIFF(MINUTE , fechaProceso,fechaDespacho )))*60), '%H:%i') AS tiempococinaminimo,
				TIME_FORMAT(SEC_TO_TIME((avg(TIMESTAMPDIFF(MINUTE , fechaProceso,fechaDespacho )))*60), '%H:%i') AS tiempococinapromedio,
				TIME_FORMAT(SEC_TO_TIME((max(TIMESTAMPDIFF(MINUTE , fechaProceso,fechaDespacho )))*60), '%H:%i') AS tiempococinamaximo,
				TIME_FORMAT(SEC_TO_TIME((min(TIMESTAMPDIFF(MINUTE , fechaDespacho, fechaDespachado)))*60), '%H:%i') AS tiempomozominimo,
				TIME_FORMAT(SEC_TO_TIME((avg(TIMESTAMPDIFF(MINUTE , fechaDespacho, fechaDespachado)))*60), '%H:%i') AS tiempomozopromedio,
				TIME_FORMAT(SEC_TO_TIME((max(TIMESTAMPDIFF(MINUTE , fechaDespacho, fechaDespachado)))*60), '%H:%i') AS tiempomozomaximo
    			")
						->join('producto', 'producto.id', '=', 'detallepedido.producto_id')
					->join('areadeproduccion', 'areadeproduccion.id', '=', 'detallepedido.idarea')
						->join('restaurante', 'restaurante.id', '=', 'areadeproduccion.id_restaurante')
					->whereBetween('fechaInicio', array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
						->where('restaurante.id', '=', $restauranteid)
					->groupby('producto_id')
						->get();

					return Response::json($detalletiempos);
				}
			});

		Route::post('tiemposproductos', function () {
				if (Request::ajax()) {
					$fechaInicio = Input::get('fechainicio');
					$fechaFin = Input::get('fechafin');
					$restauranteid = Input::get('idrestaurante');
					$productoid = Input::get('idpro');
					$detalletiempos = DetPedido::selectraw("producto.nombre,producto_id, detallepedido.cantidad,
				TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaInicio, fechaProceso ))*60), '%H:%i')
				AS tiempoesperaminimo, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaProceso,fechaDespacho ))*60), '%H:%i')
				AS tiempococinaminimo, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaDespacho, fechaDespachado))*60), '%H:%i')
				AS tiempomozominimo, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaInicio, fechaDespachado ))*60), '%H:%i')
				AS tiempototaliminimo, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaInicio, fechaProceso ))*60), '%H:%i')
				AS tiempoesperapromedio, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaProceso,fechaDespacho ))*60), '%H:%i')
				AS tiempococinapromedio, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaDespacho, fechaDespachado))*60), '%H:%i')
				AS tiempomozopromedio, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaInicio, fechaDespachado ))*60), '%H:%i')
				AS tiempototalpromedio, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaInicio, fechaProceso ))*60), '%H:%i')
				AS tiempoesperamaximo, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaProceso,fechaDespacho ))*60), '%H:%i')
				AS tiempococinamaximo, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaDespacho, fechaDespachado))*60), '%H:%i')
				AS tiempomozomaximo, TIME_FORMAT(SEC_TO_TIME((TIMESTAMPDIFF(MINUTE , fechaInicio, fechaDespachado ))*60), '%H:%i')
				AS tiempototalmaximo")
						->join('producto', 'producto.id', '=', 'detallepedido.producto_id')
					->join('areadeproduccion', 'areadeproduccion.id', '=', 'detallepedido.idarea')
						->join('restaurante', 'restaurante.id', '=', 'areadeproduccion.id_restaurante')
					->whereBetween('fechaInicio', array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
						->where('restaurante.id', '=', $restauranteid)
					->where('producto_id', '=', $productoid)
						->get();
					return Response::json($detalletiempos);
				}
			});

		//rutas 10/06/2014
		function invenDescSort($item1, $item2) {
			if ($item1['mfactu'] == $item2['mfactu']) {return 0;
			}

			return ($item1['mfactu'] < $item2['mfactu'])?1:-1;
		}

		Route::post('reporteventasmozos', function () {
				if (Request::ajax()) {
					$restauranteid = Input::get('idrestaurante');
					$fechaInicio = Input::get('fechainicio');
					$fechaFin = Input::get('fechafin');

					/*$mozos = Usuario::where('id_restaurante', '=', $restauranteid)
						->where('usuario.colaborador', '=', 2)->get();
						*/

						/*que sucede si cambio los perfiles de un usuario mozo a admin
						no figuraria aqui y el reporte estaría erroneo
						tendria q ver todos los usuarios mozos q figuran en los tickets
						almacenarlos en la variable $mozos.!!
						*/
				/*$mozos = Usuario::whereHas('persona',function($q){
					$q->where('perfil_id','=',2);
				})->get();*/

				$mozos = Ticket::selectraw('DISTINCT(mozoid)')
								->whereBetween('ticketventa.created_at',
							array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
								->get();
								//print_r($mozos->toJson());
								//die();
						

					/*$mozos = Usuario::where('usuario.colaborador','=',2)->get();*/
					//print_r(count($mozos)); die();
					$caja = Caja::where('restaurante_id','=',$restauranteid)->first();

					//print_r($caja->id);
					//die();	

					$arraydatos = array();
					foreach ($mozos as $mozo) {

						$ventas = Ticket::selectraw('SUM(ticketventa.importe) AS importe, avg(importe) AS promedioventas,
						usuario.login,COUNT(DISTINCT ticketventa.id) AS totaltickets')
							->join('pedido', 'pedido.id', '=', 'ticketventa.pedido_id')
						->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
							->whereBetween('ticketventa.created_at',
							array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
						->where('usuario.id', '=', $mozo->mozoid)
						->where('ticketventa.estado', '=', 0)
							->where('ticketventa.importe', '>=', 0)
						->first();
						
						//print_r($ventas); die();

						$productos = DB::select( DB::raw("SELECT userID AS id, sum(dettiketpedCant) AS totalproductos, COUNT(DISTINCT pedId) AS totalpedidos
						FROM (
						SELECT DISTINCT dettiketpedido.id AS dettiketpID, usuario.id userID, dettiketpedido.cantidad AS dettiketpedCant, pedido.id AS pedId
						FROM dettiketpedido 
						INNER JOIN pedido ON pedido.id = dettiketpedido.pedido_id 
						INNER JOIN ticketventa ON ticketventa.pedido_id = pedido.id 
						INNER JOIN usuario ON usuario.id = pedido.usuario_id
						WHERE dettiketpedido.created_at BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'
						AND usuario.id = '".$mozo->mozoid."' 
						AND ticketventa.estado = '0'
						AND ticketventa.importe >= '0'
						AND ticketventa.caja_id = '".$caja->id."'
						) AS foo") );

						$productos = $productos[0];


						//print_r($productos->totalproductos);
						//die();


						/*$productos = Detpedidotick::selectraw('usuario.id, sum(dettiketpedido.cantidad) AS totalproductos,
							COUNT(DISTINCT pedido.id) AS totalpedidos')
							->join('pedido', 'pedido.id', '=', 'dettiketpedido.pedido_id')
						->join('ticketventa', 'ticketventa.pedido_id', '=', 'pedido.id')
							->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
						->whereBetween('dettiketpedido.created_at', array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
							->where('usuario.id', '=', $mozo->id)
							->where('ticketventa.estado', '=', 0)
							//add
							->where('ticketventa.importe','>=',0)
							//fin add
						->first();*/

						$tiempos = DetPedido::selectraw("usuario.id,
							SEC_TO_TIME((avg(TIMESTAMPDIFF(SECOND , fechaDespacho, fechaDespachado))))
							AS tiempomozopromedio,SEC_TO_TIME((min(TIMESTAMPDIFF(SECOND , fechaDespacho, fechaDespachado))))
							AS tiempomozominimo, SEC_TO_TIME((max(TIMESTAMPDIFF(SECOND , fechaDespacho, fechaDespachado))))
							AS tiempomozomaximo")
							->join('pedido', 'pedido.id', '=', 'detallepedido.pedido_id')
						->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
							->whereBetween('detallepedido.fechaInicio', array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
						->where('usuario.id', '=', $mozo->mozoid)
						->first();
						
						$ticketsanulados = Ticket::selectraw('COUNT(ticketventa.id) AS totaltanulados')
							->join('pedido', 'pedido.id', '=', 'ticketventa.pedido_id')
						->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
							->whereBetween('ticketventa.created_at',
							array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
						->where('usuario.id', '=', $mozo->mozoid)
						->where('ticketventa.estado', '=', 1)
                        ->first();

						$pedidosanulados = Pedido::selectraw('COUNT(pedido.id) AS pedidosanulados')
							->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
						->whereBetween('pedido.fechaInicio',
							array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
							->where('usuario.id', '=', $mozo->mozoid)
							->where('pedido.estado', '=', 'A')
						->first();

						$combinacionesanuladas = DB::select(DB::raw("SELECT SUM(x.combinacion_cant) AS combinacionesanuladas FROM 
(
SELECT DISTINCT detallepedido.combinacion_id, detallepedido.combinacion_c, detallepedido.combinacion_cant  FROM `detallepedido` 
INNER JOIN `pedido` ON `pedido`.`id` = `detallepedido`.`pedido_id` 
INNER JOIN `usuario` ON `usuario`.`id` = `pedido`.`usuario_id` 
WHERE `detallepedido`.`fechaInicio` BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59' 
AND `usuario`.`id` = '".$mozo->mozoid."' 
AND `detallepedido`.`estado` = 'A'
AND detallepedido.combinacion_id IS NOT NULL
) AS x"


							));

						//print_r($combinacionesanuladas[0]->combinacionesanuladas);
						//die();

						$productosanulados = DetPedido::selectraw('SUM(detallepedido.cantidad) AS productosanulados')
							->join('pedido', 'pedido.id', '=', 'detallepedido.pedido_id')
						->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
							->whereBetween('detallepedido.fechaInicio', array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
						->where('usuario.id', '=', $mozo->mozoid)
						->where('detallepedido.estado', '=', 'A')
						->whereNull('detallepedido.combinacion_id')
							->first();

						if ($productos->totalproductos > 0) {
							$arraydatos[] = array(
								'mozoid'   => $productos->id,
								'mozo'     => $ventas->login,
								'mfactu'   => $ventas->importe,
								'promt'    => number_format($ventas->promedioventas, 2, '.', ''),
								'peds'     => $productos->totalpedidos,
								'pedsa'    => $pedidosanulados->pedidosanulados,
								'cprods'   => $productos->totalproductos,
								'panul'    => number_format($productosanulados->productosanulados+$combinacionesanuladas[0]->combinacionesanuladas, 0, '.', ''),
								'ctickets' => $ventas->totaltickets,
								'tanul'    => number_format($ticketsanulados->totaltanulados, 0, '.', ''),
								'tprom'    => $tiempos->tiempomozopromedio,
								'tmin'     => $tiempos->tiempomozominimo,
								'tmax'     => $tiempos->tiempomozomaximo,
								'fechai'   => $fechaInicio,
								'fechafin' => $fechaFin,
								'idrest'   => $restauranteid,
								'selector' => 1
							);
						}
					}

					$eventos = Ticket::join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('caja', 'caja.id', '=', 'ticketventa.caja_id')
					->where('ticketventa.estado', '=', 0)
						->where('caja.restaurante_id', '=', $restauranteid)
					->whereBetween('ticketventa.created_at',
						array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
						->wherenull('dettiketpedido.combinacion_id')
					->wherenull('dettiketpedido.producto_id')
						->sum('ticketventa.importe');

					$eventoscount = Ticket::join('dettiketpedido', 'dettiketpedido.ticket_id', '=', 'ticketventa.id')
						->join('caja', 'caja.id', '=', 'ticketventa.caja_id')
					->where('ticketventa.estado', '=', 0)
						->where('caja.restaurante_id', '=', $restauranteid)
					->whereBetween('ticketventa.created_at',
						array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
						->wherenull('dettiketpedido.combinacion_id')
					->wherenull('dettiketpedido.producto_id')
						->count('ticketventa.importe');

					if ($eventoscount > 0) {
						$arraydatos[] = array(
							'mozoid'   => '-',
							'mozo'     => 'Eventos',
							'mfactu'   => $eventos,
							'promt'    => '-',
							'peds'     => '-',
							'pedsa'    => '-',
							'cprods'   => '-',
							'panul'    => '-',
							'ctickets' => $eventoscount,
							'tanul'    => '-',
							'tprom'    => '-',
							'tmin'     => '-',
							'tmax'     => '-',
							'fechai'   => '-',
							'fechafin' => '-',
							'idrest'   => '-',
							'selector' => 0,
						);
					}
					usort($arraydatos, 'invenDescSort');
					return Response::json($arraydatos);
				}
			});

		Route::post('codigoqrmesas', function () {
				if (Request::ajax()) {
					$tipo = Input::get('tipo');
					if ($tipo == 1) {
						$codigo = crypt(uniqid(rand(), 1));
						$codigo = strip_tags(stripslashes($codigo));
						$codigo = str_replace(".", "", $codigo);
						$codigo = strrev(str_replace("/", "", $codigo));
						$codigo = substr($codigo, 0, 4);
						$qrcode = DNS2D::getBarcodeHtml("http://192.168.1.247/dev/clientes/".$codigo, "QRCODE", 7, 7, "black");
						$qrcodepath = DNS2D::getBarcodePngPath("http://192.168.1.247/dev/clientes/".$codigo, "QRCODE", 7, 7, array(0, 0, 0));
						$nombrepng = substr($qrcodepath, 2);
						File::move(public_path().'/'.$nombrepng, public_path()."/imagesqr/".$nombrepng);
						$datos = array('codigo' => $codigo, 'imagen' => $qrcode, 'urlnombre' => $nombrepng);
						return Response::json($datos);
					} else {
						return Response::json('false');
					}
				}
			});

		Route::post('reporteventassemanales', function () {
				if (Request::ajax()) {
					$idrest = Input::get('idrest');
					$year = Input::get('year');
					$semana = Input::get('semana');
					$tipocom = 1;
					$productos = DB::select(DB::raw("select * from vistatiposcombinacion3 where
						idrest = ".$idrest." and semana = ".$semana." and ayear = ".$year."
						order by total desc"));
					return Response::json($productos);
				}
			});

		Route::post('reporteventassemanasfamilias', function () {
				if (Request::ajax()) {
					$idrest = Input::get('idrest');
					$year = Input::get('year');
					$semana = Input::get('semana');
					$tipocom = Input::get('tipocomb');
					$productos = DB::select(DB::raw("select * from ventafamilias3 where
						idrest = ".$idrest." and semana = ".$semana." and ayear = ".$year."
						 and tipocombid = ".$tipocom." order by total desc"));
					return Response::json($productos);
				}
			});

		Route::post('reporteventassemanasproductos', function () {
				if (Request::ajax()) {
					$idrest = Input::get('idrest');
					$year = Input::get('year');
					$semana = Input::get('semana');
					$famiid = Input::get('famiid');
					$productos = DB::select(DB::raw("select * from ventaspoductos3 where
						idrest = ".$idrest." and semana = ".$semana." and ayear = ".$year."
						 and famiid = ".$famiid." order by total desc"));
					return Response::json($productos);
				}
			});

		Route::post('reporteventasunidadessemanales', function () {
				if (Request::ajax()) {
					$idrest = Input::get('idrest');
					$year = Input::get('year');
					$semana = Input::get('semana');
					$productos = DB::select(DB::raw("select * from vistatiposcombinacionunidades3 where
						idrest = ".$idrest." and semana = ".$semana." and ayear = ".$year."
						order by total desc"));
					return Response::json($productos);
				}
			});

		Route::post('reporteventassemanasfamiliasuni', function () {
				if (Request::ajax()) {
					$idrest = Input::get('idrest');
					$year = Input::get('year');
					$semana = Input::get('semana');
					$tipocom = Input::get('tipocomb');
					$productos = DB::select(DB::raw("select * from ventafamiliasunidades3 where
						idrest = ".$idrest." and semana = ".$semana." and ayear = ".$year."
						 and tipocombid = ".$tipocom." order by total desc"));
					return Response::json($productos);
				}
			});

		Route::post('reporteventassemanasproductosuni', function () {
				if (Request::ajax()) {
					$idrest = Input::get('idrest');
					$year = Input::get('year');
					$semana = Input::get('semana');
					$famiid = Input::get('famiid');
					$productos = DB::select(DB::raw("select * from ventaspoductosunidades3 where
						idrest = ".$idrest." and semana = ".$semana." and ayear = ".$year."
						 and famiid = ".$famiid." order by total desc"));
					return Response::json($productos);
				}
			});

		Route::post('buscarordenesproduccion', function () {
				if (Request::ajax()) {
					$idarea = Input::get('areaproduccion_id');
					$areaproduccion = Areadeproduccion::find($idarea);
					$ordenes = $areaproduccion->ordenesdeproduccion;
					return Response::json($ordenes);
				}
			});

		Route::post('create_ordenproduccion', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try {
						$areaproduccion_id = Input::get('areaproduccion_id');
						$areaproduccion = Areadeproduccion::find($areaproduccion_id);
						$ordenesflag = count($areaproduccion->ordenesdeproduccion()
							->whereBetween('ordendeproduccion.fechainicio',
								array(date('Y-m-d').' 00:00:00', date('Y-m-d').' 23:59:59'))
								->get());

						$descripcion = Input::get('descripcion');
						$observacion = Input::get('observacion');
						$productos = Input::get('productos');
						$arrayinsumos = array();
						$arraypreproductos = array();
						$arrayverificarstock = array();
						$arraydetalleorden = array();
						$arradetallerequerimiento = array();
						$ordendeproduccion = OrdendeProduccion::create(
							array('areaproduccion_id' => $areaproduccion_id,
								'descripcion'	=> $descripcion,
								'observacion'	=> $observacion,
								'fechainicio'   => date('Y-m-d H:i:s'),
								'responsable_id' => Auth::user()->id));

						$requerimiento = Requerimiento::create(
							array('areaproduccion_id' => $areaproduccion_id,
								'descripcion'   => $descripcion,
								'observacion'	=> $observacion,
								'estado'	=> 1,
								'ordendeproduccion_id'	=> $ordendeproduccion->id,
								'usuario_id'	=> Auth::user()->id));

						foreach ($productos as $producto) {
							$oproducto = Producto::find($producto['id']);
							$receta = $oproducto->insumos()->get();
							$preproductos = $oproducto->preproductos()->get();
							foreach ($receta as $insumo) {
								if (isset($arrayinsumos[$insumo->id])) {
									$newcantidad = $arrayinsumos[$insumo->id]['cantidad']+($insumo->pivot->cantidad*$producto['cantidad']);
									$arrayinsumos[$insumo->id]['cantidad'] = $newcantidad;
								} else {
									$arrayinsumos[$insumo->id] = array('insumo_id' => $insumo->id,
										'cantidad'	=> $insumo->pivot->cantidad*$producto['cantidad']);
									$arrayverificarstock[] = $insumo->id;
								}
							}

							foreach ($preproductos as $preproducto) {
								$oproducto2 = Producto::find($preproducto->id);
								if (isset($oproducto2->proveedor_id)) {
									$stockpreproducto = $areaproduccion->almacen->productos()
									->where('stockProducto.producto_id', '=', $preproducto->id)
									->first();
									$flagstockpreproducto = 0;
									if (count($stockpreproducto) == 0) {
										$flagstockpreproducto = 1;
									}
									if ($ordenesflag <= 0 && $flagstockpreproducto == 0) {
										$cantidadpreproducto = ($producto['cantidad']*$preproducto->pivot->cantidad)-$stockpreproducto->pivot->stockActual;
									} else {
										$cantidadpreproducto = ($producto['cantidad']*$preproducto->pivot->cantidad);
									}

									if ($cantidadpreproducto > 0) {
										if (isset($arraypreproductos[$preproducto->id])) {
											$newcantidad = $arraypreproductos[$preproducto->id]['cantidad']+$cantidadpreproducto;
											$arraypreproductos[$preproducto->id]['cantidad'] = $newcantidad;
										} else {
											$arraypreproductos[$preproducto->id] = array('preproducto_id' => $preproducto->id,
												'cantidad'                                                   => $cantidadpreproducto, 'areaproduccion_id'                                                   => $preproducto->proveedor_id);
										}
									}
								} else {
									$receta2 = $oproducto2->insumos()->get();
									foreach ($receta2 as $insumo) {
										if (isset($arrayinsumos[$insumo->id])) {
											$newcantidad = $arrayinsumos[$insumo->id]['cantidad']+($insumo->pivot->cantidad*$producto['cantidad']);
											$arrayinsumos[$insumo->id]['cantidad'] = $newcantidad;
										} else {
											$arrayinsumos[$insumo->id] = array('insumo_id' => $insumo->id,
												'cantidad'                                    => $insumo->pivot->cantidad*$producto['cantidad']);
											$arrayverificarstock[] = $insumo->id;
										}
									}
								}
							}

							$arraydetalleorden[] = array('cantidad' => $producto['cantidad'], 'fechainicio' => $ordendeproduccion->fechainicio,
								'ordendeproduccion_id'	=> $ordendeproduccion->id, 'producto_id'	=> $producto['id']);
						}

						if ($ordenesflag <= 0) {
							if (count($arrayverificarstock) > 0) {
								$stockinsumos = $areaproduccion->almacen->insumos()->wherein('insumo.id', $arrayverificarstock)->get();
								foreach ($stockinsumos as $insumo) {
									if (isset($arrayinsumos[$insumo->id])) {
										$newcantidad = $arrayinsumos[$insumo->id]['cantidad']-$insumo->pivot->stockActual;
										$arrayinsumos[$insumo->id]['cantidad'] = $newcantidad;
									}
								}
							}
						}

						foreach ($arrayinsumos as $insumo) {
							if ($insumo['cantidad'] > 0) {
								$arradetallerequerimiento[] = array('cantidad' => $insumo['cantidad'], 'estado' => 1,
									'fechainicio'	=> $requerimiento->created_at,
									'insumo_id'	=> $insumo['insumo_id'],
									'producto_id'	=> NULL, 'requerimiento_id'                                 => $requerimiento->id,
									'areaproduccion_id' => $areaproduccion->almacen_id);
							}
						}

						foreach ($arraypreproductos as $preproducto) {
							if ($preproducto['cantidad'] > 0) {
								$arradetallerequerimiento[] = array('cantidad' => $preproducto['cantidad'], 'estado' => 1,
									'fechainicio'	=> $requerimiento->created_at, 'insumo_id'	=> NULL,
									'producto_id'	=> $preproducto['preproducto_id'],
									'requerimiento_id'	=> $requerimiento->id,
									'areaproduccion_id'	=> $preproducto['areaproduccion_id']);
							}
						}

						$detallesorden = DetalleOrdendeProduccion::insert($arraydetalleorden);

						if (count($arradetallerequerimiento) > 0) {
							$detallesrequerimiento = Detallerequerimiento::insert($arradetallerequerimiento);
						}

					} catch (Exception $e) {
						DB::rollback();
						return Response::json(array('estado' => false, 'mgs' => $e));
					}
					DB::commit();
					return Response::json(array('estado' => true, 'mgs' => 'Operacion Completada exitosamente'));
				}
			});

		Route::post('create_requerimiento', function(){
			if (Request::ajax()) {
				DB::beginTransaction();
					try {
						$areaproduccion_id = Input::get('areaproduccion_id');
						$areaproduccion = Areadeproduccion::find($areaproduccion_id);
						$ordenesflag = count($areaproduccion->ordenesdeproduccion()
							->whereBetween('ordendeproduccion.fechainicio',
								array(date('Y-m-d').' 00:00:00', date('Y-m-d').' 23:59:59'))
								->get());

						$descripcion = Input::get('descripcion');
						$observacion = Input::get('observacion');
						$insumos = Input::get('insumos');
						$arrayinsumos = array();
						$arraypreproductos = array();
						$arrayverificarstock = array();
						$arraydetalleorden = array();
						$arradetallerequerimiento = array();
						$ordendeproduccion = OrdendeProduccion::create(
							array('areaproduccion_id' => $areaproduccion_id,
								'descripcion'	=> $descripcion,
								'observacion'	=> $observacion,
								'fechainicio'   => date('Y-m-d H:i:s'),
								'responsable_id' => Auth::user()->id));

						$requerimiento = Requerimiento::create(
							array('areaproduccion_id' => $areaproduccion_id,
								'descripcion'   => $descripcion,
								'observacion'	=> $observacion,
								'estado'	=> 1,
								'ordendeproduccion_id'	=> $ordendeproduccion->id,
								'usuario_id'	=> Auth::user()->id));
						if ($ordenesflag <= 0) {
							if (count($arrayverificarstock) > 0) {
								foreach ($insumos as $insumo) {
									$stockinsumo = $areaproduccion->almacen->insumos()
													->where('stockInsumo.insumo_id', '=', $insumo['id'])->first();
									if (count($stockinsumo > 0)) {
										$newcantidad = $insumo['cantidad']-$insumo->pivot->stockActual;
									}else
									{
										$newcantidad = $insumo['cantidad'];
									}
									if ($newcantidad > 0) {
										$requerimiento->insumos()->attach($insumo['id'],
											['cantidad' => $newcantidad,
											'estado' => 1,
											'fechainicio'	=> $requerimiento->created_at,
											'producto_id' => NULL,
											'requerimiento_id' => $requerimiento->id,
											'areaproduccion_id' => $areaproduccion->almacen_id]);
									}
								}
							}
						}else{
							foreach ($insumos as $insumo) {
										$requerimiento->insumos()->attach($insumo['id'],
											['cantidad' => $insumo['cantidad'],
											'estado' => 1,
											'fechainicio'	=> $requerimiento->created_at,
											'producto_id' => NULL,
											'requerimiento_id' => $requerimiento->id,
											'areaproduccion_id' => $areaproduccion->almacen_id]);
							}
						}
					} catch (Exception $e) {
						DB::rollback();
						return Response::json(array('estado' => false, 'mgs' => $e));
					}
					DB::commit();
					return Response::json(array('estado' => true, 'mgs' => 'Operacion Completada exitosamente'));
			}
		});

		Route::post('buscareceta', function () {
				if (Request::ajax()) {
					$producto = Producto::find(Input::get('productoid'));
					$receta = $producto->insumos()->get()->toJson();
					$preproductos = $producto->preproductos()->get()->toJson();
					return Response::json(compact('receta', 'preproductos'));
				}
			});

		Route::post('procesarrequerimiento', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try {
						$productos = Input::get('productos');
						$insumos = Input::get('insumos');
						$arrayinsumos = array();
						$arraystockinsumos = array();
						$areacompras_id = 0;
						$flag = 0;
						for ($i = 0; $i < count($insumos); $i++) {
							$requerimiento = Detallerequerimiento::find($insumos[$i]['id']);
							if ($requerimiento->estado == 1) {
								$areacompras_id = $requerimiento->areaproduccion_id;
								if (isset($arrayinsumos[$requerimiento->insumo_id])) {
									$newcantidad = $arraypreproductos[$requerimiento->insumo_id]['cantidad']
									+$insumos[$i]['cantidad'];
									$arrayinsumos[$requerimiento->insumo_id]['cantidad'] = $newcantidad;
								} else {
									$arrayinsumos[$requerimiento->insumo_id] = array('insumo_id' => $requerimiento->insumo_id,
										'cantidad'                                                  => $insumos[$i]['cantidad']);
									$arraystockinsumos[] = $requerimiento->insumo_id;
								}

								$requerimiento->estado = 2;
								$requerimiento->cantidadentregada = $insumos[$i]['cantidad'];
								$requerimiento->responsable_id = Auth::user()->id;
								$requerimiento->save();
								$flag = 1;
							}
						}
						if ($areacompras_id > 0) {
							$stockinsumos = Areadeproduccion::find($areacompras_id)->almacen
							->insumos()->wherein('insumo.id', $arraystockinsumos)->get();
							foreach ($stockinsumos as $insumo) {
								if (isset($arrayinsumos[$insumo->id])) {
									$newcantidad = $arrayinsumos[$insumo->id]['cantidad']-$insumo->pivot->stockActual;
									$arrayinsumos[$insumo->id]['cantidad'] = $newcantidad;
									if ($newcantidad <= 0) {
										unset($arrayinsumos[$insumo->id]);
									}
								}
							}
						}

						if (count($arrayinsumos) > 0) {
							$ordendecompra = Ordendecompra::create(array('area_id' => $areacompras_id, 'fechainicio' => date('Y-m-d H:i:s'), 'usuario_id' => Auth::user()->id));
							foreach ($arrayinsumos as $insumo) {
								$detalleordencompra = Detalleordendecompra::create(array('cantidad' => $insumo['cantidad'],
										'insumo_id'                                                       => $insumo['insumo_id'], 'ordendecompra_id'                                                       => $ordendecompra->id));
							}
						}

						if (count($productos) > 0) {
							foreach ($productos as $producto) {
								$requerimiento = Detallerequerimiento::find($producto['id']);
								if ($requerimiento->estado == 1) {
									$requerimiento->cantidadentregada = $producto['cantidad'];
									$requerimiento->responsable_id = Auth::user()->id;
									$requerimiento->estado = 2;
									$requerimiento->save();
									$flag = 1;
								}
							}
						}
						if ($flag == 0) {
							return Response::json(array('estado' => true, 'mgs' => 'No tienes Nada que procesar'));
						}
					} catch (Exception $e) {
						DB::rollback();
						return Response::json(array('estado' => false, 'mgs' => $e));
					}
					DB::commit();
					return Response::json(array('estado' => true, 'mgs' => 'Operacion Completada exitosamente'));
				}
			});

		Route::post('entregarrequerimiento', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try {
						$productos = Input::get('productos');
						$insumos = Input::get('insumos');
						$flag = 0;
						if (count($insumos) > 0) {
							foreach ($insumos as $insumo) {
								$requerimiento = Detallerequerimiento::find($insumo['id']);
								if ($requerimiento->estado == 2) {
									$insumominus = Areadeproduccion::find($requerimiento->areaproduccion_id)
													->almacen->insumos()
													->where('stockInsumo.insumo_id', '=', $requerimiento->insumo_id)
													->first();
									if (is_null($insumominus)) {
										DB::rollback();
										return Response::json(array('estado' => false, 'mgs' => 'No tienes Stock'));
									}else{
										$avalible = $insumominus->pivot->stockActual - $requerimiento->cantidadentregada;
										if ($avalible < 0) {
											DB::rollback();
											return Response::json(array('estado' => false, 'mgs' => 'No tienes Stock'));
										}
									}
									$requerimiento->estado = 3;
									$requerimiento->save();
									$flag = 1;
								}
							}
						}
						if (count($productos) > 0) {
							foreach ($productos as $producto) {
								$requerimiento = Detallerequerimiento::find($producto['id']);
								if ($requerimiento->estado == 2) {
									$productominus = Areadeproduccion::find($requerimiento->areaproduccion_id)
													->almacen->productos()
													->where('stockProducto.producto_id', '=', $requerimiento->producto_id)
													->first();
									if (is_null($productominus)) {
										DB::rollback();
										return Response::json(array('estado' => false, 'mgs' => 'No tienes Stock'));
									}else{
										$avalible = $productominus->pivot->stockActual - $requerimiento->cantidadentregada;
										if ($avalible < 0) {
											DB::rollback();
											return Response::json(array('estado' => false, 'mgs' => 'No tienes Stock'));
										}
									}
									$requerimiento->estado = 3;
									$requerimiento->save();
									$flag = 1;
								}
							}
						}
						if ($flag == 0) {
							return Response::json(array('estado' => true, 'mgs' => 'No tienes Nada que entregar'));
						}
					} catch (Exception $e) {
						DB::rollback();
						return Response::json(array('estado' => false, 'mgs' => $e));
					}
					DB::commit();
					return Response::json(array('estado' => true, 'mgs' => 'Operacion Completada exitosamente'));
				}
			});

		Route::post('recibirrequerimiento', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try {
						$productos = Input::get('productos');
						$insumos = Input::get('insumos');
						$flag = 0;
						if (count($insumos) > 0) {
							foreach ($insumos as $insumo) {
								$requerimiento = Detallerequerimiento::find($insumo['id']);
								if ($requerimiento->estado == 3) {
									$insumoplus = $requerimiento->requerimiento->area->almacen
										->insumos()->where('stockInsumo.insumo_id', '=', $requerimiento->insumo_id)
									->first();

									$insumominus = Areadeproduccion::find($requerimiento->areaproduccion_id)->almacen
										->insumos()->where('stockInsumo.insumo_id', '=', $requerimiento->insumo_id)
									->first();

									if (count($insumoplus) > 0) {
										$insumoplus->pivot->stockActual = $insumoplus->pivot->stockActual+$requerimiento->cantidadentregada;
										$insumoplus->pivot->save();
										$insumominus->pivot->stockActual = $insumominus->pivot->stockActual-$requerimiento->cantidadentregada;
										$insumominus->pivot->save();
									} else {
										$requerimiento->requerimiento->area->almacen->insumos()->attach($requerimiento->insumo_id,
											array('stockActual' => $requerimiento->cantidadentregada));
										$insumominus->pivot->stockActual = $insumominus->pivot->stockActual-$requerimiento->cantidadentregada;
										$insumominus->pivot->save();
									}
									$requerimiento->estado = 4;
									$requerimiento->save();
									$flag = 1;
								}
							}
						}

						if (count($productos) > 0) {
							foreach ($productos as $producto) {
								$requerimiento = Detallerequerimiento::find($producto['id']);
								if ($requerimiento->estado == 3) {
									$productoplus = $requerimiento->requerimiento->area->almacen
										->productos()->where('stockProducto.producto_id', '=', $requerimiento->producto_id)
									->first();

									$productominus = Areadeproduccion::find($requerimiento->areaproduccion_id)->almacen
										->productos()->where('stockProducto.producto_id', '=', $requerimiento->producto_id)
									->first();

									if (count($productoplus) > 0) {
										$productoplus->pivot->stockActual = $productoplus->pivot->stockActual+$requerimiento->cantidadentregada;
										$productoplus->pivot->save();
										$productominus->pivot->stockActual = $productominus->pivot->stockActual-$requerimiento->cantidadentregada;
										$productominus->pivot->save();
									} else {
										$requerimiento->requerimiento->area->almacen->productos()->attach($requerimiento->producto_id,
											array('stockActual' => $requerimiento->cantidadentregada));
										$productominus->pivot->stockActual = $productominus->pivot->stockActual-$requerimiento->cantidadentregada;
										$productominus->pivot->save();
									}
									$requerimiento->estado = 4;
									$requerimiento->save();
									$flag = 1;
								}
							}
						}

						if ($flag == 0) {
							return Response::json(array('estado' => true, 'mgs' => 'No tienes Nada que recibir'));
						}
					} catch (Exception $e) {
						DB::rollback();
						return Response::json(array('estado' => false, 'mgs' => $e));
					}
					DB::commit();
					return Response::json(array('estado' => true, 'mgs' => 'Operacion Completada exitosamente'));
				}
			});

		Route::post('actulizarstockproductos', function () {
				if (Request::ajax()) {
					DB::beginTransaction();
					try {
						$productos = Input::get('productos');
						$insumos = Input::get('insumos');
						$flag = 0;
						if (count($productos) > 0) {
							foreach ($productos as $producto) {
								$detalle = DetalleOrdendeProduccion::find($producto['id']);
								$cantidadp = $producto['cantidad'];
								$totalp = $detalle->cantidaddisponible+$cantidadp;
								if ($detalle->cantidad >= $totalp && $cantidadp > 0) {
									$detalle->cantidaddisponible = $totalp;
									$producto = $detalle->ordenproduccion->area->almacen->productos()
										->where('stockProducto.producto_id', '=', $detalle->producto_id)
										->first();
									if (count($producto) > 0) {
										$producto->pivot->stockActual = $producto->pivot->stockActual+$cantidadp;
										$producto->pivot->save();
									} else {
										$detalle->ordenproduccion->area->almacen->productos()->attach($detalle->producto_id,
											array('stockActual' => $cantidadp));
									}
									$detalle->save();
									$flag = 1;
								}
							}
						}
						if ($flag == 0) {
							return Response::json(array('estado' => true, 'mgs' => 'No tienes Nada que actulizar'));
						}
					} catch (Exception $e) {
						DB::rollback();
						return Response::json(array('estado' => false, 'mgs' => $e));
					}
					DB::commit();
					return Response::json(array('estado' => true, 'mgs' => 'Operacion Completada exitosamente'));
				}
			});

		Route::post('sesionmesa', function () {
				if (Request::ajax()) {
					$mesa_id = Input::get('mesaid');
					$mesa = Mesa::find($mesa_id);
					$pedido = $mesa->pedidos()->where('pedido.estado', '=', 'I')->first();
					if (count($pedido) > 0) {
						Session::put('sesionpedido', $pedido->id);
					} else {
						Session::put('sesionpedido', 0);
					}
					Session::put('sesionmesa', $mesa_id);
					$mesa->actividad = 1;
					$mesa->save();
					return Response::json(array('session' => Session::get('sesionmesa'),
							'pedidoid'                          => Session::get('sesionpedido')));
				}
			});

		Route::post('liberarmesa', function () {
				if (Request::ajax()) {
					$mesa_id = Input::get('mesa_id');
					if ($mesa_id > 0) {
						$mesa = Mesa::find($mesa_id);
						if ($mesa->actividad == 1) {
							$mesa->actividad = 0;
							$mesa->save();
						}
					}
					return Response::json(array('mesa_id' => $mesa_id));
				}
			});

		//NUEVO ENVIARPEDIDOS
		Route::post('enviarpedidosnew', function () {
				if (Request::ajax()) {
					$profami = json_decode(Input::get('prof'), true);
					$procombi = json_decode(Input::get('proc'), true);

					$cocinas = Input::get('cocinas');
					$pedidoid = Input::get('pedidoid');
					$mozoid = Input::get('mozoid');
					if ($mozoid == 0) {
						$mozoid = Auth::user()->id;
					}
					$idmesa = Input::get('idmesa');
					if ($pedidoid == 0) {
						$mesa = Mesa::find($idmesa);
						$Opedido = $mesa->pedidos()->whereIn('pedido.estado', array('I'))->first();
						if (!isset($Opedido)) {
							$Opedido = Pedido::create(array('estado' => 'I', 'usuario_id' => $mozoid));
							$pedidoid = $Opedido->id;
							$detMesa = DetMesa::create(array('mesa_id' => $idmesa, 'pedido_id' => $pedidoid));
						}
						$mesa->estado = 'O';
						$mesa->save();
					}
					$arrayprof = array();
					$arrayproco = array();
					$arrayimprimir = array();
					foreach ($cocinas as $cdato) {
						$arrayimprimir[$cdato['areanombre'].'_'.$cdato['id']] = array();
					}
					if (isset($profami)) {
						foreach ($profami as $datoprof) {
							$producto = Producto::find($datoprof['idpro']);
							foreach ($cocinas as $cocina) {
								$ococina = Areadeproduccion::find($cocina['id']);
								if ($ococina->id_tipo == $producto->id_tipoarepro) {
									$areapro = $cocina['id'];
									$ordencocina = $ococina->ordennumber+1;
									$arrayimprimir[$cocina['areanombre'].'_'.$cocina['id']][] = $datoprof;
								}
							}
							$datitos1 = array('pedido_id' => $pedidoid, 'producto_id' => $datoprof['idpro'],
								'cantidad'                   => $datoprof['cantidad'],
								'importeFinal'               => $datoprof['preciot'],
								'estado'                     => 'I', 'descuento'                     => 0,
								'idarea'                     => $areapro,
								'ordenCocina'                => $ordencocina);
							$odetpe = DetPedido::create($datitos1);
							$flagnotas = 0;
							if (count($datoprof['notas']) > 0) {
								$arrayinsertnotas = array();
								foreach ($datoprof['notas'] as $anota) {
									$arrayinsertnotas[] = array('notas_id' => $anota['idnota'],
										'detallePedido_id'                    => $odetpe->id, );
									$flagnotas = 1;
								}

								Detallenotas::insert($arrayinsertnotas);
							}
							$flagadicional = 0;
							if (count($datoprof['adicionales']) > 0) {
								foreach ($datoprof['adicionales'] as $datadi) {
									$inputadi = array('pedido_id' => $pedidoid,
										'producto_id'                => $datadi['idadicional'],
										'cantidad'                   => $datadi['cantidad'],
										'ImporteFinal'               => $datadi['precio'],
										'estado'                     => 'I', 'descuento'                     => 0,
										'idarea'                     => $areapro,
										'ordenCocina'                => $ordencocina,
										'detalle_id'                 => $odetpe->id);
									$odetpeadi = DetPedido::create($inputadi);
									$flagadicional = 1;
									$arrayprof[] = array('iddetpedido' => $odetpeadi->id,
										'pronombre'                       => $datadi['nombre'],
										'pestado'                         => $odetpeadi->estado,
										'notas'                           => 0,
										'cantidad'                        => $datadi['cantidad'],
										'precio'                          => $datadi['precio'],
										'idpedido'                        => $pedidoid,
										'adicionales'                     => 2,
										'sabores'                         => 0, );
								}
							}
							$flagsabor = 0;
							if (count($datoprof['sabores']) > 0) {
								$arraysabores = array();
								foreach ($datoprof['sabores'] as $datosabor) {
									$arraysabores[] = array('detpedido_id' => $odetpe->id,
										'sabor_id'                            => $datosabor['idsabor'], );
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
							$id_comb = $datoproc['combinacion_id'];
							$cont_comb_c = DB::select('select max(detallepedido.combinacion_c) as max from detallepedido
                    where detallepedido.pedido_id = ? and detallepedido.combinacion_id=?', array($pedidoid, $id_comb));
							foreach ($cont_comb_c as $ccc) {
								$cont_comb_c2 = $ccc->max;
							}
							if ($cont_comb_c2 == '') {
								$cont_comb_c2 = 0;
							}
							$cont_comb_c2 = $cont_comb_c2+1;
							foreach ($datoproc['productos'] as $procom) {
								if ($procom['nombre'] != '-') {
									$producto = Producto::find($procom['id']);
									foreach ($cocinas as $cocina) {
										$ococina = Areadeproduccion::find($cocina['id']);
										if ($ococina->id_tipo == $producto->id_tipoarepro) {
											$areapro = $cocina['id'];
											$ordencocina = $ococina->ordennumber+1;
											$oprocom2 = $procom+array('cantidad' => $datoproc['cantidad']);
											$arrayimprimir[$cocina['areanombre'].'_'.$cocina['id']][] = $oprocom2;
										}
									}
									$datitos2 = array('pedido_id' => $pedidoid,
										'producto_id'                => $procom['id'],
										'cantidad'                   => $datoproc['cantidad'],
										'ImporteFinal'               => $datoproc['preciot'],
										'estado'                     => 'I', 'descuento'                     => 0,
										'combinacion_id'             => $datoproc['combinacion_id'],
										'combinacion_c'              => $cont_comb_c2,
										'combinacion_cant'           => $datoproc['cantidad'],
										'idarea'                     => $areapro,
										'ordenCocina'                => $ordencocina);
									$oprocom = DetPedido::create($datitos2);
									$flagnotas = 0;
									if (count($procom['notas']) > 0) {
										$arrayinsertnotasc = array();
										foreach ($procom['notas'] as $anota) {
											$arrayinsertnotasc[] = array('notas_id' => $anota['idnota'],
												'detallePedido_id'                     => $oprocom->id, );
											$flagnotas = 1;
										}

										Detallenotas::insert($arrayinsertnotasc);
									}

									$flagadicional = 0;
									if (count($procom['adicionales']) > 0) {
										foreach ($procom['adicionales'] as $datadi) {
											$inputadi = array('pedido_id' => $pedidoid,
												'producto_id'                => $datadi['idadicional'],
												'cantidad'                   => $datadi['cantidad'],
												'ImporteFinal'               => $datadi['precio'],
												'estado'                     => 'I', 'descuento'                     => 0,
												'idarea'                     => $areapro,
												'ordenCocina'                => $ordencocina,
												'detalle_id'                 => $oprocom->id);
											$odetpeadi = DetPedido::create($inputadi);
											$flagadicional = 1;
											$arrayprof[] = array('iddetpedido' => $odetpeadi->id,
												'pronombre'                       => $datadi['nombre'],
												'pestado'                         => $odetpeadi->estado,
												'notas'                           => 0,
												'cantidad'                        => $datadi['cantidad'],
												'precio'                          => $datadi['precio'],
												'idpedido'                        => $pedidoid,
												'adicionales'                     => 2,
												'sabores'                         => 0, );
										}
									}
									$flagsabor = 0;
									if (count($procom['sabores']) > 0) {
										$arraysabores = array();
										foreach ($procom['sabores'] as $datosabor) {
											$arraysabores[] = array('detpedido_id' => $oprocom->id,
												'sabor_id'                            => $datosabor['idsabor'], );
											$flagsabor = 1;
										}

										Detpedidosabores::insert($arraysabores);
									}

									$procomb[] = array('iddetpedido' => $oprocom->id, 'pronombre' => $procom['nombre'], 'pestado' => $oprocom->estado, 'notas' => $flagnotas, );
								}
							}
							$arrayproco[] = array('combinombre' => $datoproc['nombre'],
								'precio'                           => $datoproc['preciot'],
								'produccomb'                       => $procomb,
								'cantidad'                         => $datoproc['cantidad'],
								'idpedido'                         => $pedidoid);
						}
					}
					$j = 0;
					foreach ($cocinas as $cocina) {
						$max = DetPedido::whereraw("pedido_id = ".$pedidoid."
                    and idarea = ".$cocina['id'])->first();
						$ordenes = 0;
						if (isset($max)) {
							$areap = Areadeproduccion::find($cocina['id']);
							$ordenes = $areap->ordennumber+1;
							$areap->ordennumber = $ordenes;
							$areap->save();
						}
						$orden[] = array('cocina' => $cocina['areanombre'].'_'.$cocina['id'],
							'orden'                  => $ordenes, );
						$j++;
					}
					$arraycocinaimpresion = array();
					foreach ($cocinas as $cocina) {
						$arraycocinaimpresion[] = $cdato['areanombre'].'_'.$cdato['id'];
					}

					Event::fire('imprimirpedidos', compact('arrayimprimir', 'mozoid', 'idmesa', 'arraycocinaimpresion'));
					return Response::json(compact('orden', 'arrayproco', 'arrayprof', 'pedidoid', 'mozoid'));
				}
			});
		//FIN NUEVO ENVIARPEDIDOS

		Route::post('sesionproducto', function () {
				if (Request::ajax()) {
					$producto_id = Input::get('producto_id');
					Session::put('sesionproducto', $producto_id);

					return Response::json(array('producto_id' => Session::get('sesionproducto')));
				}
			});

		Route::get('getSabores', function () {
				if (Request::ajax()) {
					$producto = Producto::find(Session::get('sesionproducto'));
					$sabores = $producto->sabores()->orderby('nombre', 'ASC')->get();
					return Response::json($sabores);
				}
			});

		Route::get('getAdicionales', function () {
				if (Request::ajax()) {
					$producto = Producto::find(Session::get('sesionproducto'));
					$adicionales = $producto->adicionales;
					$arrayadicionales = array();
					foreach ($adicionales as $dato) {
						$precio = $dato->precios()->where('combinacion_id', '=', 1)->first();
						$arrayadicionales[] = array('id' => $dato->id, 'nombre' => $dato->nombre, 'precio' => $precio->precio, );
					}
					return Response::json($arrayadicionales);
				}
			});
		//fin rutas

        Route::get('vales-descuentos', array('before'=>'admin', function(){
            $restaurantes = Restaurante::all();
           return View::make('reportes.vales-descuentos-index', compact('restaurantes'));
        }));


        //routes de listar mantenedores
        Route::get('/getUsers', function(){
        	$usuarios = Usuario::selectraw('concat(nombres," ",apPaterno," ",apMaterno) as nombres,perfil.nombre,usuario.estado,usuario.login,usuario.id')
						->join('persona','persona.id','=','usuario.persona_id')
						->join('perfil','persona.perfil_id','=','perfil.id')
						->get();
			return Response::json($usuarios);
        });


		function prodSort($item1, $item2) {
			if ($item1['id'] == $item2['id']) {return 0;
			}

			return ($item1['id'] > $item2['id'])?1:-1;
		}

        Route::get('/getProducts', function(){

        	$oComb = Combinacion::where('nombre','=','Normal')->first();

        	$producto1 = Producto::join('familia','familia.id','=','producto.familia_id')
        				/*->whereHas('combinaciones',function($q){
        					$q->where('combinacion.id','=',1);
        				})*/
        				->join('precio','producto.id','=','precio.producto_id')
        				/*->where('precio.combinacion_id','=',1)*/
        				->selectraw('distinct(producto.id), producto.nombre as nombreProd, precio.precio as precio, producto.costo as costo,familia.nombre as nombreFam,producto.estado as estado ')
        				->orderBy('producto.id')
        				->where('precio.combinacion_id','=',$oComb->id)
        				->where('producto.receta','=',0)
        	            ->get();

        	 $producto2 = Producto::join('familia','familia.id','=','producto.familia_id')
						->leftjoin('receta','producto.id','=','receta.producto_id')
						->join('precio','producto.id','=','precio.producto_id')
						->where('receta', '=', 1)
						->where('precio.combinacion_id','=',$oComb->id)
						->selectraw('distinct(producto.id),producto.nombre as nombreProd, precio.precio as precio, sum(receta.precio) as costo, familia.nombre as nombreFam,producto.estado as estado')
						->groupBy('producto.id')
						->get();

			$fusioPrimera = array_merge($producto1->toArray(),$producto2->toArray());

			//print_r($fusioPrimera); die();

			$arrX;
			foreach ($fusioPrimera as $x) {
				$arrX[] = $x['id'];
			}
			if (!isset($arrX)) {
				$arrX[] = 0;
			}

			$producto3 = Producto::join('familia','familia.id','=','producto.familia_id')
						->selectraw('producto.id,producto.nombre as nombreProd, "-" as precio, costo as costo, familia.nombre as nombreFam,producto.estado as estado')
						->whereNotIn('producto.id',$arrX)
						->get();
			/*$producto3 = Producto::join('precio','producto.id','=','precio.producto_id')
						->join('familia','familia.id','=','producto.familia_id')
						->where('precio.combinacion_id','!=',1)
						->selectraw('distinct(producto.id),producto.nombre as nombreProd, precio.precio as precio, familia.nombre as nombreFam,producto.estado as estado')	        
						->groupBy('producto.id')
						->get();*/
        	/*$productos = Producto::has('combinaciones','<','1')->get();*/
        	//print_r($producto3->toArray()); die();
        	$final = array_merge($fusioPrimera,$producto3->toArray());
        	usort($final,"prodSort");
        	//print_r($final); die();
			return Response::json($final);
			//return Response::json($producto1);
        });

		

		Route::get('/getInsumos', function(){

			$insumos = Insumo::all();

			return Response::json($insumos);

		});

		Route::get('/getNotas', function(){

			$insumos = Notas::all();

			return Response::json($insumos);

		});

		Route::get('/getPersonas', function(){
			$personas = Persona::with('Perfil')->whereNull('razonSocial')->get();

			return Response::json($personas);
		});

		Route::post('/resetPasswd', function(){
			if (Request::ajax()) {
				$id_login = Input::get('id_login');
				$user = Usuario::find($id_login);
				$codigo = substr( md5(microtime()), 1, 6);
				$user->password = Hash::make($codigo);
				$user->save();
				return Response::json($codigo);
			}
		});

		Route::get('/getCarta', function(){
		if (Request::ajax()) {
			/*$oComb = Combinacion::where('nombre','=','Normal')->first();
			$familias = Familia::select('familia.nombre', 'familia.id')
								->join('producto', 'producto.familia_id', '=', 'familia.id')
								->join('precio', 'precio.producto_id', '=', 'producto.id')
								->where('precio.combinacion_id', '=', $oComb->id)
								->groupby('familia.nombre')
								->get();

			/*$platosfamilia = array();
			foreach ($familias as $dato) {
			$platosfamilia[$dato->nombre] = Producto::select('producto.nombre', 'producto.id', 'precio.precio', 'producto.cantidadsabores', 'producto.imagen', 'familia.nombre as familia')
												 ->join('precio', 'precio.producto_id', '=', 'producto.id')
												 ->join('combinacion', 'combinacion.id', '=', 'precio.combinacion_id')
												 ->join('familia','familia.id','=','producto.familia_id')
												 ->where('combinacion.nombre', '=', 'Normal')
												 ->where('producto.familia_id', '=', $dato->id, 'AND')
												 ->where('producto.estado', '=', 1)
												 ->orderby('producto.nombre','ASC')
												 ->get();
			}*/

			$products = Producto::select('producto.nombre', 'producto.id', 'precio.precio', 'producto.cantidadsabores', 'producto.imagen', 'familia.nombre as familia')
												 ->join('precio', 'precio.producto_id', '=', 'producto.id')
												 ->join('combinacion', 'combinacion.id', '=', 'precio.combinacion_id')
												 ->join('familia','familia.id','=','producto.familia_id')
												 ->where('combinacion.nombre', '=', 'Normal')												 
												 ->where('producto.estado', '=', 1)
												 ->orderby('familia.nombre','ASC')
												 ->get();

			return Response::json($products);
		}

		});

	});
