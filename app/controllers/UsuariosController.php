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
	        return View::make('usuarios.create', compact('restaurantes', 'areas'));
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function postCreate()
		{
			$persona = Usuario::where('persona_id', '=', Input::get('persona_id'))->get();
			if(!empty($persona)){
				$input = Input::all();
		    	$input['password'] = Hash::make($input['password']);
		    	Usuario::create($input);
		    	return Redirect::to('usuarios')->with('mensaje_succes','');
			}else{
				return Redirect::to('usuarios')->with('mensaje_error','Esta Persona ya tiene un Usuario');
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
	        return View::make('usuarios.edit', compact('usuario', 'restaurantes','areas'));
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
			$e= true;
			try {
			$usuario = Usuario::find($id);
			$usuario->delete();
			} catch (Exception $e) {
			return false;
			}
			
			return json_encode($e);
		}

	}
