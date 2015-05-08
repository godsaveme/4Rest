<?php

class CocinaController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$pedidos = DetPedido::select('mesa.nombre','detallepedido.fechaInicio','detallepedido.pedido_id','detallepedido.ordenCocina')
						->join('detmesa', 'detmesa.pedido_id','=','detallepedido.pedido_id')
						->join('mesa', 'detmesa.mesa_id' , '=', 'mesa.id')
                        ->whereraw(" detallepedido.estado != 'T' and idarea = ".Auth::user()->id_tipoareapro)
                        ->where('detallepedido.estado', '!=', 'E')
                        ->where('detallepedido.estado', '!=', 'A')
                        ->where('detallepedido.estado', '!=', 'D')
                        ->whereNull('detallepedido.detalle_id', 'AND')
                        ->groupBy('ordenCocina')
                        ->orderBy('ordenCocina','asc')
                        ->get();
        $platos = array();   
        $platospanel = DetPedido::selectraw("detallepedido.producto_id , sum(detallepedido.cantidad) as sumcantidad ,
        				producto.nombre, detallepedido.estado")
        				->join('producto','detallepedido.producto_id','=','producto.id')
        				->where('detallepedido.estado','!=','D')
        				->where('detallepedido.estado','!=','E', 'AND')
        				->where('detallepedido.estado','!=','A', 'AND')
        				//add 19-03-15.. no se cargan los adicionales en el panel der
        				->whereNull('detallepedido.detalle_id')
        				//fin add
        				->where('idarea','=' ,Auth::user()->id_tipoareapro , 'AND')
        				->groupBy('producto_id')
        				->get();
        foreach ($pedidos as $datos) {
        $platos[$datos->pedido_id.'_'.$datos->ordenCocina] = DetPedido::select('detallepedido.estado','detallepedido.producto_id',
        				'detallepedido.cantidad', 'producto.nombre', 'detallepedido.cantidad', 'detallepedido.id', 
        				'detallepedido.pedido_id', 'detallenotas.detallePedido_id as detnota')
        				->leftJoin('detallenotas', 'detallenotas.detallePedido_id', '=', 'detallepedido.id')
                        ->join('producto','detallepedido.producto_id','=','producto.id')
                        ->whereraw("pedido_id =".$datos->pedido_id." and ordenCocina =".$datos->ordenCocina."
                        	and detallepedido.estado != 'D' and detallepedido.idarea =".Auth::user()->id_tipoareapro)
                        ->whereNull('detallepedido.detalle_id', 'AND')
                        ->groupBy('detallepedido.id')
                        ->get();
        }
        return View::make('cocina.index', compact('pedidos', 'platos', 'platospanel'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getProductosMesa()
	{
		$pedidos = Pedido::select('pedido.id', 'detallepedido.ordenCocina', 'usuario.login')
						->with(['detallepedido'=> function($q){
								$q->where('detallepedido.estado', '!=', 'E');
								$q->where('detallepedido.idarea', '=', Auth::user()->id_tipoareapro);
								$q->whereNull('detallepedido.detalle_id');
								$q->orderBy('created_at', 'ASC');
							},'detallepedido.producto',
							'detallepedido.sabores', 
							'detallepedido.notas',
							'detallepedido.adicionales',
							'detallepedido.adicionales.producto',
							'mesas'
						])
						->join('usuario', 'pedido.usuario_id','=', 'usuario.id')
						->join('detallepedido', 'detallepedido.pedido_id', '=', 'pedido.id')
						->where('detallepedido.estado', '!=', 'E')
						->where('pedido.estado', '=', 'I')
						->where('detallepedido.idarea', '=', Auth::user()->id_tipoareapro)
						->groupBy('detallepedido.ordenCocina')
						->get();
		return Response::json($pedidos);
	}
}
