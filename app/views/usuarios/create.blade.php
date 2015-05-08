@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('usuarios')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR USUARIO
</strong></div>

<div class="panel-body">


    @if ( $errors->count() > 0 )
    <div class="alert alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <p><strong>Los siguientes errores han ocurrido:</strong></p>

      <ul>
        @foreach( $errors->all() as $message )
          <li><strong>{{ $message }}</strong> </li>
        @endforeach
      </ul>

      </div>
    @endif

        {{ Form::open(array('id'=>'form_resto','url' => 'usuarios/create', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
  <div class="form-group">
    <div class="col-md-3">
      {{Form::label('login', 'Usuario',array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'login','', array('class' => 'form-control','placeholder'=>'ej gperez', 'autofocus','required', 'validationMessage'=>'Por favor entre un login (4 carac. mín.)', 'pattern'=>'.{4,}'))}}

    </div>
    <div class="col-md-4 control-label check_1" style="display:none;"><i class="fa fa-check fa-5"></i> <span class="text-info">El nombre de usuario está disponible</span></div>
    <div class="col-md-4 control-label check_2" style="display:none;"><i class="fa fa-bell fa-5"></i><span class="text-danger">El nombre de usuario no está disponible</span></div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('password', 'Contraseña', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('password', 'password','', array('class' => 'form-control','placeholder'=>'', 'autofocus','required', 'validationMessage'=>'Por favor entre una contraseña (6 caract mín.)' , 'pattern'=>'.{6,}'))}}
    </div>

</div>
<div class="form-group">
    <div class="col-md-3">
      {{Form::label('rpt_pass', 'Repita su Contraseña', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('password', 'rpt_pass','', array('class' => 'form-control','placeholder'=>'', 'autofocus','required', 'validationMessage'=>'Por favor repita su contraseña (6 caract mín.)', 'pattern'=>'.{6,}'))}}
    </div>
    <div class="col-md-4 control-label check_-" style="display:none;"><i class="fa fa-bell fa-5"></i><span class="text-danger">Contraseñas no coinciden.</span></div>
    <div class="col-md-4 control-label check_-2" style="display:none;"><i class="fa fa-check fa-5"></i><span class="text-info">Contraseñas coinciden.</span></div>

</div>
<div class="form-group">
    <div class="col-md-3">
      {{Form::label('estado', 'Estado', array('class'=>'control-label'))}}
          </div>

    <div class="col-md-5">
      {{Form::select('estado', array(1=>'Activo',0=>'Inactivo'), '',array('class' => 'form-control'))}}
       </div>
</div>
<div class="form-group">
      <div class="col-md-3">
      {{Form::hidden('persona_id', '', array('id'=>'persona_id'))}}
      {{Form::label('usuario', 'Persona/Empresa', array('class' => 'control-label'))}}
      </div>
      <div class="col-md-5">
      {{Form::input('text', 'nombre_', '', array('id'=>'nombre_', 'placeholder' => 'Buscar por nombre/ruc/dni/rs', 'required', 'validationMessage'=>'Por favor ingrese una Persona/Empresa','style'=>'width:100%;'))}}
      </div>
       <div class="col-md-4 control-label check_1--"><i class="fa fa-check fa-5"></i><span class="text-warning">Debe seleccionar una Persona/Empresa de la lista desplegable.</span></div>
    
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('id_restaurante', 'Local', array('class'=>'control-label'))}}
      {{Form::select('id_restaurante',  array('0' => "Seleccione.. ") +$restaurantes, '',array('class' => 'form-control' , ''))}}
    </div>

    <div class="col-md-4">
      {{Form::label('id_tipoareapro', 'Área', array('class'=>'control-label'))}}
      {{Form::select('id_tipoareapro', array('0' => "Seleccione ... "),'', array('class'=>'form-control','disabled'))}}
    </div>
        {{-- <div class="col-md-4">
      {{Form::label('lblColaborador', 'Colaborador', array('class'=>'control-label'))}}
      {{Form::select('colaborador', array('0' => "Seleccione.. ") + $colaboradores,'', array('class'=>'form-control'))}}
    </div> --}}
</div>

<div class="bs-callout bs-callout-info">
    <h4>Local y Área requerido.</h4>
    <p>Deben estar seleccionadas estas variables para que el Usuario sea creado.</p>
  </div>

<div class="form-group">
    <div class="col-md-4">
      {{Form::submit('Guardar', array('class' => 'btn btn-warning') )}}
    </div>
</div>
</fieldset>
{{ Form::close() }}

<script type="text/x-kendo-template" id="per_templ">
  <h5>#: nombres #</h5>
</script>

<script type="text/javascript">

                      $("#nombre_").kendoAutoComplete({
                        dataTextField: "nombres",
                        filter: "contains",
                        minLength: 3,
                        template: kendo.template($("#per_templ").html()),
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/bus_per_"
                            }
                        },
                        select: onSelect,
                        height:200
                    });



function onSelect(e){
   var dataItem = this.dataItem(e.item.index());
   $('#persona_id').val(dataItem.id);
   //$('#persona_id').text(dataItem.id);
   //console.log(dataItem.id);
   //console.log($('#persona_id').val());
};
</script>

<style scoped>
                .k-autocomplete {
                    display: block;
                    clear: left;
                    width: 318px;
                    vertical-align: middle;
                }
</style>                

@stop