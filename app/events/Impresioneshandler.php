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

					if(Auth::user()->id_restaurante == 2){
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
						}
					}
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
					                            <td style="width:110px">Total Vale</td>
					                            <td style="width:100px" class="text-right" id="totalvale">
					                            '.$datos['totalvale'].'
					                            </td>
					                        </tr>
					                        <tr>
					                            <td style="width:110px">Total Ventas</td>
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
			$cmd = "lpr -Pbarraeliasa ";
			$cmd .= $pdfPatd;
			$response = shell_exec($cmd);
			File::delete($pdfPatd);
		}
	}