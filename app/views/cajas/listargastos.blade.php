@extends('layouts.cajamaster')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-primary "id="listadegastosmodel">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Gastos</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Importe Total</th>
                    </tr>
                </thead>
                <tbody data-template="totalgasrtos_template" data-bind="source: this">
				<script id="totalgasrtos_template" type="text/x-kendo-template">
				    <tr>
				        <td>
				           #: total()#
				        </td>
				        <td>
				           #: totalPrice()#
				        </td>
				    </tr>
				</script>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody data-template="listagastos_template" data-bind="source: listagastos">
                <script id="listagastos_template" type="text/x-kendo-template">
				    <tr>
				    	<td data-bind="text: id">
				        </td>
				        <td data-bind="text: descripcion">
				        </td>
				        <td>
				            #: kendo.toString(get("importetotal"), "C") #
				        </td>
				        <td data-bind="text: tipogasto_id"></td>
				    </tr>
				</script>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop