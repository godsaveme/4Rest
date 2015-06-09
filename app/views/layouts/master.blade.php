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
    <style type="text/css"> 
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 99999;
  background: url(/img/Preloader_21.gif) center no-repeat #fff;
}
  </style>
	@section('cssgeneral')
  {{HTML::style('css/normalize.css')}}
  {{HTML::style('css/kendo/kendo.common.min.css')}}
  {{HTML::style('css/bootstrap/bootstrap_lumen.min.css')}}
  {{HTML::style('css/bootstrap/font-awesome/css/font-awesome.min.css')}}
  {{HTML::style('css/kendo/kendo.fiori.min.css')}}
  {{HTML::style('css/jquery.timeentry.css')}}
	{{HTML::style('css/general.css')}}
  {{HTML::style('css/alertify.core.css')}}
  {{HTML::style('css/alertify.default.css')}}
  {{HTML::style('css/newstyles/web.css')}}
  {{HTML::style('css/newstyles/fonts.css')}}
	@show
	<link rel="shortcut icon" sizes="128x128" href="/images/productos/favicon.png">
  @yield('css')
  @section('jsgeneral')
  {{HTML::script('js/kendo/jquery-2.1.0.min.js');}}
  {{HTML::script('js/kendo/kendo.all.min.js');}}
  {{HTML::script('js/bootstrap/bootstrap.min.js')}}
  {{HTML::script('js/kendo/kendo.culture.es-PE.min.js')}}
  {{HTML::script('js/kendo/kendo.messages.es-ES.min.js')}}
  {{HTML::script('js/under.js'); }}
  {{HTML::script('js/jquery.plugin.js'); }}
  {{HTML::script('js/jquery.timeentry.min.js'); }}
  {{HTML::script('js/alertify.min.js'); }}
  {{HTML::script('js/newjs/web.js')}}
  @show

  @yield('js')



  <script type="text/javascript">
  //paste this code under head tag or in a seperate js file.
  // Wait for window load
  $(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("fast");;
  });
  </script>

</head>
<body>
<div class="se-pre-con"></div>

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

          @if(Auth::user()->persona->perfil->nombre === 'Administrador')

              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cutlery"></i> Restaurante<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/restaurantes"><i class="fa fa-angle-right"></i>  Sucursal</a></li>
                <li class="divider"></li>
                <li><a href="/salones"><i class="fa fa-angle-right"></i>  Salones</a></li>
                <li><a href="mesas"><i class="fa fa-angle-right"></i>  Mesas</a></li>
                
              </ul>
            </li>
           @endif

            @if(Auth::user()->persona->perfil->nombre === 'Administrador' or Auth::user()->persona->perfil->nombre === 'Administrador')
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-list-alt"></i> Catálogo<b class="caret"></b>
                </a>
               <ul class="dropdown-menu">
                @if(Auth::user()->persona->perfil->nombre === 'Administrador')
                <li><a href="/familias"><i class="fa fa-angle-right"></i>  Familias</a></li>
                <li class="divider"></li>
                @endif
                <li><a href="/productos"><i class="fa fa-angle-right"></i>  Productos</a></li>
                @if(Auth::user()->persona->perfil->nombre === 'Administrador')
                <li><a href="/insumos"><i class="fa fa-angle-right"></i>  Insumos</a></li>
                @endif

                <li class="divider"></li>
                <li><a href="/tipocombinacions"><i class="fa fa-angle-right"></i>  Tipos de Combinaciones</a></li>
                <li><a href="/combinacions"><i class="fa fa-angle-right"></i>  Combinaciones</a></li>
                 @if(Auth::user()->persona->perfil->nombre === 'Administrador')
                <li class="divider"></li>
                 <li><a href="/notas"><i class="fa fa-angle-right"></i>  Notas</a></li>
                 @endif
                
