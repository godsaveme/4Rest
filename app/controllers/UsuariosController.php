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
			$persona = Usuario::where('persona_id', '=', Input::get('persona_id'))->get();
			$user = Usuario::where('login','=',Input::get('login'))->get();
			//var_dump(Input::all());
			//var_dump($user);
			//var_dump($user);

			//die();
			if(count($persona) > 0){

				Input::flash();
				return Redirect::to('usuarios/create')->withErrors('Esta Persona ya tiene un Usuario');

			}elseif(count($user) > 0){

				return Redirect::to('usuarios/create')->withErrors('Este nombre de usuario está en uso');

			}else{

				$input = Input::all();
		    	$input['password'] = Hash::make($input['password']);
		    	Usuario::create($input);
		    	return Redirect::to('usuarios')->with('success','');

			}
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
			$usuario = Usuario::find(Input::get('id'));
			$usuario->update(Input::all());
			$usuario->save();
			return Redirect::to('usuarios');
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
	}
