<?php

class WebController extends BaseController {

	public function getIndex()
	{
		$perfiln = Auth::user()->persona->perfil->nombre;
		if( $perfiln == 'Caja'){
			return Redirect::to('/cajas');
		}elseif ($perfiln == 'Mozo') {
			return Redirect::to('/pedidoscomanda');
		}elseif ($perfiln == 'Cocina') {
			return Redirect::to('/cocina');
		}elseif ($perfiln == 'MozoTablet') {
			return Redirect::to('/pedidos');
		}else{
			return View::make('web.index');
		}
	}

}
