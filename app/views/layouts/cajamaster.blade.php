<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>4Rest -
	@section('modulo')
	Caja
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
	{{HTML::style('css/normalize.css')}}
	<!--change bootstrap for bootstrap lumen-->
	{{HTML::style('css/bootstrap/bootstrap_lumen.min.css')}}
	{{HTML::style('css/foundation-icons.css')}}
	<!--quite el bootstrap theme..-->
	{{HTML::style('css/alertify.core.css')}}
  	{{HTML::style('css/alertify.default.css')}}
  	{{HTML::style('css/kendo/kendo.common.min.css')}}
  	{{HTML::style('css/bootstrap/font-awesome/css/font-awesome.min.css')}}
  	{{HTML::style('css/kendo/kendo.fiori.min.css')}}
  	{{HTML::style('css/kendo/kendo.mobile.all.min.css')}}
  	{{HTML::style('css/line/green.css')}}
  	{{HTML::style('css/tooltipster.css')}}
  	{{HTML::style('css/themes/tooltipster-light.css')}}
  	{{HTML::style('css/generalx2.css')}}
  	{{HTML::style('css/notificaciones.css')}}
  	<!--add fonts-->
  	{{HTML::style('css/newstyles/fonts.css')}}
  	<link rel="shortcut icon" sizes="128x128" href="/images/productos/favicon.png">
  	@yield('css')
  	{{HTML::script('js/vendor/modernizr.js'); }}
  	{{HTML::script('js/vendor/jquery.js'); }}
  	{{HTML::script('js/bootstrap.min.js')}}
  	<script src="/dev/socket.io/socket.io.js"></script>
  	{{HTML::script('js/jquery.plugin.js'); }}
  	{{HTML::script('js/jquery.tooltipster.min.js')}}
  	{{HTML::script('js/kendo/kendo.all.min.js')}}
  	{{HTML::script('js/kendo/kendo.culture.es-PE.min.js')}}
  	{{HTML::script('js/kendo/kendo.messages.es-ES.min.js')}}
  	{{HTML::script('js/icheck.min.js')}}
  	{{HTML::script('js/timeago.js')}}
  	{{HTML::script('js/jquery.countup.js')}}
  	{{HTML::script('js/funcionescaja.js')}}
  	{{HTML::script('js/drawer.js')}}
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
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<button type="button" class="navbar-toggle pull-right" id="btn_drawerder" style="margin: 10px; display:block">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
</button>
<button type="button" class="navbar-toggle pull-left" id="btn_draweriz" style="margin: 10px; display:block">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
</button>
<div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="/web" class="navbar-brand title" id="prueba">4 Rest</a>
        </div>
        <!-- en header navbar-->
        <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <?php $segmento = Request::segment(2);?>
      	@if ($segmento == 'cargarmesa')
      	<ul class="nav navbar-nav">
	        <li class="negrita">
	        <a href="javascript:void(0)" id="infomesa" data-id="{{$mesa->id}}"
	        @if(isset($detcaja))
	        	data-cajaid = "{{$detcaja->caja_id}}"
	        	data-detcajaid = "{{$detcaja->id}}"
	        @endif
	        >{{$mesa->nombre}}</a></li>
	        @if (isset($Opedido))
	        <li class="negrita"><a href="javascript:void(0)" id="infomozo" data-idpedido="{{$Opedido->id}}" data-idmozo ="{{$Opedido->usuario->id}}">{{$Opedido->usuario->login}}</a></li>
	        @endif
	        @if (isset($infomozo))
	        <li class="negrita"><a href="javascript:void(0)" id="infomozo" data-idpedido="0" data-idmozo ="{{$infomozo->id}}">{{$infomozo->login}}</a></li>
	        @endif
	    </ul>

      	@endif
	      <ul class="nav navbar-nav navbar-right">
	      @if (Auth::user()->persona->perfil->nombre != 'Administrador')
	      	<li>
      			<a href="javascript:void(0)" id="btn_controlpedidos">
      				Lista de Pedidos
      			</a>
      		</li>
	      	<li>
      			<a href="javascript:void(0)" id="btn_notificaciones">
      				Notificaciones 
      			</a>
      		</li>
	      @endif
	      	@if(Auth::check())
		        <li class="dropdown">
		          <a href="javascript:void(0)" user_id ="{{Auth::user()->id}}" id ="usuario" class="dropdown-toggle" data-toggle="dropdown">
		          {{Auth::user()->login}} <b class="caret"></b>
		          </a>
		          <ul class="dropdown-menu">
		            <li>{{HTML::linkAsset('logout', 'Salir')}} </li>
		          </ul>
		        </li>
		        <li>
		        @if (isset($monitor))
		        <a href="javascript:void(0)" id="area" data-idlocal="{{$area->id_restaurante}}" data-ida ="{{$area->id}}">{{$area->nombre}}</a>
		        @else
		        <?php $nombrearea= Areadeproduccion::find(Auth::user()->id_tipoareapro); ?>
		          <a href="javascript:void(0)" id="area" data-idlocal="{{$nombrearea->id_restaurante}}" data-ida ="{{$nombrearea->id}}">{{$nombrearea->nombre}}</a>
		        @endif
		        </li>
         	@endif
	      </ul>
	    </div>
    	<!-- /.navbar-collapse -->
