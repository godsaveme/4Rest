<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
	//Añadido
	if (Auth::check()) {
			//Session::set('LAST_ACTIVITY', time());  
	}
	//
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('modulo_habilitado',function($route,$request,$modulo_id, $perfil_id){
	$modulo = Modulos::whereraw('id ='.$modulo_id.' and activo = 1')->first();
	if(!isset($modulo)){
		return Redirect::to('web')->with('error_message', 'Esta acción esta deshabilitada ponte en contacto con el administrador del sistema');
	}else{
		$dato = Permisos::whereraw('id_perfil ='.$perfil_id.' and id_modulo ='.$modulo_id)->first();
		if ( !isset($dato) ) {
		return Redirect::to('web')->with('error_message', 'No tienes permisos suficientes para realizar esta acción, ponte en contacto con el administrador');
		}
	}
});

Route::filter('admin',function(){
    if(Auth::check()){
        if(Auth::user()->persona->perfil->nombre === 'Administrador'){
            //return Redirect::intended();
        }else{
            //return Redirect::to('hello');
            //return View::make('hello');
            return 'hello world';
        }
    }
});

Route::filter('caja',function(){
    if(Auth::check()){
        if(Auth::user()->persona->perfil->nombre === 'Caja'){
            //return Redirect::intended();
        }else{
            //return Redirect::to('hello');
            //return View::make('hello');
            return 'hello world';
        }
    }
});

Route::filter('cocina',function(){
    if(Auth::check()){
        if(Auth::user()->persona->perfil->nombre === 'Cocina'){
            //return Redirect::intended();
        }else{
            //return Redirect::to('hello');
            //return View::make('hello');
            return 'hello world';
        }
    }
});

Route::filter('mozo',function(){
    if(Auth::check()){
        if(Auth::user()->persona->perfil->nombre === 'Mozo'){
            //return Redirect::intended();
        }else{
            //return Redirect::to('hello');
            //return View::make('hello');
            return 'hello world';
        }
    }
});

Route::filter('admin-caja',function(){
    if(Auth::check()){
        if(Auth::user()->persona->perfil->nombre === 'Administrador' or Auth::user()->persona->perfil->nombre === 'Caja'){
            //return Redirect::intended();
        }else{
            //return Redirect::to('hello');
            //return View::make('hello');
            return 'hello world';
        }
    }
});