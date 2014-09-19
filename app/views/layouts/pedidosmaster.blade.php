<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width, initial-scale=1, maximum-scale=1" />
    <title>4Rest - Pedidos</title>
    {{HTML::style('css/normalize.css')}}
    {{HTML::style('css/font-awesome.min.css')}}
    {{HTML::style('pedidost/flaticon.css')}}
    {{HTML::style('pedidost/nprogress.css')}}
    {{HTML::style('pedidost/pedidos.css')}}
</head>
<body>
<header>
<div class="titulo">
    4Rest - Kango Café <span id="nombremesa"></span>
</div>

<div class="usuario">
    <div class="notificaciones">
        <i class="fa fa-envelope"></i>
    </div>
    {{Auth::user()->login}}
</div>
</header>
<section>
@yield('content')

</section>
<footer>
    
</footer>
{{HTML::script('js/kendo/jquery-2.1.0.min.js')}}
{{HTML::script('pedidost/nprogress.js')}}
{{HTML::script('pedidost/hammer.min.js')}}
{{HTML::script('pedidost/hammer.jquery.js')}}
{{HTML::script('js/underscore-min.js')}}
{{HTML::script('js/backbone-min.js')}}
{{HTML::script('js/backbone.localStorage-min.js')}}
<script src="/dev/socket.io/socket.io.js"></script>
<script src="/js/vendor/neon.js"></script>
<script src="/js/vendor/CustomEvent.js"></script>
<script src="/js/vendor/CustomEventSupport.js"></script>
<script src="/js/vendor/PonyExpress.js"></script>
{{HTML::script('pedidost/init.js')}}

<script src="/pedidost/app/models/familias.js"></script>
<script src="/pedidost/app/collections/familias.js"></script>
<script src="/pedidost/app/views/familias-view.js"></script>
<script src="/pedidost/app/models/tipocombinaciones.js"></script>
<script src="/pedidost/app/collections/tipocombinaciones.js"></script>
<script src="/pedidost/app/views/tipocombinaciones-view.js"></script>
<script src="/pedidost/app/models/combinaciones.js"></script>
<script src="/pedidost/app/collections/combinaciones.js"></script>
<script src="/pedidost/app/views/combinaciones-view.js"></script>
<script src="/pedidost/app/models/productos.js"></script>
<script src="/pedidost/app/collections/productos.js"></script>
<script src="/pedidost/app/views/productos-view.js"></script>
<script src="/pedidost/app/models/pcombinaciones.js"></script>
<script src="/pedidost/app/collections/pcombinaciones.js"></script>
<script src="/pedidost/app/views/pcombinaciones-view.js"></script>
<script src="/pedidost/app/models/combinacionescesta.js"></script>
<script src="/pedidost/app/collections/combinacionescesta.js"></script>
<script src="/pedidost/app/views/combinacionescesta-view.js"></script>
<script src="/pedidost/app/models/productoscesta.js"></script>
<script src="/pedidost/app/collections/productoscesta.js"></script>
<script src="/pedidost/app/views/productoscesta-view.js"></script>
<script src="/pedidost/app/models/productosmesa.js"></script>
<script src="/pedidost/app/collections/productosmesa.js"></script>
<script src="/pedidost/app/views/productosmesa-view.js"></script>
<script src="/pedidost/app/models/notas.js"></script>
<script src="/pedidost/app/collections/notas.js"></script>
<script src="/pedidost/app/views/notas-view.js"></script>
<script src="/pedidost/app/models/sabores.js"></script>
<script src="/pedidost/app/collections/sabores.js"></script>
<script src="/pedidost/app/views/sabores-view.js"></script>
<script src="/pedidost/app/models/adicionales.js"></script>
<script src="/pedidost/app/collections/adicionales.js"></script>
<script src="/pedidost/app/views/adicionales-view.js"></script>
<script src="/pedidost/app/models/mesas.js"></script>
<script src="/pedidost/app/collections/mesas.js"></script>
<script src="/pedidost/app/views/mesas-view.js"></script>
<script src="/pedidost/app/models/productosusuario.js"></script>
<script src="/pedidost/app/collections/productosusuario.js"></script>
<script src="/pedidost/app/views/productosusuario-view.js"></script>
<script src="/pedidost/app/models/usuario.js"></script>
<script src="/pedidost/app/collections/usuario.js"></script>
<script src="/pedidost/app/models/cocinas.js"></script>
<script src="/pedidost/app/collections/cocinas.js"></script>

<script src="/pedidost/app/views/app-view.js"></script>
<script src="/pedidost/app/routers/base.js"></script>

{{HTML::script('pedidost/main.js')}}

{{HTML::script('pedidost/pedidostablet.js')}}
</body>
</html>