<!--                 <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li> -->
                
              </ul>
            </li>

            @endif
        @if(Auth::user()->persona->perfil->nombre === 'Administrador' or Auth::user()->persona->perfil->nombre === 'Caja')

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i> Personas<b class="caret"></b>
                </a>
               <ul class="dropdown-menu">
                <li><a href="/personas"><i class="fa fa-angle-right"></i>  Personas</a></li>
                <li class="divider"></li>
                <li><a href="/personas/empresas"><i class="fa fa-angle-right"></i>  Empresas</a></li>
                @if(Auth::user()->persona->perfil->nombre === 'Administrador')
                <li><a href="/usuarios"><i class="fa fa-angle-right"></i>  Usuarios</a></li>
                @endif
              
                
              </ul>
            </li>

            @endif
            @if(Auth::user()->persona->perfil->nombre === 'Administrador')
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-cube"></i> Control de Stock<b class="caret"></b>
                </a>
               <ul class="dropdown-menu">
                <li><a href="/almacenes"><i class="fa fa-angle-right"></i>  Almacenes</a></li>
                
                <li><a href="/compras"><i class="fa fa-angle-right"></i>  Compras</a></li>
                <li class="divider"></li>
                <li><a href="/recetas"><i class="fa fa-angle-right"></i>  Recetas</a></li>
                <li class="divider"></li>
                <li><a href="/sabores"><i class="fa fa-angle-right"></i>  Sabores</a></li>
                <li><a href="/sabores/indexdet"><i class="fa fa-angle-right"></i>  Producto con Sabores</a></li>
                <li class="divider"></li>
                <li class="disabled"><a onclick="event.preventDefault();" href="#"><i class="fa fa-angle-right"></i>  Orden de Producción</a></li>
                <li class="disabled"><a href="#"><i class="fa fa-angle-right"></i>  Requerimiento</a></li>
                <li class="disabled"><a href="#"><i class="fa fa-angle-right"></i>  Orden de Compra</a></li>
                
                
              </ul>
            </li>

            @endif

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-share-square-o"></i> Ir a<b class="caret"></b>
                </a>
               <ul class="dropdown-menu">

                <li><a href="{{URL('monitores')}}"> <i class="glyphicon glyphicon-eye-open"></i> Monitores</a></li>
               @if(Auth::user()->persona->perfil->nombre === 'Caja')
               <li><a href="/cajas"><i class="fa fa-pencil-square-o"></i>  Caja </a></li>
               @endif
               @if(Auth::user()->persona->perfil->nombre === 'Área de Producción')
               <li class="divider"></li>
                <li><a href="/cocina"><i class="fa fa-pencil-square-o"></i>  Área de Producción: {{Auth::user()->areaproduccion->nombre}}</a></li>
                @endif
                @if(Auth::user()->persona->perfil->nombre === 'Mozo')
                <li class="divider"></li>
                <li><a href="/pedidoscomanda"><i class="fa fa-rotate-left"></i>  Punto de Venta: Salón</a></li>
                @endif

                                
              </ul>
            </li>
             @if(Auth::user()->persona->perfil->nombre === 'Administrador')
             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <i class="fa fa-columns"></i> Reportes<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                <li>
                    <a href="{{URL('cajas/reportescaja')}}">
                      <i class="fa fa-file-text-o"></i> 
                      Reporte  Caja Diario
                    </a>
                  </li>

                  <li class="divider"></li>
                  <li>
                    <a href="/usuarios/selectmozo">
                      <i class="fa fa-file-text-o"></i>
                      Reporte Mozos
                    </a>
                  </li>
                  <!--<li>
                    <a href="/usuarios/reportemozos/3">
                      <i class="fa fa-users"></i>
                      Reporte Mozos Woyke
                    </a>
                  </li>-->
                  <li class="divider"></li>
                  <li>
                    <a href="/usuarios/selectrota">
                      <i class="fa fa-file-text-o"></i>
                      Rotación Productos 
                    </a>
                  </li>
                  <!--<li>
                    <a href="/reportes/reporteproductos/3">
                      <i class="fa fa-users"></i>
                      Rotación Productos Woyke
                    </a>
                  </li>-->
                  <li class="divider"></li>
                  <li>
                    <a href="/usuarios/selectcuadro">
                      <i class="fa fa-file-text-o"></i>
                      Cuadro Semanal Venta de Productos
                    </a>
                  </li>
                  <!--<li>
                    <a href="/reportes/reportesemanal/3">
                      <i class="fa fa-users"></i>
                       Cuadro Semanal Venta de Productos Woyke
                    </a>
                  </li>-->
                  <li class="divider"></li>
                  <li>
                    <a href="/vales-descuentos">
                      <i class="fa fa-file-text-o"></i>
                       Reporte Vales y Descuentos Autorizados
                    </a>
                  </li>
                </ul>
             </li>
             @endif
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
            <li><a > </a></li>
            <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->persona->nombres.' '.Auth::user()->persona->apPaterno}} <i class="icon glyphicon glyphicon-cog"></i></a>
                          <ul class="dropdown-menu" style="padding: 7px 19px;">
                            <p class="text-center">{{Auth::user()->persona->perfil->nombre}}</p>
                            <div style="position: relative;text-align: center;
                                                           margin: 10px auto;"><img src="{{URL('../images/profile-pic.jpg')}}" class="ra-avatar img-responsive"><span onclick="window.location.href='/usuarios/edit/{{Auth::user()->id}}' " class="caption">Editar Usuario</span></div>
                            <li class="text-right"><a href="/logout"><i class="fa fa-sign-out"></i> Salir</a></li>
                          </ul>
                        </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

