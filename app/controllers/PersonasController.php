<?php

class PersonasController extends BaseController {

	public function getIndex()
	{
		$personas = Persona::where('razonSocial', '=', NULL)->leftJoin('perfil', 'perfil.id', '=', 'persona.perfil_id')
		->select('persona.id', 'persona.nombres', 'persona.apPaterno', 'persona.apMaterno','perfil.nombre as PerfilNombre')->get();
        return View::make('personas.index', compact('personas'));
	}

	public function getEmpresas()
	{
		$empresas = Persona::where('nombres', '=', NULL)->leftJoin('perfil', 'perfil.id', '=', 'persona.perfil_id')
		->select('persona.id', 'persona.razonSocial','perfil.nombre as PerfilNombre')->get();
        return View::make('personas.indexem', compact('empresas'));
	}

	public function getCreate()
	{
		//$departamentos = Ubigeo::select()->groupBy('CodDpto')->orderBy('Nombre','ASC')->get();
		$perfiles = Perfil::select()->where('nombre', '!=', 'Empresa cliente')->get();
        return View::make('personas.create', compact('departamentos','perfiles'));
	}
	public function getCreateempresas()
	{
		//$departamentos = Ubigeo::select()->groupBy('departamento')->get();
		$perfiles = Perfil::select()->where('nombre', '=', 'Empresa cliente')->get();
        return View::make('personas.createem', compact('departamentos','perfiles'));
	}


	public function postStore()
	{
		DB::beginTransaction();	
		try {
				$persona = Persona::create(Input::all());
				DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/personas'));
	}

	public function postStoreem()
	{
		DB::beginTransaction();	
		try {
			$persona = Persona::create(Input::all());
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/personas/empresas'));
	}


	public function show($id)
	{
        return View::make('personas.show');
	}

	
	public function getEdit($id)
	{
		$persona = Persona::find($id);
        if($persona->pais == 'Perú') {
            $departamentos = Ubigeo::select()->groupBy('CodDpto')->orderBy('Nombre', 'ASC')->lists('Nombre', 'CodDpto');
            if(count($persona->departamento) >0 and !empty($persona->departamento)) {
                $provincias = Ubigeo::select()->groupBy('CodProv')->orderBy('Nombre', 'ASC')
                    ->where('CodDpto', '=', $persona->departamento)
                    ->where('CodProv', '!=', 0)
                    ->lists('Nombre', 'CodProv');

            }else{
                $provincias = array('0' => 'Seleccione Prov');
            }

            if(count($persona->provincia) >0 and $persona->provincia != 'NULL'){
                $distritos = Ubigeo::select()->groupBy('CodDist')->orderBy('Nombre','ASC')
                    ->where('CodProv','=',$persona->provincia)
                    ->where('CodDpto','=',$persona->departamento)
                    ->where('CodDist','!=',0)
                    ->lists('Nombre', 'CodDist');

            }else{
                $distritos = array('0' => 'Seleccione Dist');
            }


        }else{
            $departamentos = array('0' => 'Seleccione Dpto');
            $provincias = array('0' => 'Seleccione Prov');
            $distritos = array('0' => 'Seleccione Dist');
        }

		$perfiles = Perfil::select()->where('nombre', '!=', 'Empresa cliente')->get();
        return View::make('personas.edit', compact('persona','departamentos','provincias','distritos', 'perfiles'));
	}

	public function getEditem($id)
	{
		$empresa = Persona::find($id);
		$departamentos = Ubigeo::select()->groupBy('CodDpto')->orderBy('Nombre','ASC')->get();
        /*$provincias = Ubigeo::select()->groupBy('CodProv')->orderBy('Nombre','ASC')
            ->where('CodDpto','=',$empresa->departamento)
            ->where('CodProv','!=',0)
            ->get();*/
		$perfiles = Perfil::select()->where('nombre', '=', 'Empresa cliente')->get();
        return View::make('personas.editem', compact('empresa','departamentos','provincias','distritos', 'perfiles'));
	}


	public function postEdit()
	{
		DB::beginTransaction();	

		try {
		$persona = Persona::find(Input::get('id'));
		$persona->update(Input::all());
		$persona->save();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/personas'));
	}

	public function postUpdateem()
	{
		DB::beginTransaction();	

		try {
		$persona = Persona::find(Input::get('id'));
		$persona->update(Input::all());
		$persona->save();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false));

		}
		DB::commit();
		return Response::json(array('estado' => true, 'route' => '/personas/empresas'));

	}

	public function postDestroy($id)
	{
		DB::beginTransaction();	

		try {

			$persona = Persona::find($id);
			$persona->delete();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);

	}

	public function postDestroyem($id)
	{


		DB::beginTransaction();	

		try {

			$persona = Persona::find($id);
			$persona->delete();

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(false);
		}

		DB::commit();
		return Response::json(true);
	}

    public function postGetdpto($pais){

        if($pais === 'Perú'){

            $result= "";

            $departamentos = Ubigeo::select()->groupBy('CodDpto')->orderBy('Nombre','ASC')->get();

            //print_r($departamentos); die();

            //foreach ($departamentos as $dpto) {
              //  print_r($dpto->Nombre);
            //}

            //die();

            $result =  '<option value="0">Seleccione Dpto</option>';
            foreach ($departamentos as $dpto) {
                $result .='<option value="'.$dpto->CodDpto.'">'.$dpto->Nombre.'</option>';

            }

            return \Illuminate\Support\Facades\Response::json($result);
        }elseif($pais === 'Otro'){
            return \Illuminate\Support\Facades\Response::json(1);
        }else{
            return \Illuminate\Support\Facades\Response::json(false);
        }

    }

    public function postGetprov($dpto){

            $result= "";

            $provincias = Ubigeo::select()->groupBy('CodProv')->orderBy('Nombre','ASC')
                ->where('CodDpto','=',$dpto)
                ->where('CodProv','!=',0)
                ->get();


            $result =  '<option value="0">Seleccione Prov</option>';
            foreach ($provincias as $prov) {
                $result .='<option value="'.$prov->CodProv.'">'.$prov->Nombre.'</option>';

            }

            return \Illuminate\Support\Facades\Response::json($result);
        }

    public function postGetdist($dpto, $prov){

        $result= "";

        $distritos = Ubigeo::select()->groupBy('CodDist')->orderBy('Nombre','ASC')
            ->where('CodProv','=',$prov)
            ->where('CodDpto','=',$dpto)
            ->where('CodDist','!=',0)
            ->get();


        $result =  '<option value="0">Seleccione Prov</option>';
        foreach ($distritos as $dist) {
            $result .='<option value="'.$dist->CodDist.'">'.$dist->Nombre.'</option>';

        }

        return \Illuminate\Support\Facades\Response::json($result);
    }


}
