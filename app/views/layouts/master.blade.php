<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		@section('titulo')
		.:4Rest:.
		@show
	</title>
	@section('cssgeneral')
  {{HTML::style('css/normalize.css')}}
  {{HTML::style('css/kendo/kendo.common-bootstrap.min.css')}}
  {{HTML::style('css/bootstrap/bootstrap_lumen.min.css')}}
  {{HTML::style('css/bootstrap/font-awesome/css/font-awesome.min.css')}}
  {{HTML::style('css/kendo/kendo.silver.min.css')}}
  {{HTML::style('css/jquery.timeentry.css')}}
	{{HTML::style('css/general.css')}}
  {{HTML::style('css/alertify.core.css')}}
  {{HTML::style('css/alertify.default.css')}}
  {{HTML::style('css/newstyles/web.css')}}
  {{HTML::style('css/newstyles/fonts.css')}}
	@show
  @yield('css')
  @section('jsgeneral')
  {{HTML::script('js/kendo/jquery-2.1.0.min.js');}}
  {{HTML::script('js/kendo/kendo.all.min.js');}}
  {{HTML::script('js/bootstrap.min.js')}}
  {{HTML::script('js/kendo/kendo.culture.es-PE.min.js')}}
  {{HTML::script('js/jquery-ui-1.10.4.custom.min.js');}}
  {{HTML::script('js/under.js'); }}
  {{HTML::script('js/jquery.plugin.js'); }}
  {{HTML::script('js/jquery.timeentry.min.js'); }}
  {{HTML::script('js/alertify.min.js'); }}
  {{HTML::script('js/newjs/web.js')}}
  @show

@yield('js')

</head>
<body>

@if(Auth::check())

    <!-- Fixed navbar -->
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          {{ HTML::link('web', '4Rest',array('class'=>'navbar-brand')); }}
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bookmark-o"></i> Archivo<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a onclick="event.preventDefault();" href="#"><i class="fa fa-pencil-square-o"></i>  Editar Usuario</a></li>
                <li class="divider"></li>
                <li><a href="web"><i class="fa fa-rotate-left"></i>  Limpiar</a></li>
                <li><a onclick="openCollapse();" href="#"><i class="fa fa-plus-square-o"></i>  Expandir todos</a></li>
                <li><a onclick="hideCollapse();" href="#"><i class="fa fa-minus-square-o"></i>  Colapsar todos</a></li>
                <li class="divider"></li>
<!--                 <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li> -->
                <li><a href="/logout"><i class="fa fa-sign-out"></i> Salir</a></li>
              </ul>
            </li>

                          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-square-o"></i> Ir a<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{URL('pedidos')}}"><i class="fa fa-tablet"></i>  Pedidos Tablet</a></li>
                <li class="divider"></li>
                <li><a href="{{URL('cajas')}}"><i class="fa fa-money"></i>  Caja</a></li>
                <li><a href="{{URL('cajas/reportescaja')}}"><i class="fa fa-file-text-o"></i>  Reportes</a></li>
                <li><a href="#"><i class="fa fa-users"></i>  Crear Usuario</a></li>
                <li class="divider"></li>
<!--                 <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li> -->
                <li><a href="/logout"><i class="fa fa-sign-out"></i> Salir</a></li>
              </ul>
            </li>
<!--             <li><a href="">About</a></li>
            <li><a href="">Contact</a></li> -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-question"></i> Ayuda<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="disabled"><a onclick="event.preventDefault();" href="#"><i class="fa fa-question-circle"></i> Ayuda de 4Rest</a></li>
                <li class="divider"></li>
<!--                 <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li> -->
                <li><a onclick="show4Rest();" href="#"><i class="fa fa-laptop"></i>  Acerca de 4Rest...</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{url('/logout')}}" ><i class="fa fa-sign-out"></i>  Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