@endif
@section('content')
@if(Auth::check())
<div class="container k-content" style="margin-top:-20px;">
  <div class="row" style="background: #f2f4f8;">
    <div class="col-md-3" style="display: none;" >
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
        <li class="list-group-item @if (Request::is('recetas') || Request::is('recetas/*')) active @endif">{{ HTML::link('recetas', 'Recetas'); }}
                @if (Request::is('recetas/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('recetas/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
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
        <li class="list-group-item @if (Request::is('sabores/create') || Request::is('sabores/edit/*') || Request::is('sabores')) active @endif">{{ HTML::link('sabores', 'Sabores'); }}
                @if (Request::is('sabores/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('sabores/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        <li class="list-group-item @if (Request::is('sabores/createdet') || Request::is('sabores/editdet/*') || Request::is('sabores/indexdet')) active @endif">{{ HTML::link('sabores/indexdet', 'Agregar sabor a producto'); }}
                @if (Request::is('sabores/createdet')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('sabores/editdet/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="panel-group" id="accordion6">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion6" href="#collapseOne6">
          <i class="glyphicon glyphicon-inbox"></i> Almacen<span class="pull-right glyphicon glyphicon-chevron-down"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne6" class="panel-collapse collapse @if (Request::is('almacenes') || Request::is('almacenes/*') || Request::is('almacenes') || Request::is('almacenes/*')) in @endif">
       <div class="panel-body pb-menu">
      <ul class="list-group">
        <li class="list-group-item @if (Request::is('almacenes') || Request::is('almacenes/*')) active @endif">{{ HTML::link('almacenes', 'Almacen') }}
                @if (Request::is('almacenes/create')) <span class="text-muted pull-right">CREAR</span> @endif
                @if (Request::is('almacenes/edit/*')) <span class="text-muted pull-right">EDITAR</span> @endif
        </li>
        <li class="list-group-item @if (Request::is('almacenes') || Request::is('almacenes/*')) active @endif">{{ HTML::link('almacenes/ordenproduccion', 'Orden de Producción') }}
        <li class="list-group-item @if (Request::is('almacenes') || Request::is('almacenes/*')) active @endif">{{ HTML::link('almacenes/rarea', 'Requerimiento') }}
        <li class="list-group-item @if (Request::is('almacenes') || Request::is('almacenes/*')) active @endif">{{ HTML::link('almacenes/ordendecompra', 'Orden de Compra') }}
        </li>
        <li class="list-group-item @if (Request::is('almacenes') || Request::is('almacenes/*')) active @endif">
        {{ HTML::link('/compras', 'Compras') }}
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



    <div class="col-md-12">
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
  
  <p><br>Javier Álvarez Montenegro.<br>
  Cell: # 948 535 127.
  </p>
  <p><br><br>

  </p>
  <br>
  <br><br><br/>

  <p class="text-center"><em>®2014 Todos los derechos reservados.</em></p>
  
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

<style>
    .caption{
    opacity: .6;
    bottom: 0;
    /*top: -20px;*/
    left: 0;
    color: #fff;
    font-size: 10px;
    line-height: 9px;
    position: absolute;
    padding: 10px;
    text-align: center;
    width: 100%;
    cursor: pointer;
    background-color: #474544;
    }
</style>

</body>

</html>