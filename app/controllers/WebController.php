<?php

class WebController extends BaseController {

	public function getIndex()
	{
		/*$perfiln = Auth::user()->persona->perfil->nombre;
		if( $perfiln == 'Caja'){
			return Redirect::to('/cajas/index');
		}elseif ($perfiln == 'Mozo') {
			return Redirect::to('/pedidoscomanda');
		}elseif ($perfiln == 'Cocina') {
			return Redirect::to('/cocina');
		}elseif ($perfiln == 'MozoTablet') {
			return Redirect::to('/pedidos');
		}else{
			return View::make('web.index');
		}*/


        $arraydatos1 = array();
        $arraydatos2 = array();


            //$idrest = 2; modi
            $fechaInicio  = date("Y-m-d");
            $fechaFin  = date("Y-m-d");
            //$restaurante = Restaurante::find($idrest); modi

            $restaurantes = Restaurante::all();
        $c1 = 0;
        $c2 = 0;

        if(count($restaurantes) > 0) {

            foreach ($restaurantes as $restaurante) {


                $cajas = $restaurante->cajas;

                //print_r($CajasenCurso->toJson());


                foreach ($cajas as $x) {
                    $CajasenCurso = $x->detallecaja()
                        ->where('estado', '=', 'A')
                        ->get();

                    foreach ($CajasenCurso as $CajaenCurso) {
                        $usuario = Usuario::find($CajaenCurso->usuario_id);
                        $fechaInicio = $CajaenCurso->fechaInicio;
                        $totaltickets = $CajaenCurso->tickets()->count();
                        $tickets = $CajaenCurso->tickets()->where('ticketventa.estado', '=', 0)
                            ->where('ticketventa.importe', '>=', 0)->get();
                        $totalproductosvendidos = 0;
                        foreach ($tickets as $tickete) {
                            $totalproductosvendidos = $totalproductosvendidos + $tickete->detallest()->sum('cantidad');
                        }
                        $totalventas1 = $CajaenCurso->tickets()->where('ticketventa.estado', '=', 0)
                            ->where('ticketventa.importe', '>=', 0)->sum('importe');


                        $arraydatos1[$c1] = array('caja' => $x->descripcion,
                            'usuario' => $usuario->login,
                            'fechaInicio' => $fechaInicio,
                            'totalTickets' => $totaltickets,
                            'totalProductos' => $totalproductosvendidos,
                            'ventaNeta' => $totalventas1
                        );
                        $c1++;

                        //print_r($arraydatos1);
                        //die();
                    }


                }

                //return View::make('web.index',compact('arrDatos'));


                foreach ($cajas as $x) {
                    $CajasUltimas = $x->detallecaja()
                        ->where('estado', '=', 'C')
                        ->orderBy('fechaInicio', 'DESC')
                        ->first();

 		 if(!empty($CajasUltimas)){


                    //foreach ($CajasenCurso as $CajaenCurso) {
                    $usuario = Usuario::find($CajasUltimas->usuario_id);
                    $fechaInicio = $CajasUltimas->fechaInicio;
                    $fechaCierre = $CajasUltimas->fechaCierre;
                    $totaltickets = $CajasUltimas->tickets()->count();
                    $tickets = $CajasUltimas->tickets()->where('ticketventa.estado', '=', 0)
                        ->where('ticketventa.importe', '>=', 0)->get();
                    $totalproductosvendidos = 0;
                    foreach ($tickets as $tickete) {
                        $totalproductosvendidos = $totalproductosvendidos + $tickete->detallest()->sum('cantidad');
                    }
                    $totalventas1 = $CajasUltimas->tickets()->where('ticketventa.estado', '=', 0)
                        ->where('ticketventa.importe', '>=', 0)->sum('importe');


                    $arraydatos2[$c2] = array('caja' => $x->descripcion,
                        'usuario' => $usuario->login,
                        'fechaInicio' => $fechaInicio,
                        'fechaCierre' => $fechaCierre,
                        'totalTickets' => $totaltickets,
                        'totalProductos' => $totalproductosvendidos,
                        'ventaNeta' => $totalventas1
                    );
                    $c2 = $c2 + 1;

                    //print_r($c2);
                    //print_r($arraydatos2);
                    //}
		} //empty

                }
            }
        }

             //die();

            //print_r(count($cajas));
            //die();
            /*$arraydatos = array();
            $contador = 0;
            foreach ($cajas as $cdato) {
                $cajones = $cdato->detallecaja()
                    ->whereBetween('FechaInicio', array($fechaInicio.' 00:00:00', $fechaFin.' 23:59:59'))
                    ->orderby('FechaInicio')
                    ->get();
                foreach ($cajones as $cajon) {
                    $usuario = Usuario::find($cajon->usuario_id);
                    $totaltickets = $cajon->tickets()->count();
                    $totalanulados = $cajon->tickets()->where('ticketventa.estado', '=', 1)->count();
                    $totaldescuentos = $cajon->tickets()->where('ticketventa.estado', '=', 0)
                        ->where('ticketventa.importe', '>=', 0)->sum('idescuento');
                    // no cuenta anulados ni tickets en monto negativo
                    $totalventas1 = $cajon->tickets()->where('ticketventa.estado', '=', 0)
                        ->where('ticketventa.importe', '>=', 0)->sum('importe');
                    $tickets = $cajon->tickets()->where('ticketventa.estado', '=', 0)
                        ->where('ticketventa.importe', '>=', 0)->get();
                    $ticketinicial = $cajon->tickets()->orderby('id', 'asc')->first();
                    $ticketfinal = $cajon->tickets()->orderby('id', 'desc')->first();
                    $efectivo = 0;
                    $tarjeta = 0;
                    $vale = 0;
                    $dsctoAut = 0;
                    $imProm = 0;
                    $totalproductosvendidos = 0;
                    foreach ($tickets as $tickete) {
                        $totalproductosvendidos = $totalproductosvendidos+$tickete->detallest()->sum('cantidad');
                    }

                    foreach ($tickets as $tickete) {
                        $oefect = $tickete->tipopago()
                            ->where('formadepago_id', '=', 1)
                            ->sum('importe');
                        if ($oefect > $tickete->importe) {
                            $oefect = $tickete->importe;
                        }
                        $newefec = $efectivo+$oefect;
                        $efectivo = round($newefec, 2);
                    }

                    foreach ($tickets as $tickete) {
                        $oefect = $tickete->tipopago()->where('formadepago_id', '=', 2)->sum('importe');
                        if ($oefect > $tickete->importe) {
                            $oefect = $tickete->importe;
                        }
                        $newefec = $tarjeta+$oefect;
                        $tarjeta = round($newefec, 2);
                    }

                    foreach ($tickets as $tickete) {
                        $oefect = $tickete->tipopago()->where('formadepago_id', '=', 3)->sum('importe');
                        $newefec = $dsctoAut+$oefect;
                        $dsctoAut = round($newefec, 2);
                    }

                    foreach ($tickets as $tickete) {
                        $oefect = $tickete->tipopago()->where('formadepago_id','=',4)->sum('importe');
                        $newefec = $vale+$oefect;
                        $vale = round($newefec, 2);
                    }

                    foreach ($tickets as $tickete) {
                        //$oefect = $tickete->tipopago()->where('formadepago_id','=',5)->sum('idescuento');
                        $oefect = $tickete->tipopago()->join('ticketventa','ticketventa.id','=','Detformadepago.ticket_id')
                            ->where('Detformadepago.formadepago_id','=',5)->sum('idescuento');
                        $newefec = $imProm+$oefect;
                        $imProm = round($newefec, 2);
                    }

                    //print_r($imProm); die();

                    if ($totaltickets > 0) {
                        $arraydatos[] = array('usuario' => $usuario->login,
                            'totaltickets'                 => $totaltickets,
                            'totalanulados'                => $totalanulados,
                            'totalefectivo'                => number_format($efectivo, 2, '.', ''),
                            'totaltarjeta'                 => number_format($tarjeta, 2, '.', ''),
                            'totaldsctoAut'                    => number_format($dsctoAut, 2, '.', ''),
                            'totalvale'						=> number_format($vale, 2, '.',''),
                            'totalImProm'					=> number_format($imProm,2,'.',''),
                            'totaldescuentos'              => $totaldescuentos,
                            'fondodecaja'                  => $cajon->montoInicial,
                            'totalventas'                  => $totalventas1,
                            'turno'                        => substr($cajon->fechaInicio, -8, -3).'/'.
                                substr($cajon->fechaCierre, -8, -3),
                            'arqueo'       => $cajon->arqueo,
                            'tproductos'   => $totalproductosvendidos,
                            'tinicial'     => $ticketinicial->numero,
                            'tfinal'       => $ticketfinal->numero,
                            'id'           => $contador,
                            'ingresoscaja' => $cajon->totalingresosacaja,
                            'dif'          => $cajon->diferencia,
                            'gastos'       => $cajon->gastos,
                            'caja'         => $cajon->importetotal,
                            'cajaid'       => $cajon->id);
                    } else {
                        $arraydatos[] = array('usuario' => $usuario->login,
                            'totaltickets'                 => $totaltickets,
                            'totalanulados'                => $totalanulados,
                            'totalefectivo'                => number_format($efectivo, 2, '.', ''),
                            'totaltarjeta'                 => number_format($tarjeta, 2, '.', ''),
                            'totaldsctoAut'                    => number_format($dsctoAut, 2, '.', ''),
                            'totalvale'						=> number_format($vale, 2, '.',''),
                            'totalImProm'					=> number_format($imProm,2,'.',''),
                            'totaldescuentos'              => 0.00,
                            'fondodecaja'                  => $cajon->montoInicial,
                            'totalventas'                  => $cajon->ventastotales,
                            'turno'                        => substr($cajon->fechaInicio, -8).'/'.
                                substr($cajon->fechaCierre, -8),
                            'arqueo'       => $cajon->arqueo,
                            'tproductos'   => $totalproductosvendidos,
                            'tinicial'     => 0,
                            'tfinal'       => 0,
                            'id'           => $contador,
                            'ingresoscaja' => $cajon->totalingresosacaja,
                            'dif'          => $cajon->diferencia,
                            'gastos'       => $cajon->gastos,
                            'caja'         => $cajon->importetotal,
                            'cajaid'       => $cajon->id);
                    }

                    $contador++;
                }
            }
            //return Response::json($arraydatos);
            */

        //print_r($arraydatos2);
        //die();

		return View::make('web.index',compact('arraydatos1','arraydatos2'));
	}

}
