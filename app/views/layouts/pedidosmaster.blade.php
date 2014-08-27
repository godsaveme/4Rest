<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width, initial-scale=1, maximum-scale=1" />
    <title>4Rest - Pedidos</title>
    {{HTML::style('css/normalize.css')}}
    {{HTML::style('css/font-awesome.min.css')}}
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
        <i class="fa fa-envelope-o"></i>
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
{{HTML::script('pedidost/pedidostablet.js')}}
</body>
</html>