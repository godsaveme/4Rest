@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('usuarios')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR USUARIO
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

        {{ Form::open(array('id'=>'form_resto','url' => 'usuarios/edit', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
  <div class="form-group">
    <div class="col-md-3">
      {{Form::hidden('id', $usuario->id , array('class'=>'control-label'))}}
      {{Form::label('login', 'Usuario',array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'login', $usuario->login, array('class' => 'form-control','placeholder'=>'ej gperez', 'autofocus','required', 'validationMessage'=>'Por favor entre un nombre.','disabled' => 'disabled'))}}
    </div>
        <div class="col-md-4 control-label check_1" style="display:none;"><i class="fa fa-check fa-5"></i> <span class="text-info">El nombre de usuario está disponible</span></div>
    <div class="col-md-4 control-label check_2" style="display:none;"><i class="fa fa-bell fa-5"></i><span class="text-danger">El nombre de usuario no está disponible</span></div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('password', 'Contraseña', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('password', 'password', $usuario->password, array('class' => 'form-control','placeholder'=>'', 'autofocus','required', 'validationMessage'=>'Por favor entre una contraseña' ,'disabled' => 'disabled'))}}
          </div>

</div>
<div class="form-group">
    <div class="col-md-3">
      {{Form::label('estado', 'Estado', array('class'=>'control-label'))}}
          </div>

    <div class="col-md-5">
      {{Form::select('estado', array(0=>'Inactivo', 1=>'Activo'), $usuario->estado, array('class' => 'form-control'))}}
       </div>
</div>
<div class="form-group">
    <div class="col-md-3">
      <?php $persona = Persona::find($usuario->persona_id);?>
      {{Form::hidden('persona_id', $usuario->persona_id, array('id'=>'persona_id'))}}
      {{Form::label('usuario', 'Buscar persona por', array('class'=>'control-label'))}}
          </div>

          @if ($usuario->ruc) <?php   $name_ = $usuario->persona->razonSocial ?> @else <?php $name_ = $usuario->persona->nombres. ' ' . $usuario->persona->apPaterno. ' ' . $usuario->persona->apMaterno ?> @endif
 
    <div class="col-md-5">
      {{Form::input('text', 'nombre_', $name_, array('id'=>'nombre_', 'placeholder' => 'Buscar por nombre/ruc/dni/rs', 'disabled' => 'disabled'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('id_restaurante', 'Local', array('class'=>'control-label'))}}
      {{Form::select('id_restaurante',  array('0' => "Seleccione ... ") +$restaurantes, $usuario->id_restaurante, array('class' => 'form-control'))}}
    </div>

    <div class="col-md-4">
      {{Form::label('id_tipoareapro', 'Área', array('class'=>'control-label'))}}
      {{Form::select('id_tipoareapro', array('0' => "Seleccione ... "), $usuario->id_tipoareapro, array('select-areap'=>$usuario->id_tipoareapro , 'class'=>'form-control'))}}
    </div>
            <div class="col-md-4">
      {{Form::label('lblColaborador', 'Colaborador', array('class'=>'control-label'))}}
      {{Form::select('colaborador', array('0' => "Seleccione ... ") + $colaboradores,$usuario->colaborador, array('class'=>'form-control'))}}
    </div>
</div>

<div class="bs-callout bs-callout-info">
    <h4>Local, Área y Colaborador requerido.</h4>
    <p>Deben estar seleccionadas estas variables para que el Usuario sea modificado.</p>
  </div>

<div class="form-group">
    <div class="col-md-4">
      {{Form::submit('Modificar', array('class' => 'btn btn-warning') )}}
    </div>
</div>
</fieldset>
{{ Form::close() }}

<script type="text/x-kendo-template" id="per_templ">
  <h3>#: data.nombres #</h3>
  <article>
    <img src="">
    <p></p>
  </article>
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

@stop