@extends('layouts.master')
 
@section('sidebar')
     Perfiles
@stop

 
@section('content')
<div class="row">
    <div class="small-6 medium-6 large-6 columns">
      &nbsp;
    </div>
    <div class="small-6 medium-6 large-6 columns">
      {{HTML::link('perfiles', 'Volver', array('class'=>'button radius right'))}}
    </div>
</div>
        {{ Form::open(array('url' => 'perfiles/create', 'data-abide' => 'data-abide')) }}
<fieldset>
  <legend>Crear Perfiles</legend>
  <div class="row">
    <div class="large-12 columns">
      {{Form::label('nombre', 'Nombre')}}
      {{Form::input('text', 'nombre', '')}}
    </div>
  </div>
  <div class="row">
    <div class="large-9 columns">
      {{Form::label('descripcion', 'Descripcion')}}
      {{Form::input('text', 'descripcion', '')}}
    </div>
    <div class="large-3 columns">
      {{Form::label('selector', 'Descripcion')}}
      {{Form::select('selector', array(1=>'Persona', 2 => 'Empresa'), 1)}}
    </div>
  </div>
  <div class="row">
    {{Form::hidden('contadormo', $totalmodulos)}}
    <?php $i = 0;?>
    @foreach($modulos as $modu)
    <div class="large-6 columns">
      <div class="panel">
      {{Form::checkbox('nmodulo_'.$i,$modu->nmodulo,'',array('class' => 'seleccciona'))}}
      {{Form::label('nmodulo',$modu->nmodulo, array('class'=>'negrita'))}}
      <?php $procesos = Modulos::where('nmodulo','=',$modu->nmodulo)->select('id', 'nombre')->get(); 
            $contadorp = count($procesos);
            $k = 0;
      ?>
      {{Form::hidden('contadorp_'.$i, $contadorp)}}
      <div class="row">
        @foreach ($procesos as $proc)
        <div class="large-6 columns">
              {{Form::checkbox('proc_'.$k,$proc->id , '', array('data-checkch'=>$modu->nmodulo))}}{{Form::label('proc_'.$k, $proc->nombre)}}
        </div>
        <?php $k = $k + 1;?>
        @endforeach
        <div class="large-6 columns">
          &nbsp;
        </div>
      </div>
      </div>
    </div>
    <?php $i = $i + 1;?>
    @endforeach
    <div class="large-6 columns">
      &nbsp;
    </div>
  </div>
  <div class="row">
    <div class="small-12 medium-12 large-12 columns">
      {{Form::submit('Guardar', array('class'=> 'button radius right'))}}
    </div>
  </div>
</fieldset>
        {{ Form::close() }}
@stop