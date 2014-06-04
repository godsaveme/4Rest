<?php
class EventosController extends \BaseController {
	/**
	 * Display a listing of the resource.
	 * GET /eventos
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$eventos = Evento::all();
		return View::make('eventos.index', compact('eventos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /eventos/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$detcaja =  Detcaja::where('estado', '=', 'A')
					 ->where('usuario_id', '=', Auth::user()->id, 'AND')
					 ->first();
		$restaurantes = Restaurante::all()->lists('nombreComercial', 'id');
		return View::make('eventos.create', compact('restaurantes', 'detcaja'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /eventos
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$newpedido = Pedido::create(array('estado' => 'I', 'usuario_id' => Auth::user()->id));
		$newevento = Evento::create(Input::all() + array('pedido_id' => $newpedido->id));
		return Redirect::to('/eventos/cobrar/'.$newevento->id);
	}
	/**
	 * Display the specified resource.
	 * GET /eventos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getCobrar($id)
	{
		$detcaja =  Detcaja::where('estado', '=', 'A')
					 ->where('usuario_id', '=', Auth::user()->id, 'AND')
					 ->first();
		if(isset($id)){
			$evento = Evento::find($id);
			$cuenta = $evento->costo - $evento->ticketsevento()->sum('ticketventa.importe');
			if($cuenta == 0){
				return Redirect::to('/cajas');
			}
			return View::make('eventos.cobrarevento',compact('evento', 'cuenta', 'detcaja'));
		}else{
			Redirect::to('/cajas');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /eventos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postCobrar()
	{
		$idevento = Input::get('idevento');
		$evento = Evento::find($idevento);
		$detcaja =  Detcaja::where('estado', '=', 'A')
					 ->where('usuario_id', '=', Auth::user()->id, 'AND')
					 ->first();
		$restaurante = Restaurante::find(Auth::user()->id_restaurante);
		$datoscaja = Caja::find($detcaja->caja_id);
		$newnumero = $datoscaja->numero + 1;
		$datoscaja->numero = sprintf('%07d', $newnumero);
		$newdescuento =  0.00;
		$itotal = Input::get('costo');
		$igv =  $itotal * 0.18;
		$ipagado = Input::get('ipagado');
		$vuelto = Input::get('ivuelto');
		$osubtotal = $itotal - $igv;
		$newvuelto = $ipagado - $itotal; 

		if($newvuelto != $vuelto){
			Redirect::to('/cajas');
		}

		if ($vuelto < 0) {
			Redirect::to('/cajas');
		}

		$tickete = Ticket::create(array('descuento' => 0.00, 
								   'idescuento' => number_format($newdescuento, 2), 
								   'importe' => $itotal, 
								   'numero' => $newnumero, 
								   'serie' => $datoscaja->serie, 
								   'detcaja_id' => $detcaja->id, 
								   'caja_id' => $detcaja->caja_id, 
								   'pedido_id' => $evento->pedido_id, 
								   'vuelto' => $vuelto, 
								   'IGV' => number_format($igv, 2), 
								   'subtotal' => number_format($osubtotal, 2), 
								   'ipagado' => $ipagado));
		$iefectivo = $itotal;
		Detpedidotick::create(array('pedido_id' => $tickete->pedido_id,
						'ticket_id' => $tickete->id,
						'nombre' => Input::get('descripcion'),
						'precio'=>$itotal));
		Detevento::create(array('importe'=>$itotal,
					'descripcion'=> Input::get('descripcion'),
					'evento_id'=>$evento->id,
					'ticket_id'=>$tickete->id));
		$odetallestickete = $tickete->detallest;
		
		$token = sha1(microtime().'tk');
		$html = '<!doctype html>
                    <html lang="es">
                    <head>
                    <meta charset="UTF-8">
                    </head>
                    <style>
                        body{
                        	 width: 220px;
                             font-family: sans-serif;
                             font-size: 10px;
                             color: #000;
                        }
                        table{
                            width: 100%;
                            font-size: 11px;
                            border-bottom: 1px solid #000;
                        }
                        .importetotal{
                            font-size: 14px;
                            text-align: right;
                            font-weight: 900;
                            width: 100%;
                        }
                        .titulos{
                            border-bottom: 1px solid #000;
                        }
                        .head{
                            font-size: 16px;
                            font-weight: 900;
                        }
                        .subhead{
                            font-size: 14px;
                            font-weight: 900;
                        }
                        p {
                            padding: 0;
                            margin: 2px;
                        }
                        .datos{
                            width: 52px;
                        }
                        .productos td{
						line-height: 15px;
						text-align: left;
					    }
					   .container{
						height:auto;
					   }
					   .encabezado, .subencabezado{
					   	text-align: center;
					   	font-weight: 900;
					   	margin-left:-20px;
					   	width: 100%;
					   }
					   .subencabezado{
					   	font-size: 11px;
					   }
                    </style>
                    <body>
                    <div class="container">
                    <div class="encabezado">
                    <strong>KANGO CAFE</strong><br>
                    <strong>'.$restaurante->razonSocial.'</strong><br>
                    </div>
                    <div class="subencabezado">
                    <strong>RUC Nº '.$restaurante->ruc.'</strong><br>
                    <strong>'.$restaurante->direccion.'&nbsp;-&nbsp;'.$restaurante->provincia.'
                     &nbsp;-&nbsp;'.$restaurante->departamento.'</strong><br>
                    <strong>Ticket:&nbsp;'.sprintf('%07d', $tickete->numero).' &nbsp;&nbsp;Serie:&nbsp;'.$tickete->serie.'</strong><br>
                    <strong>Fecha:'.date('d-m-Y').'&nbsp;&nbsp;Hora:'.date('H:i:s').'</strong>
   					</div>
                    <br>
                    <table>
                        <tr>
                            <td style="width: 120px">Descripcion</td>
                            <td style="width: 25px;text-align: right">P.Uni.</td>
                            <td style="width: 15px; text-align: right">Cant.</td>
                            <td style="width: 50px;text-align: right">S/.</td>
                        </tr>
                    </table>
                    <table style="width:220px">';
		$newtamaño = 4*count($odetallestickete);
		foreach ($odetallestickete as $predato) {
			$html .= '<tr class="productos">
                        <td style="width: 115px">'.substr($predato['nombre'], 0, 14).'.</td>
                        <td style="width: 25px;text-align: right">'.$predato['preciou'].'</td>
                        <td style="width: 15px; text-align: right">'.$predato['cantidad'].'</td>
                        <td style="width: 55px;text-align: right">'.$predato['precio'].'</td>
                    </tr>';
		}
		$html .= '</table>
                    <table style="border: none">
                        <tr>
                        <td style="width: 110px">Descuento S/.</td>
                        <td style="width:110px; text-align: right">-'.$tickete->idescuento.'</td>
                        </tr>
                        <tr>
                        <td style="width: 110px">&nbsp;</td>
                        <td style="width:110px; text-align: right">&nbsp;</td>
                        </tr>
                        <tr>
                        <td style="width: 110px">Subtotal S/.</td>
                        <td style="width:110px; text-align: right">'.$tickete->subtotal.'</td>
                        </tr>
                        <tr>
                        <td style="width: 110px">IGV S/.</td>
                        <td style="width:110px; text-align: right">'.$tickete->IGV.'</td>
                        </tr>
                        <tr>
                        <td style="width: 110px">Total S/.</td>
                        <td style="width:110px; text-align: right;font-weight: bold;">'.$tickete->importe.'</td>
                        </tr>
                    </table>
                    <br>
                    <table style="border: none">
                        <tr>
                            <td class="datos">Cliente</td>
                            <td>'.Input::get('nombre').'</td>
                        </tr>
                        <tr>
                            <td class="datos">DNI/RUC</td>
                            <td>'.Input::get('documento').'</td>
                        </tr>
                        <tr>
                            <td class="datos">Dirección</td>
                            <td>'.Input::get('direccion').'</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table style="border: none">
                        <tr>
                        <td style="width: 110px">Importe Pagado S/.</td>
                        <td style="width:110px; text-align: right">'.$tickete->ipagado.'</td>
                        </tr>
                        <tr>
                        <td style="width: 110px">Vuelto S/. </td>
                        <td style="width:110px; text-align: right">'.$tickete->vuelto.'</td>
                        </tr>
                        <tr>
                        <td style="width: 110px">Mesa Atendida</td>
                        <td style="width:110px;">: - </td>
                        </tr>
                        <tr>
                        <td style="width: 110px">Atendido por</td>
                        <td style="width:110px;">: - </td>
                        </tr>
                        <tr>
                        <td style="width: 110px">Cajero:</td>
                        <td style="width:110px;">: '.Auth::user()->login.'</td>
                        </tr>
                    </table>
                    </div>
                    </body>
                    </html>';
        $headers = array('Content-Type' => 'application/pdf', );
		$pdfPath = TIKET_DIR.$token.'.pdf';
		$tamaño = 125+$newtamaño;
		$html2pdf = new HTML2PDF('V', array('72', $tamaño), 'fr', true, 'UTF-8', 0);
		$html2pdf->WriteHTML($html);
		$html2pdf->Output($pdfPath, 'F');
		$cmd = "lpr -P".$datoscaja->impresora." ";
		$cmd .= $pdfPath;
		$response = shell_exec($cmd);
		File::delete($pdfPath);
		if ($iefectivo > 0) {
		$oefectivo = Detformadpago::create(array('importe' => $iefectivo, 'ticket_id' => $tickete->id, 'formadepago_id' => 1));
		}
		$datoscaja->save();
		if($evento->costo == $evento->ticketsevento()->sum('ticketventa.importe')){
			$evento->estado = 1;
			$evento->save();
		}
		return Redirect::to('/cajas');
	}
	/**
	 * Update the specified resource in storage.
	 * PUT /eventos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getListareventoscaja()
	{
		$detcaja =  Detcaja::where('estado', '=', 'A')
					 ->where('usuario_id', '=', Auth::user()->id, 'AND')
					 ->first();
		$eventos = Evento::all();
		$i = 1;
		return View::make('eventos.listareventoscaja', compact('eventos', 'i', 'detcaja'));
	}

}