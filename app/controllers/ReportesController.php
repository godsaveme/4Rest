<?php

class ReportesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /reportes
	 *
	 * @return Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /reportes/create
	 *
	 * @return Response
	 */
	public function getReportesemanal($id = NULL) {
		if (isset($id)) {
			$restaurante = Restaurante::find($id);
			return View::make('reportes.rotacionsemanal', compact('restaurante'));
		} else {
			return Redirect::to('/web');
		}
	}

	public function getReporteproductos($id = NULL) {
		if (isset($id)) {
			$tipoc       = Input::get('tipoc');
			//print_r($tipoc);
			//die();
			$restaurante = Restaurante::find($id);
			$fechaInicio = Input::get('fechainicio');
			$fechaFin    = Input::get('fechafin');
			switch ($tipoc) {
				case '1':
					$productos = DB::select(DB::raw("SELECT fnombre,tipocombid,sum(precio) AS precio,
								sum(cantidad) AS cantidad FROM table_productostipocombinacion WHERE
								created_at BETWEEN '"	.$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'
								AND idrest = "	.$id." GROUP BY tipocombid ORDER BY precio DESC"));
					$cantidad   = 0;
					$montototal = 0;
					foreach ($productos as $producto) {
						$cantidad   = $cantidad+$producto->cantidad;
						$montototal = $montototal+$producto->precio;
					}
					if (null !==Session::get('tipoc')) {
						$tipoc = 4;
					}
					return View::make('reportes.reporteproductos', compact('productos', 'fechaInicio', 'fechaFin',
							'restaurante', 'cantidad', 'montototal', 'tipoc'));
					break;
				case '2':
					$idtipocomb = Input::get('tipocombi');
					$productos  = DB::select(DB::raw("SELECT fnombre,tipocombid,famiid, combinacion_id,sum(precio) AS precio,
								sum(cantidad) AS cantidad FROM table_productosfamilias WHERE created_at
								BETWEEN '"	.$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59' AND
								idrest = "	.$id." AND tipocombid = ".$idtipocomb." GROUP BY famiid,combinacion_id
								ORDER BY precio DESC"	));
					$cantidad   = 0;
					$montototal = 0;
					foreach ($productos as $producto) {
						$cantidad   = $cantidad+$producto->cantidad;
						$montototal = $montototal+$producto->precio;
					}
					return View::make('reportes.reporteproductos', compact('productos', 'fechaInicio', 'fechaFin',
							'restaurante', 'cantidad', 'montototal', 'tipoc'));
					break;
				case '3':
					$idtipocomb = Input::get('tipocombi');
					$idfam      = Input::get('famiid');
					$productos  = DB::select(DB::raw("SELECT fnombre, producto_id,sum(precio) AS precio,
								sum(cantidad) AS cantidad FROM table_productos WHERE created_at
								BETWEEN '"	.$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'
								AND idrest = "	.$id." AND famiid = ".$idfam." GROUP BY producto_id
								ORDER BY precio DESC"	));
					$cantidad   = 0;
					$montototal = 0;
					foreach ($productos as $producto) {
						$cantidad   = $cantidad+$producto->cantidad;
						$montototal = $montototal+$producto->precio;
					}
					return View::make('reportes.reporteproductos', compact('productos', 'fechaInicio', 'fechaFin',
							'restaurante', 'cantidad', 'montototal', 'tipoc', 'idtipocomb'));
					break;
				case '4':
					$productos = DB::select(DB::raw("SELECT fnombre,tipocombid,sum(precio) AS precio,
								sum(cantidad) AS cantidad FROM table_productostipocombinacion WHERE
								created_at BETWEEN '"	.$fechaInicio." 00:00:00' AND '".$fechaFin." 23:59:59'
								AND idrest = "	.$id." GROUP BY tipocombid ORDER BY precio DESC"));
					$cantidad   = 0;
					$montototal = 0;
					foreach ($productos as $producto) {
						$cantidad   = $cantidad+$producto->cantidad;
						$montototal = $montototal+$producto->precio;
					}
					Session::put('tipoc',4);
					return View::make('reportes.reporteproductos', compact('productos', 'fechaInicio', 'fechaFin',
							'restaurante', 'cantidad', 'montototal', 'tipoc'));
					break;
				default:
					return View::make('reportes.reporteproductos', compact('fechaInicio', 'fechaFin',
							'restaurante'));
			}
		} else {
			return Redirect::to('/web');
		}
	}

	public function getReporteventa($id=NULL){
		if (isset($id)) {
			$fecha = Input::get('fecha');
			$restaurante = Restaurante::find($id);
			if (isset($fecha)) {
				$cajas = $restaurante->cajas()->with(['tickets'=>function($q) use ($fecha){
								$q->whereBetween('created_at',[$fecha.' 00:00:00', $fecha.' 23:59:59']);
								$q->where('ticketventa.importe', '>=', 0);
								$q->get();
							},'tickets.tipopago'])->get();
				$datos = ['totalventas'=>0,
							'totaldescuentos'=>0,
							'efectivo'=>0,
							'tarjeta'=>0,
							'descuentoautorizado'=>0,
							'valepersonal'=>0,
							'promocion'=>0,
							'anulados'=>0,
							'totaltickets'=>0];
				foreach ($cajas as $caja) {
					foreach ($caja->tickets as $ticket) {
						if ($ticket->estado == 0) {
							$datos['totalventas'] = $datos['totalventas'] + $ticket->importe;
							$datos['totaldescuentos'] = $datos['totaldescuentos'] + $ticket->idescuento;
							foreach ($ticket->tipopago as $formapago) {
								if ($formapago->id == 1) {
									$datos['efectivo'] = $datos['efectivo'] + $formapago->pivot->importe;
								}elseif ($formapago->id == 2) {
									$datos['tarjeta'] = $datos['tarjeta'] + $formapago->pivot->importe;
								}elseif ($formapago->id == 3) {
									$datos['descuentoautorizado'] = $datos['descuentoautorizado'] + $formapago->pivot->importe;
								}elseif ($formapago->id == 4) {
									$datos['valepersonal'] = $datos['valepersonal'] + $formapago->pivot->importe;
								}elseif ($formapago->id == 5) {
									$datos['promocion'] = $datos['promocion'] + $formapago->pivot->importe;
								}
							}
 						}elseif ($ticket->estado == 1) {
							$datos['anulados'] = $datos['anulados'] + 1;
						}
						$datos['totaltickets'] = $datos['totaltickets'] + 1;
					}
				}
			}
			return View::make('reportes.venta', compact('restaurante', 'datos'));
		}else{
			return Redirect::back();
		}
	}

    public function getValesDescuentos($id = null){
        $fechaInicio = Input::get('fechainicio');
		$fechaFin    = Input::get('fechafin');
        if(isset($id)){
            $restaurante = Restaurante::find($id);
            if(isset($fechaInicio) && isset($fechaFin)){
                $personas = Persona::has('tickets')->with(['tickets'=> function($q) use($fechaInicio, $fechaFin){
                    $q->whereBetween('created_at',[$fechaInicio.' 00:00:00',$fechaFin.' 23:59:59']);
                },'tickets.tipopago'])
                    /*->where('ruc','=',null)*/
                ->get();
                return View::make('reportes.vales-descuentos',compact('personas', 'restaurante','fechaInicio','fechaFin'));
            }else{
                $personas = array();
                return View::make('reportes.vales-descuentos',compact('personas', 'restaurante','fechaInicio','fechaFin'));
            }
        }else{
            return Redirect::back();
        }
    }

    public function getPersonaVales($id){
        $fechaInicio = Input::get('fechainicio');
        $fechaFin    = Input::get('fechafin');
        if(isset($id) && isset($fechaFin) && isset($fechaInicio)){
            $persona = Persona::find($id);
            $tickets = $persona->tickets()->whereBetween('created_at',[$fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'])
                        ->with(['tipopago'])
                        ->get();
            return View::make('reportes.tickets-vales-persona',compact('persona','tickets','fechaInicio','fechaFin'));
        }else{
            return Redirect::back();
        }
    }

    public function getPersonaDescuentosAutorizados($id){
        $fechaInicio = Input::get('fechainicio');
        $fechaFin    = Input::get('fechafin');
        if(isset($id) && isset($fechaFin) && isset($fechaInicio)){
            $persona = Persona::find($id);
            $tickets = $persona->tickets()->whereBetween('created_at',[$fechaInicio.' 00:00:00',$fechaFin.' 23:59:59'])
                ->with(['tipopago'])
                ->get();
            return View::make('reportes.tickets-descuentos-persona',compact('persona','tickets','fechaInicio','fechaFin'));
        }else{
            return Redirect::back();
        }
    }
}