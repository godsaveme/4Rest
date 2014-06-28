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
			//var_dump(Input::all());
			//die();
			//var_dump($user);
			//var_dump($user);

			//die();

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
				return View::make('usuarios.reportesmozos', compact('restaurante'));
			}else{
				return Redirect::to('/web');
			}
		}

		public function getTicketsmozo($id=NULL){
			if (isset($id)) {
				$fechaInicio = Input::get('fechainicio');
				$fechaFin = Input::get('fechafin');
				$tickestfacturados = Ticket::select('ticketventa.id', 'ticketventa.numero', 'ticketventa.importe','ticketventa.idescuento')
									->join('pedido', 'pedido.id','=', 'ticketventa.pedido_id')
									->join('usuario', 'usuario.id', '=', 'pedido.usuario_id')
									->where('usuario.id', '=', $id)
									->whereBetween('ticketventa.created_at', array($fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'))
									->get();
				var_dump($tickestfacturados);
				die();
			}else{
				return Redirect::to('/web');
			}
		}

		public function getProductosmozo($id=NULL){
			if (isset($id)) {
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
									->groupby('producto_id, combinacion_id')
									->orderby('precio', 'desc')
									->get();
				return View::make('usuarios.reporproductosmozos', compact('productos'));
			}else{
				return Redirect::to('/web');
			}
		}
	}
