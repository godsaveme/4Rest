@extends('layouts.cajamaster')
@section('js')
{{HTML::script('js/eventos.js')}}
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
			@if (isset($errors))
			<ul>
				@foreach ($errors->all() as $message)
						<li>{{$message}}</li>
				@endforeach
			</ul>
			@endif
			{{Form::open(array('url' => '/eventos/cobrar', 'method' => 'post', 'role'=>'form'))}}
				<legend>Datos - {{$evento->nombre}} - {{$evento->fecha}} - {{$evento->hora}}</legend>
				{{Form::hidden('idevento', $evento->id)}}
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="form-group">
						<label for="">Monto a Cobrar</label>
						{{Form::input('text', 'costo', $cuenta, array('class'=>'form-control text-right inpt_cobrar', 'placeholder'=> 'S/. 0.00', 'id'=>'costo'))}}
					</div>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="form-group">
						<label for="">Importe Pagado</label>
						{{Form::input('text', 'ipagado', '', array('class'=>'form-control text-right inpt_cobrar', 'placeholder'=> 'S/. 0.00', 'id'=>'ipagado'))}}
					</div>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="form-group">
						<label for="">Vuelto</label>
						{{Form::input('text', 'ivuelto', '', array('class'=>'form-control text-right inpt_cobrar', 'placeholder'=> 'S/. 0.00', 'id'=>'ivuelto'))}}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						<label>Descripción:</label>
						{{Form::input('text', 'descripcion', '',array('class'=>'form-control', 'placeholder'=> 'Ingrese Descripcion'))}}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12	">
					<div class="form-group">
						<label>Persona/Empresa:</label>
						{{Form::input('text', 'cliente', '',array('class'=>'form-control', 'placeholder'=> 'Ingrese Nombre/Razón S./DNI/RUC', 'id'=>'cliente', 'style' =>'width: 300px'))}}
						<a href="javascript:void(0)" class="btn btn-primary" id="btn_nuevoclienteevento">Nuevo Cliente</a>
					</div>
				</div>

				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8	" id="datos_clienteevento">
					 <script type="text/x-kendo-template" id="template_cliente">
	                    <legend>Datos Cliente</legend>
	                    <label>Nombre / Rzn Soc:</label> 
	                    {{Form::text('nombre', '#=nombres#', array('class'=>'form-control'))}}
	                    <br>
	                    <label>DNI/RUC:</label>
	                    {{Form::text('documento', '#=dni#',array('class'=>'form-control'))}}
	                    <br>
	                    <label>Dirección:</label> 
	                    {{Form::text('direccion', '#=direccion#', array('class'=>'form-control'))}}
			        </script>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<a href="/cajas" class="btn btn-default pull-right" style="margin-left: 10px">Cancelar</a>
					<button type="submit" class="btn btn-primary pull-right">Aceptar</button>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>

<div class="windowsregistrarclienteevento" style="width:100%;display:none;">
    <div class="btn-group btn-group-lg">
      <button type="button" class="btn btn-primary" id="btn_rpersona">Persona</button>
      <button type="button" class="btn btn-primary" id="btn_rempresa">Empresa</button>
    </div>
    <br>
    <br>
    <div id="cont_cliperona" style="display: none">
        <div style="width: 500px;" class="pull-left">
            <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">Registrar Nueva Persona</h3>
                            </div>
                            <div class="panel-body">
                            <form role="form" id="frm_clipersona">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                        <input type="text" name="first_name" id="input_nombres" class="form-control input-sm" placeholder="Nombres">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="input_apPaterno" class="form-control input-sm" placeholder="Apellido Materno">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="input_apMaterno" class="form-control input-sm" placeholder="Apellido Paterno">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password" id="input_dni" class="form-control input-sm" placeholder="DNI">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password_confirmation" id="input_direccion" class="form-control input-sm" placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
                                        <div class="form-group">
                                        <a href="javascript:void(0)" class="btn btn-info btn-block registrarcliente"> Registrar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pull-left" style="margin-left: 10px; width: 300px" id="datos_persona">
            <script type="text/x-kendo-template" id="template">
                <div class="container-fluid well span6">
                    <div class="row-fluid">
                        <div class="span8">
                            <h4>Datos Persona</h4>
                            <h6>Nombres: #=nombres#</h6>
                            <h6>Apellidos: #=apPaterno# #=apMaterno#</h6>
                            <h6>DNI: #=dni#</h6>
                            <h6>Dirección: #=Direccion#</h6>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

    <div id="cont_cliempresa" style="display: none">
        <div style="width: 500px;" class="pull-left">
            <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">Registrar Nueva Empresa</h3>
                            </div>
                            <div class="panel-body">
                            <form role="form" id="frm_cliempresa">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                        <input type="text" name="first_name" id="input_rs" class="form-control input-sm" placeholder="Razon Social">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password" id="input_ruc" class="form-control input-sm" placeholder="RUC">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password_confirmation" id="input_direccionem" class="form-control input-sm" placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
                                        <div class="form-group">
                                        <a href="javascript:void(0)" class="btn btn-info btn-block registrarcliente"> Registrar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pull-left" style="margin-left: 10px; width: 300px" id="datos_empresa">
            <script type="text/x-kendo-template" id="template_cliem">
                <div class="container-fluid well span6">
                    <div class="row-fluid">
                        <div class="span8">
                            <h4>Datos Empresa</h4>
                            <h6>Razon Soc.: #=nombres#</h6>
                            <h6>RUC: #=ruc#</h6>
                            <h6>Dirección: #=Direccion#</h6>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

</div>

@stop