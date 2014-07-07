<?php
	class UsuariosController extends BaseController {

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function getIndex()
		{
			$usuarios = Persona::all();
	        return View::make('usuarios.index', compact('usuarios'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function getCreate()
		{
			$restaurantes = Restaurante::all()->lists('nombreComercial','id');
			$colaboradores = Colaborador::all()->lists('nombre','id');
	        return View::make('usuarios.create', compact('restaurantes', 'colaboradores'));
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function postCreate()
		{
		 DB::beginTransaction();	
		 try {
			$persona = Usuario::where('persona_id', '=', Input::get('persona_id'))->get();
			$user = Usuario::where('login','=',Input::get('login'))->get();
			if( Input::get('password') != Input::get('rpt_pass') ){

				Input::flash();
				return Response::json(array('estado' => false, 'route' => '/usuarios/create' , 'msg' => '  Las contraseñas no coinciden.') );

			}elseif(count($persona) > 0){

				
				return Response::json(array('estado' => false, 'route' => '/usuarios/create' , 'msg' => '  Persona con Usuario.'));
				//return Redirect::to('usuarios/create')->withErrors('Esta Persona ya tiene un Usuario');

			}elseif(count($user) > 0){

				Input::flash();
				return Response::json(array('estado' => false, 'route' => '/usuarios/create' , 'msg' => ' Nombre de Usuario repetido.'));
				//return Redirect::to('usuarios/create')->withErrors('Este nombre de usuario está en uso');

			}else{

				$input = Input::all();
		    	$input['password'] = Hash::make($input['password']);
		    	Usuario::create($input);
		    	//return Redirect::to('usuarios')->with('success','');

			}

		} catch (Exception $e) { //'Falta Local, Área o Colaborador.'
			DB::rollback();
			return Response::json(array('estado' => false , 'msg' => 'Falta Local, Área, Colaborador o Persona/Empresa escogida por la lista desplegable.'));
		}

		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/usuarios'));
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function show($id)
		{
	        return View::make('usuarios.show');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function getEdit($id)
		{
			$restaurantes = Restaurante::all()->lists('nombreComercial','id');
			$usuario = Usuario::find($id);
			$colaboradores = Colaborador::all()->lists('nombre','id');
	        return View::make('usuarios.edit', compact('usuario', 'restaurantes','colaboradores'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function postEdit()
		{
			DB::beginTransaction();	
		 	try {
				$usuario = Usuario::find(Input::get('id'));
				$usuario->update(Input::all());
				$usuario->save();
			} catch (Exception $e) {
				DB::rollback();
				return Response::json(array('estado' => false , 'msg' => 'Falta Local, Área o Colaborador.'));
			}

			DB::commit();
			return Response::json(array('estado' => true, 'route' => '/usuarios'));
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function postDestroy($id)
		{
		DB::beginTransaction();	
		try {
			$usuario = Usuario::find($id);
			$usuario->delete();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}
		DB::commit();
		return Response::json(true);
		}

		public function getReportemozos($idrestaurante = NULL){
			if (isset($idrestaurante)) {
				$restaurante = Restaurante::find($idrestaurante);
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				return View::make('usuarios.reportesmozos', 
					compact('restaurante','fechaInicio', 'fechaFin'));
			}else{
				return Redirect::to('/web');
			}
		}

		public function getTicketsmozo($id=NULL){
			if (isset($id)) {
				$restauranteid = Input::get('idrest');
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				$tickestfacturados = Ticket::select('ticketventa.id','ticketventa.estado', 'ticketventa.numero', 'ticketventa.importe','ticketventa.idescuento')
									->join('pedido', 'pedido.id','=', 'ticketventa.pedido_id')
									->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
									->where('usuario.id', '=', $id)
									->whereBetween('ticketventa.created_at', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
									->get();
				$usuario = Usuario::select('usuario.login', 'persona.nombres','persona.apPaterno', 'persona.apMaterno')
									->join('persona', 'persona.id', '=', 'usuario.persona_id')
									->where('usuario.id', '=', $id)
									->first();
				$restaurante = Restaurante::find($restauranteid);
				$contador = 1;
				$importetotal = 0;
				$descuento = 0;
				foreach ($tickestfacturados as $ticket) {
					if($ticket->estado == 0){
						$importetotal = $importetotal + $ticket->importe;
					}
				}
				foreach ($tickestfacturados as $ticket) {
					if($ticket->estado == 0){
						$descuento = $descuento + $ticket->idescuento;
					}
				}
				return View::make('usuarios.reportetickets', 
					compact('tickestfacturados','restaurante', 'usuario', 'fechaInicio', 
						'fechaFin', 'contador','importetotal', 'descuento'));
			}else{
				return Redirect::to('/web');
			}
		}

		public function getProductosmozo($id=NULL){
			if (isset($id)) {
				$restauranteid = Input::get('idrest');
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				$productos = Detpedidotick::selectraw('usuario.id,sum(dettiketpedido.cantidad) AS cantidad, 
									dettiketpedido.nombre, dettiketpedido.created_at, dettiketpedido.producto_id , 
									dettiketpedido.combinacion_id, sum(dettiketpedido.precio) AS precio')
									->join('ticketventa', 'ticketventa.id', '=', 'dettiketpedido.ticket_id')
									->join('pedido', 'pedido.id','=', 'ticketventa.pedido_id')
									->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
									->where('usuario.id', '=', $id)
									->whereBetween('dettiketpedido.created_at', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
									->groupby('producto_id', 'combinacion_id')
									->orderby('precio', 'desc')
									->get();
				$usuario = Usuario::select('usuario.login', 'persona.nombres','persona.apPaterno', 'persona.apMaterno')
									->join('persona', 'persona.id', '=', 'usuario.persona_id')
									->where('usuario.id', '=', $id)
									->first();
				$restaurante = Restaurante::find($restauranteid);
				$cantidad = 0;
				$montototal = 0;
					foreach ($productos as $producto) {
	                	$cantidad = $cantidad + $producto->cantidad;
					}
					foreach ($productos as $producto) {
	                	$montototal = $montototal + $producto->precio;
					}

				return View::make('usuarios.reporproductosmozos', 
					compact('productos','restaurante', 'usuario', 'cantidad', 'montototal', 'fechaInicio', 'fechaFin'));
			}else{
				return Redirect::to('/web');
			}
		}

		public function getPedidosanulados($id=NULL){
			if (isset($id)) {
				$restauranteid = Input::get('idrest');
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				$pedidosanulados = Pedido::selectraw('count(detallepedido.cantidad) as cantidad, pedido.id, pedido.fechaInicio, 
									pedido.fechaCancelacion')
									->join('detallepedido', 'detallepedido.pedido_id', '=', 'pedido.id')
									->where('pedido.usuario_id', '=', $id)
									->where('pedido.estado', '=', 'A')
									->whereBetween('pedido.fechaInicio', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
									->groupby('id')
									->get();
				$usuario = Usuario::select('usuario.login', 'persona.nombres','persona.apPaterno', 'persona.apMaterno')
									->join('persona', 'persona.id', '=', 'usuario.persona_id')
									->where('usuario.id', '=', $id)
									->first();
				$restaurante = Restaurante::find($restauranteid);
				$totaldeproductos = 0;
				foreach ($pedidosanulados as $pedidoa) {
					$totaldeproductos = $totaldeproductos + $pedidoa->cantidad;
				}
				$contador = 1;
				return View::make('usuarios.pedidosanulados', 
					compact('pedidosanulados', 'usuario', 'restaurante', 'totaldeproductos', 
						'fechaInicio', 'fechaFin', 'contador'));
			}else{
				return Redirect::to('/web');
			}
		}

		public function getShowpedidosanulados($idpedido = NULL){
			if (isset($idpedido)) {
				$productosanulados = DetPedido::select('producto.nombre', 'detallepedido.cantidad',
									'fechaInicio')
									->join('producto', 'detallepedido.producto_id', '=', 'producto.id')
									->where('detallepedido.estado', '=', 'A')
									->where('detallepedido.pedido_id', '=', $idpedido)
									->get();
			}else{
				return Redirect::to('/web');
			}
		}
	}
