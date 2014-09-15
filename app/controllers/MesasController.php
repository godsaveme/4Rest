<?php

class MesasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$mesas = Mesa::all();
        return View::make('mesas.index', compact('mesas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$salones = Salon::all()->lists('nombre','id');
        return View::make('mesas.create',compact('salones'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		DB::beginTransaction();	
		 try {
		Mesa::create(Input::all());
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));
		}

		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/mesas'));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('mesas.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$mesa = Mesa::find($id);
		$salones = Salon::all()->lists('nombre','id');
		$codigo = $mesa->mesa;
		$qrcode = DNS2D::getBarcodeHtml("http://192.168.1.247/dev/clientes/".$codigo, "QRCODE", 7, 7, "black");
		$qrcodepath = DNS2D::getBarcodePngPath("http://192.168.1.247/dev/clientes/".$codigo, "QRCODE", 7, 7, array(0,0,0));
		$nombrepng = substr($qrcodepath, 2);
		File::move(public_path().'/'.$nombrepng, public_path()."/imagesqr/".$nombrepng);
        return View::make('mesas.create', compact('mesa','salones', 'qrcode', 'codigo','nombrepng'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		DB::beginTransaction();	
		 try {
		$mesa = Mesa::find($id);
		$mesa->nombre = Input::get('nombre');
		$mesa->descripcion = Input::get('descripcion');
		$mesa->salon_id = Input::get('salon_id');
		$mesa->habilitado = Input::get('habilitado');
		$mesa->mesa = Input::get('mesa');
		$mesa->save();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));
		}

		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/mesas'));
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

		$mesa = Mesa::find($id);
		$mesa->delete();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}

	public function getProductosmesa(){
		$mesa_id = Session::get('sesionmesa');
		$pedido = Mesa::find($mesa_id)->pedidos()->where('pedido.estado', '=', 'I')->first();
		$arrayproductos = array();
		if (count($pedido) > 0) {
			$productos = $pedido->productos()->orderby('detallepedido.id', 'DESC')->get();
			$combinaciones = $pedido->combinaciones()->groupby('detallepedido.combinacion_id','detallepedido.combinacion_c')->get();
			foreach ($productos as $producto) {
				if (!isset($producto->pivot->combinacion_id)) {
					$arrayproductos[] = array(
										'id'=>$producto->pivot->id,
										'nombre'=>$producto->nombre, 
										'precio'=> $producto->pivot->importeFinal, 
										'idpedido'=>$producto->pivot->id,
										'cantidad'=>$producto->pivot->cantidad,
										'estado'=>$producto->pivot->estado,
										'tipo'=>1);
				}
			}

			foreach ($combinaciones as $combinacion) {
				$arraypcombi = array();
				foreach ($productos as $producto) {
					if ($producto->pivot->combinacion_id == $combinacion->id 
						&& $producto->pivot->combinacion_c == $combinacion->pivot->combinacion_c) {
						$arraypcombi[] = array(
							'nombre'=>$producto->nombre,
							'estado'=>$producto->pivot->estado,
							'idpedido'=>$producto->pivot->id
							);
					}
				}
				$arrayproductos[] = array(
						'id'=>$combinacion->pivot->id,
						'cantidad'=>$combinacion->pivot->cantidad,
						'nombre'=>$combinacion->nombre,
						'precio'=>$combinacion->precio,
						'productos'=>$arraypcombi,
						'tipo'=>2
						);
			}
			return Response::json($arrayproductos);
		}else {
			return Response::json($arrayproductos);
		}
		
	}

	public function getMesas(){
		$salon = Salon::where('restaurante_id', '=', Auth::user()->id_restaurante)->first();
		$mesas = Mesa::leftJoin('vistamesaspedidos','vistamesaspedidos.mesa_id', '=', 'mesa.id')
				->leftJoin('vistamesaspedidosporpagar','vistamesaspedidosporpagar.mesa_id2', '=', 'mesa.id')
				->where('salon_id', '=', $salon->id)
				->get();
		return Response::json($mesas);
	}
}