</div>
</nav>

<div class="caja_derecha">
<div class="panel panel-info panel_combinaciones" style="display:none">
			<div class="panel-heading text-center">
				<h5 class="negrita"> <span id="menutitulo">nombrecombinacion</span> x <span class="cantidad_menu">0</span>&nbsp;&nbsp;
				<div class="btn-group">
				  <button type="button" class="btn btn-default btn_pluscmenu"><span class="glyphicon glyphicon-plus"></span></button>
				  <button type="button" class="btn btn-default btn_minuscmenu"><span class="glyphicon glyphicon-minus"></span></button>
				</div>
				<button type="button" class="btn btn-danger pull-right" id="btn_cancelar_combi">Cancelar</button>
				<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btn_ordenarcombi">Ordenar</button>
				</h5>
			</div>
			<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<ul class="list-group list-group-flush templatecombiiz">
			</ul>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<table class="table table-striped table-hover">
				<thead>
					<tr class="templatecombide">
					</tr>
				</thead>
				<tbody class="listplatoscombi" id="listplatoscombi" data-fconta ="faconta">
				</tbody>
			</table>
			</div>
			</div>
		</div>
	<script type="text/x-kendo-template" id="template_combi_iz">
	#var f = 0#
	# for (var i in familias) { #
				<li class="list-group-item">
					<span class="negrita #=familias[i]['familiaid']#" data-idfila ="#=f#" data-idselec ="0" data-cantidad="#=familias[i]['cantidad']#">#=familias[i]['familianombre']#</span> <br>	
					<div class="btn-group">
					#for (var j in familias[i]['productos']) {#
						<button type="button" class="btn btn-default procombi" data-faid ="#=familias[i]['familiaid']#" data-cantidad="#=familias[i]['cantidad']#" data-procompre = "#=familias[i]['productos'][j]['precio']#"
						data-procombiid ="#=familias[i]['productos'][j]['id']#">#=familias[i]['productos'][j]['nombre']#</button>
					#}#
					</div>
				</li>
				#for (var j = 0; j < familias[i]['cantidad']; j++) {#
					#f++#
				#}#
        	# } #
	</script>

	<script type="text/x-kendo-template" id="template_combi_de">
	#var faconta = 0#
	#for (var i in familias) {#
		#for (var j = 0; j < familias[i]['cantidad']; j++) {#
			<th>#=familias[i]['familianombre']#</th>
			#faconta++#
		#}#
	#}#
	<input type="hidden" value="#=faconta#" id="fcombicantidad">
	</script>

	<script type="text/x-kendo-template" id="template_listacombi">
	<tr>
	#for (var i = 0; i< cantidad; i++){#
		<td data-listaid="#=id#" data-pro= "#=producombi[i]#">#=eval(producombi[i]).nombre#</td>
	#}#
	</tr>
	</script>
</div>
<div class="container" id="contenido">
    @yield('content')

@if (Auth::user()->persona->perfil->nombre != 'Administrador')
	<div id="windowsnotificaciones" style="display:none"r>
    	<span id="notificationpedidos" style="display:none;"></span>
    </div>
