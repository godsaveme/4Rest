<?php

class ComprasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /compras
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$compras = Compra::all();
		return View::make('compras.index', compact('compras'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /compras/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$restaurantes = Restaurante::all()->lists('nombreComercial','id');
		$tipodocumentos = Tipodocumento::all()->lists('nombre','id');
        $almacenes = Almacen::all()->lists('nombre','id');
		return View::make('compras.create',compact('restaurantes','tipodocumentos','almacenes'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /compras
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		DB::beginTransaction();
		try {
			$restaurante_id = Input::get('restaurante_id');
			$restaurate = Restaurante::find($restaurante_id);
			$estado = Input::get('estado');
			$tipocomprobante_id = Input::get('tipocomprobante_id');
			$serie = Input::get('serie');
			$numero = Input::get('numero');
			$importetotal = Input::get('importetotal');
			$subtotal = Input::get('subtotal');
			$igv = Input::get('igv');
			$provedor_id = Input::get('provedor_id');
			$insumos = Input::get('insumos');
            $almacen_id = Input::get('almacen_id');
            //print_r($almacen_id); die();
			$compra = Compra::create(array('restaurante_id'=>$restaurante_id, 'estado'=>$estado, 
				'tipocomprobante_id'=>$tipocomprobante_id,'serie'=>$serie, 'numero'=>$numero, 'importetotal'=>$importetotal,
				'subtotal'=>$subtotal, 'igv'=>$igv, 'provedor_id'=>$provedor_id, 'usuario_id'=>Auth::user()->id));
			$total = 0;
			//$almacen = Areadeproduccion::find($restaurate->areacompras_id)->almacen;
            $almacen = Almacen::find($almacen_id);
			foreach ($insumos as $insumo) {
				$detallecompra = Detallecompra::create(array('cantidad'=>$insumo['cantidad'], 'compra_id'=>$compra->id, 
								'costototal'=>$insumo['costot'],'costou'=> $insumo['costou'], 'insumo_id'=> $insumo['id'],
								'porcion'=>$insumo['porcion'],'presentacion'=>$insumo['presentacion'],	
								'total'=>$insumo['total']));
				$total = $total + $detallecompra->costototal;
                //print_r($total); die();
				$insumo = $almacen->insumos()->where('stockInsumo.insumo_id', '=', $detallecompra->insumo_id)->first();
				if (count($insumo)>0) {
					$newstock = $insumo->pivot->stockActual + $detallecompra->total;
					$insumo->ultimocosto = $detallecompra->costototal / $detallecompra->total;
					$insumo->pivot->stockActual = $newstock;
					$insumo->pivot->save();
					$insumo->save();

				}else{
					$almacen->insumos()->attach($detallecompra->insumo_id,
						array('stockActual'=>$detallecompra->total));
                    $insumo = $almacen->insumos()->where('stockInsumo.insumo_id', '=', $detallecompra->insumo_id)->first();
                    $insumo->ultimocosto = $detallecompra->costototal / $detallecompra->total;
                    $insumo->save();

				}

               $recetas = Receta::where('insumo_id','=',$insumo->id)->get();
               foreach($recetas as $receta){
                   $producto = $receta->producto;
                    $receta->precio = $insumo->ultimocosto * $receta->cantidad;
                    $receta->save();
                   $insumos = $producto->insumos()->get();
                   $newcostoproducto = 0;
                   foreach($insumos as $item){
                       $newcostoproducto = $newcostoproducto + $item->pivot->precio;
                   }
                   $producto->costo = $newcostoproducto;
                   $producto->save();
                }

			}
			if($total != $importetotal){
				DB::rollback();
				return  Response::json(array('estado' => false, 'msg'=>'Importes no coinciden'));
			}
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false, 'msg'=>$e->getMessage()));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/compras'));
	}

	/**
	 * Display the specified resource.
	 * GET /compras/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDetalle($id = NULL)
	{
		if (isset($id)) {
			$compra = Compra::find($id);
			$detalles = $compra->insumos;
			return View::make('compras.detalles', compact('compra','detalles'));
		}else{
			return Redirect::to('/compras');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /compras/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /compras/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /compras/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}