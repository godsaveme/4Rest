<!DOCTYPE html>
<html>
<head>
    <title>.::4Rest::.</title>
    <!--TODO: Add CSS links-->
    <link href="css/kendo.common-bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/kendo.bootstrap.min.css" rel="stylesheet" />
    <link href="css/kendo.mobile.all.min.css" rel="stylesheet" />
    {{HTML::style('css/foundation-icons.css')}}
    {{HTML::style('css/tooltipster.css')}}
    {{HTML::style('css/themes/tooltipster-shadow.css')}}
    {{HTML::style('css/general.css')}}
    <link href="css/pedido.css" rel="stylesheet">
</head>
<body>
   <div class="splash"></div>
   <!-- Header && Footer-->
<section data-role="layout" data-id="app-toolbar">
    <div data-role="header">
        <div data-role="navbar">
            <a href="#panel" data-rel="drawer" data-role="button" data-icon="action" data-align="left">Mesas</a>
            <span data-role="view-title">My View Titlé</span>
            <a data-align="right" data-role="button" class="nav-button" href="#/" user_id ="{{Auth::user()->id}}" id ="usuario">{{Auth::user()->login}}</a>
            <a data-align="right" data-role="button" class="nav-button" href="#/" id="area" data-idlocal="{{Auth::user()->areaproduccion->id_restaurante}}" data-ida ="{{Auth::user()->areaproduccion->id}}">{{Auth::user()->areaproduccion->nombre}}</a>
        </div>
    </div>
    <footer data-role="footer">
        <div data-role="tabstrip">
            <a data-icon="globe" data-badge="0" href="#page1" id="tab_cesta">Cesta de Pedidos</a>
            <a data-icon="organize" href="#page2">Carta</a>
            <a data-icon="contacts" href="#page3">Combinaciones</a>
            <a data-icon="sortable-el" href="#page4">Platos</a>
        </div>
    </footer>
</section>
<!-- Page 1: Cesta de Pedidos -->
<div data-role="view" id="page1" data-transition="" data-layout="app-toolbar" data-title="Cesta de Pedidos"> 
    @section('cesta_view')
    @show
</div>
<!-- Page 2: Carta -->
<div data-role="view" id="page2" data-transition="" data-layout="app-toolbar" data-title="Carta">
    <div id="PanelBarCesta">
    @section('carta_view')
    @show
    </div>
</div>
<!-- Page 3: Combinaciones -->
<div data-role="view" id="page3" data-transition="" data-layout="app-toolbar" data-title="Combinaciones">
</div>
<!-- Page 3: Platos -->
<div data-role="view" id="page4" data-transition="" data-layout="app-toolbar" data-title="Platos">
    @section('platos_right_panel')
    @show
</div>
<!-- Sliding  panel -->
<div data-role="drawer" id="panel" data-title="Mesas" data-position="left">
        <header data-role="header">
            <div data-role="navbar">
                <span data-role="view-title">Mesas</span>
            </div>
        </header>

        <ul data-role="listview">
            @section('mesas_left_panel')
            @show
        </ul>
</div>
<div data-role="drawer" id="panel2" class="caja_derecha" style="margin: 0; width: 95%" data-title="" data-position="right">
    <header data-role="header">
        <div data-role="navbar">
            <span data-role="view-title">Crear Menu</span>
        </div>
    </header>
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="list-group list-group-flush templatecombiiz">
            </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="templatecombide">
                    </tr>
                </thead>
                <tbody class="listplatoscombi" id="listplatoscombi" data-fconta ="faconta" data-template="template_listacombi" data-bind="source: listacombinaciones">
                </tbody>
            </table>
            </div>
            </div>
        </div>
</div>
<!--TODO: Add JavaScript referneces-->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/kendo.all.min.js"></script>
    {{HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/jquery.tooltipster.min.js')}}
    <script src="js/pedidos.js"></script>
    <script src="js/ordenes.js"></script>
<!--FIN TODO: Add JavaScript referneces-->
</body>
</html>
