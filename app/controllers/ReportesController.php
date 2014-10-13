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

	/**
	 * Display the specified resource.
	 * GET /reportes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /reportes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /reportes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /reportes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}