@endif
    <script id="notificacionpedidos" type="text/x-kendo-template">
        <div class="new-mail">
            <h3>Mesa: #=mesa #</h3>
            <p>Mozo: #=mozo #</p>
            <p>Plato: #=producto #</p>
        </div>
    </script>
    <div id="windowscontrolpedidos" style="display:none">
    	<div class="panel panel-info">
            <div class="panel-heading">
            	Control Pedidos
            </div>
            <div id="lista_controlpedidos">
            	<table class="table">
            			@if (isset($platoscontrol))
            			@foreach ($platoscontrol as $platocontrol)
            			<tr class="{{$platocontrol->estado}}" data-iddetped="{{$platocontrol->id}}" data-estado="{{$platocontrol->estado}}">
            				<td style="line-height: 30px; background: silver;">
            					{{HTML::image('images/'.$platocontrol->estado.'.png', 'alt', array('height'=>30, 'width'=>30))}}
		            			@if ($platocontrol->estado == 'I')
		            				<time class="timeago" datetime="{{str_replace(' ','T', $platocontrol->fechaInicio)}}-05:00" style="color:red"></time>
		            			@elseif($platocontrol->estado == 'P')
		            				<time class="timeago" datetime="{{str_replace(' ','T', $platocontrol->fechaProceso)}}-05:00" style="color:red"></time>
		            			@elseif($platocontrol->estado == 'E')
		            				<time class="timeago" datetime="{{str_replace(' ','T', $platocontrol->fechaDespacho)}}-05:00" style="color:red"></time>
		            			@endif
            				</td>
            				<td style="line-height: 30px">
            					&nbsp;{{$platocontrol->mesa}} / {{$platocontrol->nombre}} x {{$platocontrol->cantidad}} / ({{$platocontrol->login}}) <time class="timeago pull-right" datetime="{{str_replace(' ','T', $platocontrol->fechaInicio)}}-05:00"></time>
            				</td>
            			</tr>
            			@endforeach
            			@endif
            	</table>
            </div>
        </div>
    </div>

    <script id="refresh_listcontrolpedidos" type="text/x-kendo-template">
    <table class="table" id="lista_controlpedidos">
    	#for (var i in listaplatos) {#
    	<tr class="#=listaplatos[i]['estado']#" data-iddetped="#=listaplatos[i]['id']#" data-estado="#=listaplatos[i]['estado']#">
			<td style="line-height: 30px; background: silver;">
				<img width="30" height="30" alt="alt" src="/images/#=listaplatos[i]['estado']#.png">
	    		#if (listaplatos[i]['estado'] == 'I') {#
	    			<time class="timeago" datetime="#=(listaplatos[i]['fechaInicio']).replace(" ", "T")#-05:00" style="color:red"></time>
	    		#}else if (listaplatos[i]['estado'] == 'P'){#
	    			<time class="timeago" datetime="#=(listaplatos[i]['fechaProceso']).replace(" ", "T")#-05:00" style="color:red"></time>
	    		#}else if(listaplatos[i]['estado'] == 'E'){#
	    			<time class="timeago" datetime="#=(listaplatos[i]['fechaDespacho']).replace(" ", "T")#-05:00" style="color:red"></time>
	    		#}#
			</td>
			<td style="line-height: 30px">
				&nbsp;#=listaplatos[i]['mesa']# / #=listaplatos[i]['nombre']# x #=listaplatos[i]['cantidad']# / 
			(#=listaplatos[i]['login']#) <time class="timeago pull-right" datetime="#=(listaplatos[i]['fechaInicio']).replace(" ", "T")#-05:00"></time>
			</td>
        </tr>
    	#}#
    </table>
    </script>
</div>
<audio id="sonido_mesas" src="/sound/cocina.mp3"> </audio>
 <span id="popupNotification"></span>
 <span id="notificaciones_mesas"></span>
<div class="caja_izquierda">
@if (isset($detcaja))
	<div id="space"></div>
	<div class="container">
		<section class="row">
			<article class="col-sm-3 col-md-3 col-lg-3">
				<ul class="list-group">
					<li class="list-group-item list_menu">
					<a href="/cajas"><i class="fa fa-plus-square-o"></i> Caja
					</a>
					</li>
					<li class="list-group-item list_menu">
					<a href="/cajas/registrargasto/{{$detcaja->id}}"><i class="fa fa-plus-square-o"></i> Registrar Gasto</a>
					</li>
					<li class="list-group-item list_menu">
					<a href="/cajas/registraringreso/{{$detcaja->id}}"><i class="fa fa-plus-square-o"></i> Registrar Ingreso</a>
					</li>
					<li class="list-group-item list_menu">
					<a href="/cajas/listargastos"><i class="fa fa-plus-square-o"></i> Lista de Gastos</a>
					</li>
					<li class="list-group-item list_menu">
                    <a href="/cajas/listaringresos"><i class="fa fa-plus-square-o"></i> Lista de Ingresos</a>
                    </li>
					<!--<li class="list-group-item list_menu">
					<a href="/eventos/listareventoscaja">Lista de Eventos</a>
					</li>-->
					<li class="list-group-item list_menu">
					<a href="/cajas/listarventas?tipoc=1"><i class="fa fa-plus-square-o"></i> Ventas Totales</a>
					</li>
					<li class="list-group-item list_menu">
						<a href="/combinacions/create" target="_blank"><i class="fa fa-plus-square-o"></i> Crear Menú</a>
					</li>
					<li class="list-group-item list_menu">
						<a href="/productos/create" target="_blank"><i class="fa fa-plus-square-o"></i> Crear Producto</a>
					</li>
					<li class="list-group-item list_menu">
					<a href="/monitores/monitorgeneral/{{Auth::user()->id_restaurante}}" target="_blank"><i class="fa fa-plus-square-o"></i> Monitor</a>
					</li>
					<li class="list-group-item list_menu">
					<a href="/cajas/cerrarcaja/{{$detcaja->id}}"><i class="fa fa-plus-square-o"></i> Cerrar Caja</a>
					</li>
				</ul>
			</article>
		</section>
	</div>
@endif
</div>
	
</body>
</html>
