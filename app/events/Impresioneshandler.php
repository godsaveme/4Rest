<?php
	/**
	* 
	*/
	class Impresioneshandler
	{
		CONST ENCABEZADOHTML = '<!doctype html>
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
						            .productos td
						            {
						            	line-height: 15px;
						            	text-align: left;
						            }
						           .container{
						        	height:auto;
						           }
						           .encabezado, .subencabezado{
						           	text-align: center;
						           	font-weight: 900;
						           	margin-left:-10px;
						           	width: 100%;
						           }
						           .subencabezado {
						           	font-size: 11px;
						           }
						        </style>
						    <body>';

		public function imprimirpedidos($datos, $mozoid, $idmesa,$cocinas){
			$i = 0;
			$infomozo = Usuario::find($mozoid);
			$infomesa = Mesa::find($idmesa);
			foreach ($cocinas as $datococinas) {
				$html = self::ENCABEZADOHTML.'<div class="container">
						            <div class="encabezado">
						                '.substr($datococinas,0,-2).'
						            </div>
						            <div class="subencabezado">
						                Fecha: '.date('d-m-Y').' - Hora: '.date('H:i:s').'
						            </div>
						            <table>
						                <tr>
						                    <td style="width: 110px">Mesa:</td>
						                    <td style="width: 110px">'.$infomesa->nombre.'</td>
						                </tr>
						                <tr>
						                    <td style="width: 110px">Mozo:</td>
						                    <td style="width: 110px">'.$infomozo->login.'</td>
						                </tr>
						            </table>
						            <table>
						                <tr>
						                    <td style="width: 15px; text-align: center">
						                        Cant.
						                    </td>
						                    <td style="width: 195px; text-align: center">
						                        Descripcion
						                    </td>
						                </tr>
						            </table>
						            <table>';
					if (!empty($datos[$datococinas])) {
						foreach ($datos[$datococinas] as $dato) {
							$html .= '<tr>';
							$html .= '<td style="width: 20px">'.$dato['cantidad'].'</td>';
							$html .= '<td style="width: 190px">'.$dato['nombre'].'<br>';
							if(isset($dato['sabores'])){
								foreach ($dato['sabores'] as $sabor) {
									$html .= '/'.$sabor['nombre'];
								}
							}
							if(isset($dato['notas'])){
								foreach ($dato['notas'] as $nota) {
									$html .= '/'.$nota['nombre'];
								}
							}
							$html .= '<br>';
							if(isset($dato['adicionales'])){
								foreach ($dato['adicionales'] as $adi) {
									$html .= '*'.$adi['nombre'].' x '.$adi['cantidad'].'<br>';
								}
							}
							$html .= '</td>';
							$html .= '</tr>';
						}
					}

					$html .= '</table>
							        </div>
							    </body>
							</html>';

					//if(Auth::user()->id_restaurante == 2){
						if (!empty($datos[$datococinas])) {
							$ococina = Areadeproduccion::find(substr($datococinas, -1));
							$token = sha1(microtime().'tk');
							$pdfPatd = TIKET_DIR.$token.$i.'.pdf';
							$tamaño = 110;
							$html2pdf = new HTML2PDF('V', array('72', $tamaño), 'fr', true, 'UTF-8', 0);
							$html2pdf->WriteHTML($html);
							$html2pdf->Output($pdfPatd, 'F');
							$cmd = "lpr -P".$ococina->impresora." ";
							$cmd .= $pdfPatd;
							$response = shell_exec($cmd);
							$i = $i +1;
							//File::delete($pdfPatd);
						}
					//}
			}
		}

		public function imprimirreportediariocaja($datos){
			$html = self::ENCABEZADOHTML.'<div class="container">
						            <div class="encabezado">
						                REPORTE DIARIO CAJA
						            </div>
						            <div class="subencabezado">
						                Día: '.$datos['fecha'].'
						            </div>
						            <div class="subencabezado">
						                '.$datos['rango'].'
						            </div>
						            <table>
						                 <tr>
				                            <td style="width:110px">Total Efectivo</td>
				                            <td style="width:100px" class="text-right">
				                            '.$datos['totalefectivo'].'
				                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Tarjeta</td>
					                            <td style="width:100px" class="text-right">
					                            '.$datos['totaltarjeta'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Importe Prom.</td>
					                            <td style="width:100px" class="text-right">
					                            '.$datos['totalimprom'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Vale</td>
					                            <td style="width:100px" class="text-right" id="totalvale">
					                            '.$datos['totalvale'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Dscto Aut.</td>
					                            <td style="width:100px" class="text-right" id="totalvale">
					                            '.$datos['totaldsctoaut'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Dsctos</td>
					                            <td style="width:100px" class="text-right" id="totalvale">
					                            '.$datos['totaldscto'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Venta Neta</td>
					                            <td style="width:100px" class="text-right" id="totalventas">
					                            '.$datos['totalventas'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Abonos Caja</td>
					                            <td style="width:100px" class="text-right" id="totalabonosacaja">
					                            '.$datos['totalabonosacaja'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Gastos</td>
					                            <td style="width:100px" class="text-right" id="totalgastos">
					                            '.$datos['totalgastos'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Caja</td>
					                            <td style="width:100px" class="text-right" id="totalcaja">
					                            '.$datos['totalcaja'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px" id="arqueo">Arqueo</td>
					                            <td style="width:100px" class="text-right">
					                            '.$datos['arqueo'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px" id="diferencia">Diferencia</td>
					                            <td style="width:100px" class="text-right">
					                            '.$datos['diferencia'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px" id="temitidos">Tickets Emitidos</td>
					                            <td style="width:100px" class="text-right">
					                            '.$datos['emitidos'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px" id="tanulados">Tickets Anulados</td>
					                            <td style="width:100px" class="text-right">
					                            '.$datos['anulados'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px" id="pvendidos">Productos Vendidos</td>
					                            <td style="width:100px" class="text-right">
					                            '.$datos['pvendidos'].'
					                            </td>
					                        </tr>
						            </table>';
			$html .= '</div> </body>
							</html>';
			$token = sha1(microtime().'tk');
			$pdfPatd = TIKET_DIR.$token.'.pdf';
			$tamaño = 110;
			$html2pdf = new HTML2PDF('V', array('72', $tamaño), 'fr', true, 'UTF-8', 0);
			$html2pdf->WriteHTML($html);
			$html2pdf->Output($pdfPatd, 'F');
			$cmd = "lpr -P barra ";
			//$cmd = "lpr -P HP_Photosmart_Plus_B209a-m ";
			$cmd .= $pdfPatd;
			$response = shell_exec($cmd);
			//File::delete($pdfPatd);
		}

		public function imprimir_ticketcaja($odetallestickete,$restaurante,$tickete, 
											$cliente,$nombremesa, $nombremozo, $cajero,$impresora){
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
	                                <strong></strong><br>
	                                <strong>'.$restaurante->nombreComercial.'</strong><br>
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
	                                        <td>'.$cliente['nombres'].'</td>
	                                    </tr>
	                                    <tr>
	                                        <td class="datos">DNI/RUC</td>
	                                        <td>'.$cliente['dni'].'</td>
	                                    </tr>
	                                    <tr>
	                                        <td class="datos">Dirección</td>
	                                        <td>'.$cliente['direccion'].'</td>
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
	                                    <td style="width:110px;">: '.$nombremesa.'</td>
	                                    </tr>
	                                    <tr>
	                                    <td style="width: 110px">Atendido por</td>
	                                    <td style="width:110px;">: '.$nombremozo.'</td>
	                                    </tr>
	                                    <tr>
	                                    <td style="width: 110px">Cajero:</td>
	                                    <td style="width:110px;">: '.$cajero.'</td>
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
			$cmd = "lpr -P".$impresora." ";
			$cmd .= $pdfPath;
			$response = shell_exec($cmd);
			//File::delete($pdfPath);
		}
	}