@endif
@section('content')
@if(Auth::check())
<div class="container k-content" style="margin-top:-20px;">
  <div class="row" style="background: #f2f4f8;">
    <div class="col-md-4 " >
                <div class="panel panel-default" style="margin-top:20px;">
  <div class="panel-body">
      <div class="well well-lg">
        <h2 class="ra-well-title"><span style="font-style:italic; "><u>Perfil</u></span></h2>
        <div class="row">
          <div class="col-lg-5 col-sm-5">
          <div class="profile-pic">
            <img src="{{URL('../images/profile-pic.jpg')}}" class="ra-avatar img-responsive">
            </div>
          </div>
          <div class="col-lg-7 col-sm-7">
            <span class="ra-first-name">{{Auth::user()->persona->nombres}}</span>
            <span class="ra-last-name">{{Auth::user()->persona->apPaterno.' '.Auth::user()->persona->apMaterno}} </span>
            <div class="ra-position"><i class="fa fa-suitcase"></i> Cargo: {{Auth::user()->persona->perfil->nombre}} </br>
            <?php $nombrearea = Areadeproduccion::find(Auth::user()->id_tipoareapro);?>
            <div style="margin-bottom:-25px;"><i class="fa fa-laptop"></i> Área Prodcc.: {{$nombrearea->nombre}}</div>
             </div>
            
            
          </div>
        </div>
      </div>
      <div class="panel-group" id="accordion1">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
          <span class="glyphicon glyphicon-cutlery"></span> Restaurante <span class="pull-right glyphicon glyphicon-chevron-down"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne1" class="panel-collapse collapse @if (Request::is('restaurantes') || Request::is('restaurantes/*') || Request::is('salones') || Request::is('salones/*') || Request::is('mesas') || Request::is('mesas/*')) in @endif">
      <div class="panel-body pb-menu">
         <ul class="list-group">
                <li class="list-group-item @if (Request::is('restaurantes') || Request::is('restaurantes/*')) active @endif">{{ HTML::link('restaurantes', 'Restaurantes'); }} 
                @if (Request::is('restaurantes/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('restaurantes/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
                
                </li>
                <li class="list-group-item @if (Request::is('salones') || Request::is('salones/*')) active @endif">{{ HTML::link('salones', 'Salones'); }}
                @if (Request::is('salones/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('salones/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
                </li>
                <li class="list-group-item @if (Request::is('mesas') || Request::is('mesas/*')) active @endif">{{ HTML::link('mesas', 'Mesas'); }}
                @if (Request::is('mesas/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('mesas/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
                </li>
          </ul>
      </div>
    </div>
  </div>
</div>


<div class="panel-group" id="accordion2">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2">
          <i class="fa fa-tasks"></i> Productos<span class="pull-right glyphicon glyphicon-chevron-down"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne2" class="panel-collapse collapse @if (Request::is('familias') || Request::is('familias/*') || Request::is('productos') || Request::is('productos/*') || Request::is('insumos') || Request::is('insumos/*')) in @endif">
       <div class="panel-body pb-menu">
      <ul class="list-group">
        <li class="list-group-item @if (Request::is('familias') || Request::is('familias/*')) active @endif">{{ HTML::link('familias', 'Familias') }}
                        @if (Request::is('familias/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('familias/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        <li class="list-group-item @if (Request::is('productos') || Request::is('productos/*')) active @endif">{{ HTML::link('productos', 'Productos'); }}
                @if (Request::is('productos/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('productos/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        <li class="list-group-item @if (Request::is('insumos') || Request::is('insumos/*')) active @endif">{{ HTML::link('insumos', 'Insumos'); }}
                @if (Request::is('insumos/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('insumos/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="panel-group" id="accordion3">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion3" href="#collapseOne3">
          <i class="fa fa-copy"></i> Combinaciones<span class="pull-right glyphicon glyphicon-chevron-down"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne3" class="panel-collapse collapse @if (Request::is('tipocombinacions') || Request::is('tipocombinacions/*') || Request::is('combinacions') || Request::is('combinacions/*')) in @endif">
    <div class="panel-body pb-menu">
      <ul class="list-group">
        <li class="list-group-item @if (Request::is('tipocombinacions') || Request::is('tipocombinacions/*')) active @endif">{{ HTML::link('tipocombinacions', 'Tipo de Combinaciones'); }}
                @if (Request::is('tipocombinacions/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('tipocombinacions/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        <li class="list-group-item @if (Request::is('combinacions') || Request::is('combinacions/*')) active @endif">{{ HTML::link('combinacions', 'Combinaciones'); }}
                @if (Request::is('combinacions/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('combinacions/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
      </ul>
    </div>
    </div>
  </div>
</div>

<div class="panel-group" id="accordion4">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion4" href="#collapseOne4">
          <span class="glyphicon glyphicon-user"></span> Personas<span class="pull-right glyphicon glyphicon-chevron-down"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne4" class="panel-collapse collapse @if (Request::is('personas') || Request::is('personas/*') || Request::is('personas/empresas') || Request::is('personas/empresas/*') || Request::is('usuarios') || Request::is('usuarios/*') ) in @endif">
    <div class="panel-body pb-menu">
      <ul class="list-group">
        <li class="list-group-item @if (Request::is('personas') || Request::is('personas/create') || Request::is('personas/edit/*')) active @endif">{{ HTML::link('personas', 'Personas'); }}
                @if (Request::is('personas/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('personas/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        <li class="list-group-item @if (Request::is('personas/empresas') || Request::is('personas/createempresas') || Request::is('personas/editem/*')) active @endif">{{ HTML::link('personas/empresas', 'Empresas'); }}
                @if (Request::is('personas/empresas/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('personas/editem/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        <li class="list-group-item @if (Request::is('usuarios') || Request::is('usuarios/*')) active @endif">{{ HTML::link('usuarios', 'Usuarios'); }}
                @if (Request::is('usuarios/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('usuarios/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
      </ul>
    </div>
    </div>
  </div>
</div>

<div class="panel-group" id="accordion5">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion5" href="#collapseOne5">
          <i class="fa fa-tasks"></i> Notas y Sabores<span class="pull-right glyphicon glyphicon-chevron-down"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne5" class="panel-collapse collapse @if (Request::is('notas') || Request::is('notas/*') || Request::is('sabores') || Request::is('sabores/*')) in @endif">
       <div class="panel-body pb-menu">
      <ul class="list-group">
        <li class="list-group-item @if (Request::is('notas') || Request::is('notas/*')) active @endif">{{ HTML::link('notas', 'Notas') }}
                        @if (Request::is('notas/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('notas/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        <li class="list-group-item @if (Request::is('sabores') || Request::is('sabores/*')) active @endif">{{ HTML::link('sabores', 'Sabores'); }}
                @if (Request::is('sabores/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('sabores/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        </ul>
      </div>
    </div>
  </div>
</div>



                    </div>
                    </div>

    </div>


<script type="text/javascript">
  $('#collapseOne1').on('shown.bs.collapse', function () {
    <?php Session::put('coll_1', 'in');?>
    //document.location = "#ost"
});
    $('#collapseOne1').on('hidden.bs.collapse', function () {
  <?php Session::put('coll_1', '');?>
});
</script>



    <div class="col-md-8">
                    <div class="panel panel-default" style="margin-top:20px;" >
                    
      @section('sub-content')
<div id="loading" class="progress progress-striped active center-block" style="width:60%; top: 260px; position:relative;">
  <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    <span class="sr-only">Cargando...</span>
  </div>
</div>
      @show
                    
                    </div>
    </div>



  </div>
</div>


@endif

@show

<!-- WINDOWS PANELS -->
<div iclass="k-content">
<div id="window" style="display:none; padding-top:20px;">

  <!-- <h3 class="text-center"><strong>Equipo de Desarrollo</strong></h3> -->
  <div class="bg_resto">
    <img src="{{URL('../images/bg_resto.jpg')}}" alt="">
  </div>
  
  <p><strong>Director Regional:</strong> <br>Javier Álvarez Montenegro.<br>
  Cell: # 948 535 127.</p>
  <p><strong>Director de Software:</strong> <br>Iván Calvay Requejo.<br>
  Cell: # 944 824 053. 
  </p>
  <br>
  <br><br>

  <p class="text-center"><em>®2014 Plaza Verde. Todo los derechos reservados.</em></p>
  
</div>
</div>


@section('footer')
        <footer id="footer">
      <div class="container">
        <p class="text-muted"><tt>®4Rest 2014. Todos los derechos reservados.</tt></p>
      </div>
    </footer>
@show




 <!-- FIN DIV VIEW -->
            <script>
/*      var app = new kendo.mobile.Application(document.body);
  $(function() {
    app.showLoading();
    setTimeout(function() {
        app.hideLoading();
    }, 2000);
  });*/



      </script>
        <script type="text/javascript">

kendo.culture('es-PE');
/*$(function(){
  kendo.ui.progress($('body'), true);
})*/  
</script>
</body>

</html>