<?php
class PedidosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$restaurante = Restaurante::find(Auth::user()->id_restaurante);
		$salones = Salon::where('restaurante_id', '=', Auth::user()->id_restaurante)->get();
		$arraymesas = array();
		$arrayocupadas = array();
		foreach ($salones as $salon) {
			$oarraymesas[$salon->id] = Mesa::where('salon_id', '=', $salon->id)->get();
			foreach ($oarraymesas[$salon->id] as $dato) {
				$mesa = Mesa::find($dato->id);
				$Opedido = $mesa->pedidos()->whereIn('pedido.estado', array('I'))->first();
				if (!isset($Opedido)) {
					$mesa->actividad = NULL;
					$mesa->estado = 'L';
				}else{
					$mesa->actividad = NULL;
					$mesa->estado = 'O';
				}
				$mesa->save();
			}
			$arraymesas[$salon->id] = Mesa::where('salon_id', '=', $salon->id)->get();
			$ocupadas = Mesa::selectraw('mesa.estado , mesa.nombre , pedido.created_at, 
								mesa.id,pedido.id as pedidoid , usuario.login, SUM(dettiketpedido.precio) as consumo')
								->leftJoin('detmesa', 'detmesa.mesa_id', '=', 'mesa.id')
								->leftJoin('pedido', 'pedido.id','=', 'detmesa.pedido_id')
								->leftJoin('usuario', 'pedido.usuario_id','=', 'usuario.id')
								->leftJoin('dettiketpedido', 'dettiketpedido.pedido_id','=', 'pedido.id')
								->where('pedido.estado', '!=','T')
								->where('pedido.estado', '!=','A')
								->where('salon_id', '=', $salon->id)
								->groupby('id')
								->get();
			foreach ($arraymesas[$salon->id]  as $mesita) {
				foreach ($ocupadas as $ocupada) {
					if($mesita->id == $ocupada->id){
						$arrayocupadas[$ocupada->id] = $ocupada;
						$arrayocupadas['pagado_'.$ocupada->id] = Mesa::selectraw('SUM(dettiketpedido.precio) as pagado')
								->leftJoin('detmesa', 'detmesa.mesa_id', '=', 'mesa.id')
								->leftJoin('pedido', 'pedido.id','=', 'detmesa.pedido_id')
								->leftJoin('usuario', 'pedido.usuario_id','=', 'usuario.id')
								->leftJoin('dettiketpedido', 'dettiketpedido.pedido_id','=', 'pedido.id')
								->where('pedido.estado', '!=','T')
								->where('pedido.estado', '!=','A')
								->whereNull('dettiketpedido.ticket_id')
								->where('mesa.id', '=', $ocupada->id)
								->first();
					}
				}
			}
		}
        return View::make('pedidos.index', compact('salones', 'arraymesas'));
	}

	/*
	ESTOS MESA SON DE PRUEBA
*/
	public function getMesa()
	{
		$familias = Familia::all();
		$tipocomb = TipoComb::all();
		return View::make('pedidos.mesa', compact('familias' , 'tipocomb'));
	}

		public function postMesa()
	{
		$familias = Familia::all();
		$tipocomb = TipoComb::all();
		return View::make('pedidos.mesa', compact('familias' , 'tipocomb'));
	}


	/* funciones de abrir pedido*/

	/* funciones de abrir pedido*/

	public function postClickmesa(){

		$mesa_id = Input::get('mesa_id');
		$Omesa = Mesa::find($mesa_id);
		return $Omesa->toJson();
		//return json_encode($Omesa);
		//return View::make('pedidos.clickmesa',compact('Omesa'));
	}

	public function postFrmmovermesa(){
		$mesa_id = Input::get('mesa_id');
		$Omesas = Mesa::select('*')
					->whereraw('estado = "L" and id !='.$mesa_id)->get();
		return $Omesas->toJson();
	}

	public function postMovermesa(){

		//DB::beginTransaction();
		//try {

		$mesa_id = Input::get('mesa_id');
		$mesa_sel_id = Input::get('mesa_sel_id');
		$Omesa = Mesa::find($mesa_id);
		$OmesaSel = Mesa::find($mesa_sel_id);
		$Opedido = $Omesa->pedidos()->whereIn('pedido.estado', array('I','D'))->first();
		//$detMesa = DetMesa::where('pedido_id','=',$Opedido->id)->where('mesa_id','=',$Omesa->id,'and')->first();
		Pedido::find($Opedido->id)->mesas()->detach();
		//$detMesa->detach();
		$Omesa->estado = 'L';
		$Omesa->save();

		/* NUEVO DET_MESA*/
		$detMesa2 = new DetMesa;
		$detMesa2->mesa_id = $OmesaSel->id;
		$detMesa2->pedido_id = $Opedido->id;
		$detMesa2->save();

		$OmesaSel->estado = 'O';
		$OmesaSel->save();


		//} catch (Exception $e) {
		//	DB::rollback();
		//	return Response::json($e, 500);	
		//}

		DB::commit();
		return Response::json(array($OmesaSel->id, $Omesa->id), 200);

	}
	/* funcion de cargar MakeComb*/	
	public function postMakecomb(){

		$id_comb = Input::get('id_comb');
		$id_ped = Input::get('data_ped');
		$OCombinacion = Combinacion::find($id_comb);

		$nomb_comb = $OCombinacion->nombre;

		$prod_fam = DB::select('select familia.id as FamiliaId, familia.nombre as FamiliaNombre, precio.cantidad as PrecioCantidad, producto.id ProductoId, producto.nombre as ProductoNombre, precio.precio as ProductoPrecio from familia inner join producto
	on familia.id=producto.familia_id inner join precio
	on producto.id = precio.producto_id inner join combinacion
	on combinacion.id = precio.combinacion_id
where combinacion.id = ? and combinacion.FechaInicio <= curdate() and combinacion.FechaTermino >= curdate()
	and combinacion.HoraInicio <= curtime() and combinacion.HoraTermino >= curtime()' , array($id_comb));

		return View::make('pedidos.makeComb', compact('prod_fam' , 'nomb_comb' , 'id_comb', 'id_ped'));

	}
	/*Abre mesa de un pedido nuevo*/
	public function getAbrirpedido($mesa_id){
		/*MESA*/
		//$mesa = Mesa::find(Input::get('mesa_id'));
		$platos = DetPedido::select('pedido.id', 'usuario.login', 'mesa.nombre', 
                        'producto.nombre as pnombre','detallepedido.combinacion_c', 
                        'detallepedido.ordenCocina', 'detallepedido.cantidad', 'detallepedido.id as detpedid',
                        'detallepedido.estado')
                        ->join('producto', 'producto.id','=', 'detallepedido.producto_id')
                        ->join('pedido', 'pedido.id','=', 'detallepedido.pedido_id')
                        ->join('usuario', 'usuario.id','=', 'pedido.usuario_id')
                        ->join('detmesa', 'detmesa.pedido_id','=', 'detallepedido.pedido_id')
                        ->join('mesa', 'mesa.id', '=', 'detmesa.mesa_id')
                        ->whereraw("usuario.id = ".Auth::user()->id." and detallepedido.estado != 'D'")
                        ->get();
		$mesa = Mesa::find($mesa_id);
		if ($mesa->estado == 'O') {
			return Redirect::to('/pedidos/cargarpedido/'.$mesa->id);
		}else{
			$mesa->estado = 'O';
			$mesa->save();

		/*PEDIDO*/
		$Opedido = new Pedido;
		$Opedido->estado = 'I';
		$Opedido->usuario_id = Auth::user()->id;
		$Opedido->save();

		/*DET_MESA*/
		$detMesa = new DetMesa;
		$detMesa->mesa_id = $mesa->id;
		$detMesa->pedido_id = $Opedido->id;
		$detMesa->save();

		$familias = DB::select('select distinct familia.id, familia.nombre from familia inner join producto
	on familia.id = producto.familia_id inner join precio
	on producto.id = precio.producto_id inner join combinacion
	on combinacion.id = precio.combinacion_id inner join tipocomb
	on tipocomb.id = combinacion.TipoComb_id
where familia.nombre != ? and tipocomb.nombre = ?' , array('Adicionales','Normal'));

		$combinaciones = DB::select('select tipocomb.id as TipoCombinacionId, tipocomb.nombre as TipoCombinacionNombre, combinacion.id as CombinacionId, combinacion.nombre as CombinacionNombre, familia.nombre as FamiliaNombre, producto.id as ProductoId , producto.nombre as ProductoNombre, precio.precio as Precio from familia inner join producto
	on familia.id=producto.familia_id inner join precio
	on producto.id = precio.producto_id inner join combinacion
	on combinacion.id = precio.combinacion_id inner join tipocomb
	on tipocomb.id = combinacion.TipoComb_id
	where combinacion.FechaInicio <= curdate() and combinacion.FechaTermino >= curdate()
	and combinacion.HoraInicio <= curtime() and combinacion.HoraTermino >= curtime()
	and combinacion.nombre != ?
	' ,  array('Normal'));

		$restaurante = Restaurante::find(2);

		$salones = Salon::whereraw('restaurante_id='.$restaurante->id.' and habilitado=1')->get();;

		//print_r($menu_dia);
		//die();

		return View::make('pedidos.realizarPedido', compact('Opedido' , 'familias' , 'combinaciones', 'salones','platos'));
		}
	}

	/*Carga la mesa de un pedido abierto*/
	public function getCargarpedido($mesa_id){
		/*MESA*/
		//$mesa = Mesa::find(Input::get('mesa_id'));
		$platos = DetPedido::select('pedido.id', 'usuario.login', 'mesa.nombre', 
                        'producto.nombre as pnombre','detallepedido.combinacion_c', 
                        'detallepedido.ordenCocina', 'detallepedido.cantidad', 'detallepedido.id as detpedid',
                        'detallepedido.estado')
                        ->join('producto', 'producto.id','=', 'detallepedido.producto_id')
                        ->join('pedido', 'pedido.id','=', 'detallepedido.pedido_id')
                        ->join('usuario', 'usuario.id','=', 'pedido.usuario_id')
                        ->join('detmesa', 'detmesa.pedido_id','=', 'detallepedido.pedido_id')
                        ->join('mesa', 'mesa.id', '=', 'detmesa.mesa_id')
                        ->whereraw("usuario.id = ".Auth::user()->id." and detallepedido.estado != 'D'")
                        ->get();
		$mesa = Mesa::find($mesa_id);
		//$Opedido = $mesa->pedidos()->whereIn('pedido.estado',array('I','D'))->get();
		$Opedido = $mesa->pedidos()->whereIn('pedido.estado',array('I','D'))->first();
		/*Consulta para ver los productos de familia y combinaciones de un pedido . Odp= obj det pedido*/
		$Odp = DB::select('select producto.id, producto.nombre, detallepedido.estado, detallepedido.cantidad, 
			detallepedido.importeFinal, detallepedido.combinacion_id, detallepedido.combinacion_c, 
			detallepedido.combinacion_cant, detallepedido.id as iddetped, detallepedido.pedido_id,  
			detallepedido.ordenCocina from mesa inner join detmesa
			on mesa.id = detmesa.mesa_id inner join pedido
			on pedido.id = detmesa.pedido_id inner join detallepedido
			on pedido.id = detallepedido.pedido_id inner join producto	
			on producto.id = detallepedido.producto_id
		where pedido.id = ?
		order by detallepedido.id desc
		' , array($Opedido->id));
		/*fin*/
		//$Odp2 = json_encode($Odp);
		$familias = DB::select('select distinct familia.id, familia.nombre from familia inner join producto
	on familia.id = producto.familia_id inner join precio
	on producto.id = precio.producto_id inner join combinacion
	on combinacion.id = precio.combinacion_id inner join tipocomb
	on tipocomb.id = combinacion.TipoComb_id
	where familia.nombre != ? and tipocomb.nombre = ?' , array('Adicionales','Normal'));

		$combinaciones = DB::select('select tipocomb.id as TipoCombinacionId, tipocomb.nombre as TipoCombinacionNombre, combinacion.id as CombinacionId, combinacion.nombre as CombinacionNombre, familia.id as FamiliaId, familia.nombre as FamiliaNombre, producto.id as ProductoId , producto.nombre as ProductoNombre, precio.precio as Precio from familia inner join producto
	on familia.id=producto.familia_id inner join precio
	on producto.id = precio.producto_id inner join combinacion
	on combinacion.id = precio.combinacion_id inner join tipocomb
	on tipocomb.id = combinacion.TipoComb_id
	where combinacion.FechaInicio <= curdate() and combinacion.FechaTermino >= curdate()
	and combinacion.HoraInicio <= curtime() and combinacion.HoraTermino >= curtime()
	and combinacion.nombre != ?
	' ,  array('Normal'));

		//print_r($menu_dia);
		//die();

		$restaurante = Restaurante::find(2);

		$salones = Salon::whereraw('restaurante_id='.$restaurante->id.' and habilitado=1')->get();;

		return View::make('pedidos.realizarPedido', compact('Opedido' , 'familias' , 'combinaciones' , 'Odp' , 'salones', 'platos'));
	}

	/*Envia detalles de pedidos uno x uno*/
	public function postEnviarordenes(){
		$pedido = Input::get('pedido');
		$productos = Input::get('datos');
		$cocinas = Input::get('cocinas');
		$fecha = new DateTime();
		$orden = array();
		//$datitos1 = array();
		//$datitos2 = array();
		foreach ($productos as $datos) {
				$id_ped=$datos['id_ped'];
		if ($datos['tipo']=='f') {
			$producto = Producto::find($datos['id_prod']);
			foreach ($cocinas as $cocina) {
				$ococina = Areadeproduccion::find(substr($cocina, -1));
				if($ococina->id_tipo == $producto->id_tipoarepro){
					$areapro = substr($cocina, -1);
					$ordencocina = $ococina->ordennumber + 1;
				}
			}
			$ImprtFnl = $datos['precio']*$datos['cant'];
			$datitos1 = array(
				'pedido_id' => $datos['id_ped'],
				'producto_id' => $datos['id_prod'],
				'cantidad' => $datos['cant'],
				'ImporteFinal' => number_format($ImprtFnl,2),
				'estado' => 'I',
				'descuento' => 0,
				'idarea'=> $areapro, 
				'ordenCocina' => $ordencocina
				);
			$odetpe = DetPedido::create($datitos1);
			
			if(isset($datos['notas'])){
				$arraynotas = explode(',', substr($datos['notas'],1));
				$arrayinsertnotas = array( );
				foreach ($arraynotas as $anota) {
					$arrayinsertnotas[] = array('notas_id'=>$anota, 'detallePedido_id' => $odetpe->id);
				}

				Detallenotas::insert($arrayinsertnotas);
			}
		}elseif ($datos['tipo']=='c') {
			$id_prod=explode("-",$datos['id_prod'],-1);
			/*momentaneo solo 1 en valor de cantidad
			si cubre 2 frutimix de distintos sabores.. 2 frutimix d 1 mismo sabor no cumple
			*/
			$subprecio=explode("-",$datos['subprecio']);
			$cantidad=$datos['cant']; //cantidad de combinaciones..  no cantidad de productos de la comb
			$id_comb=$datos['id_comb'];
			$cont_comb_c = DB::select('select max(detallepedido.combinacion_c) as max from detallepedido
		where detallepedido.pedido_id = ? and detallepedido.combinacion_id=?', array($id_ped,$id_comb));
			foreach ($cont_comb_c as $ccc) {
				$cont_comb_c2 = $ccc->max;
			}
			if ($cont_comb_c2=='') {
				$cont_comb_c2 = 0;		
			}
			$cont_comb_c2 = $cont_comb_c2 + 1;
					for ($i=0; $i < count($id_prod) ; $i++) {
						$producto = Producto::find($id_prod[$i]);
						foreach ($cocinas as $cocina) {
							$ococina = Areadeproduccion::find(substr($cocina, -1));
							if($ococina->id_tipo == $producto->id_tipoarepro){
								$areapro = substr($cocina, -1);
								$ordencocina = $ococina->ordennumber + 1;
							}
						}
					$datitos2= array(
						'pedido_id' => $id_ped,
						'producto_id' => $id_prod[$i],
						'cantidad' => $cantidad,
						'ImporteFinal' => $subprecio[$i],
						'estado' => 'I',
						'descuento' => 0,
						'combinacion_id' => $id_comb,
						'combinacion_c' => $cont_comb_c2,
						'combinacion_cant' => $cantidad,
						'idarea'=> $areapro,
						'ordenCocina' => $ordencocina
						);
					DetPedido::insert($datitos2);
					}
						
		}
		}//fin foreach
		$j = 0;
		foreach ($cocinas as $cocina) {
			$max = DetPedido::whereraw("pedido_id = ".$pedido." 
				and idarea = ".substr($cocina, -1))->first();
			$ordenes = 0;
        	if(isset($max)){
            	$areap = Areadeproduccion::find(substr($cocina, -1));
        		$ordenes = $areap->ordennumber + 1;
        		$areap->ordennumber = $ordenes;
        		$areap->save();
           	}
           	$orden[] = array('cocina' => $cocina, 'orden'=> $ordenes);
           	$j++;
		}
		 return json_encode($orden);
	}

	public function getCancelarpedido($idpedido){

			$Opedido = Pedido::find($idpedido);
			$mnttl = Input::get('mnttl');
			//var_dump($mnttl);
			//die();
			return View::make('pedidos.cancelarPedido', compact('Opedido' , 'mnttl'));

	}

	public function postCancelarpedido($idpedido){

			$Opedido = Pedido::find($idpedido);
			//var_dump($Opedido);
			//die();
			$Omesa = $Opedido->mesas()->first();
			$ImprtFnl = Input::get('ImprtFnl');

			$Opedido->importeFinal = number_format($ImprtFnl,2);
			$Opedido->estado = 'T';
			$Opedido->save();

			$Omesa->estado = 'L';
			$Omesa->save();
			//var_dump($mnttl);
			//die();
			//return View::make('pedidos.cancelarPedido', compact('Opedido' , 'mnttl'));

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return View::make('pedidos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
        return View::make('pedidos.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
        return View::make('pedidos.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
		//
	}

}